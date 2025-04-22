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
        $data = \Input::post();

        if (empty($data['date']) || empty($data['category']) || empty($data['amount'])) {
            \Session::set_flash('error_msg', '入力漏れがあります');
            return \Response::redirect('register');
        }

        Model\Register::create($user_id, $data);

        return \Response::redirect('main/index/' . $data['date']); 
    }


    public function action_edit()
    {
        $data = \Input::get();
        $id = $data['edit'];

        $transactions = Model\Register::read2($id);
        $data = [
            'transactions' => $transactions
        ];

        return \View::forge('edit', $data);
    }


    public function post_update()
    {
        $data = \Input::post();

        if (empty($data['category']) || empty($data['amount'])) {
            \Session::set_flash('error_msg', '入力漏れがあります');
            return \Response::redirect('register/edit?edit=' . $data['id']);
        }

        Model\Register::update($data);

        return \Response::redirect('main/index/' . $data['date']);
    }


    public function action_delete()
    {
        $data = Input::get();
        $id = $data['delete'];

        Model\Register::delete($id);

        return \Response::redirect('main');
    }
}