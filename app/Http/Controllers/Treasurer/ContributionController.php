<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\User;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $barangay = $user->barangay;

        $query = Contribution::forBarangay($barangay)->with(['user', 'recordedBy']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('reference_number', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
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

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('contribution_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('contribution_date', '<=', $request->date_to);
        }

        $contributions = $query->latest()->paginate(15);

        return view('treasurer.contributions.index', compact('contributions', 'barangay'));
    }

    public function create()
    {
        $user = auth()->user();
        $members = User::byRole('member')->forBarangay($user->barangay)->active()->get();
        
        return view('treasurer.contributions.create', compact('members'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $barangay = $user->barangay;

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:weekly_savings,special_contribution,penalty,other',
            'reference_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'contribution_date' => 'required|date',
            'proof_of_payment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Ensure the member belongs to the treasurer's barangay
        $member = User::findOrFail($request->user_id);
        if ($member->barangay !== $barangay) {
            return back()->withErrors(['user_id' => 'You can only record contributions for members in your barangay.']);
        }

        $data = $request->only([
            'user_id', 'amount', 'type', 'reference_number',
            'description', 'contribution_date'
        ]);

        $data['recorded_by'] = auth()->id();
        $data['status'] = 'pending'; // Treasurer entries need admin validation

        // Handle file upload
        if ($request->hasFile('proof_of_payment')) {
            $data['proof_of_payment'] = $request->file('proof_of_payment')
                ->store('contributions', 'public');
        }

        Contribution::create($data);

        return redirect()->route('treasurer.contributions.index')
            ->with('success', 'Contribution recorded successfully. It will be reviewed by an administrator.');
    }

    public function show(Contribution $contribution)
    {
        $user = auth()->user();
        
        // Ensure the contribution belongs to a member in the treasurer's barangay
        if ($contribution->user->barangay !== $user->barangay) {
            abort(403, 'You can only view contributions from your assigned barangay.');
        }

        $contribution->load(['user', 'recordedBy']);
        return view('treasurer.contributions.show', compact('contribution'));
    }

    public function edit(Contribution $contribution)
    {
        $user = auth()->user();
        
        // Ensure the contribution belongs to a member in the treasurer's barangay
        if ($contribution->user->barangay !== $user->barangay) {
            abort(403, 'You can only edit contributions from your assigned barangay.');
        }

        // Only allow editing if status is pending
        if ($contribution->status !== 'pending') {
            return redirect()->route('treasurer.contributions.show', $contribution)
                ->with('error', 'You can only edit pending contributions.');
        }

        $members = User::byRole('member')->forBarangay($user->barangay)->active()->get();
        
        return view('treasurer.contributions.edit', compact('contribution', 'members'));
    }

    public function update(Request $request, Contribution $contribution)
    {
        $user = auth()->user();
        
        // Ensure the contribution belongs to a member in the treasurer's barangay
        if ($contribution->user->barangay !== $user->barangay) {
            abort(403, 'You can only edit contributions from your assigned barangay.');
        }

        // Only allow editing if status is pending
        if ($contribution->status !== 'pending') {
            return redirect()->route('treasurer.contributions.show', $contribution)
                ->with('error', 'You can only edit pending contributions.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:weekly_savings,special_contribution,penalty,other',
            'reference_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'contribution_date' => 'required|date',
            'proof_of_payment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Ensure the member belongs to the treasurer's barangay
        $member = User::findOrFail($request->user_id);
        if ($member->barangay !== $user->barangay) {
            return back()->withErrors(['user_id' => 'You can only record contributions for members in your barangay.']);
        }

        $data = $request->only([
            'user_id', 'amount', 'type', 'reference_number',
            'description', 'contribution_date'
        ]);

        // Handle file upload
        if ($request->hasFile('proof_of_payment')) {
            $data['proof_of_payment'] = $request->file('proof_of_payment')
                ->store('contributions', 'public');
        }

        $contribution->update($data);

        return redirect()->route('treasurer.contributions.show', $contribution)
            ->with('success', 'Contribution updated successfully.');
    }

    public function destroy(Contribution $contribution)
    {
        $user = auth()->user();
        
        // Ensure the contribution belongs to a member in the treasurer's barangay
        if ($contribution->user->barangay !== $user->barangay) {
            abort(403, 'You can only delete contributions from your assigned barangay.');
        }

        // Only allow deletion if status is pending
        if ($contribution->status !== 'pending') {
            return redirect()->route('treasurer.contributions.show', $contribution)
                ->with('error', 'You can only delete pending contributions.');
        }

        $contribution->delete();

        return redirect()->route('treasurer.contributions.index')
            ->with('success', 'Contribution deleted successfully.');
    }
}