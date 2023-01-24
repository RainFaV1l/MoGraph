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
                            Добавление урока
                        </h1>
                        <div class="main-header__figure landing-header__figure"></div>
                    </div>
                    <form
                        action="crud/addLesson?id=<?php echo $_GET['id'] ?>"
                        name="lesson-add"
                        method="post"
                        class="course-control__form standart__form"
                        enctype="multipart/form-data"
                    >
                        <div class="standart__row">
                            <input
                                    type="text"
                                    name="name"
                                    placeholder="Название урока"
                                    class="standart__input"
                                    value="<?php echo $_SESSION['name'] ?? ''; unset($_SESSION['name']);?>"
                            />
                            <input type="file" name="img" class="standart__input">
                        </div>

                        <textarea
                            name="description"
                            placeholder="Описание"
                            class="standart__input"
                        ><?php echo $_SESSION['description'] ?? ''; unset($_SESSION['description']);?></textarea>

                        <input
                            type="submit"
                            name="lesson-add"
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