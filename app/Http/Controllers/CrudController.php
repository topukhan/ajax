<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Validator;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class CrudController extends Controller
{
    //Index 
    public function index(){
        $users = User::all();
        return view('crud.list', compact('users'));

    }
    // Create user 
    public function createFormView()
    {
        return view("crud.create");
    }
    public function createFormValidation(Request $request)
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
            return response()->json(['success' => 'User Created Successfully']);
            
        }
        return response()->json(['error' => $validator->errors()->toJson()]);
    }

    # Edit Form View and Validation for Update Data in Database
    public function editFormView($id){
        $user = User::where('id', $id)->first();
        return view('crud.edit', compact('user'));
    }
    //
    public function updateUserInfo(Request $request, $id){
        try {
            dd('');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
