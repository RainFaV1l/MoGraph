"use strict";

// Parallax анимация для блока start
const parallax = () => {
  const start = document.querySelector(".start");

  if (!start) {
    return false;
  }

  const img = start.querySelector(".start-content-column-img");

  // Коэффициенты
  const forContent = 40;
  const forImg = 20;

  // Скорочть анимации
  const speed = 0.05;

  // Объявление переменных
  let positionX = 0,
    positionY = 0;
  let coordXprocent = 0,
    coordYprocent = 0;

  let setMouseParallaxStyle = () => {
    const distX = coordXprocent - positionX;
    const distY = coordYprocent - positionY;

    positionX = positionX + distX * speed;
    positionY = positionY + distY * speed;

    // Передаем стили
    img.style.cssText = `transform: translate(${positionX / forImg}%,${
      positionY / forImg
    }%);`;

    requestAnimationFrame(setMouseParallaxStyle);

    start.addEventListener("mousemove", (e) => {
      // Получение ширины и высоты блока
      const parallaxWidth = start.offsetWidth;
      const parallaxHeight = start.offsetHeight;

      // Ноль по середине
      const coordX = e.pageX - parallaxWidth / 2;
      const coordY = e.pageY - parallaxHeight / 2;

      // Получаем проценты
      coordXprocent = (coordX / parallaxWidth) * 100;
      coordYprocent = (coordY / parallaxHeight) * 100;
    });
  };

  setMouseParallaxStyle();
};

// Модальное окно
const modal = (modalClass, closeClass, openClass) => {
  const modal = document.querySelector(modalClass);
  if (!modal) return false;
  const close = modal.querySelector(closeClass);
  if (!close) return false;
  const open = document.querySelector(openClass);
  if (!open) return false;

  const closeModal = () => {
    modal.classList.remove("modal-feedback_active");
  };

  const addModal = () => {
    modal.classList.add("modal-feedback_active");
  };

  open.addEventListener("click", (e) => {
    e.preventDefault();
    addModal();
  });

  close.addEventListener("click", (e) => {
    e.preventDefault();
    closeModal();
  });

  document.addEventListener("keydown", (e) => {
    if (e.which === 27) {
      closeModal();
    }
  });

  const deleteItem = document.querySelector('.delete-item');
  if(!deleteItem) return false;
  const id = open.dataset.id;
  deleteItem.href="/my-courses?id="+ id +"&del";
};

// header скролл
const headerScroll = () => {
  const header = document.querySelector(".header__relative");

  if (header) {
    let prevScrollpos = window.pageYOffset;
    window.addEventListener("scroll", () => {
      let currentScrollPos = window.pageYOffset;
      if (prevScrollpos > currentScrollPos) {
        header.style.top = "0";
      } else {
        let headerHeight = header.offsetHeight;
        header.style.top = "-" + headerHeight + "px";
      }
      prevScrollpos = currentScrollPos;
    });
  }

  const scrollChangeHeader = () => {
    window.addEventListener("scroll", () => {
      if (window.scrollY > 0) {
        header.classList.add("header__change");
      } else {
        header.classList.remove("header__change");
      }
    });
  };

  scrollChangeHeader();
};

// swiper каталога
const startCatalogeSwiper = (swiper, slides) => {
  const swiperCheck = document.querySelector(swiper);
  if (swiperCheck) {
    const swiper = new Swiper(".swiper.start-cataloge__slider", {
      // Optional parameters
      direction: "horizontal",
      loop: true,

      // If we need pagination
      pagination: {
        el: ".swiper-pagination",
      },

      // Navigation arrows
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },

      // And if we need scrollbar
      scrollbar: {
        el: ".swiper-scrollbar",
      },
      effect: "slide",
      autoplay: {
        delay: 3000,
        pauseOnMouseEnter: true,
      },
      freeMode: false,
      breakpoints: {
        1920: {
          spaceBetween: 55,
          slidesPerView: 3,
          slidesPerGroup: 3,
        },
        850: {
          spaceBetween: 55,
          slidesPerView: 2,
          slidesPerGroup: 2,
        },
      },
    });
  }
};

// бургер меню
const humburger = () => {
  const header = document.querySelector(".start__header");

  if (!header) return false;
  const open = header.querySelector(".menu__btn");
  if (!open) return false;
  const menu = document.querySelector(".mobile-menu-div");

  open.addEventListener("click", () => {
    open.classList.toggle("active");
    menu.classList.toggle("active");
    header.classList.toggle("active");
  });
};

