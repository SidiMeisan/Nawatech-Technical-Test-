<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\stdClass;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ahass extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $jsonContents1 = '{
            "status":1,
            "message":"Data Successfuly Retrieved.",
            "data":[
               {
                  "name":"anwar",
                  "email":"anwar@mail.com",
                  "booking":{
                     "booking_number":"101000103066",
                     "book_date":"2022-03-12",
                     "workshop":{
                        "code":"01000",
                        "name":"Wahana Honda Gunung Sahari"
                     },
                     "motorcycle":{
                        "name":"NEW CB150R STREETFIRE",
                        "ut_code":"H5C02R20S1 M/T"
                     }
                  }
               },
               {
                  "name":"heru",
                  "email":"heru@gmail.com",
                  "booking":{
                     "booking_number":"10100062661",
                     "book_date":"2022-06-09",
                     "workshop":{
                        "code":"11497",
                        "name":"AHASS KAWI Indah Jaya Motor 3"
                     },
                     "motorcycle":{
                        "name":"BEAT SPORTY CBS MMC",
                        "ut_code":"HH1B02N41S1 A/T"
                     }
                  }
               },
               {
                  "name":"bayu",
                  "email":"bayu@yahoo.com",
                  "booking":{
                     "booking_number":"100190109431",
                     "book_date":"2022-06-10",
                     "workshop":{
                        "code":"17236",
                        "name":"AHASS MEGATAMA MOTOR"
                     },
                     "motorcycle":{
                        "name":"BEAT POP ESP CW COMIC",
                        "ut_code":"Y1G02N02L1A A/T"
                     }
                  }
               },
               {
                  "name":"santoso",
                  "email":"santoso@microsoft.com",
                  "booking":{
                     "booking_number":"101000109430",
                     "book_date":"2022-03-12",
                     "workshop":{
                        "code":"07577",
                        "name":"AHASS TUNGGAL JAYA"
                     },
                     "motorcycle":{
                        "name":"BLADE S",
                        "ut_code":"NF11C1CD M/T"
                     }
                  }
               },
               {
                  "name":"ilyas",
                  "email":"ilyas@gmail.com",
                  "booking":{
                     "booking_number":"117236109426",
                     "book_date":"2022-06-08",
                     "workshop":{
                        "code":"00190",
                        "name":"Dunia Motor Kebayoran Lama"
                     },
                     "motorcycle":{
                        "name":"NEW BEAT CAST WHEEL",
                        "ut_code":"NC11B3C2A/T"
                     }
                  }
               },
               {
                  "name":"kibo",
                  "email":"kibo@gmail.com",
                  "booking":{
                     "booking_number":"117550109401",
                     "book_date":"2022-05-10",
                     "workshop":{
                        "code":"11497",
                        "name":"AHASS KAWI Indah Jaya Motor 3"
                     },
                     "motorcycle":{
                        "name":"BEAT STREET",
                        "ut_code":"D1I02N27M1 A/T"
                     }
                  }
               },
               {
                  "name":"ilyas",
                  "email":"ilyas@gmail.com",
                  "booking":{
                     "booking_number":"117550109404",
                     "book_date":"2022-06-08",
                     "workshop":{
                        "code":"00190",
                        "name":"Dunia Motor Kebayoran Lama"
                     },
                     "motorcycle":{
                        "name":"REVO FIT JKT",
                        "ut_code":"R2B02K01S1K M/T"
                     }
                  }
               }
            ]
        }';
        
        $jsonContents2 = '{
            "status":1,
            "message":"Data Successfuly Retrieved.",
            "data":[
               {
                  "code":"01000",
                  "name":"Wahana Honda Gunung Sahari",
                  "address":"Jalan Gunung Sahari",
                  "phone_number":"085800000000",
                  "distance":5.2
               },
               {
                  "code":"11497",
                  "name":"AHASS KAWI Indah Jaya Motor 3",
                  "address":"Jakarta Pusat",
                  "phone_number":"085300000000",
                  "distance":10.3
               },
               {
                  "code":"00190",
                  "name":"Dunia Motor Kebayoran Lama",
                  "address":"Kebayoran Lama, Jakarta Selatan",
                  "phone_number":"085600000000",
                  "distance":2.5
               },
               {
                  "code":"07577",
                  "name":"AHASS TUNGGAL JAYA",
                  "address":"Jakarta Timur",
                  "phone_number":"085200000000",
                  "distance":11.5
               }
            ]
        }';

        $data1 = json_decode($jsonContents1);
        $data2 = json_decode($jsonContents2);
        $joinData = []; 
        foreach($data1->data as $data){
            foreach ($data2->data as $dataWorkshop) {
                if($dataWorkshop->code == $data->booking->workshop->code){
                    $entry = [
                        "name" => $data->name,
                        "email" => $data->email,
                        "booking_number" => $data->booking->booking_number,
                        "book_date" => $data->booking->book_date,

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
        }

        return $this->bubbleSort($joinData);
    }

    public function bubbleSort($my_array){
        $myArray = json_decode(json_encode($my_array), true); // Konversi objek menjadi array

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
