<?php
    // Главный файл

    session_start();

    use App\Services\App;
    use App\Dta\User;

    require_once  __DIR__ . "/vendor/autoload.php";

    App::start();

    if(isset($_SESSION['uid'])) {
        $user_query = \R::findOne( 'users', 'id = ?', [$_SESSION['uid']] );
        $user = new User($user_query['name'], $user_query['surname'], $user_query['email'], $user_query['tel'],
            $user_query['password'], $user_query['role'], $user_query['avatar']);
        $_SESSION['user_role'] = $user->role;
    }
    require_once  __DIR__ . "/router/routes.php";
?>

<?php
use App\Services\Page;
?>
