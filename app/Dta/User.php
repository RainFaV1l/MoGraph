<?php

namespace App\Dta;

class User
{
    public function __construct($name, $surname, $email, $tel, $password, $role, $avatar = null)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->tel = $tel;
        $this->password = $password;
        $this->role = $role;
        $this->avatar = $avatar;
    }

    public function getAllDate () {
        $arr = [
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'tel' => $this->tel,
            'password' => $this->password,
            'avatar' => $this->avatar
        ];
        return $arr;
    }
}