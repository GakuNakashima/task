<?php

namespace Model;

class Register extends \Model
{
    public static function create($user_id, $data)
    {
        $insert_data = [
            'user_id'     => $user_id,
            'date'        => $data['date'],
            'category'    => $data['category'],
            'amount'      => $data['amount'],
            'description' => $data['description'],
        ];

        $query = \DB::insert('transactions')
            ->set($insert_data)
            ->execute();

        return $query;
    }


    public static function read_from_date($user_id, $date_str)
    {
        $query = \DB::select(
            'id',
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


    public static function read_from_id($id)
    {
        $query = \DB::select(
            'id',
            'category',
            'amount',
            'description',
            'date',
        )
        ->from('transactions') 
        ->where('id', '=', $id)
        ->where('deleted_at', 'is', null);
        
        $result = $query->execute()->as_array();
        return $result;
    }
    

    public static function update($user_id, $data)
    {
        $update_data = [
            'category'    => $data['category'],
            'amount'      => $data['amount'],
            'description' => $data['description'],  
        ];

        $query = \DB::update('transactions')
            ->set($update_data)
            ->where('id', '=', $data['id'])
            ->where('user_id', '=', $user_id)
            ->execute();

        return $query;
    }


    public static function delete($user_id, $id)
    {
        $query = \DB::update('transactions')
            ->set(['deleted_at' => date('Y-m-d H:i:s')])
            ->where('id', '=', $id)
            ->where('user_id', '=', $user_id)
            ->execute();

        return $query;
    }   
}
