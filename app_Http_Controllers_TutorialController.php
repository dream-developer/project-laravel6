<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index()
    {
        return view('tutorial.index');
    }
    public function create()
    {
        return view('tutorial.create');
    }
    public function store(Request $request)
    {
        // データ追加処理
    }
}
