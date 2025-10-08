<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::with('user')->latest()->paginate(10);
        
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'target_audience' => 'required|in:all,members,treasurers,admins',
            'is_published' => 'boolean',
        ]);

        $announcement = Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'priority' => $request->priority,
            'target_audience' => $request->target_audience,
            'is_published' => $request->has('is_published'),
            'created_by' => Auth::id(),
        ]);

        // Trigger notification if announcement is published
        if ($request->has('is_published')) {
            $this->notificationService->createAnnouncementNotification($announcement);
        }

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        $announcement->load('user');
        
        return view('admin.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority' => 'required|in:low,medium,high,urgent',
            'target_audience' => 'required|in:all,members,treasurers,admins',
            'is_published' => 'boolean',
        ]);

        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'priority' => $request->priority,
            'target_audience' => $request->target_audience,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }

    /**
     * Publish an announcement
     */
    public function publish(Announcement $announcement)
    {
        $announcement->update(['is_published' => true]);

        // Trigger notification when announcement is published
        $this->notificationService->createAnnouncementNotification($announcement);

        return redirect()->back()
            ->with('success', 'Announcement published successfully.');
    }

    /**
     * Unpublish an announcement
     */
    public function unpublish(Announcement $announcement)
    {
        $announcement->update(['is_published' => false]);

        return redirect()->back()
            ->with('success', 'Announcement unpublished successfully.');
    }
}
