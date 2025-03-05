<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function dashboard(){
    $data['meta_title'] = "Dashboard";
    return view('backend.dashboard', $data);
   }
}
