<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use PDF;

class RentLogController extends Controller
{
    public function index(Request $request)
    {
        $rentlogs = RentLogs::with(['user', 'book'])->paginate(10);
        return view('rent-logs.rentlog', ['rent_logs' => $rentlogs]);
    }

    public function exportpdf()
    {
        $data = RentLogs::with(['user', 'book'])->get();

        view()->share('data', $data);
        $pdf = PDF::loadview('rent-logs.rentlog-pdf');
        return $pdf->download('data.pdf');
    }
}
