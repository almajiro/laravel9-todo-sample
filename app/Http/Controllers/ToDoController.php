<?php

namespace App\Http\Controllers;

class ToDoController extends Controller
{
    public function showToDoApplication()
    {
        return view('todo');
    }
}
