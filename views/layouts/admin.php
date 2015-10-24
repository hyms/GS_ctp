<?php
use app\assets\AppAsset2;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

/* @var $this \yii\web\View */
    /* @var $content string */

    AppAsset2::register($this,true);

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">

        <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl."/favicon.png"?>" type="image/x-icon" />
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
            $items = [];

            array_push($items,[
                'label'=>'Reportes de Placas',
                'url'=>['admin/placas']
            ]);
            if(Yii::$app->user->identity->role==1) {
                array_push($items,[
                    'label'=>'Reportes de Caja',
                    'items'=>[
                        [
                            'label' => 'Reportes de Venta',
                            'url'=>['admin/report'],
                        ],
                        [
                            'label'=>'Reporte de Arqueos',
                            'url'=>['admin/arqueos']
                        ],
                        /*[
                            'label'=>'Caja',
                            'url'=>['admin/caja']
                        ]*/
                    ]
                ]);
                array_push($items,[
                    'label'=>'Producto',
                    'url'=>['admin/producto']
                ]);
                array_push($items, [
                    'label'=>'Clientes',
                    'url'=>['admin/cliente']
                ]);
                array_push($items,[
                    'label'=>'Configuracion',
                    'url'=>['admin/config']
                ]);
            }
            array_push($items, Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                ['label' => 'user('.Yii::$app->user->identity->username.')',
                 'items'=>[
                     [
                         'label' => 'Logout',
                         'url' => ['/site/logout'],
                         'linkOptions' => ['data-method' => 'post'],
                     ]
                 ]
                ]);
            echo Nav::widget([
                                 'options' => ['class' => 'navbar-nav navbar-right'],
                                 'items' => $items]);
            NavBar::end();
        ?>

        <div class="container">
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