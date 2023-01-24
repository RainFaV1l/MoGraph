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
    <div class="wrapper lesson__wrapper">
      <div class="header__main">
          <?php Page::part('header');?>
      </div>
      <main class="main">
        <div class="main__container container">
          <div class="users">
            <div class="users__container">
              <div class="header-title-row">
                <h1 class="main-header__title header-title">Пользователи</h1>
                <div class="main-header__figure landing-header__figure"></div>
                <div class="users__search-form users-search-form">
                  <form
                    name="search"
                    method="post"
                    class="users-search-form__form standart__form"
                  >
                    <input
                      type="text"
                      name="name"
                      class="standart__input"
                      placeholder="Имя"
                    />
                    <input
                      type="text"
                      name="surname"
                      class="standart__input"
                      placeholder="Фамилия"
                    />
                    <input
                      type="text"
                      name="patronymic"
                      class="standart__input"
                      placeholder="Отчество"
                    />
                    <select name="role" class="standart__input">
                      <option value="1">Пользователь</option>
                      <option value="2">Сотрудник</option>
                      <option value="3">Админ</option>
                    </select>
                    <select name="course" class="standart__input">
                      <option value="1">124</option>
                      <option value="2">224</option>
                      <option value="3">324</option>
                      <option value="4">424</option>
                    </select>
                    <input
                      type="submit"
                      name="course"
                      class="standart__submit"
                      value="Поиск"
                    />
                  </form>
                </div>
              </div>
              <div class="table">
                <table class="users__table users-table">
                  <tr class="users-table__row users-table-row header__row">
                    <th class="users-table-row__el users-table-row__header-el">id</th>
                    <th class="users-table-row__el users-table-row__header-el">Имя</th>
                    <th class="users-table-row__el users-table-row__header-el">Фамилия</th>
                    <th class="users-table-row__el users-table-row__header-el">Отчество</th>
                    <th class="users-table-row__el users-table-row__header-el">Email</th>
                    <th class="users-table-row__el users-table-row__header-el">Пароль</th>
                    <th class="users-table-row__el users-table-row__header-el">Роль</th>
                    <th class="users-table-row__el users-table-row__header-el">Курсы</th>
                    <th class="users-table-row__el users-table-row__header-el">Изменение</th>
                  </tr>
                  <tr class="users-table__row">
                    <td class="users-table-row__el">1</td>
                    <td class="users-table-row__el">Эмиль</td>
                    <td class="users-table-row__el">Зарипов</td>
                    <td class="users-table-row__el">Ильгизович</td>
                    <td class="users-table-row__el">zare@mail.ru</td>
                    <td class="users-table-row__el">$rhEqrt13</td>
                    <td class="users-table-row__el">Админ</td>
                    <td class="users-table-row__el">Основы моушн дизайна</td>
                    <td
                      class="users-table-row__el users-table-row__control users-table-row-control"
                    >
                      <div class="users-table-row-control__item">
                        <svg
                          width="40"
                          height="40"
                          viewBox="0 0 40 40"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <circle cx="20" cy="20" r="19.5" stroke="white" />
                          <path
                            d="M13.8253 12.3132C13.4078 11.8956 12.7307 11.8956 12.3132 12.3132C11.8956 12.7308 11.8956 13.4078 12.3132 13.8253L18.4878 20L12.3132 26.1747C11.8957 26.5922 11.8957 27.2692 12.3132 27.6868C12.7308 28.1044 13.4078 28.1044 13.8254 27.6868L20 21.5122L26.1746 27.6868C26.5922 28.1044 27.2692 28.1044 27.6868 27.6868C28.1043 27.2692 28.1043 26.5922 27.6868 26.1747L21.5122 20L27.6868 13.8253C28.1044 13.4078 28.1044 12.7308 27.6868 12.3132C27.2693 11.8956 26.5922 11.8956 26.1747 12.3132L20 18.4879L13.8253 12.3132Z"
                            fill="white"
                          />
                        </svg>
                      </div>
                      <div class="users-table-row-control__item">
                        <svg
                          width="40"
                          height="40"
                          viewBox="0 0 40 40"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <circle
                            cx="20"
                            cy="20"
                            r="20"
                            fill="url(#paint0_linear_112_1494)"
                          />
                          <g clip-path="url(#clip0_112_1494)">
                            <path
                              d="M11.4883 18.0702C10.6445 18.2967 10 19.1288 10 19.9998C10 20.6913 10.4414 21.4295 11.0508 21.7538C11.832 22.1678 12.7734 22.0311 13.3906 21.4139C13.7969 21.0077 13.9844 20.5584 13.9844 19.9998C13.9844 19.4413 13.7969 18.992 13.3906 18.5858C12.9023 18.0975 12.1484 17.8905 11.4883 18.0702Z"
                              fill="white"
                            />
                            <path
                              d="M19.5037 18.0664C18.8045 18.2539 18.2498 18.8203 18.0662 19.5195C17.7966 20.5586 18.4568 21.6562 19.5193 21.9336C20.5584 22.2031 21.656 21.543 21.9334 20.4805C22.2029 19.4414 21.5427 18.3437 20.4802 18.0664C20.2029 17.9922 19.7732 17.9961 19.5037 18.0664Z"
                              fill="white"
                            />
                            <path
                              d="M27.5198 18.0625C26.8519 18.2304 26.2464 18.8242 26.0745 19.4804C25.8948 20.1757 26.0941 20.8984 26.6097 21.414C27.5628 22.3672 29.1761 22.0976 29.7738 20.8906C30.0784 20.2773 30.0784 19.7226 29.7738 19.1093C29.3675 18.2851 28.4105 17.8398 27.5198 18.0625Z"
                              fill="white"
                            />
                          </g>
                          <defs>
                            <linearGradient
                              id="paint0_linear_112_1494"
                              x1="4.35384e-08"
                              y1="44.0741"
                              x2="42.9316"
                              y2="40.2891"
                              gradientUnits="userSpaceOnUse"
                            >
                              <stop stop-color="#1153FC" offset=""/>
                              <stop offset="1" stop-color="#9600FF" />
                            </linearGradient>
                            <clipPath id="clip0_112_1494">
                              <rect
                                width="20"
                                height="20"
                                fill="white"
                                transform="translate(10 10)"
                              />
                            </clipPath>
                          </defs>
                        </svg>
                      </div>
                    </td>
                </table>
              </div>
            </div>
          </div>
        </div>
      </main>
        <?php Page::part('footer');?>
    </div>
  </body>
</html>
