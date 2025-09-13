<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index()
    {
        $benefits = auth()->user()->benefits()
            ->latest()
            ->paginate(10);

        return view('member.benefits.index', compact('benefits'));
    }

    public function myRequests()
    {
        $benefits = auth()->user()->benefits()
            ->latest()
            ->paginate(12);

        return view('member.benefits.my-requests', compact('benefits'));
    }

    public function create()
    {
        $benefitTypes = [
            'hospitalization' => 'Hospitalization Benefit',
            'burial' => 'Burial Assistance',
            'animal_bite' => 'Animal Bite Assistance',
            'accidental' => 'Accidental Assistance',
            'outpatient' => 'Outpatient Benefit',
            'birthday' => 'Birthday Gift',
        ];

        return view('member.benefits.create', compact('benefitTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'benefit_type' => 'required|string|max:255',
            'requested_amount' => 'required|numeric|min:0.01',
            'reason' => 'required|string',
            'supporting_documents' => 'nullable|array',
            'supporting_documents.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->only(['benefit_type', 'requested_amount', 'reason']);
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        // Handle file uploads
        if ($request->hasFile('supporting_documents')) {
            $documents = [];
            foreach ($request->file('supporting_documents') as $file) {
                $documents[] = $file->store('benefits', 'public');
            }
            $data['supporting_documents'] = $documents;
        }

        $benefit = Benefit::create($data);

        // Create notification for new application
        $this->createBenefitNotification($benefit, 'submitted');

        return redirect()->route('member.benefits.index')
            ->with('success', 'Benefit application submitted successfully.');
    }

    public function show(Benefit $benefit)
    {
        // Ensure the benefit belongs to the authenticated user
        if ($benefit->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        return view('member.benefits.show', compact('benefit'));
    }

    public function edit(Benefit $benefit)
    {
        // Ensure the benefit belongs to the authenticated user
        if ($benefit->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        // Only allow editing if status is pending
        if ($benefit->status !== 'pending') {
            return redirect()->route('member.benefits.show', $benefit)
                ->with('error', 'You can only edit pending applications.');
        }

        $benefitTypes = [
            'hospitalization' => 'Hospitalization Benefit',
            'burial' => 'Burial Assistance',
            'animal_bite' => 'Animal Bite Assistance',
            'accidental' => 'Accidental Assistance',
            'outpatient' => 'Outpatient Benefit',
            'birthday' => 'Birthday Gift',
        ];

        return view('member.benefits.edit', compact('benefit', 'benefitTypes'));
    }

    public function update(Request $request, Benefit $benefit)
    {
        // Ensure the benefit belongs to the authenticated user
        if ($benefit->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        // Only allow editing if status is pending
        if ($benefit->status !== 'pending') {
            return redirect()->route('member.benefits.show', $benefit)
                ->with('error', 'You can only edit pending applications.');
        }

        $request->validate([
            'benefit_type' => 'required|string|max:255',
            'requested_amount' => 'required|numeric|min:0.01',
            'reason' => 'required|string',
            'supporting_documents' => 'nullable|array',
            'supporting_documents.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->only(['benefit_type', 'requested_amount', 'reason']);

        // Handle file uploads
        if ($request->hasFile('supporting_documents')) {
            $documents = [];
            foreach ($request->file('supporting_documents') as $file) {
                $documents[] = $file->store('benefits', 'public');
            }
            $data['supporting_documents'] = $documents;
        }

        $benefit->update($data);

        return redirect()->route('member.benefits.show', $benefit)
            ->with('success', 'Benefit application updated successfully.');
    }

    public function destroy(Benefit $benefit)
    {
        // Ensure the benefit belongs to the authenticated user
        if ($benefit->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access.');
        }

        // Only allow deletion if status is pending
        if ($benefit->status !== 'pending') {
            return redirect()->route('member.benefits.show', $benefit)
                ->with('error', 'You can only delete pending applications.');
        }

        $benefit->delete();

        return redirect()->route('member.benefits.index')
            ->with('success', 'Benefit application deleted successfully.');
    }

    private function createBenefitNotification($benefit, $action)
    {
        // In a real application, this would create a database record
        // For now, we'll just log it or handle it in the notification system
        \Log::info("Benefit notification created: {$benefit->id} - {$action}");
    }
}