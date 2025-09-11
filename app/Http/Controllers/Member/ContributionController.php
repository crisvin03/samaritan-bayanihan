<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Contribution;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Get statistics
        $totalContributions = $user->contributions()->sum('amount');
        $validatedContributions = $user->contributions()->where('status', 'validated')->sum('amount');
        $totalCount = $user->contributions()->count();
        $pendingCount = $user->contributions()->where('status', 'pending')->count();
        
        // Build query with filters
        $query = $user->contributions()->with('recordedBy');
        
        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Apply date filters
        if ($request->filled('from_date')) {
            $query->whereDate('contribution_date', '>=', $request->from_date);
        }
        
        if ($request->filled('to_date')) {
            $query->whereDate('contribution_date', '<=', $request->to_date);
        }
        
        // Get contributions with pagination
        $contributions = $query->latest('contribution_date')->paginate(15);
        
        return view('member.contributions.index', compact(
            'contributions',
            'totalContributions',
            'validatedContributions',
            'totalCount',
            'pendingCount'
        ));
    }

    public function show(Contribution $contribution)
    {
        // Ensure the contribution belongs to the authenticated user
        if ($contribution->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to contribution record.');
        }

        return view('member.contributions.show', compact('contribution'));
    }

    public function export(Request $request)
    {
        $user = auth()->user();
        
        // Build query with same filters as index
        $query = $user->contributions()->with('recordedBy');
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('from_date')) {
            $query->whereDate('contribution_date', '>=', $request->from_date);
        }
        
        if ($request->filled('to_date')) {
            $query->whereDate('contribution_date', '<=', $request->to_date);
        }
        
        $contributions = $query->latest('contribution_date')->get();
        
        // Generate CSV
        $filename = 'contributions_' . now()->format('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($contributions) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'Date',
                'Amount',
                'Payment Method',
                'Reference Number',
                'Status',
                'Recorded By',
                'Notes'
            ]);
            
            // CSV data
            foreach ($contributions as $contribution) {
                fputcsv($file, [
                    $contribution->contribution_date->format('Y-m-d'),
                    number_format($contribution->amount, 2),
                    $contribution->payment_method,
                    $contribution->reference_number ?? '',
                    $contribution->status,
                    $contribution->recordedBy->name ?? 'System',
                    $contribution->notes ?? ''
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public function print(Request $request)
    {
        $user = auth()->user();
        
        // Build query with same filters as index
        $query = $user->contributions()->with('recordedBy');
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('from_date')) {
            $query->whereDate('contribution_date', '>=', $request->from_date);
        }
        
        if ($request->filled('to_date')) {
            $query->whereDate('contribution_date', '<=', $request->to_date);
        }
        
        $contributions = $query->latest('contribution_date')->get();
        
        // Get summary statistics
        $totalAmount = $contributions->sum('amount');
        $validatedAmount = $contributions->where('status', 'validated')->sum('amount');
        $pendingAmount = $contributions->where('status', 'pending')->sum('amount');
        
        return view('member.contributions.print', compact(
            'contributions',
            'totalAmount',
            'validatedAmount',
            'pendingAmount',
            'user'
        ));
    }
}
