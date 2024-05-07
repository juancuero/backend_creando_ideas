<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function logueado(Request $request)
    {
        return 'usuario log';
    }

    public function nologueado(Request $request)
    {
        return 'usuario not log';
    }
}
