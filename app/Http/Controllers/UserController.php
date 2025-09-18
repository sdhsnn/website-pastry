<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\UserRequest;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Exports\UsersExport;
class UserController extends Controller
{
    
    public function import(UserRequest $request) 
    {
        try{

            Excel::import(new UsersImport, $request->file('file'));
            return response()->json(['data'=>'Users imported successfully.',201]);
        }catch(\Exception $ex){
            Log::info($ex);
            return response()->json(['data'=>'Some error has occur.',400]);

        }
        
    }

     /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}