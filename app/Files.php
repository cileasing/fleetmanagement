<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
     protected $table = "files";
     
    protected $fillable = [
        'table_name', 'document_title', 'table_pk', 'request_id', 'org_filenames', 'filenames', 
         'logged_by', 'created_by'
    ];
}
