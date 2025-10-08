<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of announcements for members.
     */
    public function index()
    {
        $announcements = Announcement::published()
            ->where(function ($query) {
                $query->forAudience('all')
                      ->orWhere('target_audience', 'members');
            })
            ->with('user')
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('member.announcements.index', compact('announcements'));
    }

    /**
     * Display the specified announcement.
     */
    public function show(Announcement $announcement)
    {
        // Check if the announcement is published and accessible to members
        if (!$announcement->is_published) {
            abort(404);
        }

        // Check if the announcement is targeted to members or all users
        if (!in_array($announcement->target_audience, ['all', 'members'])) {
            abort(404);
        }

        $announcement->load('user');

        return view('member.announcements.show', compact('announcement'));
    }
}
