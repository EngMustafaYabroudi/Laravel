<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(){
        $bookings =Booking::all();
        return $bookings;
    }
    public function store(Request $request){
        $request->validate([
           'user_id'=>'required',
            'appointment_id'=>'required'
        ]);

        $x = $request->appointment_id;
        $appoientment = Appointment::find($x);

        $booking = new Booking();
        // $booking->user_id = $request->user_id;
        $booking->user_id = $request->user_id;;
        $booking->expert_id = $appoientment->Expert->id;
        $booking->day = $appoientment->day;
        $booking->time_start =$appoientment->time_start;
        $booking->time_end =$appoientment->time_end;
        $booking->save();
        $appoientment->status = true;
        $appoientment->update();

         return ['message' => 'booking created', 'data' => $booking];
    }

}
