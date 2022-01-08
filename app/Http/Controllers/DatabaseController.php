<?php

namespace App\Http\Controllers;

use DB;
use App\Model\Region;
use App\Model\Responsible;
use App\Model\User;
use App\Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function foundUserRegion()
    {
        $regions = Region::select('*')->get();

        // $users = User::select('users.region')->get();

            foreach ($regions as $region) {
                    DB::table('users')
						->where('users.region', '=', $region->label)
						->update([
									'region_id' => $region->id,
										
								]);
                
            }


        return 'toto';

        // return $regions;
        // dd($regions);
    }


    public function foundUserResponsible()
    {
        $responsibles = Responsible::select('*')->get();

        // $users = User::select('users.region')->get();

            foreach ($responsibles as $responsible) {
                    DB::table('users')
						->where('users.responsible', '=', $responsible->label)
						->update([
									'responsible_id' => $responsible->id,
										
								]);
                
            }


        return 'tata';
    }
}
