<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model {

    //use SoftDeletes;
    //protected $dates = ['deleted_at'];
    protected $table = "vessel_assets";
   /* protected $fillable = [
        'vessel_Name', 'vessel_Ex_Name',  'vessel_Type', 'Owner_vessel_manager', 'IMO_Number', 
         'Deadweight', 'Gross_Tonnage', 'TEU_Capacity', 'Length', 'Beam', 
        'Age_of_vessel', 'Engine_power',  'contract_type', 'Built', 'Size', 'Draught', 'Builder', 'Place_of_build', 'Net_Tonnage', 'Crude', 'status'
    ];
    * 
    */

}
