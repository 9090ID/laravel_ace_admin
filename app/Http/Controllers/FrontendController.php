<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berita;
class FrontendController extends Controller
{
    public function index()
    {
    	 $data = Berita::paginate(6);
        return view('frontend.index')->with('data', $data);
    }
}
