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
    <div class="wrapper wrapper__cataloge">
      <div class="header__main">
        <?php Page::part('header');?>
      </div>
      <main class="main">
        <div class="cataloge">
          <div class="cataloge__container container">
            <div class="cataloge__header main-header">
              <h1 class="main-header__title header-title">Наши курсы</h1>
              <div class="main-header__figure landing-header__figure"></div>
              <div class="main-header__nav">
                  <?php
                    $all_category_count = \R::count( 'courses' );
                  ?>
                  <a href="/catalog" class="main-header__item">Все (<?php echo  $all_category_count ?>)</a>
                  <?php
                  $categorys = \R::findAll('courses_category');
                  foreach ($categorys as $category) {
                      $category_count = \R::count( 'courses', 'category = ?', [$category['id']] );
                      if(isset($_GET['c'])) {
                          if($_GET['c'] == $category['id']) {
                              $cat_id = $_GET['c'];
                              $catalog_items = \R::findAll('courses', 'category = ?', [$cat_id]);
                          }
                      }
                      ?>
                    <a href="?c=<?php echo $category['id'] ?>" class="main-header__item"><?php echo $category['name']?> курсы (<?php echo $category_count?>)</a>
                  <?php }
                  if(!isset($_GET['c'])) {
                      $catalog_items = \R::findAll('courses');
                  }
                  ?>
              </div>
            </div>
            <div class="cataloge__list">
                <?php
                foreach ($catalog_items as $item) {
                    $item_category = \R::load('courses_category', $item['category']);
                    $user = \R::load('users', $item['author_id']);
                    ?>
                    <div class="cataloge-cataloge__item cataloge-item">
                        <div class="cataloge-item-figure">
                            <div class="cataloge-item-figure__figure"></div>
                        </div>
                        <div class="cataloge-item__content">
                            <div class="cataloge-item__top cataloge-item-top">
                                <div class="cataloge-item-top__content">
                                    <div class="cataloge-item-top__icons">
                                        <a href="https://www.maxon.net/ru/cinema-4d">
                                            <img src="../img/start_cataloge/c4d.png" alt="c4d" />
                                        </a>
                                        <a
                                                href="https://www.adobe.com/products/aftereffects.html"
                                        >
                                            <img src="../img/start_cataloge/ae.png" alt="ae" />
                                        </a>
                                    </div>
                                    <div class="cataloge-item-top__text">
                                        <p class="cataloge-item-top__subtitle">Мини курс</p>
                                        <p class="cataloge-item-top__title">
                                            <?php echo $item['name'] ?>
                                        </p>
                                    </div>
                                    <div class="cataloge-item-top__category"><?php echo $item_category['name']?> курс</div>
                                </div>
                                <div class="cataloge-item-top__img">
                                    <img src="<?php echo $item['path']?>" alt="img" />
                                </div>
                            </div>
                            <div class="cataloge-item__bottom cataloge-item-bottom">
                                <div class="cataloge-item-bottom__info">
                                    <div
                                            class="cataloge-item-bottom__time cataloge-item-bottom-time"
                                    >
                                        <svg
                                                width="23"
                                                height="23"
                                                viewBox="0 0 23 23"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                    d="M10.5963 0.0790043C6.77795 0.391504 3.37951 2.56924 1.49474 5.91885C-0.0872892 8.73135 -0.385141 12.1737 0.679312 15.2548C1.24572 16.8808 2.09045 18.2382 3.31603 19.4979C6.75841 23.0282 12.066 23.956 16.5045 21.8026C18.902 20.6356 20.8893 18.5849 21.9488 16.1874C23.6969 12.2372 23.1305 7.76943 20.4547 4.36123C19.8248 3.56045 18.5748 2.42764 17.7008 1.871C16.7291 1.25088 15.5231 0.718653 14.4537 0.440332C13.6432 0.225489 13.1012 0.137598 12.2809 0.0741215C11.5485 0.0204105 11.3092 0.0204105 10.5963 0.0790043ZM12.9889 2.24209C13.9752 2.41787 14.6832 2.64736 15.5475 3.05752C19.1608 4.78604 21.2701 8.59951 20.8014 12.5741C20.3961 16.0604 18.0719 19.039 14.7955 20.2646C10.6744 21.8075 6.06994 20.3036 3.65295 16.622C2.9547 15.5575 2.49084 14.3563 2.23693 12.9647C2.11974 12.3153 2.11974 10.6845 2.23693 10.0351C2.42736 9.00479 2.6422 8.31631 3.05724 7.45205C4.45373 4.53213 7.19298 2.58389 10.4742 2.17861C10.9967 2.11025 12.4664 2.14932 12.9889 2.24209Z"
                                                    fill="white"
                                            />
                                            <path
                                                    d="M11.0113 4.33203C10.8892 4.40039 10.7281 4.54688 10.6451 4.65918L10.4986 4.86914L10.4839 8.26758C10.4742 10.7383 10.4839 11.7246 10.5279 11.8662C10.5718 12.0273 10.8697 12.3496 12.2466 13.7363C14.024 15.5186 14.1851 15.6504 14.6099 15.6504C15.3667 15.6504 15.8599 14.8789 15.5474 14.1855C15.4742 14.0244 15.0591 13.5752 13.9898 12.501L12.5249 11.0361L12.5152 7.95508L12.5005 4.87402L12.3687 4.68359C12.1539 4.38086 11.9292 4.25391 11.5533 4.23438C11.2847 4.21973 11.1919 4.23926 11.0113 4.33203Z"
                                                    fill="white"
                                            />
                                        </svg>
                                        <p class="cataloge-item-bottom-time__text"><?php echo $item['number_of_hours'] ?> часов</p>
                                    </div>
                                    <div
                                            class="cataloge-item-bottom__lesson cataloge-item-bottom-lesson"
                                    >
                                        <svg
                                                width="25"
                                                height="25"
                                                viewBox="0 0 25 25"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <g clip-path="url(#clip0_159_1103)">
                                                <path
                                                        d="M11.3291 0.053709C6.95414 0.502928 3.21879 3.0664 1.29985 6.93847C0.694377 8.15429 0.337932 9.27246 0.113323 10.6494C-0.0282789 11.5332 -0.0380445 13.3594 0.0889086 14.209C0.450237 16.5381 1.36821 18.6475 2.78422 20.3857C3.90239 21.7578 5.33793 22.9004 6.93461 23.6816C8.20414 24.3066 9.29301 24.6533 10.6455 24.8633C11.6221 25.0146 13.3311 25.0146 14.3077 24.8633C15.6651 24.6533 16.7588 24.3018 18.0235 23.6816C19.2979 23.0518 20.2354 22.3828 21.2803 21.3477C22.3057 20.3369 23.0381 19.3115 23.6875 17.9932C24.2979 16.748 24.6446 15.6348 24.8643 14.209C24.9913 13.3594 24.9815 11.5332 24.8399 10.6494C24.2637 7.08984 22.3301 4.05762 19.3907 2.09472C18.7461 1.66504 17.4864 1.02539 16.7686 0.761717C16.0899 0.512693 15.0694 0.253904 14.3223 0.1416C13.5704 0.029295 12.0079 -0.0195332 11.3291 0.053709ZM14.2344 2.23633C18.1504 2.93457 21.3829 5.81543 22.4668 9.58008C22.7842 10.6836 22.8526 11.2061 22.8477 12.5244C22.8428 13.8379 22.7793 14.3262 22.4668 15.4053C21.4903 18.7842 18.7608 21.5137 15.3819 22.4902C14.2881 22.8076 13.8194 22.8711 12.4766 22.8711C11.1338 22.8711 10.6651 22.8076 9.57133 22.4902C6.19242 21.5137 3.46293 18.7842 2.48637 15.4053C2.16899 14.3115 2.10551 13.8428 2.10551 12.5C2.10551 11.4893 2.12504 11.2158 2.21293 10.7422C2.61332 8.56445 3.59477 6.68457 5.12797 5.15137C6.80766 3.47168 8.92192 2.44629 11.3047 2.15332C11.9248 2.07519 13.5899 2.12402 14.2344 2.23633Z"
                                                        fill="white"
                                                />
                                                <path
                                                        d="M10.7725 8.18856C10.6846 8.23251 10.5674 8.33993 10.5186 8.41806C10.4307 8.56454 10.4258 8.75009 10.4258 12.5147C10.4258 16.0841 10.4355 16.4796 10.5039 16.6016C10.6895 16.9093 11.1045 16.9874 11.4268 16.7725C11.5244 16.7042 12.7549 15.8106 14.1611 14.795C16.2461 13.2813 16.7295 12.9054 16.7979 12.7638C16.8906 12.5733 16.8711 12.3438 16.749 12.1729C16.6611 12.046 11.4121 8.22274 11.2314 8.15438C11.0557 8.08602 10.9678 8.09579 10.7725 8.18856Z"
                                                        fill="white"
                                                />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_159_2333">
                                                    <rect width="25" height="25" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        <p class="cataloge-item-bottom-lesson__text">
                                            12 уроков
                                        </p>
                                    </div>
                                </div>
                                <div class="cataloge-item-bottom__price-author">
                                    <h3 class="cataloge-item-bottom__price"><?php echo $item['price'] ?> ₽</h3>
                                    <p class="cataloge-item-bottom__author">
                                        Автор курса: <?php echo $user['surname'] .' '.$user['name']?>
                                    </p>
                                </div>
                                <a
                                        href="one-item?id=<?php echo $item['id']?>"
                                        class="cataloge-item-bottom__button gradient__button"
                                >Подробнее</a
                                >
                            </div>
                        </div>
                    </div>
                    <?}
                ?>
          </div>
        </div>
      </main>
        <?php Page::part('footer');?>
    </div>
  </body>
</html>
