<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class counseling_expert extends Model
{
    use HasFactory;
    protected $fillable = ['counseling_id','expert_id'];
}
