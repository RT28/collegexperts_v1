<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\sidenav\SideNav;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    echo SideNav::widget([
        'type' => SideNav::TYPE_DEFAULT,        
        'containerOptions' => [
            'class' => ['c-navbar']
        ],
        'items' => [
            [
                'url' => ['/site/index'],
                'label' => 'Home',
            ],
            [
                'url' => ['/site/employee-form'],
                'label' => 'Employee',
            ],
            [                
                'label' => 'University',
                'items' => [
                    ['label' => 'View', 'url' => ['/university/index']],
                    ['label' => 'Create', 'url' => ['/university/create']],
                ]
            ],
            [
                'label' => 'Country',
                'items' => [
                    ['label' => 'View', 'url' => ['/country/index']],
                    ['label' => 'Create', 'url' => ['/country/create']],
                ]
            ],
            [                
                'label' => 'State',
                'items' => [
                    ['label' => 'View', 'url' => ['/state/index']],
                    ['label' => 'Create', 'url' => ['/state/create']],
                ]
            ],
            [                
                'label' => 'City',
                'items' => [
                    ['label' => 'View', 'url' => ['/city/index']],
                    ['label' => 'Create', 'url' => ['/city/create']],
                ]
            ],
            [                
                'label' => 'Degree',
                'items' => [
                    ['label' => 'View', 'url' => ['/degree/index']],
                    ['label' => 'Create', 'url' => ['/degree/create']],
                ]
            ],
            [                
                'label' => 'Majors',
                'items' => [
                    ['label' => 'View', 'url' => ['/majors/index']],
                    ['label' => 'Create', 'url' => ['/majors/create']],
                ]
            ]            
        ],
    ]);

    NavBar::begin([
        'brandLabel' => 'GoToUniversity',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top navbar-container',
        ],
    ]);
    $menuItems = [        
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid content-container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid footer-container">
        <p class="pull-left">&copy; GoToUniversity <?= date('Y') ?></p>        
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
