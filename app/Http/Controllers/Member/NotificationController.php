<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use App\Models\Contribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = collect();

        // System Alerts - Always show important system information
        $notifications = $notifications->merge($this->getSystemAlerts($user));

        // Application Status Updates - Based on user's actual applications
        $notifications = $notifications->merge($this->getApplicationStatusUpdates($user));

        // Contribution Updates - Based on user's actual contributions
        $notifications = $notifications->merge($this->getContributionUpdates($user));

        // Sort by timestamp (newest first)
        $notifications = $notifications->sortByDesc('timestamp')->values();

        return view('member.notifications.index', compact('notifications'));
    }

    private function getSystemAlerts($user)
    {
        $alerts = collect();

        // Welcome message for new users
        if ($user->created_at->isAfter(now()->subDays(7))) {
            $alerts->push([
                'id' => 'welcome_' . $user->id,
                'type' => 'System Alert',
                'message' => 'Welcome to Samaritan Bayanihan! Your account has been successfully created.',
                'timestamp' => $user->created_at,
                'read' => false,
                'priority' => 'high'
            ]);
        }

        // Profile completion reminder
        if (!$user->phone || !$user->address) {
            $alerts->push([
                'id' => 'profile_incomplete_' . $user->id,
                'type' => 'System Alert',
                'message' => 'Please complete your profile information to access all features.',
                'timestamp' => now()->subHours(2),
                'read' => false,
                'priority' => 'medium'
            ]);
        }

        // New benefits available
        $alerts->push([
            'id' => 'new_benefits_' . now()->format('Y-m-d'),
            'type' => 'System Alert',
            'message' => 'New benefits are now available for application. Check the benefits page for details.',
            'timestamp' => now()->subHours(1),
            'read' => false,
            'priority' => 'medium'
        ]);

        // System maintenance notice
        $alerts->push([
            'id' => 'maintenance_' . now()->format('Y-m-d'),
            'type' => 'System Alert',
            'message' => 'Scheduled system maintenance will occur this Sunday from 2:00 AM to 4:00 AM.',
            'timestamp' => now()->subDays(1),
            'read' => true,
            'priority' => 'low'
        ]);

        return $alerts;
    }

    private function getApplicationStatusUpdates($user)
    {
        $updates = collect();
        
        // Get user's recent benefit applications
        $recentBenefits = $user->benefits()
            ->where('created_at', '>=', now()->subDays(30))
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($recentBenefits as $benefit) {
            $statusMessage = $this->getBenefitStatusMessage($benefit);
            if ($statusMessage) {
                $updates->push([
                    'id' => 'benefit_' . $benefit->id . '_' . $benefit->updated_at->timestamp,
                    'type' => 'Benefit Update',
                    'message' => $statusMessage,
                    'timestamp' => $benefit->updated_at,
                    'read' => $benefit->status === 'pending' ? false : true,
                    'priority' => $benefit->status === 'approved' ? 'high' : 'medium'
                ]);
            }
        }

        return $updates;
    }

    private function getBenefitStatusMessage($benefit)
    {
        $benefitType = ucfirst(str_replace('_', ' ', $benefit->benefit_type));
        
        switch ($benefit->status) {
            case 'pending':
                return "Your application for {$benefitType} is currently under review.";
            case 'approved':
                return "Great news! Your {$benefitType} application has been approved for ₱" . number_format($benefit->requested_amount, 2) . ".";
            case 'rejected':
                return "Your {$benefitType} application has been reviewed. Please check the details for more information.";
            case 'disbursed':
                return "Your {$benefitType} benefit of ₱" . number_format($benefit->requested_amount, 2) . " has been disbursed.";
            default:
                return null;
        }
    }

    private function getContributionUpdates($user)
    {
        $updates = collect();
        
        // Get user's recent contributions
        $recentContributions = $user->contributions()
            ->where('created_at', '>=', now()->subDays(30))
            ->orderBy('updated_at', 'desc')
            ->get();

        foreach ($recentContributions as $contribution) {
            $statusMessage = $this->getContributionStatusMessage($contribution);
            if ($statusMessage) {
                $updates->push([
                    'id' => 'contribution_' . $contribution->id . '_' . $contribution->updated_at->timestamp,
                    'type' => 'Contribution Update',
                    'message' => $statusMessage,
                    'timestamp' => $contribution->updated_at,
                    'read' => $contribution->status === 'validated' ? true : false,
                    'priority' => $contribution->status === 'validated' ? 'medium' : 'low'
                ]);
            }
        }

        return $updates;
    }

    private function getContributionStatusMessage($contribution)
    {
        $amount = "₱" . number_format($contribution->amount, 2);
        
        switch ($contribution->status) {
            case 'pending':
                return "Your contribution of {$amount} is pending validation.";
            case 'validated':
                return "Your contribution of {$amount} has been successfully validated.";
            case 'rejected':
                return "Your contribution of {$amount} requires attention. Please contact support.";
            default:
                return null;
        }
    }

    public function markAsRead(Request $request)
    {
        // In a real app, this would update the database
        return redirect()->route('member.notifications.index')
            ->with('success', 'All notifications have been marked as read.');
    }

    public function clearAll(Request $request)
    {
        // In a real app, this would delete notifications from the database
        return redirect()->route('member.notifications.index')
            ->with('success', 'All notifications have been cleared.');
    }
}
