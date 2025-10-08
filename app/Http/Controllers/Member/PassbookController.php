<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PassbookController extends Controller
{
    /**
     * Display the online passbook.
     */
    public function index()
    {
        return view('member.passbook.index');
    }
}
