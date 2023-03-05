<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //
    public function parseDB() {
        $cat = UserModel::select("category")
                    ->groupBy('category')
                    ->get();
        $users = UserModel::simplePaginate(15);
        return view('review', ["users"=>$users, "categories"=>$cat]);
    }
    
    
    public function parseDBWithParams(Request $req) {
        //form validation
        $req->validate([
            'export' => 'required|digits_between:0,1',
            'cat' => 'required|string|max:100',
            'gender' => 'required|string|max:6',
            'bd' => 'max:10',
            'age' => 'digits_between:0,150',
            'from' => 'digits_between:0,150|required_with_all:to.',
            'to' => 'digits_between:0,150|required_with_all:from'
        ]);
        
        //parse input
        $expt = intval($req -> input('export'));
        $cat = $req -> input('cat');
        $gender = $req -> input('gender');
        $bd = $req -> input('bd');
        $age = $req -> input('age');
        $fromy = $req -> input('from');
        $toy = $req -> input('to');
        
        //where maker
        $where = [];
        //add category
        if ($cat != 'all') {
            $where[] = ['category', '=', $cat];
        }
        //add gender
        if ($gender != 'all') {
            $where[] = ['gender', '=', $gender];
        }
        //add date
        if (!is_null($bd)) {
            $where[] = ['birthdate', '=', $bd];
        } else if (!is_null($age)) {
            $where[] = [DB::raw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) "), '=', $age];
        } else if (!is_null($fromy))  {
            $where[] = [DB::raw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) "), '>', $fromy];
            $where[] = [DB::raw("TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) "), '<', $toy];
        }
        //end where maker
        
        //select what to do on "export" parseDBWithParams
        if ($expt == 0) {
            $cat = UserModel::select("category")
                    ->groupBy('category')
                    ->get();
            $users = UserModel::where($where)->simplePaginate(15);
            return view('review', ["users"=>$users, "categories"=>$cat]);
        } else {
            $results = UserModel::where($where)->get();
            //for download by user
            header('Content-Type: text/csv; charset=utf-8');  
            header('Content-Disposition: attachment; filename=export.csv'); 
            //make csv
            $out = fopen("php://output", "w"); 
            foreach($results as $res){
                fputcsv($out, [$res->category, $res->fname, $res->lname, $res->email, $res->gender, $res->birthdate]);
            }
            fclose($out);
        }
        
    }
}
