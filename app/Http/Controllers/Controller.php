<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public static function getSlug($text)
    {
        $word = strtolower($text);
        $word = str_replace("ä", "ae", $word);
        $word = str_replace("ö", "oe", $word);
        $word = str_replace("ü", "ue", $word);
        $word = str_replace("ß", "ss", $word);
        $word = str_replace("&", "und", $word);
        $text = preg_replace('~[^\pL\d]+~u', '-', $word);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-\w]+~', "", $text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}
