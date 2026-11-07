<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ajax extends Model
{
   public function index()
    {
        $games = (new Ajax)->getAllGames();
        print($games->toJson());
    }


}
