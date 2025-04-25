<?php

class Controller_Register extends Controller
{
    public function action_index()
    {
        return \View::forge('register');
    }


    public function post_create()
    {
        $user_id = \Auth::get_user_id();
        // if (!$user_id) {
        //     \Session::set_flash('error_msg', 'ユーザーidが取得できませんでした');
        //     return Response::redirect('/auth/login');
        // }
        $data = \Input::post();

        if (empty($data['date']) || empty($data['category']) || empty($data['amount'])) {
            \Session::set_flash('error_msg', '入力漏れがあります');
            return \Response::redirect('register');
        }

        if(!\Security::check_token()) {
			\Session::set_flash('error_msg', '不正なリクエストです');
			return \Response::redirect('register');
		}

        $result = Model\Register::create($user_id, $data);
        if ($result[1] > 0) {
            \Session::set_flash('success_msg', '登録しました');
        } else {
            \Session::set_flash('error_msg', '登録に失敗しました');
        }

        return \Response::redirect('main/index/' . $data['date']); 
    }


    public function post_edit()
    {
        $data = \Input::post();
        $id = $data['edit'];

        $transactions = Model\Register::read_from_id($id);
        $data = [
            'transactions' => $transactions
        ];

        if(!\Security::check_token()) {
			\Session::set_flash('error_msg', '不正なリクエストです');
			return \Response::redirect('main/index/' . $data['date']);
		}

        return \View::forge('edit', $data);
    }


    public function post_update()
    {
        $data = \Input::post();

        if (empty($data['category']) || empty($data['amount'])) {
            \Session::set_flash('error_msg', '入力漏れがあります');
            return \Response::redirect('register/edit?edit=' . $data['id']);
        }

        $user_id = \Auth::get_user_id();
        // if (!$user_id) {
        //     \Session::set_flash('error_msg', 'ユーザーidが取得できませんでした');
        //     return Response::redirect('/auth/login');
        // }

        if(!\Security::check_token()) {
			\Session::set_flash('error_msg', '不正なリクエストです');
			return \Response::redirect('main/index/' . $data['date']);
		}

        $result = Model\Register::update($user_id, $data);
        if ($result > 0) {
            \Session::set_flash('success_msg', '更新しました');
        } else {
            \Session::set_flash('error_msg', '更新に失敗しました');
        }

        return \Response::redirect('main/index/' . $data['date']);
    }


    public function post_delete()
    {
        $data = Input::post();
        $id = $data['delete'];

        $user_id = \Auth::get_user_id();
        // if (!$user_id) {
        //     \Session::set_flash('error_msg', 'ユーザーidが取得できませんでした');
        //     return Response::redirect('/auth/login');
        // }
        $transactions = Model\Register::read_from_id($id);

        if(!\Security::check_token()) {
			\Session::set_flash('error_msg', '不正なリクエストです');
			return \Response::redirect('main/index/' . $transactions[0]['date']);
		}

        $result = Model\Register::delete($user_id, $id);
        if ($result > 0) {
            \Session::set_flash('success_msg', '削除しました');
        } else {
            \Session::set_flash('error_msg', '削除に失敗しました');
        }

        return \Response::redirect('main/index/' . $transactions[0]['date']);
    }
}