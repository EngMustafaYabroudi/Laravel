<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Models\counseling;
use App\Models\counseling_Expert;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class counseling_ExpertController extends Controller
{
    public function index()
    {
        $counselings_Experts = counseling_Expert::all();
        return $counselings_Experts;
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'counseling_id'=>'required'
        ]);
        $counseling_Expert = new counseling_Expert();
       // $counseling_Expert->expert_id = $request->expert_id;
        $counseling_Expert->expert_id = $request->user_id;
        $counseling_Expert->counseling_id = $request->counseling_id;
        $counseling_Expert->save();

        return ['message' => ' counseling_Expert created', 'data' => $counseling_Expert];

    }

    // User
    public function show_experts($id_counseling){
        $counseling = counseling::find($id_counseling);
        return $counseling->experts;
    }
    public function show_counseling($id_expert){

        $expert = Expert::find($id_expert);
        return $expert->counselings;
    }
}
