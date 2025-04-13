<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function show($error = 500)
    {
        return response()->view('errors.show', ['error' => $error], $error);
    }
}
