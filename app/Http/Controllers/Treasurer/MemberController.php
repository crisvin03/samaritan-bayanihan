<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $barangay = $user->barangay;

        $query = User::byRole('member')
            ->forBarangay($barangay)
            ->with('role');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $members = $query->paginate(15);

        return view('treasurer.members.index', compact('members', 'barangay'));
    }

    public function create()
    {
        $user = auth()->user();
        return view('treasurer.members.create', compact('user'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $barangay = $user->barangay;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'occupation' => 'nullable|string|max:255',
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
            'barangay' => $barangay, // Automatically assign to treasurer's barangay
            'status' => 'active',
        ]);

        return redirect()->route('treasurer.members.index')
            ->with('success', 'Member registered successfully.');
    }

    public function show(User $member)
    {
        $user = auth()->user();
        
        // Ensure the member belongs to the treasurer's barangay
        if ($member->barangay !== $user->barangay) {
            abort(403, 'You can only view members from your assigned barangay.');
        }

        $member->load(['contributions', 'benefits']);
        
        $totalContributions = $member->contributions->validated()->sum('amount');
        $pendingBenefits = $member->benefits->where('status', 'pending')->count();
        $approvedBenefits = $member->benefits->where('status', 'approved')->count();

        return view('treasurer.members.show', compact(
            'member',
            'totalContributions',
            'pendingBenefits',
            'approvedBenefits'
        ));
    }

    public function edit(User $member)
    {
        $user = auth()->user();
        
        // Ensure the member belongs to the treasurer's barangay
        if ($member->barangay !== $user->barangay) {
            abort(403, 'You can only edit members from your assigned barangay.');
        }

        return view('treasurer.members.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        $user = auth()->user();
        
        // Ensure the member belongs to the treasurer's barangay
        if ($member->barangay !== $user->barangay) {
            abort(403, 'You can only edit members from your assigned barangay.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $member->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'occupation' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $member->update($request->only([
            'name', 'email', 'phone_number', 'address',
            'birth_date', 'gender', 'occupation', 'status'
        ]));

        return redirect()->route('treasurer.members.show', $member)
            ->with('success', 'Member updated successfully.');
    }

    public function destroy(User $member)
    {
        $user = auth()->user();
        
        // Ensure the member belongs to the treasurer's barangay
        if ($member->barangay !== $user->barangay) {
            abort(403, 'You can only manage members from your assigned barangay.');
        }

        // Soft delete by changing status to inactive
        $member->update(['status' => 'inactive']);

        return redirect()->route('treasurer.members.index')
            ->with('success', 'Member deactivated successfully.');
    }
}