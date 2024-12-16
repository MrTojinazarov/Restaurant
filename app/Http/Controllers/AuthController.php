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
    
        if ($user && $request->password == $user->password) {
            Auth::login($user);
    
            $attendance = Attendence::where('user_id', $user->id)
                ->where('date', Carbon::today()->toDateString())
                ->latest('created_at')
                ->first();
    
            if ($attendance) {
                $attendance->start_time = Carbon::now()->toTimeString();
                $attendance->end_time = null;
                $attendance->save();
            } else {
                $attendance = new Attendence();
                $attendance->user_id = $user->id;
                $attendance->employee_id = $user->employee->id;
                $attendance->date = Carbon::today()->toDateString();
                $attendance->start_time = Carbon::now()->toTimeString();
                $attendance->save();
            }
    
            return redirect()->route('main.page');
        }
    
        return back()->withErrors(['error' => 'Email yoki parol noto\'g\'ri']);
    }
    
    public function logout()
    {
        $user = Auth::user();

        $attendance = Attendence::firstOrCreate(
            [
                'user_id' => $user->id,
                'date' => Carbon::today()->toDateString(),
            ],
            [
                'start_time' => null,
                'end_time' => null,
                'time' => 0,
            ]
        );

        if ($attendance) {
            $currentLogoutTime = Carbon::now()->toTimeString();

            $workStartTime = Carbon::parse($user->employee->start_time);
            $workEndTime = Carbon::parse($user->employee->end_time);
            $currentStartTime = Carbon::parse($attendance->start_time ?: $currentLogoutTime);

            $actualStartTime = max($currentStartTime, $workStartTime);
            $actualEndTime = min(Carbon::now(), $workEndTime);

            $workedHours = $this->calculateTimeDifferenceInFloat($actualStartTime, $actualEndTime);
            $attendance->time += $workedHours;
            $attendance->end_time = $currentLogoutTime;
            $attendance->save();
        }

        Auth::logout();

        return redirect()->route('login');
    }

    private function calculateTimeDifferenceInFloat($start_time, $end_time)
    {
        $start = Carbon::parse($start_time);
        $end = Carbon::parse($end_time);

        $totalMinutes = $start->diffInMinutes($end);
        return $totalMinutes / 60;
    }
}
