<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WikipediaController extends Controller
{
    public function index()
    {
        $url = "http://en.wikipedia.org/w/api.php?"
              ."action=query&"
              ."list=exturlusage&"
              ."eulimit=500&"
              ."format=json&"
              ."euquery=www.bdtheque.com";

        // Get data from URL and store in object
        $response = Http::withHeaders([
                'User-Agent' => 'University of Wolverhampton',
            ])->get($url);

        // Convert response to json object
        $wikis = $response->json('query.exturlusage');

        // Pass json object to view and display view
        return view('wikipedia', ['wikis' => $wikis]);
    }
}
