<?php
use App\Services\Page;
use App\Services\Router;

if(!isset($_GET['id'])) {
    Router::redirect('/');
} else if($_SESSION['user_role'] != 3) {
    $check_user = R::getAll('SELECT * FROM `userscourses` WHERE `course_id` = ? AND `user_id` = ?', [$_GET['id'], $_SESSION['uid']]);
    if(!$check_user) {
        Router::redirect('/');
    }
}

if(isset($_SESSION['uid'])) {
    $check_query = R::getAll('SELECT * FROM `users_courses` JOIN `courses` ON users_courses.course_id = courses.id WHERE users_courses.user_id = ?', [$_SESSION['uid']]);
    if(!$check_query && !$_SESSION['user_role'] > 1 ) {
        Router::redirect('/');
    }
} else {
    Router::redirect('/');
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
    <div class="wrapper profile__wrapper">
      <div class="header__main">
          <?php Page::part('header');?>
      </div>
      <main class="main">
        <div class="main__container container">
          <div class="one-course">
            <div class="one-course__container">
              <div class="header-title-row">
                <a href="/my-courses" class="main-header__nav main-header-nav">
                  <div class="main-header-nav__icon">
                    <svg
                      width="50"
                      height="50"
                      viewBox="0 0 50 50"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <circle
                        cx="25"
                        cy="25"
                        r="25"
                        fill="url(#paint0_linear_109_2139)"
                      />
                      <path
                        d="M20.2929 25.7071C19.9024 25.3166 19.9024 24.6834 20.2929 24.2929L26.6569 17.9289C27.0474 17.5384 27.6805 17.5384 28.0711 17.9289C28.4616 18.3195 28.4616 18.9526 28.0711 19.3431L22.4142 25L28.0711 30.6569C28.4616 31.0474 28.4616 31.6805 28.0711 32.0711C27.6805 32.4616 27.0474 32.4616 26.6569 32.0711L20.2929 25.7071ZM22 26L21 26L21 24L22 24L22 26Z"
                        fill="white"
                      />
                      <defs>
                        <linearGradient
                          id="paint0_linear_109_2139"
                          x1="5.4423e-08"
                          y1="55.0926"
                          x2="53.6645"
                          y2="50.3613"
                          gradientUnits="userSpaceOnUse"
                        >
                          <stop stop-color="#1153FC" offset=""/>
                          <stop offset="1" stop-color="#9600FF" />
                        </linearGradient>
                      </defs>
                    </svg>
                  </div>
                  <p class="main-header-nav__text">Мои курсы</p>
                </a>
                <h1 class="main-header__title header-title">Мои курсы</h1>
                <div class="main-header__figure landing-header__figure"></div>
              </div>
              <?php  if(isset($_SESSION['uid'])) {
                if($_SESSION['user_role'] > 1) {?>
                <div class="main-header__nav my-courses-header__nav">
                    <a href="/add_lesson?id=<?php echo $_GET['id']?>" class="main-header__item">Добавить урок</a>
                </div>
                <?php }
              }
              $course_items = R::getAssoc('SELECT * FROM `courses` WHERE `id` = ?', [$_GET['id']]);
              foreach ($course_items as $course_item) {}
              $course_item_cat = R::load('courses_category', $course_item['category']);
              ?>
              <div class="one-course__row">
                <div class="one-course__course">
                  <p class="one-course__type"><?php echo $course_item_cat['name'] ?> курс</p>
                  <div class="one-course__info">
                    <h4 class="one-course__title"><?php echo $course_item['name']?></h4>
                    <a href="#" class="one-course__icon-text">
                      <div class="one-course__icon">
                        <svg
                          width="70"
                          height="70"
                          viewBox="0 0 70 70"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <circle
                            cx="35"
                            cy="35"
                            r="35"
                            fill="url(#paint0_linear_106_1780)"
                          />
                          <path
                            d="M48.5 35.866C49.1667 35.4811 49.1667 34.5189 48.5 34.134L29 22.8756C28.3333 22.4907 27.5 22.9719 27.5 23.7417V46.2583C27.5 47.0281 28.3333 47.5093 29 47.1244L48.5 35.866Z"
                            fill="white"
                          />
                          <defs>
                            <linearGradient
                              id="paint0_linear_106_1780"
                              x1="7.61922e-08"
                              y1="77.1296"
                              x2="75.1303"
                              y2="70.5059"
                              gradientUnits="userSpaceOnUse"
                            >
                              <stop stop-color="#1153FC" offset="1"/>
                              <stop offset="1" stop-color="#9600FF" />
                            </linearGradient>
                          </defs>
                        </svg>
                      </div>
                      <div class="one-course__text-column">
                        <p class="one-course__text">Вы остановились на уроке</p>
                        <p class="one-course__text">1. Введение в курс</p>
                      </div>
                    </a>
                    <p class="one-course__progress">Пройдено 0 / 12 уроков</p>
                  </div>
                </div>
                <div class="one-course__course-list">
                    <?php
                        if(isset($_SESSION['uid'])) {
                            $lessons = R::getAll('SELECT * FROM `lessons` WHERE `course_id` = ?', [$_GET['id']]);
                            ?><div class="one-course__accordion one-item-training-program__accordion">
                            <?php
                                foreach ($lessons as $lesson) {?>
                                    <div
                                            class="one-item-training-program__item one-item-accordion__item one-item-accordion-item"
                                    >
                                        <div class="one-item-accordion-item__header-icon">
                                            <div class="one-item-accordion-item__header">
                                                <div class="one-item-accordion-item-figure">
                                                    <div class="one-item-accordion-item__figure"></div>
                                                </div>
                                                <a href="lesson?course=<?php echo $_GET['id'] ?>&id=<?php echo $lesson['id'] ?>" class="one-item-accordion-item__text">
                                                    <?php echo $lesson['name'] ?>
                                                </a>
                                            </div>
                                            <div class="one-item-accordion-item__icon">
                                                <svg
                                                        width="20"
                                                        height="12"
                                                        viewBox="0 0 20 12"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                            d="M3.00471 1.22398C2.51453 0.7238 1.70911 0.723873 1.21902 1.22415L1.1261 1.319C0.649954 1.80504 0.650013 2.58265 1.12624 3.06863L8.70019 10.7976C9.18165 11.289 9.96959 11.2989 10.4633 10.82L18.4529 3.06958C18.9501 2.58723 18.9603 1.79249 18.4755 1.29762L18.3789 1.19902C17.8991 0.709298 17.1145 0.697362 16.62 1.17226L10.116 7.41956C9.81935 7.70446 9.34862 7.69734 9.06076 7.4036L3.00471 1.22398Z"
                                                            fill="white"
                                                            stroke="#6C63FF"
                                                            stroke-width="0.5"
                                                    />
                                                </svg>
                                            </div>
                                        </div>
                                        <div
                                                class="one-item-training-program__content one-item-training-program-content"
                                        >
                                            <?php echo $lesson['description'] ?>
                                        </div>
                                    </div>
                                <?php }
                            ?>
                            </div><?php
                        }
                    ?>
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
