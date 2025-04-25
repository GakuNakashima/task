<?php

namespace Model;

class Auth extends \Model
{
    public static function read_auth($username, $email)
    {
        $query = \DB::select(
            'username',
            'email',
        )
        ->from('users')
        ->where('username', '=', $username)
        ->where('email', '=', $email);
        
        $result = $query->execute()->as_array();
        return $result;
    }   
}