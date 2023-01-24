<?php


namespace App\Controllers;
use App\Services\Router;

class Crud
{
    // Файл для выполнения crud операция

    public function addCourse($data, $files) {
        $name = $data["name"];
        $price = $data["price"];
        $time = $data["time"];
        $description = $data["description"];
        $file_name = time().$files['img']['name'];
        $path = "img/courses/".$file_name;
        $category = $data["category"];


        $_SESSION['name'] = $name;
        $_SESSION['price'] = $price;
        $_SESSION['time'] = $time;
        $_SESSION['description'] = $description;

        $validate =  new Validator();

        $validate->isEmpty($name);
        $validate->inLength($name, 2);

        $validate->isEmpty($price);
        $validate->inLength($price, 0);

        $validate->isEmpty($time);
        $validate->inLength($time, 0);

        $validate->isEmpty($description);
        $validate->inLength($description, 2);

        $validate->isCheckFile($files);

        if(empty($_SESSION['validator_error'])) {
            if(empty($files['img']['type'])) $_SESSION['validator_error'] .= ' Загрузите изображение.';
            else if($files['img']['size'] > 5000000 ) $_SESSION['validator_error'] .= 'Слишком большой размер.';
            if(move_uploaded_file($files['img']['tmp_name'], $path)) {
                $course = \R::dispense('courses');
                $course->name = $name;
                $course->description = $description;
                $course->price = $price;
                $course->path = $path;
                $course->number_of_hours = $time;
                $course->category = $category;
                \R::store($course);
                unset($_SESSION['name']);
                unset($_SESSION['price']);
                unset($_SESSION['time']);
                unset($_SESSION['description']);
                Router::redirect('../my-courses');
            } else {
                $_SESSION['validator_error'] .= 'Не удалось загрузить файл.';
                Router::redirect('../add_course');
            }
        } else {
            Router::redirect('../add_course');
        }
    }
    public function editCourse($data, $files) {
        $name = $data["name"];
        $price = $data["price"];
        $time = $data["time"];
        $description = $data["description"];
        $category = $data["category"];
        $validate =  new Validator();

        $validate->isEmpty($name);
        $validate->inLength($name, 2);

        $validate->isEmpty($price);
        $validate->inLength($price, 0);

        $validate->isEmpty($time);
        $validate->inLength($time, 0);

        $validate->isEmpty($description);
        $validate->inLength($description, 2);

        $validate->isEmpty($category);

        if(!empty($files['img']['name'])) {
            $file_name = time().$files['img']['name'];
            $path = "img/courses/".$file_name;
            $validate->isCheckFile($files);
            if(empty($_SESSION['validator_error'])) {
                if(empty($files['img']['type'])) $_SESSION['validator_error'] .= ' Загрузите изображение.';
                else if($files['img']['size'] > 5000000 ) $_SESSION['validator_error'] .= ' Слишком большой размер.';
                if(move_uploaded_file($files['img']['tmp_name'], $path)) {
                    $course = \R::exec('UPDATE `courses` SET `name` = :name, `description` = :description, `price` = :price,
                     `path` = :path, `number_of_hours` = :number_of_hours, `category` = :category WHERE id = :id', [
                        'id' => $_GET['id'],
                        'name' => $name,
                        'description' => $description,
                        'price' => $price,
                        'path' => $path,
                        'number_of_hours' => $time,
                        'category' => $category

                    ]);
                    $uri = '/edit_course?id='. $_GET['id'] . '&edit';
                    Router::redirect($uri);
                } else {
                    $_SESSION['validator_error'] .= 'Не удалось загрузить файл.';
                    Router::redirect('../add_course');
                }
            }
        } else {
            if(empty($_SESSION['validator_error'])) {
                unset($_SESSION['validator_error']);
                $course = \R::exec('UPDATE `courses` SET `name` = :name, `description` = :description, `price` = :price,
                    `number_of_hours` = :number_of_hours, `category` = :category WHERE id = :id', [
                    'id' => $_GET['id'],
                    'name' => $name,
                    'description' => $description,
                    'price' => $price,
                    'number_of_hours' => $time,
                    'category' => $category
                ]);
                $uri = '/edit_course?id='. $_GET['id'] . '&edit';
                Router::redirect($uri);
            } else {
                $uri = '/edit_course?id='. $_GET['id'] . '&edit';
                Router::redirect($uri);
            }
        }


    }
    public function addLesson($data, $files) {
        $name = $data["name"];
        $description = $data["description"];
        $file_name = time().$files['img']['name'];
        $path = "video/courses/".$file_name;
        $course_id = $_GET['id'];


        $_SESSION['name'] = $name;
        $_SESSION['description'] = $description;

        $validate =  new Validator();

        $validate->isEmpty($name);
        $validate->inLength($name, 2);

        $validate->isEmpty($description);
        $validate->inLength($description, 2);

        $validate->isCheckVideo($files);

        $uri_back = "/add_lesson?id=" . $course_id;
        $uri = "/one-course?id=" . $course_id;

        if(empty($_SESSION['validator_error'])) {
            if($files['img']['type'] == 'video/mp4' || $files['img']['type'] == 'video/mov' || $files['img']['type'] == 'video/ivi') {
                if(move_uploaded_file($files['img']['tmp_name'], $path)) {
                    unset($_SESSION['name']);
                    unset($_SESSION['description']);

                    $lesson = \R::dispense('lessons');
                    $lesson->name = $name;
                    $lesson->description = $description;
                    $lesson->path = $path;
                    $lesson->course_id = $course_id;
                    \R::store($lesson);
                    Router::redirect($uri);
                }
                else {
                    $_SESSION['validator_error'] .= ' Не удалось загрузить файл.';
                    Router::redirect($uri_back);
                }

            } else {
                $_SESSION['validator_error'] .= ' Загрузите видео в корректном формате (mp4, mov, ivi).';
                Router::redirect($uri_back);
            }
        } else {
            Router::redirect($uri_back);
        }
    }
    public function changeLogo($data, $files) {
        $file_name = time().$files['img']['name'];
        $path = "img/courses/".$file_name;

        $validate =  new Validator();

        $validate->isCheckFile($files);

        if(empty($_SESSION['validator_error'])) {
            if($files['img']['size'] > 5000000 ) $_SESSION['validator_error'] .= ' Слишком большой размер.';
            else if(move_uploaded_file($files['img']['tmp_name'], $path)) {
                \R::exec('UPDATE `users` SET `avatar` = :path WHERE id = :id', [
                    'id' => $_SESSION['uid'],
                    'path' => $path,
                ]);
                Router::redirect('/profile');
            } else {
                $_SESSION['validator_error'] .= 'Не удалось загрузить файл.';
                Router::redirect('/profile');
            }
        } else {
            Router::redirect('/profile');
        }
    }
    public function saveProfile($data, $files) {
        $name = $data["name"];
        $surname = $data["surname"];
        $tel = $data["tel"];

        $_SESSION['name'] = $name;
        $_SESSION['surname'] = $surname;
        $_SESSION['tel'] = $tel;

        $validate =  new Validator();

        $validate->isEmpty($name);
        $validate->inLength($name, 2);

        $validate->isEmpty($surname);
        $validate->inLength($surname, 2);

        $validate->isEmpty($tel);
        $validate->inLength($tel, 17);

        if(empty($_SESSION['validator_error'])) {
            \R::exec('UPDATE `users` SET `name` = :name, `surname` = :surname, `tel` = :tel WHERE id = :id', [
                'id' => $_SESSION['uid'],
                'name' => $name,
                'surname' => $surname,
                'tel' => $tel
            ]);
            Router::redirect('/profile');
        } else {
            Router::redirect('/profile');
        }
    }
    public function changePassword($data, $files) {
        $new_pass = $data["password_n"];
        $new_pass_r = $data["password_r"];
        $password = $data["password"];

        $_SESSION['new_pass'] = $new_pass;
        $_SESSION['new_pass_r'] = $new_pass_r;
        $_SESSION['password'] = $password;

        $validate =  new Validator();

        $validate->isEmpty($new_pass);
        $validate->inLength($new_pass, 6);

        $validate->isEmpty($new_pass_r);
        $validate->inLength($new_pass_r, 6);

        $validate->checkPassword($new_pass, $new_pass_r);

        if(empty($_SESSION['validator_error'])) {
            $password_check = \R::findOne('users', 'id = ?', [$_SESSION['uid']]);
            if(password_verify($password, $password_check['password'])) {
                \R::exec('UPDATE `users` SET `password` = :password WHERE id = :id', [
                    'id' => $_SESSION['uid'],
                    'password' => password_hash($new_pass, PASSWORD_DEFAULT)
                ]);
                unset($_SESSION['validator_error']);
                unset($_SESSION['new_pass']);
                unset($_SESSION['password_r']);
                unset($_SESSION['password']);
                Router::redirect('/profile');
            } else {
                $_SESSION['validator_error'] = 'Неверный пароль.';
                Router::redirect('/profile');
            }
        } else {
            Router::redirect('/profile');
        }
    }
    public function changeEmail($data, $files) {
        $password = $data["password"];
        $email = $data["email"];

        $_SESSION['password_e'] = $password;
        $_SESSION['email'] = $email;

        $validate =  new Validator();

        $validate->isEmpty($password);
        $validate->inLength($password, 6);

        $validate->isEmpty($email);
        $validate->inLength($email, 2);
        $validate->isEmail($email);
        $validate->isIssetEmail($email);


        if(empty($_SESSION['validator_error'])) {
            $password_check = \R::findOne('users', 'id = ?', [$_SESSION['uid']]);
            if(password_verify($password, $password_check['password'])) {
                \R::exec('UPDATE `users` SET `email` = :email WHERE id = :id', [
                    'id' => $_SESSION['uid'],
                    'email' => $email
                ]);
                unset($_SESSION['validator_error']);
                unset($_SESSION['password_e']);
                Router::redirect('/profile');
            } else {
                $_SESSION['validator_error'] = 'Неверный пароль.';
                Router::redirect('/profile');
            }
        } else {
            Router::redirect('/profile');
        }
    }
    public function addSubscribe($data, $files) {
        $email = $data["email"];

        $_SESSION['email'] = $email;

        $validate =  new Validator();

        $validate->isEmpty($email);
        $validate->inLength($email, 3);
        $validate->isEmail($email);

        if(empty($_SESSION['validator_error'])) {
            $subscribe = \R::dispense('subscribe');
            $subscribe->email = $email;
            \R::store($subscribe);
            Router::redirect('/');
        } else {
            Router::redirect('/#mailing-list');
        }
    }
    public function editLesson($data, $files)
    {
        $name = $data["name"];
        $description = $data["description"];
        $validate =  new Validator();

        $validate->isEmpty($name);
        $validate->inLength($name, 2);

        $validate->isEmpty($description);
        $validate->inLength($description, 2);

        if (!empty($files['img']['name'])) {
            $file_name = time() . $files['img']['name'];
            $path = "video/courses/" . $file_name;
            $validate->isCheckVideo($files);
            if (empty($_SESSION['validator_error'])) {
                if ($files['img']['type'] == 'video/mp4' || $files['img']['type'] == 'video/mov' || $files['img']['type'] == 'video/ivi') {
                    if (move_uploaded_file($files['img']['tmp_name'], $path)) {
                        $lesson = \R::exec('UPDATE `lessons` SET `name` = :name, `description` = :description,
                     `path` = :path WHERE id = :id', [
                            'id' => $_GET['id'],
                            'name' => $name,
                            'description' => $description,
                            'path' => $path

                        ]);
                        $back = '/edit-lesson?id='.$_GET['id'];
                        Router::redirect($back);
                    } else {
                        $_SESSION['validator_error'] .= 'Не удалось загрузить видео.';
                        $back = '/edit-lesson?id='.$_GET['id'];
                        Router::redirect($back);
                    }
                } else {
                    $_SESSION['validator_error'] .= ' Загрузите видео в корректном формате (mp4, mov, ivi).';
                    $back = '/edit-lesson?id='.$_GET['id'];
                    Router::redirect($back);
                }
            }
        } else {
            if (empty($_SESSION['validator_error'])) {
                unset($_SESSION['validator_error']);
                $course = \R::exec('UPDATE `lessons` SET `name` = :name, `description` = :description WHERE id = :id', [
                    'name' => $name,
                    'description' => $description,
                    'id' => $_GET['id'],
                ]);
                $back = '/edit-lesson?id='.$_GET['id'];
                Router::redirect($back);
            } else {
                $back = '/edit-lesson?id='.$_GET['id'];
                Router::redirect($back);
            }
        }
    }
}