<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

use App\Helpers\LogSearch;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function count_v1(Request $request) {
        $log = new Log();
        $query = $log->newQuery();
        if($request->filled('serviceNames')){
            $query->whereHas('service', function ($q) use ($request) {
                $q->whereIn('slug', explode(",",$request->input('serviceNames')));
            });
        }
        if($request->filled('statusCode')){
            $query->whereIn('status_code', explode(",",$request->input('statusCode')));
        }
        if($request->filled('startDate')){
            $query->where('output_date_time', '>=',$request->input('startDate'));
        }
        if($request->filled('endDate')){
            $query->where('output_date_time', $request->input('endDate'));
        }
        return $query->count();
    }

    public function count(Request $request) {
        $log = new Log();
        return LogSearch::truncateResults($request, $log);
    }
}
