<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rule;

class PageController extends Controller
{
    public function home()
	{
		return view('pages.home');
	}		

    public function rules()
	{
		$rules = Rule::orderBy('order_index')->get();
		return view('pages.rules', compact('rules'));
	}
}
