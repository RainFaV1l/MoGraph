<?php

namespace App\Controllers;

class Validator
{
    // Файл для валидации

    public static function isEmpty($str)
    {
        if(empty(trim($str))) $_SESSION['validator_error'] = 'Заполните пустые поля. ';
    }

    public static function isEmail($str)
    {
        if(!filter_var($str, FILTER_VALIDATE_EMAIL)) $_SESSION['validator_error'] .= 'Некорректно введён email. ';
    }

    public static function inLength($str, $min)
    {
        if($min > strlen(trim($str))) $_SESSION['validator_error'] .= 'Минимальный размер пароля - ' . $min . ' символов.';
    }

    public static function checkPassword($pass, $pass_r)
    {
        if($pass !== $pass_r) $_SESSION['validator_error'] .= 'Введенные пароли не совпадают. ';
    }

    public static function isFile($file, $name)
    {
        if(empty($file[$name]['name'])) $_SESSION['validator_error'] .= 'Загрузите изображение. ';
        else {
            $path = time().$file[$name]['name'];
            if($file[$name]['type'] != 'image/jpeg' || $file[$name]['type'] != 'image/png' || $file[$name]['type'] != 'image/jpg' || $file[$name]['type'] != 'image/bmp')
                $_SESSION['validator_error'] .= 'Неверный формат файла. ';
            if($file[$name]['size'] > 5000000) $_SESSION['validator_error'] .= 'Слишком большой размер файла. ';
            if(move_uploaded_file($path, $file[$name]['tmp_name'])) $_SESSION['validator_error'] .= 'Ошибка загрузки изображения. ';
        }
    }

    public static function isChecked($checkbox)
    {
        if($checkbox === null) $_SESSION['validator_error'] .= 'Согласитесь с политикой конфиденциальности. ';
    }

    public static function isIssetEmail($email)
    {
        $count = \R::findOne( 'users', 'email = ?', [$email] );
        if ($count)
            $_SESSION['validator_error'] .= ' Ваш email уже зарегистрирован. ';
    }

    public static function isEmptyEmail($email)
    {
        $count = \R::findOne( 'users', 'email = ?', [$email] );
        if (!$count)
            $_SESSION['validator_error'] .= ' Вы не зарегистрированы на нашем сайте.';
    }

    public static function isCheckFile($file) {
        if(empty($file['img']['name'])) $_SESSION['validator_error'] = ' Загрузите изображение.';
        else if($file['img']['size'] > 5000000 ) $_SESSION['validator_error'] .= ' Слишком большой размер.';
    }

    public static function isCheckVideo($file) {
        if(empty($file['img']['name'])) $_SESSION['validator_error'] .= ' Загрузите видео.';
        else if($file['img']['size'] > 500000000 ) $_SESSION['validator_error'] .= ' Слишком большой размер.';
    }
}