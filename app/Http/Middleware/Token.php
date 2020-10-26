<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Ahc\Jwt\JWT;
use Ahc\Jwt\JWTException;
use App\models\User;
class Token{
    public function handle(Request $request, Closure $next){
        $cek_token = $request->header('token');
        if(!$cek_token){
            return response()->json(['msg' => 'required headers token '], 402);
        }
        try {
            $pay = new JWT('secret', 'HS256', 3600*30, 10);
            $token = $pay->decode($cek_token);
        }catch(JWTException $e){
            return response()->json(['msg' => 'wrong token'], 403);
        }
         $user = User::where('email',$token['email'])->first();
     if (!$user && Hash::check($token['pw'], $user->password)) {
         return $cek_token;
    }
        return $next($request);
    }
}
