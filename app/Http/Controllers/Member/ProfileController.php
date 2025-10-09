<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Events\DocumentVerificationStatusChanged;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('member.profile.show', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('member.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'occupation' => 'nullable|string|max:255',
        ]);

        $user->update($request->only([
            'name', 'email', 'phone_number', 'address',
            'birth_date', 'gender', 'occupation'
        ]));

        return redirect()->route('member.profile.show')
            ->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('member.profile.show')
            ->with('success', 'Password updated successfully.');
    }

    public function uploadDocuments(Request $request)
    {
        $user = auth()->user();
        
        // Check if user is already verified
        if ($user->verification_status === 'approved') {
            return back()->with('error', 'You are already a verified member.');
        }

        $request->validate([
            'documents' => 'required|array|min:1',
            'documents.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240',
        ], [
            'documents.required' => 'Please upload at least one identification document.',
            'documents.min' => 'Please upload at least one identification document.',
            'documents.*.file' => 'Each document must be a valid file.',
            'documents.*.mimes' => 'Documents must be in JPG, PNG, or PDF format.',
            'documents.*.max' => 'Each document must not exceed 10MB.',
        ]);

        // Handle document uploads
        if ($request->hasFile('documents')) {
            $documents = $request->file('documents');
            $uploadedDocuments = [];
            
            foreach ($documents as $document) {
                $filename = time() . '_' . $document->getClientOriginalName();
                $path = $document->storeAs('documents/verification', $filename, 'public');
                
                $uploadedDocuments[] = [
                    'user_id' => $user->id,
                    'document_type' => 'other',
                    'document_name' => $document->getClientOriginalName(),
                    'file_path' => $path,
                    'file_name' => $document->getClientOriginalName(),
                    'file_size' => (string)$document->getSize(),
                    'mime_type' => $document->getMimeType(),
                    'status' => 'pending',
                    'uploaded_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            
            // Store document records in database
            \DB::table('document_verifications')->insert($uploadedDocuments);
            
            // Update user verification status to pending
            $user->update([
                'verification_status' => 'pending'
            ]);

            // Dispatch notification event
            event(new DocumentVerificationStatusChanged($user->id, 'pending'));
        }

        return redirect()->route('member.profile.show')
            ->with('success', 'Documents uploaded successfully! They are now under review for member verification.');
    }
}