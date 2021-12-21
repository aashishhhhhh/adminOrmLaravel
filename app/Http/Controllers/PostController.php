<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\each;

class PostController extends Controller
{
    public function getId()
    {
        $temp=User::where('username',session()->get('user'))->get();
    }

    public function addPost()
    {
        return view('addPost');
    }

    public function createPost(Request $request)
    {
        $temp= User::where('username',session()->get('user'))->get();
        foreach($temp as $data)
        {
            $id= $data->id;
        }

        $data= $request->validate([
            'title'=>'required',
            'content'=>'required',
            'photo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $newImageName= time().'-'.$data['title'].'.'.$data['photo']->extension();
        $data['photo']->move(public_path('images'),$newImageName);
        
        
        post::create([
            'title'=>$data['title'],
            'content'=>$data['content'],
            'photo'=>$newImageName,
            'id'=>$id
        ]);

        return redirect('dashboard');
    }

    public function seePost()
    {

      $data=user::join('posts','posts.id',"=",'users.id')->orderby('posts.created_at','desc')->get();

      return view('listPost',['datas'=>$data]);
    }

    public function showPost($id)
    {
        $data = user::join('posts','posts.id',"=",'users.id')->where('users.id',$id)->orderby('posts.created_at','desc')->get();
        return view('listPost',['datas'=>$data]);
    }
}
