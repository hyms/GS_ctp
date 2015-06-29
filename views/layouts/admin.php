<?php
    use app\assets\AppAsset2;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\helpers\Html;
    use yii\widgets\Breadcrumbs;

    /* @var $this \yii\web\View */
/* @var $content string */

AppAsset2::register($this,true);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl."/favicon.ico"?>" type="image/x-icon" />
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
            'class' => 'navbar navbar-default',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label'=>'Reportes de Placas',
                'url'=>['admin/placas']
            ],
            [
                'label'=>'Reportes de Caja',
                'items'=>[
                    [
                        'label' => 'Reportes de Venta',
                        'url'=>['admin/report'],
                    ],
                    [
                        'label'=>'Reporte de Arqueos',
                        'url'=>['admin/arqueos']
                    ]
                ]
            ],
            [
                'label'=>'Producto',
                'url'=>['admin/producto']
            ],
            [
                'label'=>'Clientes',
                'url'=>['admin/cliente']
            ],
            [
                'label'=>'Configuracion',
                'url'=>['admin/config']
            ],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                ['label' => 'user('.Yii::$app->user->identity->username.')',
                    'items'=>[
                        [
                            'label' => 'Logout',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post'],
                        ],
                        [
                            'label'=>'Cambiar Contraseña'
                        ]
                    ]
                ],
        ],
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
