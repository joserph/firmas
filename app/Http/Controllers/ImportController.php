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
}
