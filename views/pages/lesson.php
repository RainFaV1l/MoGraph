<?php use App\Services\Page;
use App\Services\Router;

    if(!isset($_GET['id'])) {
        Router::redirect('/');
    }

    if(isset($_SESSION['uid'])) {
        if ($_SESSION['user_role'] < 2) {
            $check_query = R::getAll('SELECT * FROM `users_courses` JOIN `courses` ON users_courses.course_id = courses.id WHERE users_courses.user_id = ? AND courses.id = ?', [$_SESSION['uid'], $_GET['course']]);
            if(!$check_query) {
                Router::redirect('/');
            }
            $check_q = R::getAll('SELECT * FROM `courses` JOIN `lessons` ON courses.id = lessons.course_id JOIN userscourses ON userscourses.course_id = courses.id  WHERE user_id = ? AND courses.id = ? AND lessons.id = ?',[$_SESSION['uid'], $_GET['course'], $_GET['id']]);
            if(!$check_q) {
                Router::redirect('/');
            }
        } else {
            $check_query = R::getAll('SELECT * FROM `courses` JOIN `lessons` ON courses.id = lessons.course_id WHERE courses.id = ? AND lessons.id = ?', [$_GET['course'], $_GET['id']]);
            if(!$check_query) {
                Router::redirect('/');
            }
            $lessons = R::getAll('SELECT * FROM `lessons` WHERE course_id = ? AND id = ?', [$_GET['course'], $_GET['id']]);
        }
    } else {
        Router::redirect('/');
    }

    foreach ($lessons as $lesson) {

    }

