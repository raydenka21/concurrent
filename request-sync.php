<?php

namespace App\Http\Controllers;

use GuzzleHttp\Promise\Utils;
use GuzzleHttp\Client;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->client = new Client();
    }

    public function sync(): object
    {
        $promises = [];
        for ($x = 1; $x <= 100; $x++) {
            $getData = $this->client->request("GET", "https://jsonplaceholder.typicode.com/posts/$x/comments");
            $promises[] = json_decode($getData->getBody(), true);
        }
        return response()->json($promises);
    }

}
