<?php use App\Services\Page; ?>
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
    <div class="wrapper profile__wrapper">
      <div class="header__main">
          <?php Page::part('header');?>
      </div>
      <main class="main">
        <div class="main__container container">
          <div class="profile">
              <?php
              if(isset($_SESSION['validator_error'])) {?>
                  <div class="message__error">
                      <?php
                      echo $_SESSION['validator_error'];
                      unset($_SESSION['validator_error']);
                      ?>
                  </div>
              <?php } ?>
            <div class="profile__container">
                <?php
                    $user_id = $_SESSION['uid'];
                    $users = R::getAssoc('SELECT * FROM `users` WHERE `id` = ?', [$user_id]);
                    foreach ($users as $user) {

                    }
                ?>
              <div class="header-title-row">
                <h1 class="main-header__title header-title">Профиль</h1>
                <div class="main-header__figure landing-header__figure"></div>
              </div>
              <div class="profile__form">
                <form action="/crud/changeLogo" method="post" name="logo-change" class="profile__logo-form" enctype="multipart/form-data">
                    <div class="profile__logo">
                        <img src="<?php echo $user['avatar']?>" alt="avatar" />
                        <input type="file" class="hidden" name="img" id="profile_file">
                        <label for="profile_file" class="logo__change">
                            <svg
                                    width="15"
                                    height="15"
                                    viewBox="0 0 15 15"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M1.9037 7.29677C1.9037 10.341 4.1109 12.4147 6.58942 12.8439C6.87304 12.893 7.06315 13.1627 7.01404 13.4464C6.96493 13.73 6.6952 13.9201 6.41157 13.871C3.49991 13.3668 0.861328 10.9127 0.861328 7.29677C0.861328 5.76009 1.56045 4.55245 2.37688 3.63377C2.96173 2.97568 3.63083 2.44135 4.16895 2.03202L2.53254 2.03202C2.2564 2.03202 2.03254 1.80816 2.03254 1.53202C2.03254 1.25588 2.2564 1.03202 2.53254 1.03202L5.53254 1.03202C5.80868 1.03202 6.03254 1.25588 6.03254 1.53202L6.03254 4.53202C6.03254 4.80816 5.80868 5.03202 5.53254 5.03202C5.2564 5.03202 5.03254 4.80816 5.03254 4.53202L5.03254 2.68645L5.03103 2.68759L5.03094 2.68766L5.03093 2.68767L5.03092 2.68767C4.45945 3.11868 3.76108 3.64538 3.15603 4.3262C2.44151 5.13021 1.9037 6.10154 1.9037 7.29677ZM13.0113 7.70321C13.0113 4.69115 10.8509 2.6296 8.40432 2.17029C8.12142 2.11718 7.93514 1.84479 7.98825 1.56188C8.04136 1.27898 8.31375 1.0927 8.59665 1.14581C11.4709 1.68541 14.0537 4.12605 14.0537 7.70321C14.0537 9.23988 13.3546 10.4475 12.5382 11.3662C11.9533 12.0243 11.2842 12.5586 10.7461 12.968L12.3825 12.968C12.6587 12.968 12.8825 13.1918 12.8825 13.468C12.8825 13.7441 12.6587 13.968 12.3825 13.968L9.38254 13.968C9.1064 13.968 8.88254 13.7441 8.88254 13.468L8.88254 10.468C8.88254 10.1918 9.1064 9.96796 9.38254 9.96796C9.65868 9.96796 9.88254 10.1918 9.88254 10.468L9.88254 12.3135L9.88411 12.3123C10.4556 11.8813 11.154 11.3546 11.759 10.6738C12.4735 9.86976 13.0113 8.89844 13.0113 7.70321Z"
                                        fill="white"
                                />
                            </svg>
                        </label>
                    </div>
                    <input type="submit" class="standart__submit" name="logo-change" value="Сохранить">
                </form>
                <div class="profile__content">
                  <div class="profile__item">
                    <h3 class="profile__title">Общая информация</h3>
                    <form
                      name="changeGeneralInformation"
                      method="post"
                      class="general-information__form standart__form"
                      action="crud/saveProfile"
                    >
                      <div class="input__row">
                        <input
                          type="text"
                          name="surname"
                          class="general-information__input standart__input"
                          placeholder="Фамилия"
                          value="<?php echo $user['surname'] ?>"
                        />
                        <input
                          type="text"
                          name="name"
                          class="general-information__input standart__input"
                          placeholder="Имя"
                          value="<?php echo $user['name'] ?>"
                        />
                          <input
                                  type="text"
                                  name="tel"
                                  class="general-information__input standart__input tel"
                                  placeholder="Телефон"
                                  value="<?php echo $user['tel'] ?>"
                          />
                        <input
                          type="submit"
                          name="changeGeneralInformation"
                          class="general-information__input standart__submit"
                          value="Сохранить"
                        />
                      </div>
                    </form>
                  </div>
                  <div class="profile__item">
                    <h3 class="profile__title">Смена пароля</h3>
                    <form
                      name="changePassword"
                      method="post"
                      class="general-information__form standart__form"
                      action="crud/changePassword"
                    >
                      <div class="input__row">
                        <input
                          type="password"
                          name="password_n"
                          class="general-information__input standart__input"
                          placeholder="Новый пароль"
                          value="<?php echo $_SESSION['new_pass'] ?? ''; unset($_SESSION['new_pass']);?>"
                        />
                        <input
                          type="password"
                          name="password_r"
                          class="general-information__input standart__input"
                          placeholder="Подтвердите новый пароль"
                          value="<?php echo $_SESSION['new_pass_r'] ?? ''; unset($_SESSION['new_pass_r']);?>"
                        />
                        <input
                          type="submit"
                          name="changePassword"
                          class="general-information__input standart__submit"
                          value="Сохранить"
                        />
                        <input
                          type="password"
                          name="password"
                          class="general-information__input standart__input"
                          placeholder="Текущий пароль"
                          value="<?php echo $_SESSION['password'] ?? ''; unset($_SESSION['password']);?>"
                        />
                      </div>
                    </form>
                  </div>
                  <div class="profile__item">
                    <h3 class="profile__title">Смена email</h3>
                    <form
                      name="changeEmail"
                      method="post"
                      class="general-information__form standart__form"
                      action="crud/changeEmail"
                    >
                      <div class="input__row">
                        <input
                          type="password"
                          name="password"
                          class="general-information__input standart__input"
                          placeholder="Пароль"
                          value="<?php echo $_SESSION['password_e'] ?? ''; unset($_SESSION['password_e']);?>"
                        />
                        <input
                          type="email"
                          name="email"
                          class="general-information__input standart__input"
                          placeholder="Email"
                          value="<?php echo $user['email'] ?>"
                        />
                        <input
                          type="submit"
                          name="changeEmail"
                          class="general-information__input standart__submit"
                          value="Сохранить"
                        />
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
        <?php Page::part('footer');?>
    </div>
  </body>
</html>
