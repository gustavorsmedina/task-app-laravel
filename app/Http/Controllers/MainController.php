<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home(): View
    {
        $user = Auth::user();

        $tasks = $user->tasks()->orderBy('created_at', 'asc')->get();

        return view('home', compact('tasks'));
    }
}
