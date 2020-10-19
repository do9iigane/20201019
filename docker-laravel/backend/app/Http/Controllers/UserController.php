<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;

class UserController extends Controller
{

    public function index(){
        $data = [];
        $data['page_name'] = "ユーザー一覧";

        $data['list'] = User::all();

        if(View::exists('user.index')){
            return view('user.index', $data);
        }
    }

    public function register(){
        $data = [];
        $data['page_name'] = "ユーザー登録画面";

        if(View::exists('user.register')){
            return view('user.register', $data);
        }
    }

    public function detail(User $user){
        $data = [];
        $data['page_name'] = "ユーザー詳細";

        $data['user'] = $user;

        if(View::exists('user.detail')){
            return view('user.detail', $data);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'year' => 'required',
            'month' => 'required',
            'day' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $name = $request->get('name');
        $birth = $request->get('year').'-'.$request->get('month').'-'.$request->get('day');

        User::create(['name' =>$name, 'birth'=>$birth]);
        return redirect(route('user.list'));
    }
}
