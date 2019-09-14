<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function manager(Request $request)
    {
        return view('manager',['tags' => $request->tags]);
    }
}

?>