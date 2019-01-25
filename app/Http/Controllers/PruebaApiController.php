<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PruebaApiController extends Controller
{
    

    public function getstate()
    {
        $client = new Client(['base_uri' => 'https://swapi.co/api/']);  
        $response = $client->request('GET', 'people'); 
        $body = $response->getBody();
        $content =$body->getContents();
        $arr = json_decode($content,TRUE);
        
       
        $arrName = array();
        for ($i=0; $i < count($arr); $i++) { 
            array_push($arrName, $arr[$results][$i]->name);
        }
       return $arrName;
     
    }
}




