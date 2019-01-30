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
        
      //return $arr;

    return view('welcome')->with(['pjs'=>$arr['results']]); 

   
  
     
    }
    public function imgurApiView()
    {
   

    return view('imgur'); 

    }

    public function imgurApi(Request $request){
        $foto = $request->file('foto');
         // $extension = $foto->getClientOriginalExtension();
        // Storage::disk('public')->put($foto->getFileName().'.'.$extension, File::get($foto));
        $image64 = base64_encode(file_get_contents($foto)); //pasar la foto a base64
          //llamar a la api y subir la imagen
          $curl = curl_init();
          $client_id = "85a6440ece3ba5b";
          $token = "a9faf883bce05d06613ea6d0ece2c6e0aa764497";
          curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.imgur.com/3/image",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array('image' => $image64),
            CURLOPT_HTTPHEADER => array(
              // "Authorization: Client-ID {{1cb45b7462006f}}",
              "Authorization: Bearer ".$token //nuestro token para acceder a ala api
            ),
          ));
          $response = curl_exec($curl);
          $err = curl_error($curl);
          curl_close($curl);
          if ($err) {
            echo "cURL Error #:" . $err;
          } else {
            $json = json_decode($response);
            return view ('imgur',['img' => $json->data->link]); //pilla link de la api
            
          }
      }        
    
}




