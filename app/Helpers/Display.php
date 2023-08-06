<?php
namespace App\Helpers;

class Display 
{
    public static function status_order($value)
    {
        if($value == 'natYet')
        {
            return '<i class="fa-solid fa-bars-progress"></i>';
        }else{
            return '<i class="fa-solid fa-thumbs-up" style="color: #7be137;"></i>';
        }
    }
    public static function upload_image($file, $heros)
    {
        $background = $file;
            $filename = time() . '-' . rand() . $background->getClientOriginalName(); //untuk insert file background 
            $background->move(public_path('/img/$heros'), $filename);
            return $filename;
    }
}