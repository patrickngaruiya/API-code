<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Models\User;
class UserController extends Controller
{
   
   
           
 //sign in
            
            public function signin(Request $request) {
                $fields=$request->validate([
                'email'=>'required|string',
                'password'=>'required|string'
                ]);
                $user=User::where('email',$fields['email'])->first();
        
                if(!$user || !Hash()::check($fields['password'],$user->password)){
                    return response([
                        'message'=>'wrong credentials'
                    ], 401);
        
                }
                $token = $user->createToken('myapptoken')->plainTextToken;
                $response=[
                   'user'=>$user,
                   'token'=>$token
                ];
                return response($response,201);
                    }
        




//register

                    public function register (Request $request) {
                        $fields=$request->validate([
                        'name'=>'required|string',
                        'email'=>'required|string|unique:users,email',
                        'password'=>'required|string|confirmed'
                        ]);
                        $user=User::create([
                            'name'=>$fields['name'],
                            'email'=>$fields['email'],
                            'password'=>bcrypt($fields['password'])
                        ]);
                        $token = $user->createToken('myapptoken')->plainTextToken;
                        $response=[
                           'user'=>$user,
                           'token'=>$token
                        ];
                        return response($response,201);
                            }
                           
                        



                            
  //log out
                        
                                    
            public function logout(Request $request){
            auth()->user()->tokens()-delete();
             return[
                          'message'=>'BYE'
             ];
            }
        }
        

