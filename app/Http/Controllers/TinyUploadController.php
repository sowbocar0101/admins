<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TinyUploadController extends Controller{

    public function uploadImage(Request $request){
        $destinationPathImage = 'images/uploaded';

        if (!file_exists(public_path($destinationPathImage))) {
            mkdir(public_path($destinationPathImage), 0755, true);
        }

        $file = $request->file('file');
        // Get file extension
        $extension = $file->getClientOriginalExtension();
        $filename = $file->getClientOriginalName();

        // Get file extension
        $extension = $file->getClientOriginalExtension();
        $filename = $file->getClientOriginalName();

        // return $filename;
        $original_name = pathinfo($filename, PATHINFO_FILENAME);


        // Valid extensions
        $validextensions = array("jpeg","jpg","png");

        if(in_array(strtolower($extension), $validextensions)){
            // Rename file
            $fileNameImages = str_replace(' ', '_', $original_name) .'.' . $extension;
            // Uploading file to given path
            $file->move($destinationPathImage, $fileNameImages);
            return response()->json(['location' => asset('/images/uploaded/'.$fileNameImages)]);
        }else{
            return response(["Unable to uppload image"]);
        }
    }

}
