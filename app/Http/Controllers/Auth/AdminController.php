<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use AuthorizesRequests;
    
    public function index() 
    {
        if ($this->authorize('viewAdmin', Auth::user())) {
            return view('admin');
        }
    }
}
