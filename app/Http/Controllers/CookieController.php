<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieController extends Controller
{
    public function acceptCookies(Request $request)
    {
        Cookie::queue('cookies_accepted', true, 60 * 24 * 365);
        return response()->json(['message' => 'Cookies acceptés']);
    }
}
