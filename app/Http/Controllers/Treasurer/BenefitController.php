<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BenefitController extends Controller
{
    /**
     * Display a listing of benefit requests from the treasurer's barangay.
     */
    public function index()
    {
        $treasurer = Auth::user();
        $barangay = $treasurer->barangay;

        // Get benefit requests from members in the same barangay
        $benefits = Benefit::with(['user'])
            ->whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay)
                      ->whereHas('role', function($q) {
                          $q->where('name', 'member');
                      });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Get statistics
        $stats = [
            'total_requests' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay)
                      ->whereHas('role', function($q) {
                          $q->where('name', 'member');
                      });
            })->count(),
            'pending_requests' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay)
                      ->whereHas('role', function($q) {
                          $q->where('name', 'member');
                      });
            })->where('status', 'pending')->count(),
            'approved_requests' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay)
                      ->whereHas('role', function($q) {
                          $q->where('name', 'member');
                      });
            })->where('status', 'approved')->count(),
            'rejected_requests' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay)
                      ->whereHas('role', function($q) {
                          $q->where('name', 'member');
                      });
            })->where('status', 'rejected')->count(),
        ];

        return view('treasurer.benefits.index', compact('benefits', 'stats', 'barangay'));
    }

    /**
     * Display the specified benefit request.
     */
    public function show(Benefit $benefit)
    {
        $treasurer = Auth::user();
        
        // Ensure the benefit belongs to a member from the same barangay
        if ($benefit->user->barangay !== $treasurer->barangay || !$benefit->user->isMember()) {
            abort(403, 'Unauthorized access to this benefit request.');
        }

        return view('treasurer.benefits.show', compact('benefit'));
    }

    /**
     * Forward benefit request to admin for approval.
     */
    public function forward(Request $request, Benefit $benefit)
    {
        $treasurer = Auth::user();
        
        // Ensure the benefit belongs to a member from the same barangay
        if ($benefit->user->barangay !== $treasurer->barangay || !$benefit->user->isMember()) {
            abort(403, 'Unauthorized access to this benefit request.');
        }

        $request->validate([
            'treasurer_notes' => 'nullable|string|max:1000',
        ]);

        // Update benefit with treasurer notes and forward status
        $benefit->update([
            'treasurer_notes' => $request->treasurer_notes,
            'status' => 'forwarded',
            'forwarded_at' => now(),
            'forwarded_by' => $treasurer->id,
        ]);

        return redirect()->route('treasurer.benefits.index')
            ->with('success', 'Benefit request has been forwarded to admin for approval.');
    }

    /**
     * Reject benefit request with reason.
     */
    public function reject(Request $request, Benefit $benefit)
    {
        $treasurer = Auth::user();
        
        // Ensure the benefit belongs to a member from the same barangay
        if ($benefit->user->barangay !== $treasurer->barangay || !$benefit->user->isMember()) {
            abort(403, 'Unauthorized access to this benefit request.');
        }

        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        // Update benefit with rejection
        $benefit->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'rejected_at' => now(),
            'rejected_by' => $treasurer->id,
        ]);

        return redirect()->route('treasurer.benefits.index')
            ->with('success', 'Benefit request has been rejected.');
    }
}
