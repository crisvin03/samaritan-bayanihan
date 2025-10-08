<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use App\Models\Benefit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display the reports dashboard.
     */
    public function index()
    {
        $treasurer = Auth::user();
        $barangay = $treasurer->barangay;

        // Get date range for current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Get statistics for the treasurer's barangay
        $stats = [
            'total_members' => User::where('barangay', $barangay)
                ->whereHas('role', function($q) {
                    $q->where('name', 'member');
                })->count(),
            'total_contributions' => Contribution::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->count(),
            'total_contribution_amount' => Contribution::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->sum('amount') ?? 0,
            'total_benefits' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->count(),
            'pending_benefits' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->where('status', 'pending')->count(),
            'approved_benefits' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->where('status', 'approved')->count(),
        ];

        // Get monthly contribution data for the current year
        $monthlyContributions = $this->getMonthlyContributions($barangay);
        
        // Get recent contributions
        $recentContributions = Contribution::with('user')
            ->whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })
            ->latest()
            ->limit(5)
            ->get();

        // Get recent benefits
        $recentBenefits = Benefit::with('user')
            ->whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })
            ->latest()
            ->limit(5)
            ->get();

        return view('treasurer.reports.index', compact(
            'stats',
            'monthlyContributions',
            'recentContributions',
            'recentBenefits',
            'barangay'
        ));
    }

    /**
     * Generate financial report.
     */
    public function financial()
    {
        $treasurer = Auth::user();
        $barangay = $treasurer->barangay;

        // Get date range for current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Get financial data
        $financialData = [
            'monthly_contributions' => Contribution::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('amount') ?? 0,
            'yearly_contributions' => Contribution::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->whereYear('created_at', Carbon::now()->year)->sum('amount') ?? 0,
            'total_contributions' => Contribution::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->sum('amount') ?? 0,
            'average_contribution' => Contribution::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->avg('amount') ?? 0,
        ];

        // Get monthly contribution data for charts
        $monthlyData = $this->getMonthlyContributions($barangay);

        return view('treasurer.reports.financial', compact('financialData', 'monthlyData', 'barangay'));
    }

    /**
     * Generate member report.
     */
    public function members()
    {
        $treasurer = Auth::user();
        $barangay = $treasurer->barangay;

        // Get member statistics
        $memberStats = [
            'total_members' => User::where('barangay', $barangay)
                ->whereHas('role', function($q) {
                    $q->where('name', 'member');
                })->count(),
            'active_members' => User::where('barangay', $barangay)
                ->whereHas('role', function($q) {
                    $q->where('name', 'member');
                })
                ->whereHas('contributions')
                ->count(),
            'new_members_this_month' => User::where('barangay', $barangay)
                ->whereHas('role', function($q) {
                    $q->where('name', 'member');
                })
                ->whereMonth('created_at', Carbon::now()->month)
                ->count(),
        ];

        // Get member contribution data
        $memberContributions = User::where('barangay', $barangay)
            ->whereHas('role', function($q) {
                $q->where('name', 'member');
            })
            ->withCount('contributions')
            ->withSum('contributions', 'amount')
            ->orderBy('contributions_sum_amount', 'desc')
            ->limit(10)
            ->get();

        return view('treasurer.reports.members', compact('memberStats', 'memberContributions', 'barangay'));
    }

    /**
     * Generate benefit report.
     */
    public function benefits()
    {
        $treasurer = Auth::user();
        $barangay = $treasurer->barangay;

        // Get benefit statistics
        $benefitStats = [
            'total_benefits' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->count(),
            'pending_benefits' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->where('status', 'pending')->count(),
            'approved_benefits' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->where('status', 'approved')->count(),
            'rejected_benefits' => Benefit::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })->where('status', 'rejected')->count(),
        ];

        // Get benefit type breakdown
        $benefitTypes = Benefit::whereHas('user', function($query) use ($barangay) {
            $query->where('barangay', $barangay);
        })
        ->selectRaw('benefit_type, COUNT(*) as count')
        ->groupBy('benefit_type')
        ->get();

        return view('treasurer.reports.benefits', compact('benefitStats', 'benefitTypes', 'barangay'));
    }

    /**
     * Get monthly contribution data for charts.
     */
    private function getMonthlyContributions($barangay)
    {
        $months = [];
        $contributions = [];

        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::create(null, $i, 1);
            $months[] = $month->format('M');
            
            $amount = Contribution::whereHas('user', function($query) use ($barangay) {
                $query->where('barangay', $barangay);
            })
            ->whereMonth('created_at', $i)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount') ?? 0;
            
            $contributions[] = $amount;
        }

        return [
            'months' => $months,
            'contributions' => $contributions
        ];
    }
}
