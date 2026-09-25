<?php

namespace App\Http\Controllers\Web\Office;

use App\Http\Controllers\Controller;
use Exception;

class CorrespondenceController extends Controller
{
 public function index()
    {
        try{
           return view('office.correspondence.index');
        }catch(Exception $ex){
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}
