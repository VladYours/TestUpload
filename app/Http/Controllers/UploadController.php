<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;

class UploadController extends Controller
{
    //
    public function uploadToDB(Request $req) {
        //form validation
        $req->validate([
            'csv' => 'required|mimes:csv,txt'
        ]);
        
        $file = $req->file('csv');
        if ($file) {
            //generate uniq filename
            $fileName = time().'_'.$file->getClientOriginalName();
            //store uploaded file
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            //make real path of file for delete
            $realPath = "../storage/app/public/".$filePath;
            $um = new UserModel();
            //clear table user_models in db
            $um->truncate();
            if (($handle = fopen($realPath, "r")) !== FALSE) {
                //parse CSV to model
                $users = [];
                while (($data = fgetcsv($handle, 700)) !== FALSE) {
                    $users[] = [
                        'category'=>$data[0],
                        'fname'=>$data[1],
                        'lname'=>$data[2],
                        'email'=>$data[3],
                        'gender'=>$data[4],
                        'birthdate'=>$data[5]
                        ];
                }
                fclose($handle);
                //insert in DB
                UserModel::insert($users);
                return redirect('/review');
            } else {
                return "Error when parse data from CSV";
            } //end else 
            //delete file from server
            unlink($realPath);
        } else {
            return "No file";
        }
        
    }
    
    
}
