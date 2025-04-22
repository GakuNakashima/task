<?php

class Controller_Auth extends Controller
{

	public function action_login()
	{
		return \View::forge('login');
	}


	public function post_login()
	{  
        $input = \Input::post();

        if (\Auth::login($input['username'], $input['password']))
        {
			// $user_id = \Auth::get_user_id();
			// \Session::set('user_id', $user_id);
            return \Response::redirect('main');
        }
		else
		{
			\Session::set_flash('error_msg', 'ログインに失敗しました');
			return \Response::redirect('auth/login');
		}
    }


	public function action_create()
	{
		return \View::forge('create');
	}


	public function post_create()
	{       
        $input = \Input::post();

		if (empty($input['username']) || empty($input['email']) || empty($input['password'])) {
			\Session::set_flash('error_msg', '入力漏れがあります');
			return \Response::redirect('auth/create');
		}

        $user_info = \Model\Auth::read($input['username'], $input['email']);
        if ($user_info) {
			\Session::set_flash('error_msg', 'ユーザー名かメールアドレスが重複しています');
            return \Response::redirect('auth/create');
        }

        \Auth::create_user(
	        $input['username'],
	        $input['password'],
	        $input['email']
        );

		\Auth::login($input['username'], $input['password']);

        return \Response::redirect('main');
	}


	public function action_logout()
	{
		\Auth::logout();
		return \Response::redirect('auth/login');	
	}

}
