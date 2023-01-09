<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Appointment;
use App\Models\Expert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index(){
        $accounts = Account::all();
        return $accounts;

    }
    public function store(Request $request){

        $request->validate([
            'user_id'=>'required',
            'Balance'=>'required',
            'Account_Number'=>'required'
        ]);
        $account = new Account();
        $account->user_id = $request->user_id;;
        $account->Balance = $request->Balance;
        $account->Account_Number = $request->Account_Number;
        $account->save();

        return ['message' => 'Account created', 'data' => $account];

    }
    public function Payment(Request $request){

        $request->validate([
           //  'user_Number'=>'required',
           // 'expert_Number'=>'required'
            'appointment_id'=>'required',
            'user_id'=>'required'
        ]);
        $x = $request->appointment_id;
        $appoientment = Appointment::find($x);

        $expert_id = $appoientment->Expert->id;
        $user_id = $request->user_id;

        $expert_price =Expert::find($expert_id)->price;


        $account_user =Account::where('user_id',$user_id)->firstOrFail();
        $account_expert = Account::where('user_id',$expert_id)->firstOrFail();


        $account_user->Balance = $account_user->Balance - $expert_price ;
        $account_expert->Balance = $account_expert->Balance + $expert_price ;

        $account_user->update();
        $account_expert->update();


        return ['message' => 'Payment Successfully','data'=> $account_user];

    }

}
