<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\User;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index(Request $request)
    {
        $query = Benefit::with(['user', 'reviewedBy']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('benefit_type', 'like', "%{$search}%")
                  ->orWhere('reason', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by benefit type
        if ($request->filled('benefit_type')) {
            $query->where('benefit_type', $request->benefit_type);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $benefits = $query->latest()->paginate(15);

        return view('admin.benefits.index', compact('benefits'));
    }

    public function show(Benefit $benefit)
    {
        $benefit->load(['user', 'reviewedBy']);
        return view('admin.benefits.show', compact('benefit'));
    }

    public function edit(Benefit $benefit)
    {
        return view('admin.benefits.edit', compact('benefit'));
    }

    public function update(Request $request, Benefit $benefit)
    {
        $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected,disbursed',
            'admin_notes' => 'nullable|string',
            'approved_amount' => 'nullable|numeric|min:0',
        ]);

        $data = $request->only(['status', 'admin_notes', 'approved_amount']);

        // If status is being changed to approved/rejected, set reviewed_by and reviewed_at
        if (in_array($request->status, ['approved', 'rejected'])) {
            $data['reviewed_by'] = auth()->id();
            $data['reviewed_at'] = now();
        }

        // If status is being changed to disbursed, set disbursed_at
        if ($request->status === 'disbursed') {
            $data['disbursed_at'] = now();
        }

        $benefit->update($data);

        return redirect()->route('admin.benefits.show', $benefit)
            ->with('success', 'Benefit application updated successfully.');
    }

    public function destroy(Benefit $benefit)
    {
        $benefit->delete();

        return redirect()->route('admin.benefits.index')
            ->with('success', 'Benefit application deleted successfully.');
    }

    public function approve(Benefit $benefit, Request $request)
    {
        $request->validate([
            'approved_amount' => 'required|numeric|min:0',
            'admin_notes' => 'nullable|string',
        ]);

        $benefit->update([
            'status' => 'approved',
            'approved_amount' => $request->approved_amount,
            'admin_notes' => $request->admin_notes,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Benefit application approved successfully.');
    }

    public function reject(Benefit $benefit, Request $request)
    {
        $request->validate([
            'admin_notes' => 'required|string',
        ]);

        $benefit->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Benefit application rejected successfully.');
    }

    public function disburse(Benefit $benefit)
    {
        if ($benefit->status !== 'approved') {
            return redirect()->back()
                ->with('error', 'Only approved benefits can be disbursed.');
        }

        $benefit->update([
            'status' => 'disbursed',
            'disbursed_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Benefit disbursed successfully.');
    }
}