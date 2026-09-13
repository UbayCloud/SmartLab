<?php
namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Http\Controllers\Controller;
class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::with('user')->latest()->paginate(10);
           

        return view('admin.logActivity', compact('logs'));
    }
}
