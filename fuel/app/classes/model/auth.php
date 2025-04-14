<?php
namespace Model;

class User extends Model
{
    public static function get_all_by_user($user_id)
    {
        $query = DB::select('id', 'date', 'category', 'price')
            ->from('expenses')
            ->where('user_id', $user_id)
            ->orderBy('date', 'desc');
        return $query->execute()->as_array();
    }

    public static function create($data)
    {
        list($insert_id, $rows_affected) = DB::insert('expenses')
            ->set($data)
            ->execute();

        return $insert_id;
    }
}