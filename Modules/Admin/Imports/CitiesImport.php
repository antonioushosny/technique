<?php
namespace Modules\Admin\Imports;

use Modules\Admin\Models\City;
use Modules\Admin\Models\Country;
use Modules\Admin\Models\CityTranslation;
 
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithMappedCells	;
// use Maatwebsite\Excel\Concerns\SkipsOnFailure;
class CitiesImport implements ToCollection ,WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.cities_code'     => 'required|numeric',
            // '*.cities_status'   => 'required',
            '*.cities_name_ar'  => 'required',
            '*.cities_name_en'  => 'required',
            
        ])->validate();

        // dd($rows) ;
        foreach($rows as $row) {
            // dd($row['cities_code']) ;
            $city = City::where('cities_code',$row['cities_code'])->first();
            $country = Country::first();
            if(!$city){
                $city = new City ;
            } 
             $city->cities_code = $row['cities_code'] ; 
             $city->countries_id = $country->countries_id ; 
             $city->name = $row['cities_name_en'] ; 
             $city->cities_status = 1 ; 
             $city->save() ;

             $CityTranslation = CityTranslation::where('cities_id',$city->cities_id)->where('locale','ar')->first();
             if($CityTranslation){
                $CityTranslation->cities_id     =  $city->cities_id;
                $CityTranslation->locale        =  'ar';
                $CityTranslation->cities_name   =  $row['cities_name_ar'] ;
                 $CityTranslation->save() ; 
             }else{
                $CityTranslation                    = new CityTranslation ;
                $CityTranslation->cities_id     =  $city->cities_id;
                $CityTranslation->locale        =  'ar';
                $CityTranslation->cities_name   =  $row['cities_name_ar'] ;
                 $CityTranslation->save() ; 
             }

             $CityTranslation = CityTranslation::where('cities_id',$city->cities_id)->where('locale','en')->first();
             if($CityTranslation){
                $CityTranslation->cities_id    =  $city->cities_id;
                $CityTranslation->locale       =  'en';
                $CityTranslation->cities_name  =  $row['cities_name_en'] ;
                 $CityTranslation->save() ; 
             }else{
                $CityTranslation = new CityTranslation ;
                $CityTranslation->cities_id    =  $city->cities_id;
                $CityTranslation->locale       =  'en';
                $CityTranslation->cities_name  =  $row['cities_name_en'] ;
                 $CityTranslation->save() ; 
             }
  
         
        }
       
    }
    public function batchSize(): int
    {
        return 1000;
    }
    public function onFailure(Failure ...$failures)
    {
        // Handle the failures how you'd like.
    }
    public function chunkSize(): int
    {
        return 1000;
    }
    public function model(array $row)
    {
        //  
    }
    
}