<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Actor;

class ExampleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Example Controller
    |--------------------------------------------------------------------------
    |
    | This controller demonstrates preloading some data from a database
    | and redirecting to a new webpage.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Preloads data and displays example view.
     */
    public function index() {
        
        $data = Actor::select('first_name', 'last_name')->limit(10)->get();

        return view('example', ['data' => $data]);
    }
}
