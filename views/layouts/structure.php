<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use app\assets\AppAsset;
use app\models\category\Category;
use app\models\themes\Themes;
AppAsset::register($this);

$categories = Category::getItems();
$themes = Themes::findAll('1')[0];
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?= Html::csrfMetaTags() ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
              integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
              crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title><?= Html::encode($this->title) ?></title>

        <?php $this->head() ?>
    </head>
    <script>
        const getData = (str) => {
            let li = $('#livesearch').find($('li')).length;
            if (li > 0) {
                console.log(li);
                $('#livesearch').empty();
            }
            if (str === "" || str.length === 0) {
                document.getElementById('livesearch').innerHTML = "";
                return;
            } else if (str.length > 0) {
                $.ajax({
                    type: 'GET',
                    url: '/search/' + str.toLowerCase(),
                    data: str,
                    success: (requests) => {
                        requests = JSON.parse(requests);
                        requests.map(
                            (request) => {
                                console.log(request);
                                $('#livesearch').append('<li  class="list-group-item"> <a class="dropdown-item" href=' + '"/tags/' + request.id + '"' + '>' + request.name + '</a></li>');
                            }
                        );
                    }
                });
            }
        }
    </script>
    <body style="background-color: <?= $themes['site_color']?>;">
    <?php $this->beginBody() ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top justify-content-between"
         style="background-color: <?= $themes['navbar_color']?>;">
        <a class="navbar-brand" href="/">News.net</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         Меню
                    </a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        <li class="dropdown-item"><a href="/contact">Contact</a></li>
                        <li class="dropdown-item"><a href="/signup">Реєстрація</a></li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-submenu">
                            <a  class="dropdown-item" tabindex="-1" href="/categories">Категорії</a>
                            <ul class="dropdown-menu">
                               <? foreach ($categories as $category):?>
                                <li class="dropdown-item"><a href="/category/<?=$category['id']?>"><?=$category['name']?></a></li>
                                <?endforeach;?>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <form class="form-inline">
            <input id="search_window" class="form-control mr-sm-2" type="search" placeholder="Search"
                   aria-label="Search" onkeyup="getData(this.value)">
            <ul class="list-group" id="livesearch"></ul>
        </form>
        <?
        echo Nav::widget([
            'items' => [
                Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->user_name . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        ?>

    </nav>
    <!-- Content -->

    <?= $content ?>
    <!-- Footer -->
    <hr class="featurette-divider">
    <!-- FOOTER -->
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>&copy; 2017 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>