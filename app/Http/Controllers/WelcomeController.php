<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {

         $ch = curl_init();

         curl_setopt($ch, CURLOPT_URL, 'https://newsapi.org/v2/top-headlines?country=us&apiKey=a0803122081a42b78d1fab855bf9a00c');
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


         $headers = array();
         $headers[] = 'Postman-Token: f71506de-3e98-46ac-9996-cdbe031e5538';
         $headers[] = 'Cache-Control: no-cache';
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

         $result = curl_exec($ch);
         if (curl_errno($ch)) {
             echo 'Error:' . curl_error($ch);
         }
         curl_close($ch);

         /*json decoding*/
         $newsPosts = json_decode($result);

        /*getting only articles from json*/
        $articles= $newsPosts->articles;

//         var_dump($newsPosts->articles[0]->title);die;

        return view('welcome', compact('articles'));

    }

}
