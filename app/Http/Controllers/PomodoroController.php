<?php

namespace App\Http\Controllers;

use App\Models\PomodoroLog;
use Illuminate\Http\Request;

class PomodoroController extends Controller
{
    public function index()
    {
        $logs = PomodoroLog::latest()->get();
        return view('pomodoro', compact('logs'));
    }

    public function store(Request $request)
    {
        PomodoroLog::create([
            'duration' => $request->duration,
            'status' => $request->status,
        ]);

        return response()->json(['success' => true]);
    }
}