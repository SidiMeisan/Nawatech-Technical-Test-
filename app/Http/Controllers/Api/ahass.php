<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ahass extends Controller
{
   /**
    * index
    *
    * @return void
    */
   public function index(){
      $data1 = json_decode(Storage::disk('public')->get('JSON 1.json'));
      $data2 = json_decode(Storage::disk('public')->get('JSON 2.json'));

      $joinData = []; 
      foreach($data1->data as $data){
         $found = false;
         $entry = [
            "name" => $data->name,
            "email" => $data->email,
            "booking_number" => $data->booking->booking_number,
            "book_date" => $data->booking->book_date
         ];
         foreach ($data2->data as $dataWorkshop) {
            if($dataWorkshop->code == $data->booking->workshop->code){
               $found = true;
               $entry += [
                  "ahass_code" => $dataWorkshop->code,
                  "ahass_name" => $dataWorkshop->name,
                  "ahass_address" => $dataWorkshop->address,
                  "ahass_contact" => $dataWorkshop->phone_number,
                  "ahass_distance" => $dataWorkshop->distance,
                  "motorcycle_ut_code" => $data->booking->motorcycle->ut_code,
                  "motorcycle" => $data->booking->motorcycle->name,
               ];
               array_push($joinData, $entry);
               break;
            }
         }

         if ($found == false) {
            $entry += [
               "ahass_code" => $data->booking->workshop->code,
               "ahass_name" => $data->booking->workshop->name,
               "ahass_address" => "",
               "ahass_contact" => "",
               "ahass_distance" => 0,
               "motorcycle_ut_code" => $data->booking->motorcycle->ut_code,
               "motorcycle" => $data->booking->motorcycle->name,
            ];
            array_push($joinData, $entry);
         }
      }
      
      $returnData =[
         "status" => 1,
         "message" => "Data Successfully Retrieved.",
         "data" => $this->bubbleSort($joinData)
      ];

      return $returnData;
   }

   public function bubbleSort($my_array){
      $myArray = json_decode(json_encode($my_array), true); 

      do
      {
         $swapped = false;
         for ($i = 0, $c = count($myArray) - 1; $i < $c; $i++)
         {
               if (isset($myArray[$i]['ahass_distance']) && isset($myArray[$i + 1]['ahass_distance']))
               {
                  if ($myArray[$i]['ahass_distance'] > $myArray[$i + 1]['ahass_distance'])
                  {
                     list($myArray[$i + 1], $myArray[$i]) = array($myArray[$i], $myArray[$i + 1]);
                     $swapped = true;
                  }
               }
         }
      }
      while ($swapped);

      return $myArray;
   }

}
