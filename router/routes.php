<?php

use App\Controllers\Crud;
use App\Services\Router;
use App\Controllers\Auth;

Router::page('/', 'start');
Router::page('/catalog', 'catalog');
Router::page('/sign-in', 'sign-in');
Router::page('/sign-up', 'sign-up');
Router::page('/lesson', 'lesson');
Router::page('/my-courses', 'my-courses');
Router::page('/course', 'one-course');
Router::page('/one-item', 'one-item');
Router::page('/one-course', 'one-course');
Router::page('/profile', 'profile');
Router::page('/users', 'users');
Router::page('/add_course', 'add-course');
Router::page('/edit_course', 'edit-course');
Router::page('/add_lesson', 'add-lesson');

Router::post('/auth/register', Auth::class, 'register', true, false);
Router::post('/auth/auth', Auth::class, 'auth', true, false);
Router::post('/crud/addCourse', Crud::class, 'addCourse', true, true);
Router::post('/crud/editCourse', Crud::class, 'editCourse', true, true);
Router::post('/crud/addLesson', Crud::class, 'addLesson', true, true);
Router::post('/crud/addSubscribe', Crud::class, 'addSubscribe', true, false);
Router::post('/crud/saveProfile', Crud::class, 'saveProfile', true, false);
Router::post('/crud/changePassword', Crud::class, 'changePassword', true, false);
Router::post('/crud/changeEmail', Crud::class, 'changeEmail', true, false);
Router::post('/crud/changeLogo', Crud::class, 'changeLogo', true, true);
Router::post('/auth/logout', Auth::class, 'logout');

Router::enable();