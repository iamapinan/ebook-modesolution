<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    //
    public function privacy() {
	return view('privacy');
    }
}
