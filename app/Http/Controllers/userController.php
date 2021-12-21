<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class userController extends Controller
{

    public function logout()
    {
        session()->forget('user');
        return view('login');
    }
    public function dashboardShow()
    {
        $temp= User::where('username',session()->get('user'))->get();
        foreach($temp as $data)
        {
            $id= $data->id;
        }
        $temp =User::select('role')->where([ 'username'=>session()->get('user')])->get(); 
        $data=User::where('role','normal')->paginate(8);
        $post=post::where('id',$id)->orderby('created_at','desc')->get();
        return view('dashboard',['datas'=>$data,'role'=>$temp,'posts'=>$post]);
    }

    public function signUpShow()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {   
        $data= $request->validate(
            [
                'username'=> 'required|unique:users|max:255',
                'email'=> 'required',
                'password'=>'required',
                'address'=>'required',
                'role'=>'required'
            ]
            );
        
        User::create(
            [
                'username'=>$data['username'],
                'email'=>$data['email'],
                'password'=>hash::make($data['password']),
                'address'=>$data['address'],
                'role'=>$data['role']
            ]
            );
    }

    public function loginShow ()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data= $request->validate(
            [
                'username'=> 'required',
                'password'=> 'required',
            ]
            );

            if(Auth::attempt($data))
            {
                session()->put('user',$data['username']);
                return redirect('dashboard');
            }
            else{
                session()->flash('msg','Credentials not Matched');
                return view('login');
            }
    }

    public function addUser(Request $request)
    {
        $data=$request->validate(
            [
                'username'=> 'required|unique:users|max:255',
                'email'=> 'required',
                'password'=>'required',
                'address'=>'required',
            ]
            );
        User::create(
             [
                'username'=>$data['username'],
                'email'=>$data['email'],
                'password'=>hash::make($data['password']),
                'address'=>$data['address'],
                'role'=>'normal'
            ]
            );

        return redirect('dashboard');
    }

    public function edit(Request $request)
    {
       $id= $request->post('id');
      
       
        $data= $request->validate(
            [
                'username'=> 'required|unique:users|max:255',
                'email'=> 'required',
                'password'=>'required',
                'address'=>'required',
            ]
            );

            User::where('id',$id)->update([
                'username'=>$data['username'],
                'email'=>$data['email'],
                'password'=>hash::make($data['password']),
                'address'=>$data['address'],
                'role'=>'normal'
            ]);
            return redirect('dashboard');
    }

    public function delete($id)
    {
        User::where('id',$id)->delete();
        return redirect('dashboard');
    }

}
