<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use App\Models\UrlClick;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class DashboardController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $urls = ShortUrl::where('user_id', Auth::user()->id)->get();
        return view('backend.dashboard.dashboard', compact('urls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $url = ShortUrl::where('code', $id)->first();
        return view('backend.manage-url.report', compact('url'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getClickbyCurrentYear(Request $request)
    {
        $code = $request->code;
        $url = ShortUrl::where('code', $code)->first();
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now()->endOfYear();
        $clickCounts = [];
        $urlclick = [];
        $columns = ['platform', 'browser', 'device'];
        foreach ($columns as $column) {
            $urlclick[$column] = UrlClick::select($column, DB::raw('count(' . $column . ') as count_' . $column))
                ->where('url_id', $url->id)
                ->groupBy($column)
                ->get();
        }  
        $url->urlclicks = $urlclick;
        $currentDate = $startDate->copy();
            while ($currentDate <= $endDate) {
                $clickCount = UrlClick::whereYear('created_at', $currentDate->year)
                        ->whereMonth('created_at', $currentDate->month)
                        ->where('url_id', $url->id)
                        ->count();
                $clickCounts[$currentDate->format('n') - 1] = $clickCount;

                $currentDate->addMonth();
            }
            $url->months = $clickCounts;
            $clickCounts = [];
        return response()->json($url);
    }

    public function getReportByDateRange(Request $request)
    {
        $code = $request->code;
        $url = ShortUrl::where('code', $code)->first();
        $startDate = Carbon::parse($request->startDate)->startOfMonth();
        $endDate = Carbon::parse($request->endDate)->endOfMonth();
        $clickCounts = [];
        $urlclick = [];
        $columns = ['platform', 'browser', 'device'];
        foreach ($columns as $column) {
            $urlclick[$column] = UrlClick::select($column, DB::raw('count(' . $column . ') as count_' . $column))
                ->where('url_id', $url->id)
                ->whereBetween('created_at', [$startDate->toDateString(), $endDate->toDateString()])
                ->groupBy($column)
                ->get();
        }
        $url->urlclicks = $urlclick;
        $diffInMonths = $startDate->diffInMonths($endDate);
        $i = 0;
        $day = [];
        $currentDate = $startDate->copy();
        // foreach ($urls as $key => $url) {
            while ($startDate->lte($endDate)) {
                $end_date = $i == $diffInMonths ? $endDate->toDateString() : $startDate->endOfMonth()->toDateString();
                $day[] = [
                    'start' => $startDate->toDateString(),
                    'end' => $end_date,
                ];
                $clickCount = UrlClick::where('url_id', $url->id)
                        ->whereBetween('created_at', [$currentDate->toDateString(), $end_date])
                        ->count();

                $clickCounts[$currentDate->format('n') - 1] = $clickCount;

                $currentDate->addMonth();
                $i++;
            }
            $url->months = $clickCounts;
            $url->day = $day;
            $clickCounts = [];
        // }
        return response()->json($url);
    }
}
