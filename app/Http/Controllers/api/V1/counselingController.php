<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Models\counseling;
use App\Models\Expert;
use Illuminate\Http\Request;

class counselingController extends Controller
{
    public function index()
    {
        $counselings = counseling::all();
        return $counselings;
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|min:3|max:255',
        ]);
        $counseling = new counseling();
        $counseling->name = $request->name;
        $counseling->save();
        return ['message' => ' counseling created', 'data' => $counseling];

    }
    public function show($id){
        $counseling = counseling::find($id);
        return $counseling;
    }
    public function Search_name($name_counseling){
        $counseling = counseling::where('name',$name_counseling)->firstOrFail();
        return $counseling;
    }




}
