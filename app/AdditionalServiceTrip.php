<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdditionalServiceTrip extends Model
{
     use SoftDeletes;
     protected $table = "additional_service_trip";
     protected $fillable = ['reservation_id', 'service', 'service_cost', 'quanitity', 'total_cost', 'trip_id'];
     protected $dates = ['deleted_at'];
}
