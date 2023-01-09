<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpertController extends Controller
{


    public function index()
    {
        $experts = Expert::all();
        return $experts;
    }


    public function create()
    {
        //
    }
    public function show($id){
        $expert =Expert::find($id);
        return $expert;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'name'  => 'required|min:3|max:255',
            'address'=>'required|min:3|max:255',
            'phone_number'=>'required|min:3|max:255',
            'description'=>'required|min:3|max:255',
            'image'      => 'required|min:3|max:255',
            'image_upload' => 'image|nullable',

        ]);

        $expert = new Expert();

        $expert->id = $request->user_id;
        $expert->name = $request->name;
        $expert->address = $request->address;
        $expert->phone_number = $request->phone_number;
        $expert->description = $request->description;
        $expert->price = $request->price;

        if ($request->has('image_upload')) {
            $image = $request->image_upload;
            $path = $image->store('Expert-images', 'public');
            $expert->image = $path;
        } else {
            $expert->image = $request->image;
        }


       // $expert->image = $request->image;

        $expert->save();
        return ['message' => 'Expert created', 'data' => $expert];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Expert Show_My_Appointment
    public function show_MyAppointments(Request $request)
    {
        $request->validate([
            'user_id'=>'required',]);

        $id = $request->user_id;
        $expert = Expert::find($id);
        foreach ($expert->Appointments as $appointment){
            if($appointment->status == true){
                $appointments[]=$appointment;
            }

        }
        return $appointments;

    }


    // User
    function show_Appointment($id){
        $appointments=null;
        $expert = Expert::find($id);

        foreach ($expert->Appointments as $appointment){
            if($appointment->status == false){
                $appointments[]=$appointment;
            }
        }
        return $appointments;
    }

    public function Search_name($name_expert){

        $expert = Expert::where('name',$name_expert)->firstOrFail();

        return $expert;

    }

    public function Evaluation(Request $request){
        $request->validate([
            'user_id'=>'required',
            'value'=>'required'

        ]);
        $id = $request->user_id;
        $value = $request->value;

        $expert = Expert::find($id);
        $old_value =$expert->value_likes;
        $expert->value_likes = $old_value + $value ;
        $expert->counter_likes = $expert->counter_likes + 1;
        $expert->update();

    }public function average($id){

    $expert = Expert::find($id);
    $avr = $expert->value_likes/$expert->counter_likes;
    $response =['average'=>$avr];
    return response($response, 201);
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

}
