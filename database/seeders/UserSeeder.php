<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LocalCommunity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::disableQueryLog();
        DB::table('user_models')->truncate();
    
        LazyCollection::make(function () {
            $path = storage_path()."/app/public/uploads/dataset.txt";
          $handle = fopen($path, 'r');
          
          while (($line = fgetcsv($handle, 4096)) !== false) {
            $dataString = implode(", ", $line);
            $row = explode(';', $dataString);
            yield $line;
          }
    
          fclose($handle);
        })
        ->skip(1)
        ->chunk(1000)
        ->each(function (LazyCollection $chunk) {
          $records = $chunk->map(function ($row) {
          return [
            'category'=>$row[0],
            'fname'=>$row[1],
            'lname'=>$row[2],
            'email'=>$row[3],
            'gender'=>$row[4],
            'birthdate'=>$row[5]
          ];
          })->toArray();
          
          DB::table('user_models')->insert($records);
        });
    }
}
