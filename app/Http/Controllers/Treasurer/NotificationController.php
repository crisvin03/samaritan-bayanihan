<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use App\Models\TreasurerNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Get treasurer's barangay
        $treasurerBarangay = Auth::user()->barangay;
        
        $notifications = TreasurerNotification::where('barangay', $treasurerBarangay)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('treasurer.notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = TreasurerNotification::findOrFail($id);
        
        // Ensure notification belongs to treasurer's barangay
        if ($notification->barangay !== Auth::user()->barangay) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        TreasurerNotification::where('barangay', Auth::user()->barangay)
            ->where('read', false)
            ->update([
                'read' => true,
                'read_at' => now()
            ]);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function clearAll()
    {
        TreasurerNotification::where('barangay', Auth::user()->barangay)->delete();

        return redirect()->back()->with('success', 'All notifications cleared.');
    }

    public function getUnreadCount()
    {
        $count = TreasurerNotification::where('barangay', Auth::user()->barangay)
            ->unread()
            ->count();
        
        return response()->json(['count' => $count]);
    }
}