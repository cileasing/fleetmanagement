<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Serverside extends Controller
{
      public function advancesearch() {
          if(isset($_SERVER['QUERY_STRING'])){
              echo $_SERVER['QUERY_STRING'];
              exit();
          }else{
              echo "nothing to output";
          }
          
      }
}
