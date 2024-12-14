<?php

namespace App\Http\Controllers;

use App\Models\Attendence;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('livewire.auth');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && User::where($request->password, $user->password)) {
            Auth::login($user);

            $attendance = new Attendence();
            $attendance->user_id = $user->id;
            $attendance->employee_id = $user->employee->id; 
            $attendance->date = Carbon::today()->toDateString();
            $attendance->start_time = Carbon::now()->toTimeString(); 
            $attendance->save();

            return redirect()->route('main.page');
        }

        return back()->withErrors(['error' => 'Email yoki parol noto\'g\'ri']);
    }

    public function logout()
    {
        $user = Auth::user();
        
        $attendance = Attendence::where('user_id', $user->id)
            ->where('date', Carbon::today()->toDateString())
            ->latest('created_at')
            ->first();

        if ($attendance) {
            $attendance->end_time = Carbon::now()->toTimeString();
            $attendance->time = $this->calculateTimeDifference($attendance->start_time, $attendance->end_time);
            $attendance->save();
        }

        Auth::logout();

        return redirect()->route('login');
    }

    private function calculateTimeDifference($start_time, $end_time)
    {
        $start = Carbon::parse($start_time);
        $end = Carbon::parse($end_time);
        $hours = $start->diffInHours($end);
        $minutes = $start->diffInMinutes($end) % 60;
        return $hours . ' soat ' . $minutes . ' daqiqa';
    }
}
