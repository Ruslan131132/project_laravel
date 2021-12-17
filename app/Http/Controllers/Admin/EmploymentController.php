<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employment;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    public function index(){
        $employment = Employment::paginate(15);
         return view('pages.admin.employment', [
             'employments' => $employment
         ]);
    }
}
