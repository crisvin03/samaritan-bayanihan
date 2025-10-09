<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DocumentVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerificationController extends Controller
{
    public function index()
    {
        $pendingUsers = User::where('verification_status', 'pending')
            ->orWhere('verification_status', 'email_verified')
            ->orWhere('verification_status', 'phone_verified')
            ->orWhere('verification_status', 'documents_uploaded')
            ->with(['documentVerifications' => function($query) {
                $query->where('status', 'pending');
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $approvedUsers = User::where('verification_status', 'approved')
            ->with('documentVerifications')
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        $rejectedUsers = User::where('verification_status', 'rejected')
            ->with('documentVerifications')
            ->orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('admin.verification.index', compact('pendingUsers', 'approvedUsers', 'rejectedUsers'));
    }

    public function show(User $user)
    {
        $user->load(['documentVerifications', 'role']);
        return view('admin.verification.show', compact('user'));
    }

    public function approve(User $user, Request $request)
    {
        $request->validate([
            'notes' => 'nullable|string|max:500'
        ]);

        $user->update([
            'verification_status' => 'approved',
            'status' => 'active',
            'rejection_reason' => null
        ]);

        // Update all pending documents as approved
        $user->documentVerifications()
            ->where('status', 'pending')
            ->update([
                'status' => 'approved',
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now()
            ]);

        // Send notification to user
        // TODO: Implement notification system

        return redirect()->route('admin.verification.index')
            ->with('success', 'User verification approved successfully.');
    }

    public function reject(User $user, Request $request)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000'
        ]);

        $user->update([
            'verification_status' => 'rejected',
            'status' => 'inactive',
            'rejection_reason' => $request->rejection_reason
        ]);

        // Update all pending documents as rejected
        $user->documentVerifications()
            ->where('status', 'pending')
            ->update([
                'status' => 'rejected',
                'rejection_reason' => $request->rejection_reason,
                'reviewed_by' => auth()->id(),
                'reviewed_at' => now()
            ]);

        // Send notification to user
        // TODO: Implement notification system

        return redirect()->route('admin.verification.index')
            ->with('success', 'User verification rejected.');
    }

    public function approveDocument(DocumentVerification $document, Request $request)
    {
        $document->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
            'rejection_reason' => null
        ]);

        // Check if all documents are approved
        $user = $document->user;
        $allDocumentsApproved = $user->documentVerifications()
            ->where('status', '!=', 'approved')
            ->count() === 0;

        if ($allDocumentsApproved) {
            $user->update([
                'verification_status' => 'approved',
                'status' => 'active'
            ]);
        }

        return back()->with('success', 'Document approved successfully.');
    }

    public function rejectDocument(DocumentVerification $document, Request $request)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $document->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now()
        ]);

        return back()->with('success', 'Document rejected.');
    }

    public function downloadDocument(DocumentVerification $document)
    {
        if (!Storage::exists($document->file_path)) {
            return back()->with('error', 'Document file not found.');
        }

        return Storage::download($document->file_path, $document->file_name);
    }
}