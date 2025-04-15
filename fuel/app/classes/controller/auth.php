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
            \Log::error("ログインしました。");
			list($driver, $user_id) = Auth::get_user_id();
			\Log::error('ログイン直後 User ID: ' . $user_id);
	        // ユーザーは正常にログインされている
            return Response::redirect('main');
        }
		else{
			\Log::error("ログインに失敗しました。");
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
