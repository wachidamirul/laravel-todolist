<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function home(Request $request): RedirectResponse
	{
		return ($request->session()->exists("user")) ? redirect("/todolist") : redirect("/login");
	}
}
