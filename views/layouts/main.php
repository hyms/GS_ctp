<?php
    use app\assets\AppAsset;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\helpers\Html;
    use yii\widgets\Breadcrumbs;

    /* @var $this \yii\web\View */
/* @var $content string */

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
            NavBar::begin([
                'brandLabel' => 'Grafica Singular',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse',
                ],
            ]);

            $items = [['label' => 'Home', 'url' => ['/site/index']]];
            if(Yii::$app->user->isGuest)
            {
                array_push($items,['label' => 'Login', 'url' => ['/site/login']]);
            }
            else
            {
                array_push($items,
                           ['label' => 'Admin', 'url' => ['/admin/index']],
                           ['label' => 'Diseño', 'url' => ['/diseno/index']],
                           ['label' => 'Venta', 'url' => ['/venta/index']],
                           ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']]
                );
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $items,
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-center">&copy; Grafica Singular <?= date('Y') ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
