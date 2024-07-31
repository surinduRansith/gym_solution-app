<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'member_id',
        'sheduleType_id',
         'noofsets',
         'nooftime'
 ];

}
