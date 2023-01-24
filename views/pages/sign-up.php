<?php use App\Services\Page;
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
                  <form action="auth/register" name="sign-up" method="post" class="sign-in-up__form">
                      <h2 class="sign-in-up__title">Регистрация</h2>
                      <p class="sign-in-up__subtitle">
                          Есть профиль? Скорей <a href="/sign-in">авторизуйся</a>!
                      </p>
                      <div class="sign-in-up__row">
                          <input
                                  type="text"
                                  name="name"
                                  class="sign-in-up__input"
                                  placeholder="Имя"
                                  value="<?php echo $_SESSION['name'] ?? ''; unset($_SESSION['name']);?>"
                          />
                          <input
                                  type="text"
                                  name="surname"
                                  class="sign-in-up__input"
                                  placeholder="Фамилия"
                                  value="<?php echo $_SESSION['surname'] ?? ''; unset($_SESSION['surname']);?>"
                          />
                      </div>
                      <div class="sign-in-up__row">
                          <input
                                  type="email"
                                  name="email"
                                  class="sign-in-up__input"
                                  placeholder="Email"
                                  value="<?php echo $_SESSION['email'] ?? ''; unset($_SESSION['email']);?>"
                          />
                          <input
                                  type="text"
                                  name="tel"
                                  class="sign-in-up__input tel"
                                  placeholder="Телефон"
                                  value="<?php echo $_SESSION['tel'] ?? ''; unset($_SESSION['tel']);?>"
                          />
                      </div>
                      <div class="sign-in-up__row">
                          <input
                                  type="password"
                                  name="password"
                                  class="sign-in-up__input"
                                  placeholder="Пароль"
                                  value="<?php echo $_SESSION['password'] ?? ''; unset($_SESSION['password']);?>"
                          />
                          <input
                                  type="password"
                                  name="password_r"
                                  class="sign-in-up__input"
                                  placeholder="Потвердите пароль"
                                  value="<?php echo $_SESSION['password_r'] ?? ''; unset($_SESSION['password_r']);?>"
                          />
                      </div>
                      <div class="agreement">
                          <input type="checkbox" value="1" name="agreement"
                              <?= isset($_SESSION['agreement']) ? 'checked="checked"' : '' ?> <?php unset($_SESSION['agreement']);?>"
                          />
                          <p class="sign-in-up__change-password sign-in-up__agreement"
                          >Согласен на <a href="#">обработку персональных данных</a></p
                          >
                      </div>

                      <input
                              type="submit"
                              name="sign-up"
                              class="sign-in-up__input"
                              value="Зарегистрироваться"
                      />
                  </form>
              </div>
          </div>
      </main>
      <?php Page::part('footer');?>
  </div>
  </body>
</html>
