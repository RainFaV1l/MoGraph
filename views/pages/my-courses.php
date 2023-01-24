<?php use App\Services\Page;
use App\Services\Router;
if(isset($_GET['del'])) {
    R::exec('DELETE FROM `lessons` WHERE `course_id` = :course_id', [
        'course_id' => $_GET['id']
    ]);
    $course = R::load('courses', $_GET['id']);
    R::trash($course);
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
    <div class="wrapper profile__wrapper">
        <?php Page::part('modal');?>
      <div class="header__main">
          <?php Page::part('header');?>
      </div>
      <main class="main">
        <div class="main__container container">
          <div class="my-courses">
            <div class="my-courses__container">
              <div class="header-title-row">
                  <?php
                    if(isset($_SESSION['uid'])) {
                        if($_SESSION['user_role'] == 3) {?>
                            <h1 class="main-header__title header-title">Все курсы</h1>
                        <?php }
                        else {?>
                            <h1 class="main-header__title header-title">Мои курсы</h1>
                        <?php }
                    }
                  ?>

                <div class="main-header__figure landing-header__figure"></div>
              </div>
                <?php
                if(isset($_SESSION['uid'])) {
                    if($_SESSION['user_role'] > 1) {?>
                        <div class="main-header__nav my-courses-header__nav">
                            <a href="/add_course" class="main-header__item">Добавить</a>
                        </div>
                    <?php }
                }
                ?>

              <div class="my-courses__list">
                  <?php
                    $courses = '';
                    if(isset($_SESSION['uid'])) {
                        if($_SESSION['user_role'] == 3) {
                            $courses = R::getAll('SELECT * FROM `courses`');
                        }
                        if($_SESSION['user_role'] == 2) {
                            $courses = R::getAll('SELECT * FROM `courses` WHERE `author_id` = ?', [$_SESSION['uid']]);
                        }
                        if($_SESSION['user_role'] == 1) {
                            $courses = R::getAll('SELECT * FROM `userscourses` JOIN `courses` ON userscourses.course_id = courses.id WHERE user_id = ?', [$_SESSION['uid']]);
                        }
                        foreach ($courses as $course) {
                            $course_cat_id = $course['category'];
                            $course_cat = R::load('courses_category', $course_cat_id);
                            ?>
                            <div class="my-courses__item">
                                <p class="my-courses__type"><?php echo $course_cat['name']?> курс</p>
                                <div class="my-courses__title-row">
                                    <h4 class="my-courses__title"><?php echo $course['name']?></h4>
                                    <div class="my-courses__line-icon-text">
                                        <div class="my-courses-line">
                                            <div class="my-courses__line"></div>
                                        </div>
                                        <div class="my-courses__icon-text">
                                            <a href="one-course?id=<?php echo $course['id'] ?>" class="my-courses__icon">
                                                <svg width="70" height="70" viewBox="0 0 70 70" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="35" cy="35" r="35" fill="url(#paint0_linear_106_1780)"/>
                                                    <path d="M48.5 35.866C49.1667 35.4811 49.1667 34.5189 48.5 34.134L29 22.8756C28.3333 22.4907 27.5 22.9719 27.5 23.7417V46.2583C27.5 47.0281 28.3333 47.5093 29 47.1244L48.5 35.866Z" fill="white"/>
                                                    <defs>
                                                        <linearGradient id="paint0_linear_106_1780" x1="7.61922e-08" y1="77.1296" x2="75.1303" y2="70.5059" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#1153FC"/>
                                                            <stop offset="1" stop-color="#9600FF"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                            </a>
                                            <div class="my-courses__text-row">
                                                <p class="my-courses__text">
                                                    Вы остановились на уроке
                                                </p>
                                                <p class="my-courses__text">1. Введение в курс</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-courses__info my-courses-info">
                                    <div class="my-courses-info__item">
                                        <div class="my-courses-info__icon">
                                            <svg
                                                    width="31"
                                                    height="30"
                                                    viewBox="0 0 31 30"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <g clip-path="url(#clip0_28240_869)">
                                                    <path
                                                            d="M14.095 0.0644512C8.84497 0.603514 4.36255 3.67969 2.05982 8.32617C1.33325 9.78515 0.905519 11.127 0.635987 12.7793C0.466065 13.8398 0.454347 16.0312 0.60669 17.0508C1.04028 19.8457 2.14185 22.377 3.84107 24.4629C5.18286 26.1094 6.90552 27.4805 8.82153 28.418C10.345 29.168 11.6516 29.584 13.2747 29.8359C14.4465 30.0176 16.4973 30.0176 17.6692 29.8359C19.2981 29.584 20.6106 29.1621 22.1282 28.418C23.6575 27.6621 24.7825 26.8594 26.0364 25.6172C27.2668 24.4043 28.1458 23.1738 28.925 21.5918C29.6575 20.0977 30.0735 18.7617 30.3372 17.0508C30.4895 16.0312 30.4778 13.8398 30.3079 12.7793C29.6165 8.50781 27.2961 4.86914 23.7688 2.51367C22.9954 1.99804 21.4836 1.23047 20.6223 0.914061C19.8079 0.615232 18.5833 0.304686 17.6868 0.16992C16.7844 0.0351543 14.9094 -0.0234394 14.095 0.0644512ZM17.5813 2.68359C22.2805 3.52148 26.1594 6.97851 27.4602 11.4961C27.8411 12.8203 27.9231 13.4473 27.9172 15.0293C27.9114 16.6055 27.8352 17.1914 27.4602 18.4863C26.2883 22.541 23.0129 25.8164 18.9583 26.9883C17.6458 27.3691 17.0833 27.4453 15.4719 27.4453C13.8606 27.4453 13.2981 27.3691 11.9856 26.9883C7.93091 25.8164 4.65552 22.541 3.48364 18.4863C3.10278 17.1738 3.02661 16.6113 3.02661 15C3.02661 13.7871 3.05005 13.459 3.15552 12.8906C3.63599 10.2773 4.81372 8.02148 6.65357 6.18164C8.66919 4.16601 11.2063 2.93554 14.0657 2.58398C14.8098 2.49023 16.8079 2.54883 17.5813 2.68359Z"
                                                            fill="white"
                                                    />
                                                    <path
                                                            d="M13.4268 9.82619C13.3213 9.87892 13.1807 10.0078 13.1221 10.1016C13.0166 10.2774 13.0107 10.5 13.0107 15.0176C13.0107 19.3008 13.0225 19.7754 13.1045 19.9219C13.3271 20.291 13.8252 20.3848 14.2119 20.127C14.3291 20.0449 15.8057 18.9727 17.4932 17.7539C19.9951 15.9375 20.5752 15.4863 20.6572 15.3164C20.7686 15.0879 20.7451 14.8125 20.5986 14.6074C20.4932 14.4551 14.1943 9.86721 13.9775 9.78517C13.7666 9.70314 13.6611 9.71486 13.4268 9.82619Z"
                                                            fill="white"
                                                    />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_281310_869">
                                                        <rect
                                                                width="30"
                                                                height="30"
                                                                fill="white"
                                                                transform="translate(0.5)"
                                                        />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <p class="my-courses-info__text">15 уроков</p>
                                    </div>
                                    <div class="my-courses-info__item">
                                        <div class="my-courses-info__icon">
                                            <svg
                                                    width="31"
                                                    height="30"
                                                    viewBox="0 0 31 30"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <g clip-path="url(#clip0_280_83275)">
                                                    <path
                                                            d="M15.6156 1.2948C11.0335 1.6698 6.95541 4.28308 4.69369 8.30262C2.79525 11.6776 2.43783 15.8085 3.71517 19.5057C4.39486 21.4569 5.40853 23.0858 6.87924 24.5975C11.0101 28.8339 17.3792 29.9471 22.7054 27.3632C25.5824 25.9628 27.9671 23.5018 29.2386 20.6249C31.3363 15.8846 30.6566 10.5233 27.4456 6.43348C26.6898 5.47254 25.1898 4.11316 24.141 3.44519C22.9749 2.70105 21.5277 2.06238 20.2445 1.7284C19.2718 1.47058 18.6214 1.36512 17.637 1.28894C16.7581 1.22449 16.471 1.22449 15.6156 1.2948ZM18.4867 3.89051C19.6703 4.10144 20.5199 4.37683 21.557 4.86902C25.8929 6.94324 28.4242 11.5194 27.8617 16.2889C27.3753 20.4725 24.5863 24.0468 20.6546 25.5175C15.7093 27.369 10.1839 25.5643 7.28353 21.1464C6.44564 19.869 5.889 18.4276 5.58432 16.7577C5.44369 15.9784 5.44369 14.0214 5.58432 13.2421C5.81283 12.0057 6.07064 11.1796 6.56869 10.1425C8.24447 6.63855 11.5316 4.30066 15.4691 3.81433C16.096 3.7323 17.8597 3.77918 18.4867 3.89051Z"
                                                            fill="white"
                                                    />
                                                    <path
                                                            d="M16.1135 6.39832C15.967 6.48035 15.7737 6.65613 15.6741 6.79089L15.4983 7.04285L15.4807 11.121C15.469 14.0858 15.4807 15.2694 15.5334 15.4393C15.5862 15.6327 15.9436 16.0194 17.5959 17.6835C19.7288 19.8221 19.9221 19.9803 20.4319 19.9803C21.3401 19.9803 21.9319 19.0546 21.5569 18.2225C21.469 18.0292 20.9709 17.4901 19.6877 16.201L17.9299 14.4432L17.9182 10.746L17.9006 7.04871L17.7424 6.82019C17.4846 6.45691 17.2151 6.30457 16.7639 6.28113C16.4417 6.26355 16.3303 6.28699 16.1135 6.39832Z"
                                                            fill="white"
                                                    />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_24280_842475">
                                                        <rect
                                                                width="30"
                                                                height="30"
                                                                fill="white"
                                                                transform="translate(0.5)"
                                                        />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <p class="my-courses-info__text"><?php echo $course['number_of_hours']?> часов</p>
                                    </div>
                                </div>
                                <div class="my-courses__continue-learning continue-learning">
                                    <?php
                                        if(isset($_SESSION['uid'])) {
                                            if($_SESSION['user_role'] > 1) {?>
                                                <a href="#" data-id="<?php echo $course['id'] ?>" class="continue-learning__text delete-item openDeleteModal">Удалить</a>
                                                <a href="/edit_course?id=<?php echo $course['id']?>&edit" class="continue-learning__text delete-item">Редактировать</a>
                                            <?php }
                                        }
                                    ?>
                                    <div class="my-courses__icon-text">
                                        <a href="one-course?id=<?php echo $course['id']?>" class="continue-learning__text">Продолжить обучение</a>
                                        <div class="continue-learning__arrow">
                                            <svg
                                                    width="41"
                                                    height="15"
                                                    viewBox="0 0 41 15"
                                                    fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
                                            >
                                                <path
                                                        d="M40.7071 8.20711C41.0976 7.81659 41.0976 7.18342 40.7071 6.7929L34.3431 0.428935C33.9526 0.0384108 33.3195 0.0384107 32.9289 0.428935C32.5384 0.819459 32.5384 1.45262 32.9289 1.84315L38.5858 7.5L32.9289 13.1569C32.5384 13.5474 32.5384 14.1805 32.9289 14.5711C33.3195 14.9616 33.9526 14.9616 34.3431 14.5711L40.7071 8.20711ZM-8.74228e-08 8.5L40 8.5L40 6.5L8.74228e-08 6.5L-8.74228e-08 8.5Z"
                                                        fill="white"
                                                />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                  ?>
              </div>
            </div>
          </div>
        </div>
      </main>
        <?php Page::part('footer');?>
    </div>
  </body>
</html>
