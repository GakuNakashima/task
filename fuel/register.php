<?php

use Auth\Auth;


class Controller_Register extends Controller
{
    public function action_index()
    {
        return View::forge('register');
    }

    public function action_register()
    {
        if (Auth::check()) {
            list($driver_id, $user_id) = Auth::get_user_id();
            // $user_id にはログインユーザーのIDが入るはず
            \Log::error("ログイン済み: Driver ID = " . $driver_id . ", User ID = " . $user_id);
        } else {
            // ログインしていない場合の処理
            \Log::error("ログインしていません。");
            list($driver_id, $user_id) = Auth::get_user_id(); // この場合 $user_id は 0 になる
            \Log::error("Auth::get_user_id() の結果: Driver ID = " . $driver_id . ", User ID = " . $user_id);
        }
        
        // $user_id_info = \Auth::get_user_id();
        // \Log::error(print_r($user_id_info, true));
        // $user_id = $user_id_info[1];


        // $data = Input::post();

        // Model\Register::insert($user_id, $data);
    }
}