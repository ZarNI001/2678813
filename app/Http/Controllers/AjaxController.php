<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ajax;

class AjaxController extends Controller
{
    public function index()
    {
        $games = (new Ajax)->getAllGames();
        print($games->toJson());
    }
}
