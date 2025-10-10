<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = AdminNotification::orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        AdminNotification::where('read', false)->update([
            'read' => true,
            'read_at' => now()
        ]);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function clearAll()
    {
        AdminNotification::truncate();

        return redirect()->back()->with('success', 'All notifications cleared.');
    }

    public function getUnreadCount()
    {
        $count = AdminNotification::unread()->count();
        
        return response()->json(['count' => $count]);
    }
}