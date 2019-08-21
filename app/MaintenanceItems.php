<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceItems extends Model
{
    protected $fillable = [
        'maintenance_id', 'type_name', 'sub_type', 'description', 'quantity', 'estimated_cost', 'approved_cost', 
        'estimated_amount', 'approved_amount', 'logged_by', 'created_by',
    ];
}
