<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Contribution;
use App\Models\Benefit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_members' => User::byRole('member')->active()->count(),
            'total_admins' => User::byRole('admin')->active()->count(),
            'total_treasurers' => User::byRole('barangay_treasurer')->active()->count(),
            'total_contributions' => Contribution::validated()->sum('amount'),
            'pending_benefits' => Benefit::pending()->count(),
            'approved_benefits' => Benefit::approved()->count(),
        ];

        $recent_members = User::byRole('member')
            ->with('role')
            ->latest()
            ->limit(5)
            ->get();

        $recent_contributions = Contribution::with(['user', 'recordedBy'])
            ->latest()
            ->limit(5)
            ->get();

        $pending_benefits = Benefit::with(['user'])
            ->pending()
            ->latest()
            ->limit(5)
            ->get();

        $barangay_stats = User::byRole('member')
            ->active()
            ->selectRaw('barangay, COUNT(*) as member_count')
            ->groupBy('barangay')
            ->orderBy('member_count', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recent_members',
            'recent_contributions',
            'pending_benefits',
            'barangay_stats'
        ));
    }
}