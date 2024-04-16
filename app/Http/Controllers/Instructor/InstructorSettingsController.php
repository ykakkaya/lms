<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorSettingsController extends Controller
{
    public function index(){
        return view('instructor.instructor_dashboard');
    }
}
