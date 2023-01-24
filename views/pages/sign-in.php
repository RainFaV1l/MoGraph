<?php
use App\Services\Page;
if(isset($_SESSION['uid'])) {
    \App\Services\Router::redirect('/');
}
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MoGraph</title>
      <?php Page::head();?>
  </head>

  <body>
    <div class="wrapper wrapper__sign-in">
      <div class="header__main">
          <?php Page::part('header');?>
      </div>
      <main class="main">
        <div class="sign-in-up">
            <?php
            if(isset($_SESSION['validator_error'])) {?>
                <div class="message__error">
                    <?php
                    echo $_SESSION['validator_error'];
                    unset($_SESSION['validator_error']);
                    ?>
                </div>
            <?php } ?>
            <div class="sign-in-up__container container">
                <form action="auth/auth" name="sign-in" method="post" class="sign-in-up__form">
                    <h2 class="sign-in-up__title">Вход</h2>
                    <p class="sign-in-up__subtitle">Нет профиля? Скорей <a href="sign-up">создавай</a>, это бесплатно!</p>
                    <input type="email" name="email" class="sign-in-up__input" placeholder="Email" value="<?php echo $_SESSION['email'] ?? ''; unset($_SESSION['email']);?>">
                    <input type="password" name="password" class="sign-in-up__input" placeholder="Пароль" value="<?php echo $_SESSION['password'] ?? ''; unset($_SESSION['password']);?>">
                    <a href="#" class="sign-in-up__change-password">Забыли пароль?</a>
                    <input type="submit" name="sign-in" class="sign-in-up__input" value="Авторизоваться">
                </form>
            </div>
        </div>
      </main>
        <?php Page::part('footer');?>
    </div>
  </body>
</html>
