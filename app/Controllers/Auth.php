<?php

namespace App\Controllers;

use App\Services\Router;

class Auth
{
    public function register($data, $files) {
        $name = $data["name"];
        $surname = $data["surname"];
        $email = $data["email"];
        $tel = $data["tel"];
        $password = $data["password"];
        $password_r = $data["password_r"];

        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['email'] = $email;
        $_SESSION['tel'] = $tel;
        $_SESSION['password'] = $password;
        $_SESSION['password_r'] = $password_r;
        $_SESSION['agreement'] = $data["agreement"] ?? null;

        if(isset($data["agreement"])) $agreement = $data["agreement"] ?? null;

        $validate =  new Validator();

        $validate->isEmpty($name);
        $validate->inLength($name, 2);

        $validate->isEmpty($surname);
        $validate->inLength($surname, 2);

        $validate->isEmpty($email);
        $validate->isEmail($email);
        $validate->inLength($email, 2);
        $validate->isIssetEmail($email);

        $validate->isEmpty($tel);
        $validate->inLength($tel, 17);

        $validate->isEmpty($password);
        $validate->inLength($password, 5);

        $validate->isEmpty($password_r);

        $validate->checkPassword($password, $password_r);

        $validate->isChecked($agreement);

        if(empty($_SESSION['validator_error'])) {
            $user = \R::dispense('users');
            $user->name = $name;
            $user->surname = $surname;
            $user->email = $email;
            $user->tel = $tel;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            \R::store($user);
            unset($_SESSION['name']);
            unset($_SESSION['surname']);
            unset($_SESSION['tel']);
            unset($_SESSION['password_r']);
            unset($_SESSION['agreement']);
            Router::redirect('../sign-in');
        } else {
            Router::redirect('../sign-up');
        }
    }
    public function auth($data, $files) {
        $email = $data["email"];
        $password = $data["password"];

        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;

        $validate =  new Validator();

        $validate->isEmpty($email);
        $validate->isEmail($email);
        $validate->inLength($email, 2);
        $validate->isEmptyEmail($email);

        $validate->isEmpty($password);
        $validate->inLength($password, 5);
        if(empty($_SESSION['validator_error'])) {
            $user = \R::findOne( 'users', 'email = ?', [$email] );
            if(!password_verify($password, $user->password)) $_SESSION['validator_error'] = 'Неверный логин или пароль';
            else {
                session_destroy();
                session_start();
                $_SESSION['uid'] = $user['id'];
                Router::redirect('/');
            }
        } else {
            Router::redirect('../sign-in');
        }

    }
    public function logout() {
        session_destroy();
        Router::redirect('/sign-in');
    }
}