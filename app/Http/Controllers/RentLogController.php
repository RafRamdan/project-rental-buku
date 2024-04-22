<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\RentLogs;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index(Request $request)
    {
        $rentlogs = RentLogs::with(['user', 'book'])
            ->whereRelation('book', 'deleted_at', '=', null)
            ->whereRelation('user', 'deleted_at', '=', null)
            ->orderBy('actual_return_date', 'DESC')
            ->paginate(20);

        return view('rent-logs.rentlog', ['rent_logs' => $rentlogs]);
    }

    public function exportpdf()
    {
        $data = RentLogs::with(['user', 'book'])
            ->whereRelation('book', 'deleted_at', '=', null)
            ->whereRelation('user', 'deleted_at', '=', null)
            ->get();
        view()->share('data', $data);
        $pdf = PDF::loadview('rent-logs.rentlog-pdf');
        return $pdf->download('data.pdf');
    }
}
