<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $logs = Log::where('user_id', $request->session()->get('userID'))->paginate(15);

        return view('/user/log/index')->with('logs', $logs);
    }
}
