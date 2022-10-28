<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class redirectLinkController extends Controller
{
    public function showCreate($value='')
    {
        return view('redirect.create');
    }
}
