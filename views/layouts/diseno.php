<?php
    use app\assets\AppAsset2;
    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;
    use yii\helpers\Html;

    /* @var $this \yii\web\View */
/* @var $content string */

AppAsset2::register($this);
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
        'brandLabel' => 'Grafica Singular '.((!empty(Yii::$app->user->identity->fk_idSucursal))?"(".Yii::$app->user->identity->fkIdSucursal->nombre.")":""),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default',
        ],
    ]);
    $sucursal = \app\models\Sucursal::findOne(Yii::$app->user->identity->fk_idSucursal);
    $items = [[
        'label'=>'Ordenes',
        'url'=>['/diseno/orden']
    ]];
    array_push($items,[
        'label'=>'Internas',
        'url'=>['/diseno/interna']
    ]);
    if(!empty($sucursal->sucursals))
    {
        array_push($items,[
            'label'=>'Suc. Dependientes',
            'url'=>['/diseno/dependientes']
        ]);
    }
    if(Yii::$app->user->identity->role==4 || Yii::$app->user->identity->role<=2) {
        array_push($items, [
            'label' => 'Reposiciones',
            'url' => ['/diseno/reposicion']
        ]);
    }
        array_push($items, [
            'label' => 'Clientes',
            'url' => ['/diseno/clientes']
        ]);
    array_push($items, Yii::$app->user->isGuest ?
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
                    'url'=>['diseno/user'],
                ]
            ]
        ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    NavBar::end();
    ?>

    <div class="container">
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
