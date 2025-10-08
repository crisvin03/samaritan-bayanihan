<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Benefit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $stats = [
            'total_contributions' => $user->contributions()->where('status', 'validated')->sum('amount'),
            'pending_benefits' => $user->benefits->where('status', 'pending')->count(),
            'approved_benefits' => $user->benefits->where('status', 'approved')->count(),
            'disbursed_benefits' => $user->benefits->where('status', 'disbursed')->count(),
        ];

        $recent_contributions = $user->contributions()
            ->with('recordedBy')
            ->latest()
            ->limit(5)
            ->get();

        $recent_benefits = $user->benefits()
            ->latest()
            ->limit(5)
            ->get();

        $contribution_history = $user->contributions()
            ->where('status', 'validated')
            ->selectRaw('DATE(contribution_date) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(12)
            ->get();

        return view('member.dashboard', compact(
            'stats',
            'recent_contributions',
            'recent_benefits',
            'contribution_history'
        ));
    }
}