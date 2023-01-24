<?php use App\Services\Page;
use App\Services\Router;

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
            <div class="course-control">
                <?php
                if(isset($_SESSION['validator_error'])) {?>
                    <div class="message__error">
                        <?php
                        echo $_SESSION['validator_error'];
                        unset($_SESSION['validator_error']);
                        ?>
                    </div>
                <?php } ?>
                <div class="course-control__container">
                    <div class="header-title-row">
                        <h1 class="main-header__title header-title">
                            Добавление курса
                        </h1>
                        <div class="main-header__figure landing-header__figure"></div>
                    </div>
                    <form
                        action="crud/addCourse"
                        name="course-add"
                        method="post"
                        class="course-control__form standart__form"
                        enctype="multipart/form-data"
                    >
                        <input
                            type="text"
                            name="name"
                            placeholder="Название курса"
                            class="standart__input"
                            value="<?php echo $_SESSION['name'] ?? ''; unset($_SESSION['name']);?>"
                        />
                        <input
                            type="text"
                            name="price"
                            placeholder="Цена"
                            class="standart__input"
                            value="<?php echo $_SESSION['price'] ?? ''; unset($_SESSION['price']);?>"
                        />
                        <input
                            type="number"
                            name="time"
                            placeholder="Кол-во часов"
                            class="standart__input"
                            value="<?php echo $_SESSION['time'] ?? ''; unset($_SESSION['time']);?>"
                        />
                        <textarea
                            name="description"
                            placeholder="Описание"
                            class="standart__input"
                        ><?php echo $_SESSION['description'] ?? ''; unset($_SESSION['description']);?></textarea>
                        <input type="file" name="img" class="standart__input">
                        <select name="category" class="standart__input">
                            <?php
                                $categories = R::findAll('courses_category');
                                foreach ($categories as $category) {?>
                                    <option value="<?=$category['id']?>"><?=$category['name']?></option>
                                <?php }
                            ?>
                        </select>
                        <input
                            type="submit"
                            name="course-add"
                            class="standart__submit"
                            value="Добавить"
                        />
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php Page::part('footer');?>
</div>
</body>
</html>
