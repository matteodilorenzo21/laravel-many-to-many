<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class HomeController extends Controller
{
    public function index()
    {
        return $this->projectCounter();
        return view('admin.home');
    }

    public function projectCounter()
    {
        $projectCount = Project::count();

        return view('admin.home', compact('projectCount'));
    }
}
