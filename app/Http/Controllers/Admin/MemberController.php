<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::byRole('member')->with('role');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        // Filter by barangay
        if ($request->filled('barangay')) {
            $query->where('barangay', $request->barangay);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $members = $query->paginate(15);
        $barangays = User::byRole('member')->distinct()->pluck('barangay')->filter();

        return view('admin.members.index', compact('members', 'barangays'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'occupation' => 'nullable|string|max:255',
            'barangay' => 'required|string|max:255',
        ]);

        $memberRole = Role::getByName('member');

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $memberRole->id,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'barangay' => $request->barangay,
            'status' => 'active',
        ]);

        return redirect()->route('admin.members.index')
            ->with('success', 'Member created successfully.');
    }

    public function show(User $member)
    {
        $member->load(['contributions', 'benefits']);
        
        $totalContributions = $member->contributions->validated()->sum('amount');
        $pendingBenefits = $member->benefits->where('status', 'pending')->count();
        $approvedBenefits = $member->benefits->where('status', 'approved')->count();

        return view('admin.members.show', compact(
            'member',
            'totalContributions',
            'pendingBenefits',
            'approvedBenefits'
        ));
    }

    public function edit(User $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $member->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'occupation' => 'nullable|string|max:255',
            'barangay' => 'required|string|max:255',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $member->update($request->only([
            'name', 'email', 'phone_number', 'address',
            'birth_date', 'gender', 'occupation', 'barangay', 'status'
        ]));

        return redirect()->route('admin.members.show', $member)
            ->with('success', 'Member updated successfully.');
    }

    public function destroy(User $member)
    {
        // Soft delete by changing status to inactive
        $member->update(['status' => 'inactive']);

        return redirect()->route('admin.members.index')
            ->with('success', 'Member deactivated successfully.');
    }

    public function activate(User $member)
    {
        $member->update(['status' => 'active']);

        return redirect()->back()
            ->with('success', 'Member activated successfully.');
    }

    public function suspend(User $member)
    {
        $member->update(['status' => 'suspended']);

        return redirect()->back()
            ->with('success', 'Member suspended successfully.');
    }
}