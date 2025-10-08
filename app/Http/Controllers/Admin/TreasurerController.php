<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TreasurerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::byRole('barangay_treasurer')->with('role');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%");
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
        
        $treasurers = $query->paginate(10)->withQueryString();
        
        // Get unique barangays for filter dropdown
        $barangays = User::byRole('barangay_treasurer')
            ->whereNotNull('barangay')
            ->distinct()
            ->pluck('barangay')
            ->sort()
            ->values();
        
        return view('admin.treasurers.index', compact('treasurers', 'barangays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barangays = [
            'Barangay 1', 'Barangay 2', 'Barangay 3', 'Barangay 4', 'Barangay 5',
            'Barangay 6', 'Barangay 7', 'Barangay 8', 'Barangay 9', 'Barangay 10'
        ];
        
        return view('admin.treasurers.create', compact('barangays'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'barangay' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'occupation' => 'nullable|string|max:255',
        ]);

        $treasurerRole = Role::where('name', 'barangay_treasurer')->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $treasurerRole->id,
            'barangay' => $request->barangay,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'occupation' => $request->occupation,
            'status' => 'active',
        ]);

        return redirect()->route('admin.treasurers.index')
            ->with('success', 'Treasurer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $treasurer)
    {
        $treasurer->load('role');
        
        return view('admin.treasurers.show', compact('treasurer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $treasurer)
    {
        $barangays = [
            'Barangay 1', 'Barangay 2', 'Barangay 3', 'Barangay 4', 'Barangay 5',
            'Barangay 6', 'Barangay 7', 'Barangay 8', 'Barangay 9', 'Barangay 10'
        ];
        
        return view('admin.treasurers.edit', compact('treasurer', 'barangays'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $treasurer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($treasurer->id)],
            'barangay' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'occupation' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $treasurer->update($request->only([
            'name', 'email', 'barangay', 'phone_number', 
            'address', 'birth_date', 'gender', 'occupation', 'status'
        ]));

        return redirect()->route('admin.treasurers.index')
            ->with('success', 'Treasurer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $treasurer)
    {
        $treasurer->delete();

        return redirect()->route('admin.treasurers.index')
            ->with('success', 'Treasurer deleted successfully.');
    }

    /**
     * Activate a treasurer
     */
    public function activate(User $treasurer)
    {
        $treasurer->update(['status' => 'active']);

        return redirect()->back()
            ->with('success', 'Treasurer activated successfully.');
    }

    /**
     * Suspend a treasurer
     */
    public function suspend(User $treasurer)
    {
        $treasurer->update(['status' => 'suspended']);

        return redirect()->back()
            ->with('success', 'Treasurer suspended successfully.');
    }
}
