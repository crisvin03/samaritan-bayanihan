<?php

namespace App\Http\Controllers\Treasurer;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of announcements for the treasurer.
     */
    public function index()
    {
        $treasurer = Auth::user();
        $barangay = $treasurer->barangay;

        // Get admin announcements (targeted to 'all' or 'treasurers')
        $adminAnnouncements = Announcement::with('user')
            ->where('is_published', true)
            ->whereIn('target_audience', ['all', 'treasurers'])
            ->latest()
            ->paginate(10);

        // Get treasurer's own announcements for their barangay
        $treasurerAnnouncements = Announcement::with('user')
            ->where('created_by', $treasurer->id)
            ->where('target_audience', 'members')
            ->latest()
            ->paginate(10);

        // Get statistics
        $stats = [
            'total_admin_announcements' => Announcement::where('is_published', true)
                ->whereIn('target_audience', ['all', 'treasurers'])
                ->count(),
            'total_treasurer_announcements' => Announcement::where('created_by', $treasurer->id)
                ->where('target_audience', 'members')
                ->count(),
            'recent_admin_announcements' => Announcement::where('is_published', true)
                ->whereIn('target_audience', ['all', 'treasurers'])
                ->latest()
                ->limit(5)
                ->get(),
            'recent_treasurer_announcements' => Announcement::where('created_by', $treasurer->id)
                ->where('target_audience', 'members')
                ->latest()
                ->limit(5)
                ->get(),
        ];

        return view('treasurer.announcements.index', compact(
            'adminAnnouncements',
            'treasurerAnnouncements',
            'stats',
            'barangay'
        ));
    }

    /**
     * Show the form for creating a new announcement.
     */
    public function create()
    {
        return view('treasurer.announcements.create');
    }

    /**
     * Store a newly created announcement.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority_level' => 'required|in:low,medium,high,urgent',
            'target_audience' => 'required|in:members',
        ]);

        $treasurer = Auth::user();

        $announcement = Announcement::create([
            'title' => $request->title,
            'content' => $request->content,
            'priority' => $request->priority_level,
            'target_audience' => 'members', // Treasurers can only create announcements for members
            'is_published' => true, // Treasurers' announcements are published immediately
            'created_by' => $treasurer->id,
            'published_at' => now(),
        ]);

        return redirect()->route('treasurer.announcements.index')
            ->with('success', 'Announcement created successfully for your barangay members.');
    }

    /**
     * Display the specified announcement.
     */
    public function show(Announcement $announcement)
    {
        $treasurer = Auth::user();

        // Check if treasurer can view this announcement
        if ($announcement->target_audience === 'members' && $announcement->created_by !== $treasurer->id) {
            abort(403, 'You can only view announcements you created for your barangay members.');
        }

        if ($announcement->target_audience === 'treasurers' && $announcement->created_by === $treasurer->id) {
            abort(403, 'You cannot view your own admin announcements.');
        }

        return view('treasurer.announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified announcement.
     */
    public function edit(Announcement $announcement)
    {
        $treasurer = Auth::user();

        // Only allow editing own announcements for members
        if ($announcement->created_by !== $treasurer->id || $announcement->target_audience !== 'members') {
            abort(403, 'You can only edit your own announcements for your barangay members.');
        }

        return view('treasurer.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified announcement.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $treasurer = Auth::user();

        // Only allow updating own announcements for members
        if ($announcement->created_by !== $treasurer->id || $announcement->target_audience !== 'members') {
            abort(403, 'You can only update your own announcements for your barangay members.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'priority_level' => 'required|in:low,medium,high,urgent',
        ]);

        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'priority' => $request->priority_level,
        ]);

        return redirect()->route('treasurer.announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified announcement.
     */
    public function destroy(Announcement $announcement)
    {
        $treasurer = Auth::user();

        // Only allow deleting own announcements for members
        if ($announcement->created_by !== $treasurer->id || $announcement->target_audience !== 'members') {
            abort(403, 'You can only delete your own announcements for your barangay members.');
        }

        $announcement->delete();

        return redirect()->route('treasurer.announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }
}
