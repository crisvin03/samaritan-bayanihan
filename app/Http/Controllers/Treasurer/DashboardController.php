<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Contribution;
use App\Models\Benefit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $barangay = $user->barangay;

        $stats = [
            'total_members' => User::byRole('member')->forBarangay($barangay)->active()->count(),
            'total_contributions' => Contribution::forBarangay($barangay)->validated()->sum('amount'),
            'pending_contributions' => Contribution::forBarangay($barangay)->pending()->count(),
            'pending_benefits' => Benefit::forBarangay($barangay)->pending()->count(),
        ];

        $recent_members = User::byRole('member')
            ->forBarangay($barangay)
            ->with('role')
            ->latest()
            ->limit(5)
            ->get();

        $recent_contributions = Contribution::forBarangay($barangay)
            ->with(['user', 'recordedBy'])
            ->latest()
            ->limit(5)
            ->get();

        $pending_benefits = Benefit::forBarangay($barangay)
            ->with(['user'])
            ->pending()
            ->latest()
            ->limit(5)
            ->get();

        $monthly_contributions = Contribution::forBarangay($barangay)
            ->validated()
            ->selectRaw('DATE_FORMAT(contribution_date, "%Y-%m") as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        return view('treasurer.dashboard', compact(
            'stats',
            'recent_members',
            'recent_contributions',
            'pending_benefits',
            'monthly_contributions',
            'barangay'
        ));
    }
}