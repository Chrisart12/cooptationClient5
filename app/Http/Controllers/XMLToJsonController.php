<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class XMLToJsonController extends Controller
{
    /**
     * Prend une url en paramettre et le convertit
     * en json et retourne un json_decode
     */
    public static function convertXmlToJson($xmlUrl)
    {
        // Read entire file into string 
        $xmlFile = file_get_contents($xmlUrl); 

        // Convert xml string into an object 
        $objectFile = simplexml_load_string($xmlFile); 

        // Convert into json 
        $jsonFile = json_encode($objectFile); 

        return json_decode($jsonFile, true); 
    }
}
