<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;

class WelcomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalAdmins = Admin::count();
        $totalWriters = \App\Models\Writer::count();

        return view('welcome', compact('totalUsers', 'totalAdmins', 'totalWriters'));
    }
}