<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    use HasFactory;
    protected $fillable = ['name','address','phone_number','description','image','value_likes','counter_likes','price'];

    // Appointments
    public function Appointments()
    {
        return $this->hasMany(Appointment::class);

    }
    // counselings
    public function counselings(){
        return $this->belongsToMany(counseling::class,'counseling_experts');
    }
    public function users(){
        return $this->belongsToMany(User::class,'bookings');
    }
}
