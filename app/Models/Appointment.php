<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = ['day','time_end','time_start','expert_id'];

    public function Expert(){
        return $this->belongsTo(Expert::class);
    }
}
