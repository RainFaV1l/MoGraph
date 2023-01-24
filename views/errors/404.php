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
        <div class="error404">
            <div class="error404__container container">
                <h1 class="not-found-error-title">Ошибка 404. Страница не найдена.</h1>
            </div>
        </div>
    </main>
    <?php Page::part('footer');?>
</div>
</body>
</html>