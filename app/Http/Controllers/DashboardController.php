<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DashboardController extends Controller
{
    public function admin()
    {
        return Inertia::render('Admin/Dashboard');
    }

    public function artist()
    {
        return Inertia::render('Artist/Dashboard');
    }

    public function listener()
    {
        return Inertia::render('Listener/Dashboard');
    }
}