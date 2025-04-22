<?php

use Model\Register;

class Controller_Main extends Controller_Template
{

    public function before()
    {
        parent::before();

        // if (!\Auth::check()) {
        //     return Response::redirect('/auth/login');
        // }

        // $user_id = \Session::get('user_id');
        // if (!$user_id) {
        //     return Response::redirect('/auth/login');
        // }

        $this->template->title = '家計簿アプリ';
        $this->template->site_name = '0さんの家計簿';
    }

    
    public function action_index()
    {
        $date_original = \Date::forge()->format('%Y-%m-%d');
        $date_formatted = \Date::forge()->format('%m/%d');

        $user_id = \Auth::get_user_id();
        $transactions = Register::read1($user_id, $date_original);

        $data = [
            'original' => $date_original,
            'formatted' => $date_formatted,
            'transactions' => $transactions
        ];

        $this->template->content = View::forge('main', $data);
    }


    public function post_calendar()
    {
        $submitted_date =\Input::post('date', null);
        $operation = Input::post('operation', 'none');
        $target_date = \Date::create_from_string($submitted_date, '%Y-%m-%d');
        $now_date_timestamp = $target_date->get_timestamp();
        switch (strtolower($operation)) {
            case 'previous':
                $date = $now_date_timestamp - 86400;
                break;
            case 'following':
                $date = $now_date_timestamp + 86400;
                break;
            case 'update':
                $date = $now_date_timestamp;
                break;
            default:
                break;
        }

        $fomatted_date = \Date::forge($date)->format('%m/%d');
        $original_date = \Date::forge($date)->format('%Y-%m-%d');
        
        $user_id = \Auth::get_user_id();
        $transactions = Register::read1($user_id, $submitted_date);

        $data = [
            'original' => $original_date,
            'formatted' => $fomatted_date,
            'transactions' => $transactions
        ];

        return Response::forge(json_encode($data), 200, [
            'Content-Type' => 'application/json'
        ]);
    }

}

