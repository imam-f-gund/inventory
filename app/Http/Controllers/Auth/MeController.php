<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return response()->json($user, 200);
    }
}
