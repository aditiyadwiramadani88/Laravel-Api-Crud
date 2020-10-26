<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Ahc\Jwt\JWT;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class ProductC extends Controller{
     public function List_Data(Request $request){
        $model = Product::all();
        $create = new Product;
        if($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price' =>  'required',
                ]);
        if ($validator->fails()){
            return $validator->errors();
        }
            $create->name = $request->name;
            $create->price = $request->price;
            $create->save();
            return $request->input();
    }
    return $model;
    }
    public function Details(Request $request, $id){
        $model = Product::find($id);
        if(!$model){
            return response()->json([
                'msg' => 'id not fout'
            ], 403);
        }
        
        if($request->isMethod('put')){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'price' =>  'required',
                 ]);
            if ($validator->fails()){
                    return $validator->errors();
            }
                $model->name = $request->name;
                $model->price = $request->price;
                $model->save();
                return $request->input();
        }
        else if($request->isMethod('delete')){
            $model->delete();
            return \response()->json([
                'msg' => 'success detete'
            ], 202);
        }
        return $model;
    }
public function Token($email, $pw){
     $jwt = new JWT('secret', 'HS256', 3600*30, 10);
      $token = $jwt->encode([
      'email' => $email,
      'pw' => $pw
]);
      return ['token' => $token];
}
    public function Login(Request $request){

         $validator = Validator::make($request->all(), [
                'email' => ['required', 'email'],
                'password' =>  ['required', 'min:8'],
                ]);
        if ($validator->fails()){
            return $validator->errors();
        }
     $user = User::where('email', $request->email)->first();
     if(!$user){
         return response()->json(['msg' => 'email not registered yet'], 402);
     }
     if (Hash::check($request->password, $user->password)) {
         if($user->role_id != 1){
             return ['msg' => 'sucesss login'];
         }
         return  $this->Token($request->email, $request->password);
    }
      return response()->json([
          'msg' => 'email or password wrong'
      ], 402);
    }

public function Register(Request $request){

    $validator = Validator::make($request->all(), [
        'email' => ['required', 'email', 'unique:users'],
        'password' =>  ['required', 'min:8'],
        'name' => ['required', 'string', 'min:4']

        ]);
    if ($validator->fails()){
            return $validator->errors();
        }
    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->role_id = 2;
    $user->save();
    return ['msg' => 'success create acconout'];
}

}