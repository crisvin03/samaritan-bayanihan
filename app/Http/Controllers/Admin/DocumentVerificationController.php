<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentVerification;
use App\Models\User;
use App\Events\DocumentVerificationStatusChanged;

class DocumentVerificationController extends Controller
{
    public function index()
    {
        $pendingDocuments = DocumentVerification::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.document-verification.index', compact('pendingDocuments'));
    }

    public function approve(Request $request, $id)
    {
        $document = DocumentVerification::findOrFail($id);
        $user = $document->user;

        // Update document status
        $document->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        // Update user verification status
        $user->update([
            'verification_status' => 'approved'
        ]);

        // Dispatch notification
        event(new DocumentVerificationStatusChanged($user->id, 'approved'));

        return back()->with('success', 'Document approved successfully. User is now verified.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $document = DocumentVerification::findOrFail($id);
        $user = $document->user;

        // Update document status
        $document->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        // Update user verification status
        $user->update([
            'verification_status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        // Dispatch notification
        event(new DocumentVerificationStatusChanged($user->id, 'rejected', $request->rejection_reason));

        return back()->with('success', 'Document rejected. User has been notified.');
    }

    public function show($id)
    {
        $document = DocumentVerification::with('user')->findOrFail($id);
        return view('admin.document-verification.show', compact('document'));
    }
}
