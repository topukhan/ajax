<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class TestController extends Controller
{

    public function createFormView()
    {
        return view("crud.create");
    }
    public function validation(Request $request)
    {
        // dd($request->password);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required']
        ]);

        if ($validator->passes()) {
            $save = new User;
            $save->name = $request->name;
            $save->email = $request->email;
            $save->password = md5($request->password);
            $save->save();
            return response()->json(['success' => 'data saved']);
            
        }
        return response()->json(['error' => $validator->errors()->toJson()]);
    }
}