// аккордион
const accordion = (accordionClass, accordionItemClass, accordionIconClass) => {
  const accordion = document.querySelector(accordionClass);
  if (!accordion) return false;
  const accordionItem = accordion.querySelectorAll(accordionItemClass);
  accordionItem.forEach((element) => {
    element.addEventListener("click", () => {
      const accordionIcon = element.querySelector(accordionIconClass);
      element.classList.toggle("active");
      accordionIcon.classList.toggle("active");
    });
  });
};

// Маска ввода для телефона
const telMask = () => {
  window.addEventListener("DOMContentLoaded", function () {
    [].forEach.call(document.querySelectorAll(".tel"), function (input) {
      let keyCode;
      function mask(event) {
        event.keyCode && (keyCode = event.keyCode);
        let pos = this.selectionStart;
        if (pos < 3) event.preventDefault();
        let matrix = "+7 (___) ___ ____",
          i = 0,
          def = matrix.replace(/\D/g, ""),
          val = this.value.replace(/\D/g, ""),
          new_value = matrix.replace(/[_\d]/g, function (a) {
            return i < val.length ? val.charAt(i++) || def.charAt(i) : a;
          });
        i = new_value.indexOf("_");
        if (i != -1) {
          i < 5 && (i = 3);
          new_value = new_value.slice(0, i);
        }
        let reg = matrix
          .substr(0, this.value.length)
          .replace(/_+/g, function (a) {
            return "\\d{1," + a.length + "}";
          })
          .replace(/[+()]/g, "\\$&");
        reg = new RegExp("^" + reg + "$");
        if (
          !reg.test(this.value) ||
          this.value.length < 5 ||
          (keyCode > 47 && keyCode < 58)
        )
          this.value = new_value;
        if (event.type == "blur" && this.value.length < 5) this.value = "";
      }
      input.addEventListener("input", mask, false);
      input.addEventListener("focus", mask, false);
      input.addEventListener("blur", mask, false);
      input.addEventListener("keydown", mask, false);
    });
  });
};

// Форма обратной связи

const getData = () => {
  const formLog = document.querySelector('.modal-feedback__form');
  if(!formLog) return false;
  const inputsLog = formLog.querySelectorAll('input');
  const textLog = formLog.querySelector('textarea');
  const buttonLog = formLog.querySelector('button');
  const labelLog = formLog.querySelectorAll('label');

  const errorLog = document.querySelector('.error-log');

  let isSentLog = false;

  const loginFormData = () => {
    const logFormData = new FormData();

    logFormData.append(inputsLog[0].name, inputsLog[0].value);
    logFormData.append(textLog.name, textLog.value);

    return logFormData;
  }

  async function sendServer(url) {
    const responseLogServ = await fetch(url, {
      method: 'POST',
      body: loginFormData()
    });
    const dataLog = await responseLogServ.json();
    return dataLog;
  }

  formLog.addEventListener('submit', async (event) => {
    event.preventDefault();
    if (isSentLog) return
    isSentLog = true;
    buttonLog.textContent = 'Отправка'
    const responseLog = await sendServer('../app/Controllers/Send_message.php');

    if (responseLog.type === 'error') {
      errorLog.textContent = responseLog.body;
      errorLog.classList.add('active');
    } else {
      if (responseLog.type === 'success') {

        errorLog.textContent = responseLog.body

        errorLog.classList.add('active');
        errorLog.classList.add('success');

        inputsLog.forEach(el => {
          el.value = "";
        })

        labelLog.forEach(el => {
          el.classList.remove('active');
        })
      }
    }
    isSentLog = false;
    buttonLog.textContent = 'Отправлено';
  })
}

// Инициализация функций js
const init = () => {
  parallax();
  headerScroll();
  startCatalogeSwiper(".start-cataloge__slider", 3);
  modal(".modal-feedback", ".modal-feedback__close", ".feedback");
  modal(".modal-feedback", ".modal-feedback__close", ".openDeleteModal");
  humburger();
  accordion(
    ".one-course__accordion",
    ".one-item-accordion-item",
    ".one-item-accordion-item__icon"
  );
  telMask();
  getData();
};

document.addEventListener("DOMContentLoaded", init);
