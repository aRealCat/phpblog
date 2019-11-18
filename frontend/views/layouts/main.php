<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('common', 'Blog'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $leftMenu = [
        ['label' => '首页', 'url' => ['/site/index']],
        ['label' => Yii::t('common','Article'), 'url' => ['/post/index']]
        // ['label' => Yii::t('common','contack'), 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $rightMenu[] = ['label' => Yii::t('common', 'Signup'), 'url' => ['/site/signup']];
        $rightMenu[] = ['label' => Yii::t('common','login'), 'url' => ['/site/login']];
    } else {
        $rightMenu[] = [
            'label' => '<img src="'.Yii::$app->params['avatar']['small'].'" alt="'.Yii::$app->user->identity->username.'">',
    
            'linkOptions' => ['class' => 'avatar'],
            'items'=> [
                [
                    'label' => '个人中心',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
                [
                    'label' => '<i class="fa fa-sign-out"></i>退出',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ]
            ]
            // 'linkOptions' => ['data-method' => 'post']
        ];
        // '<li>'
        //     .'<img src="/blog1.0/frontend/web/statics/images/avatar/small.png">'
        //     . Html::beginForm(['/site/logout'], 'post')
        //     . Html::submitButton(
        //         'Logout (' . Yii::$app->user->identity->username . ')',
        //         ['class' => 'btn btn-link logout']
        //     )
        //     . Html::endForm()
        //     . '</li>';
    };
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false, // 转码
        'items' => $leftMenu,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false, // 转码
        'items' => $rightMenu,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
