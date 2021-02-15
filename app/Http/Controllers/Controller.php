<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function GetCode($row = null)
    {
        $contents = file_get_contents("txt.txt", "r") or die("Unable to open file!");
        $lines = explode("\n", $contents);
        $return = "";
        for ($i = 0; $i < count($lines); $i++) {
            $time = $lines[$i];
            if($row){
                if (explode("\t"[0],$time)[0] == $row) {
                    array_splice($lines, 0, $i+1); //removes 0 -- $i from $lines
                    $return =  implode("\n", $lines);
                }
            }
            $first = explode("\n",implode("\n", $lines))[0];
            $socunt = explode("\t",$first)[1];
            $return = $socunt;
        }
        return $return;
    }

    public function IP_Address(){
        return \Request::ip();
    }

    public function CheckCodeSearch($row)
    {
        $four = substr($row, -1);
        $three = substr($row, -2 , -1);
        $two = substr($row, -3 , -2);
        $one = substr($row, -4 , -3);

        if($four >= 1 && $four < 6){
            $four = $four + 1;
        }
        else if($three >= 1 && $three < 6){
            $three = $three + 1;
        }
        else if($two >= 1 && $two < 6){
            $two = $two + 1;
        }
        else if($one >= 1 && $one < 6){
            $one = $one + 1;
        }


        return $one.$two.$three.$four;

    }

}
