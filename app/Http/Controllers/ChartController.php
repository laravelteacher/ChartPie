<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Redirect,Response;
Use DB;
use Carbon\Carbon;
 
class ChartController extends Controller
{
    public function index()
    {
// get all user has same name
    $record = DB::table('users')
                  ->select('name', DB::raw('count(*) as count'))
                  ->groupBy('name')
                  ->get();
  
     $data = [];
   //by this function we can get each user in same name
     foreach($record as $row) {
        $data['label'][] = $row->name;
        $data['data'][] = (int) $row->count;
      }
 // by this function we can send all data for chart by Jason
    $data['chart_data'] = json_encode($data);
    return view('chart-js', $data);
    }
}