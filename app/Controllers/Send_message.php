<?php

require_once '../../libs/rb.php';
\R::setup( 'mysql:host=localhost;dbname=MoGraph','root', '', false);
if(!\R::testConnection()) die('No DB connection!');

function validate(){
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    global $count;

    if (empty($email)) {
        return [
            'type' => 'error',
            'body' => 'Введите email'
        ];
    }
    if(empty($message)){
        return [
            'type' => 'error',
            'body' => 'Введите сообщение'
        ];
    }
}


if (isset($_POST)) {
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    $error = validate();

    if(!isset($error)){
        $messages = \R::dispense('messages');
        $messages->email = $email;
        $messages->message = $message;
        \R::store($messages);
        echo json_encode([
            'type' => 'success',
            'body' => 'Форма успешно отправлена!'
        ]);
    }else{
        echo json_encode($error);
    }
}
