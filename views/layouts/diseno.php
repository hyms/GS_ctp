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
        echo Nav::widget([
                             'options' => ['class' => 'navbar-nav navbar-right'],
                             'items' => [
                                 [
                                     'label'=>'Ordenes',
                                     'url'=>['/diseno/orden']
                                 ],
                                 [
                                     'label'=>'Internas',
                                     'url'=>['/diseno/interna']
                                 ],
                                 [
                                     'label'=>'Reposiciones',
                                     'url'=>['/diseno/reposicion']
                                 ],
                                 Yii::$app->user->isGuest ?
                                     ['label' => 'Login', 'url' => ['/site/login']] :
                                     ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                      'url' => ['/site/logout'],
                                      'linkOptions' => ['data-method' => 'post']],
                             ],
                         ]);
        NavBar::end();
    ?>

    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
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
        <p class="text-center">&copy; Grafica Singular <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
