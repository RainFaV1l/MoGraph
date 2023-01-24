<?php use App\Services\Page;
use App\Services\Router;

if(!isset($_GET['id'])) {
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
    <div class="wrapper one-item__wrapper">
      <div class="header__main">
          <?php Page::part('header');?>
      </div>
      <main class="main">
        <div class="main__container container">
            <?php
                if(isset($_GET['id'])) {
                    $catalog_items = \R::findAll('courses', 'id = ?', [$_GET['id']]);
                    foreach ($catalog_items as $item) {
                        $lesson_items = \R::findAll('lessons', 'course_id = ?', [$_GET['id']]);
                        $item_category = \R::load('courses_category', $item['category']);
                        $user = \R::load('users', $item['author_id']);?>
                        <div class="one-item">
                            <div class="one-item__start one-item-start">
                                <div class="one-item-start__container">
                                    <div class="one-item__top">
                                        <div class="one-item__bread-crumbs">
                                            Главная / Каталог / HTML + CSS
                                        </div>
                                    </div>
                                    <div class="one-item__content">
                                        <div class="one-item__content-info">
                                            <h2 class="one-item__title"><?php echo $item['name']?></h2>
                                            <div class="one-item__info">
                                                <div class="one-item-figure">
                                                    <div class="one-item__figure"></div>
                                                </div>
                                                <p class="one-item__text"><?php echo $item['description']?></p>
                                            </div>
                                            <div class="one-item__button-price">
                                                <?php
                                                    $course_id = $_GET['id'];
                                                    $check_query =
                                                    R::exec('SELECT * FROM `userscourses` WHERE `course_id` = :course_id AND `user_id` = :user_id', [
                                                        'course_id' => $course_id,
                                                        'user_id' => $_SESSION['uid'],
                                                    ]);

                                                    if($check_query != NULL) {
                                                        if(isset($_GET['id'])) {
                                                            if(isset($_GET['subscribe'])) {

                                                            }
                                                        }
                                                        ?>
                                                        <a href="/one-item?id=<?php echo $_GET['id'] ?>" class="one-item__button">Вы уже записаны</a>
                                                    <?php } else if(empty($_SESSION['uid'])) {?>
                                                        <a href="/sign-in" class="one-item__button">Вход</a>
                                                    <?php } else {?>
                                                        <a href="/one-item?id=<?php echo $_GET['id'] ?>&subscribe" class="one-item__button">Записаться</a>
                                                    <?php }

                                                    if(isset($_GET['id'])) {
                                                        if(isset($_GET['subscribe'])) {
                                                            $subscribe = \R::dispense('userscourses');
                                                            $subscribe->user_id = $_SESSION['uid'];
                                                            $subscribe->course_id = $_GET['id'];
                                                            \R::store($subscribe);
                                                            ?>
                                                            <script>location.href="/one-item?id=<?php echo $_GET['id']?>"</script><?
                                                        }
                                                    }
                                                ?>

                                                <p class="one-item__price"><?php echo $item['price']?> ₽</p>
                                            </div>
                                        </div>
                                        <div class="one-item__img">
                                            <img src="<?php echo $item['path']?>" alt="img" />
                                        </div>
                                    </div>
                                    <div class="one-item__bottom">
                                        <div class="one-item__course">
                                            <p class="one-item__type"><?php echo $item_category['name']?> курс</p>
                                            <div class="one-item__time one-item-time">
                                                <svg
                                                        width="35"
                                                        height="35"
                                                        viewBox="0 0 35 35"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                            d="M17.6353 1.5106C12.2896 1.9481 7.5318 4.99693 4.89313 9.68639C2.67828 13.6239 2.26129 18.4432 3.75153 22.7567C4.54449 25.0331 5.72711 26.9335 7.44293 28.6971C12.2623 33.6395 19.6929 34.9383 25.9068 31.9237C29.2632 30.2899 32.0455 27.4188 33.5289 24.0624C35.9761 18.5321 35.1832 12.2772 31.4371 7.50572C30.5552 6.38463 28.8052 4.79869 27.5816 4.01939C26.2213 3.15123 24.5328 2.40611 23.0357 2.01646C21.9009 1.71568 21.1422 1.59264 19.9937 1.50377C18.9683 1.42857 18.6334 1.42857 17.6353 1.5106ZM20.9849 4.53893C22.3658 4.78502 23.357 5.10631 24.567 5.68053C29.6255 8.10045 32.5787 13.4393 31.9224 19.0038C31.355 23.8846 28.1011 28.0546 23.5142 29.7704C17.7447 31.9305 11.2984 29.8251 7.91461 24.6708C6.93707 23.1805 6.28766 21.4989 5.93219 19.5506C5.76813 18.6415 5.76813 16.3583 5.93219 15.4491C6.19879 14.0067 6.49957 13.0428 7.08063 11.8329C9.03571 7.74498 12.8707 5.01744 17.4644 4.45006C18.1959 4.35435 20.2535 4.40904 20.9849 4.53893Z"
                                                            fill="white"
                                                    />
                                                    <path
                                                            d="M18.2163 7.46472C18.0454 7.56042 17.8198 7.7655 17.7036 7.92273L17.4985 8.21667L17.478 12.9745C17.4643 16.4335 17.478 17.8143 17.5395 18.0126C17.601 18.2382 18.018 18.6893 19.9458 20.6307C22.434 23.1259 22.6596 23.3104 23.2544 23.3104C24.3139 23.3104 25.0044 22.2303 24.5669 21.2596C24.4643 21.0341 23.8833 20.4052 22.3862 18.9012L20.3354 16.8505L20.3217 12.537L20.3012 8.22351L20.1167 7.95691C19.8159 7.53308 19.5014 7.35535 18.9751 7.328C18.5991 7.30749 18.4692 7.33484 18.2163 7.46472Z"
                                                            fill="white"
                                                    />
                                                </svg>
                                                <p class="one-item-time__time"><?php echo $item['number_of_hours']?> часов</p>
                                            </div>
                                            <div class="one-item__time one-item-lesson">
                                                <svg
                                                        width="35"
                                                        height="35"
                                                        viewBox="0 0 35 35"
                                                        fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <g clip-path="url(#clip0_94_3566)">
                                                        <path
                                                                d="M15.8608 0.0751915C9.7358 0.704098 4.50631 4.29297 1.81978 9.71387C0.972128 11.416 0.473105 12.9814 0.158652 14.9092C-0.0395904 16.1465 -0.0532623 18.7031 0.124472 19.8926C0.630331 23.1533 1.91549 26.1064 3.89791 28.54C5.46334 30.4609 7.4731 32.0605 9.70846 33.1543C11.4858 34.0293 13.0102 34.5146 14.9038 34.8086C16.271 35.0205 18.6635 35.0205 20.0307 34.8086C21.9311 34.5146 23.4624 34.0225 25.2329 33.1543C27.017 32.2725 28.3295 31.3359 29.7924 29.8867C31.228 28.4717 32.2534 27.0361 33.1626 25.1904C34.0171 23.4473 34.5024 21.8887 34.81 19.8926C34.9878 18.7031 34.9741 16.1465 34.7758 14.9092C33.9692 9.92578 31.2622 5.68066 27.1469 2.93261C26.2446 2.33105 24.4809 1.43554 23.476 1.0664C22.5258 0.71777 21.0971 0.355465 20.0512 0.198238C18.9985 0.0410118 16.811 -0.0273476 15.8608 0.0751915ZM19.9282 3.13086C25.4106 4.1084 29.936 8.1416 31.4536 13.4121C31.8979 14.957 31.9936 15.6885 31.9868 17.5342C31.9799 19.373 31.8911 20.0566 31.4536 21.5674C30.0864 26.2979 26.2651 30.1191 21.5346 31.4863C20.0034 31.9307 19.3471 32.0195 17.4672 32.0195C15.5874 32.0195 14.9311 31.9307 13.3999 31.4863C8.66939 30.1191 4.8481 26.2979 3.48092 21.5674C3.03658 20.0361 2.94771 19.3799 2.94771 17.5C2.94771 16.085 2.97506 15.7021 3.0981 15.0391C3.65865 11.9902 5.03268 9.3584 7.17916 7.21191C9.53072 4.86035 12.4907 3.4248 15.8266 3.01465C16.6948 2.90527 19.0258 2.97363 19.9282 3.13086Z"
                                                                fill="white"
                                                        />
                                                        <path
                                                                d="M15.0815 11.4639C14.9585 11.5254 14.7944 11.6758 14.7261 11.7852C14.603 11.9902 14.5962 12.25 14.5962 17.5205C14.5962 22.5176 14.6099 23.0713 14.7056 23.2422C14.9653 23.6729 15.5464 23.7822 15.9976 23.4815C16.1343 23.3858 17.8569 22.1348 19.8257 20.7129C22.7446 18.5938 23.4214 18.0674 23.5171 17.8692C23.647 17.6026 23.6196 17.2813 23.4487 17.042C23.3257 16.8643 15.9771 11.5117 15.7241 11.416C15.478 11.3203 15.355 11.334 15.0815 11.4639Z"
                                                                fill="white"
                                                        />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_94_3566">
                                                            <rect width="35" height="35" fill="white" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                                <p class="one-item-lesson__lesson">12 уроков</p>
                                            </div>
                                        </div>
                                        <div class="one-item__author">Автор курса: <?php echo $user['surname'] . ' ' . $user['name']?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="one-item__training-program one-item-training-program">
                                <div class="one-item-training-program__container">
                                    <div class="one-item-training-program__header landing-header">
                                        <h2 class="landing-header__title">Программа обучения</h2>
                                        <div class="landing-header__figure"></div>
                                    </div>
                                    <div class="one-item-training-program__accordion">
                                        <?php
                                            foreach ($lesson_items as $lesson_item) {?>
                                                <div
                                                        class="one-item-training-program__item one-item-accordion__item one-item-accordion-item"
                                                >
                                                    <div class="one-item-accordion-item__header-icon">
                                                        <div class="one-item-accordion-item__header">
                                                            <div class="one-item-accordion-item-figure">
                                                                <div class="one-item-accordion-item__figure"></div>
                                                            </div>
                                                            <p class="one-item-accordion-item__text">
                                                                <?php
                                                                    echo $lesson_item['name'];
                                                                ?>
                                                            </p>
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
                                                        <?php
                                                            echo $lesson_item['description'];
                                                        ?>
                                                    </div>
                                                </div>
                                            <?}
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?}
                }
            ?>
        </div>
      </main>
        <?php Page::part('footer');?>
    </div>
  </body>
</html>
