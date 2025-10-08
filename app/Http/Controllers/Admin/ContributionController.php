<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function index(Request $request)
    {
        $query = Contribution::with(['user', 'recordedBy']);

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

        return view('admin.contributions.index', compact('contributions'));
    }

    public function create()
    {
        $members = User::byRole('member')->active()->get();
        return view('admin.contributions.create', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:weekly_savings,special_contribution,penalty,other',
            'reference_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'contribution_date' => 'required|date',
            'proof_of_payment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->only([
            'user_id', 'amount', 'type', 'reference_number',
            'description', 'contribution_date'
        ]);

        $data['recorded_by'] = auth()->id();
        $data['status'] = 'validated'; // Admin entries are auto-validated

        // Handle file upload
        if ($request->hasFile('proof_of_payment')) {
            $data['proof_of_payment'] = $request->file('proof_of_payment')
                ->store('contributions', 'public');
        }

        Contribution::create($data);

        return redirect()->route('admin.contributions.index')
            ->with('success', 'Contribution recorded successfully.');
    }

    public function show(Contribution $contribution)
    {
        $contribution->load(['user', 'recordedBy']);
        return view('admin.contributions.show', compact('contribution'));
    }

    public function edit(Contribution $contribution)
    {
        $members = User::byRole('member')->active()->get();
        return view('admin.contributions.edit', compact('contribution', 'members'));
    }

    public function update(Request $request, Contribution $contribution)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:weekly_savings,special_contribution,penalty,other',
            'reference_number' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'contribution_date' => 'required|date',
            'status' => 'required|in:pending,validated,rejected',
            'validation_notes' => 'nullable|string',
            'proof_of_payment' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->only([
            'user_id', 'amount', 'type', 'reference_number',
            'description', 'contribution_date', 'status', 'validation_notes'
        ]);

        // Handle file upload
        if ($request->hasFile('proof_of_payment')) {
            $data['proof_of_payment'] = $request->file('proof_of_payment')
                ->store('contributions', 'public');
        }

        $oldStatus = $contribution->status;
        $contribution->update($data);

        // Trigger notification if status changed
        if ($oldStatus !== $request->status) {
            $this->notificationService->createContributionStatusNotification($contribution, $oldStatus, $request->status);
        }

        return redirect()->route('admin.contributions.show', $contribution)
            ->with('success', 'Contribution updated successfully.');
    }

    public function destroy(Contribution $contribution)
    {
        $contribution->delete();

        return redirect()->route('admin.contributions.index')
            ->with('success', 'Contribution deleted successfully.');
    }

    public function validate(Contribution $contribution, Request $request)
    {
        $request->validate([
            'status' => 'required|in:validated,rejected',
            'validation_notes' => 'nullable|string',
        ]);

        $oldStatus = $contribution->status;
        $contribution->update([
            'status' => $request->status,
            'validation_notes' => $request->validation_notes,
        ]);

        // Trigger notification for status change
        $this->notificationService->createContributionStatusNotification($contribution, $oldStatus, $request->status);

        $status = $request->status === 'validated' ? 'validated' : 'rejected';
        
        return redirect()->back()
            ->with('success', "Contribution {$status} successfully.");
    }
}