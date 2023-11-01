<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function index()
    {
        $rentlogs = RentLogs::with(['user', 'book'])->where('user_id', Auth::user()->id)->first();
        return view('profile.profile', ['rent_logs' => $rentlogs]);
    }

   
}
