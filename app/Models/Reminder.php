<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'email', 'reminder_date', 'message','title', 'description', 'date', 'latitude', 'longitude',];
   
    
}
