<?php
namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;

use App\Models\product;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Flash;
use Response;

class ProductControllerAPI extends Controller{
public function login(){
    if(Auth::attempt(['username' => request('username'),'password' => request('password')])){
        $user = Auth::user();
        $success['token'] = Str::random(64);
        $success['name'] = $user->name;
        $success['username'] = $user->username;
        $success['id']=$user->id;
        $user->remember_token = $success['token'];
        $user->save();
        $logs = new Logs;
        $logs->userid = $user->id;
        $logs->log = "Login";
        $logs->logdetails = "User $user->name has logged into my system";
        $logs->logtype = "API login";
        $logs->save();
        
        return response()->json($success,200);
    }else{
        return response()->json($success,404);
    }
   }
   public function register(Request $request){
       $validator = Validator::make($request->all(),[
           'name'=>'required',
           'username'=>'required',
           'email'=>'required|email',
           'password'=>'required',
       ]);
       if($validator->fails()){
           return response()->json(['respons'=>$validator->errors()],401); 
       }else{
           $input = $request->all();
           if(User::where('email',$input['email'])->exists()){
               return response()->json(['response'=>'Email already exists'],401);
           }elseif(User::where('username',$input['username']->exists())){
               return respones()->json(['response'=>'Username already exists'],401);
           }else{
               $input['password']->bcrypt($input['password']);
               $user = User::create($input);
               $success['token']=Str::random(64);
               $success['name']=$user->name;
               $success['username']=$user->username;
               $success['id']=$user->id;
               return response()->json($success,200);

           }
       }
   }
   public function resetpassword(Request $request){
       $user = User::where('email',$request['email']->first());
       if ($user !=null){
           $user->password = bcrypt($request['password']);
           $user->save();
           return response()->json(['response'=>'User has succeded resseting his/her password'],200);

       }else{
           return response()->json(['response'=>'User not found'],404);
       }
   }
}