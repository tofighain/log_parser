<?php 

namespace App\Helpers;

use App\Helpers\Filters\FGeneral;
use App\Models\Log;
use Illuminate\Http\Request;

class LogSearch {
    public static function truncateResults(Request $request, Log $log) {
        $query = $log->newQuery();
        if($request->filled('serviceNames')){
            $query = FGeneral::truncateResults($query, $request->input('serviceNames'), 'slug', 'service');
        }
        if($request->filled('statusCode')){
            $query = FGeneral::truncateResults($query, $request->input('statusCode'), 'status_code');
        }
        if($request->filled('startDate')){
            $query->where('output_date_time', '>=',$request->input('startDate'));
        }
        if($request->filled('endDate')){
            $query->where('output_date_time', $request->input('endDate'));
        }
        return $query->count();
    }
}