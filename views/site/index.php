<?php
use yii\bootstrap\Carousel;
use yii\helpers\Html;

/* @var $this yii\web\View */
    $this->title = 'Grafica Singular';
?>
<div class="row">
    <div class="row">
        <div class="text-center"><?= Html::img(Yii::$app->request->baseUrl."/images/logoSingular.png")?></div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="page-header">
                <h2>CTP</h2>
            </div>
            <?=
                Carousel::widget([
                        'items' => [
                            '<div class="text-center">'.Html::img(Yii::$app->request->baseUrl.'/images/CTP1.jpeg',['style'=>'with:410px; height: 310px']).'</div>',
                            '<div class="text-center">'.Html::img(Yii::$app->request->baseUrl.'/images/CTP2.jpeg',['style'=>'with:410px; height: 310px']).'</div>',
                            '<div class="text-center">'.Html::img(Yii::$app->request->baseUrl.'/images/CTP3.jpeg',['style'=>'with:410px; height: 310px']).'</div>',
                        ],
                ]);
            ?>
        </div>
        <div class="col-xs-6">
            <div class="page-header">
                <h2>Imprenta</h2>
            </div>
            <?=
                Carousel::widget([
                                     'items' => [
                                         '<div class="text-center">'.Html::img(Yii::$app->request->baseUrl.'/images/Imprenta1.jpeg',['style'=>'with:410px; height: 310px']).'</div>',
                                         '<div class="text-center">'.Html::img(Yii::$app->request->baseUrl.'/images/Imprenta2.jpeg',['style'=>'with:410px; height: 310px']).'</div>',
                                         '<div class="text-center">'.Html::img(Yii::$app->request->baseUrl.'/images/Imprenta3.jpeg',['style'=>'with:410px; height: 310px']).'</div>',
                                     ],
                                 ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="page-header">
            <h2>Ubiquenos</h2>
        </div>
        <?php
        $sucursales = \app\models\Sucursal::find()->all();
        $items = [];
        foreach($sucursales as $key => $item)
        {
            echo '<dl class="dl-horizontal">';
            echo '<dt class="text-capitalize">'.$item->nombre.'</dt>';
            echo '<dd class="text-capitalize">'.$item->descripcion.'</dd>';
            echo '</dl>';
        }
        ?>
    </div>
</div>
