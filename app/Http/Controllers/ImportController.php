<?php

namespace App\Http\Controllers;

use App\Imports\SignatureImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importSignatures(Request $request)
    {
        if($request->file())
        {
            $file = $request->file('importSignature');
            
            // fill consolidations
            Excel::import(new SignatureImport, $file);
            // dd($signatures);
            return redirect()->route('signatures');
        }else{
            dd('no tiene');
        }
        
    }

    public function image()
    {
        $ci = strlen('1760840239001');
        $espacio = " ";
        $algo = $espacio * 2;
        // dd($ci);
        $text = $ci . $algo .'| Jose Perez | 1 año | $18 |';
        $a = html_entity_decode($text);
        header("Content-Type: image/png");
        $im = @imagecreate(800, 200)
            or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($im, 255, 255, 255);
        $text_color = imagecolorallocate($im, 233, 14, 91);
        // imagestring($im, 11, 1, 1, $a, $text_color);
        imagestring($im, 5, 1, 1,  "Cedula | Nombre", $text_color); 
        imagestring($im, 3, 1, 20, $text, $text_color); 
        $img = imagepng($im);
        imagedestroy($im);
        return $img;
    }
}
