<?php

namespace Model;

class Register extends \Model
{
    public static function insert($user_id, $data)
    {
        $insert_data = [
            'user_id'     => $user_id,
            'date'        => $data['date'],
            'category'    => $data['category'],
            'amount'      => $data['amount'],
            'description' => $data['description'],
            //'created_at'  => \Date::forge()->format('mysql'),
            //'updated_at'  => \Date::forge()->format('mysql'),
        ];

        $query = \DB::insert('transactions')
            ->set($insert_data)
            ->execute();
    }

    public static function get($user_id, $date_str)
    {
        $query = \DB::select(
            'category',
            'amount',
            'description',
        )
        ->from('transactions') 
        ->where('user_id', '=', $user_id)
        ->where('date', '=', $date_str) 
        ->where('deleted_at', 'is', null);
        
        $result = $query->execute()->as_array();
        return $result;
    }
}