if(isset($_GET['del'])) {
    $del = R::load('lessons', $_GET['del']);
    R::trash($del);
    Router::redirect("my-courses");
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
    <div class="wrapper lesson__wrapper">
      <div class="header__main">
          <?php Page::part('header');?>
      </div>
      <main class="main">
        <div class="main__container container">
          <div class="lesson">
            <div class="lesson__container">
              <div class="header-title-row">
                <h1 class="main-header__title header-title">
                  <?php echo $lesson['name'] ?>
                </h1>
                <div class="main-header__figure landing-header__figure"></div>
              </div>
                <div class="lesson-content__video">
                    <iframe width="100%" height="700px" src="<?php echo $lesson['path'] ?>" title="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
              <div class="lesson__row">
                <div class="lesson__content lesson-content">
                  <div class="lesson-content__title-text">
                    <h4 class="lesson-content__title">
                        <?php echo $lesson['name'] ?>
                    </h4>
                    <p class="lesson-content__text">
                        <?php echo $lesson['description'] ?>
                    </p>
                  </div>
                  <div class="lesson-content__buttons">
                      <?php
                        $lessons =  R::getAll('SELECT * FROM `userscourses` WHERE id = ?', [$_SESSION['uid']]);
                      ?>
                    <a href="?" class="lesson__button lesson__button-back"
                      >Предыдущий</a
                    >
                    <a href="#" class="lesson__button lesson__button-next"
                      >Следующий</a
                    >
                      <?php
                      // Проверка на роль пользователя
                        if(isset($_SESSION['uid'])) {
                            if($_SESSION['user_role'] > 1 ) {?>
                                <a href="lesson?del=<?php echo $_GET['id']?>" class="lesson__button lesson__button-back">Удалить</a>
                            <?php }
                        }
                      ?>
                  </div>
                </div>
                <div class="lesson__chat lesson-chat">
                  <div class="lesson-chat__content">
                    <div class="user__receiver user-receiver">
                      <div class="user-receiver__list">
                        <div class="user-receiver__item user-receiver-item">
                          <div class="user-receiver-item__info">
                            <div class="user-receiver-item__avatar"></div>
                            <div class="user-receiver-item__content">
                              <p class="user-receiver-item__name">Система</p>
                              <p class="user-receiver-item__date">
                                26.10.22 0:04
                              </p>
                            </div>
                          </div>
                          <div
                            class="user-receiver-item__messageuser-receiver-item-message"
                          >
                            <p class="user-receiver-item-message__text">
                              В данном чате вы можете задать вопрос
                              преподавателю по данному уроку.
                            </p>
                          </div>
                        </div>
                        <div
                          class="user__sender user-receiver__item user-receiver-item"
                        >
                          <div class="user-receiver-item__info">
                            <div class="user-receiver-item__avatar"></div>
                            <div class="user-receiver-item__content">
                              <p class="user-receiver-item__name">
                                Назмиев Азат
                              </p>
                              <p class="user-receiver-item__date">
                                26.10.22 0:05
                              </p>
                            </div>
                          </div>
                          <div
                            class="user-receiver-item__messageuser-receiver-item-message"
                          >
                            <p class="user-receiver-item-message__text">
                              Здравстуйте, я хотел бы задать вопрос по поводу
                              анимации высокополигональных моделей, вы не
                              заняты?
                            </p>
                          </div>
                        </div>
                        <div class="user-receiver__item user-receiver-item">
                          <div class="user-receiver-item__info">
                            <div class="user-receiver-item__avatar"></div>
                            <div class="user-receiver-item__content">
                              <p class="user-receiver-item__name">
                                Преподаватель
                              </p>
                              <p class="user-receiver-item__date">
                                26.10.22 0:14
                              </p>
                            </div>
                          </div>
                          <div
                            class="user-receiver-item__messageuser-receiver-item-message"
                          >
                            <p class="user-receiver-item-message__text">
                              Здравстуйте, ответ на ваш вопрос уже формируется.
                              Ожидайте ответа.
                            </p>
                          </div>
                        </div>
                        <div class="user-receiver__item user-receiver-item">
                          <div class="user-receiver-item__info">
                            <div class="user-receiver-item__avatar"></div>
                            <div class="user-receiver-item__content">
                              <p class="user-receiver-item__name">
                                Преподаватель
                              </p>
                              <p class="user-receiver-item__date">
                                26.10.22 0:24
                              </p>
                            </div>
                          </div>
                          <div
                            class="user-receiver-item__messageuser-receiver-item-message"
                          >
                            <p class="user-receiver-item-message__text">
                              Здравстуйте, я с вами на связи. Задавайте ваш
                              вопрос.
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="lessom-chat__message">
                    <form
                      name="sendMessage"
                      method="post"
                      class="lessom-chat__form standart__form"
                    >
                      <input
                        type="text"
                        name="message_text"
                        placeholder="Введите ваше сообщение..."
                        class="standart__input"
                      />
                      <label for="message">
                        <svg
                          width="31"
                          height="30"
                          viewBox="0 0 31 30"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M15.3532 6.76172C9.23016 8.92383 4.09735 10.7461 3.93914 10.8047C3.58172 10.9395 3.36493 11.2207 3.32391 11.5957C3.29461 11.918 3.44696 12.2871 3.68133 12.4336C3.83954 12.5449 12.488 16.582 12.5524 16.582C12.5759 16.582 13.6013 15.5801 14.8259 14.3613C16.777 12.4102 17.0817 12.1348 17.2751 12.0996C17.738 12.0117 18.3181 12.416 18.4059 12.8789C18.488 13.3184 18.4411 13.3828 16.1149 15.7031C14.9079 16.9102 13.9177 17.9238 13.9177 17.9473C13.9177 18.0117 17.9548 26.6543 18.0661 26.8242C18.195 27.0176 18.5583 27.1875 18.8513 27.1875C19.1852 27.1875 19.4899 26.9766 19.6481 26.6484C19.7126 26.5078 21.5524 21.3457 23.7263 15.1699C26.4509 7.45312 27.6872 3.87305 27.6872 3.70898C27.6872 3.24023 27.2302 2.80664 26.7556 2.81836C26.5563 2.82422 23.5153 3.87305 15.3532 6.76172Z"
                            fill="white"
                          />
                        </svg>
                      </label>
                      <input type="submit" name="sendMessage" id="message" />
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
