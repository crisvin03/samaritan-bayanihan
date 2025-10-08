<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $user = Auth::user();
        
        // Get notifications from database
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('member.notifications.index', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        $user = Auth::user();
        $this->notificationService->markAllAsRead($user->id);
        
        return redirect()->route('member.notifications.index')
            ->with('success', 'All notifications have been marked as read.');
    }

    public function markSingleAsRead(Request $request, $id)
    {
        $user = Auth::user();
        $success = $this->notificationService->markAsRead($id, $user->id);
        
        if ($success) {
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 404);
    }

    public function clearAll(Request $request)
    {
        $user = Auth::user();
        $this->notificationService->clearAll($user->id);
        
        return redirect()->route('member.notifications.index')
            ->with('success', 'All notifications have been cleared.');
    }

    public function getUnreadCount()
    {
        $user = Auth::user();
        $count = $this->notificationService->getUnreadCount($user->id);
        
        return response()->json(['count' => $count]);
    }
}
