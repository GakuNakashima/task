<?php

class Controller_Calendar extends Controller
{
    public function action_index()
    {
        $user = DB::select()->from('users')->execute()->current();
        var_dump($user);

        // 現在の年月を取得（URLパラメータがあればその月を使用）
        $month = Input::get('month', null);  // monthパラメータを取得
        $current_date = new DateTime($month ? $month : 'now'); // パラメータがなければ現在の日付を使用
        
        // 月初の日付を取得
        $first_day_of_month = (clone $current_date)->modify('first day of this month');
        
        // 月末の日付を取得
        $last_day_of_month = (clone $current_date)->modify('last day of this month');
        
        // 月の最初の日が何曜日かを取得（0:日曜日, 1:月曜日, ..., 6:土曜日）
        $start_day_of_week = $first_day_of_month->format('w');
        
        // 1ヶ月分の日付を生成
        $days_in_month = [];
        $current_day = clone $first_day_of_month;
        
        // 月初から月末までの日付を生成
        while ($current_day <= $last_day_of_month) {
            $days_in_month[] = $current_day->format('Y-m-d');
            $current_day->modify('+1 day');
        }

        // 月初の日に空白を追加する
        // 例えば、1日が水曜日なら、月初前に3つの空白を追加する
        $calendar = array_pad($days_in_month, -count($days_in_month) - $start_day_of_week, null);
        
        // 7日ごとに1週としてカレンダーに表示
        $calendar = array_chunk($calendar, 7);

        // 次月と前月を取得
        $next_month = (clone $first_day_of_month)->modify('first day of next month')->format('Y-m');
        $prev_month = (clone $first_day_of_month)->modify('first day of previous month')->format('Y-m');

        // ビューにカレンダーの情報を渡す
        return View::forge('calendar', [
            'calendar' => $calendar,
            'current_month' => $first_day_of_month->format('Y-m'),
            'next_month' => $next_month,
            'prev_month' => $prev_month,
        ]);
    }
}