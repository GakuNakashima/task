<?php

class Controller_Main extends Controller
{

    //public function before()
    //{
    //    if (!\Auth::check()) {
    //        Session::set_flash('error', 'ログインが必要です。');
    //        return Response::redirect('/login');
    //    }
    //}


    public function action_index()
    {
        $date_obj = \Date::forge()->format('%Y-%m-%d');

        if (Auth::check()) {

        $user_id_info = \Auth::get_user_id();
        $user_id = $user_id_info[1];
        $transactions = Model\Register::get($user_id, $date_obj);

        $data = [
            'date' => $date_obj,
            'transactions' => $transactions
        ];


        return View::forge('main', $data);
        }
        else{
            return Response::redirect('auth/login');
        }
    }


    public function action_previous($now_date)
    {
        $target_date = \Date::create_from_string($now_date, '%Y-%m-%d');
        $now_date_timestamp = $target_date->get_timestamp();
        $previous_day_timestamp = $now_date_timestamp - 86400;
        $previous_day = \Date::forge($previous_day_timestamp)->format('%Y-%m-%d');
        $data = [
            'date' => $previous_day
        ];
        return View::forge('main', $data);
    }


    public function action_following($now_date)
    {
        $target_date = \Date::create_from_string($now_date, '%Y-%m-%d');
        $now_date_timestamp = $target_date->get_timestamp();
        $following_day_timestamp = $now_date_timestamp + 86400;
        $following_day = \Date::forge($following_day_timestamp)->format('%Y-%m-%d');
        $data = [
            'date' => $following_day
        ];
        return View::forge('main', $data);
    }


    public function action_calendar()
    {
        $submitted_date =\Input::get('selected_date');
        
        $user_id_info = \Auth::get_user_id();
        $user_id = $user_id_info[1];
        $transactions = Model\Register::get($user_id, $submitted_date);

        $data = [
            'date' => $submitted_date,
            'transactions' => $transactions
        ];

        return View::forge('main', $data);
    }

}
