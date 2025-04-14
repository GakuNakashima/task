<?php

class Controller_Auth extends Controller
{

	public function action_login()
	{
		return View::forge('login');
	}

	public function action_create()
	{
		return View::forge('create');
	}

    public function post_login()
	{  
        $input = Input::post();
        // ログインを実行
        if (Auth::login($input['username'], $input['password']))
        {
	        // ユーザーは正常にログインされている
            return Response::redirect('calendar');
        }
		else{
			return View::forge('error');
		}
    }

	public function post_create()
	{       
        $input = Input::post();

        // 新しいユーザーを作成
        Auth::create_user(
	        $input['username'],
	        $input['password'],
	        $input['email']
        );
        return Response::redirect('auth/login');
	}

}
