<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LogoutController extends Controller
{
    public function index(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        
        $data['message'] = 'Berhasil logout';

        return response()->json($data, 200);
    }
}
