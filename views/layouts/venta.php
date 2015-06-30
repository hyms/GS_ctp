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
        'brandLabel' => 'Grafica Singular '.((!empty(Yii::$app->user->identity->fk_idSucursal))?"(".Yii::$app->user->identity->fkIdSucursal->nombre.")":""),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default',
        ],
    ]);
        $items =[];
        array_push($items,[
            'label'=>'Orden',
            'url'=>['venta/orden']
        ]);
        array_push($items,[
            'label'=>'Caja',
            'url'=>['venta/caja']
        ]);
        if(Yii::$app->user->identity->role!=6) {
            array_push($items, [
                'label' => 'Reportes',
                'url'   => ['venta/report']
            ]);
        }
        array_push($items,[
            'label'=>'Cliente',
            'url'=>['venta/cliente']
        ]);
        array_push($items,
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
                                'label'=>'Cambiar Contraseña',
                                'url'=>['venta/user'],
                            ]
                        ]
                       ]
        );
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items
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
        <div class="col-xs-5">
            <?php
            $sucursales = \app\models\Sucursal::find()->where(['enable'=>true])->all();
            foreach($sucursales as $key => $item)
            {
                echo Html::a($item->nombre,'#',[
                    'data-original-title'=>$item->descripcion,
                    'data-toggle'=>'tooltip',
                    'title'=>''
                ]);
                if(($key + 1) < count($sucursales))
                    echo " - ";
            }
            ?>
        </div>
        <div class="col-xs-2 text-center">&copy; Grafica Singular <?= date('Y') ?></div>
    </div>
</footer>
<?php
$js = <<< 'SCRIPT'
/* To initialize BS3 tooltips set this below */
$(function () {
$("[data-toggle='tooltip']").tooltip();
});;
/* To initialize BS3 popovers set this below */
$(function () {
$("[data-toggle='popover']").popover();
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
