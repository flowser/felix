<?php

namespace App\Http\Controllers\API\User\Atrribute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\Attribute\Gender;

class GenderController extends Controller
{
    public function index()
    {
        $genders = Gender::get();
        return response()->json([
            'genders' => $genders,
        ], 200);
    }

    public function store(Request $request)
    {
        if (auth('api')->user()) {
            $this->validate($request,[
                'name'               =>'required',
            ]);

            $gender = new Gender();
            $gender->name             = $request->name;
            $gender->save();
            return response()->json([
                'gender' => $gender,
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth('api')->user()) {
            $this->validate($request, [
                'name'               =>'required',
            ]);

            $gender = Gender::find($id);
            $gender->name                = $request->name;
            $gender->save();
            return response()->json([
                'gender' => $gender,
            ], 200);
        }
    }

    public function destroy($id)
    {
        if(auth('api')->user()){
            $gender = Gender::findOrFail($id);
            $gender->delete();
            return response()->json([
                'gender' => $gender,
            ], 200);
        }
    }
}
