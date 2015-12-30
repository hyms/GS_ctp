<?php
use yii\bootstrap\Carousel;
use yii\bootstrap\Modal;
use yii\helpers\Html;

?>

    <div class="row">
        <div class="row">
            <div class="text-center">
                <?= Html::img(Yii::$app->request->baseUrl . "/images/logoSingularN.png") ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="page-header">
                    <h2>Pre Prensa CTP</h2>
                </div>
                <?=
                Carousel::widget([
                    'items' => [
                        '<div class="text-center">' . Html::img(Yii::$app->request->baseUrl . '/images/CTP1.jpeg', ['style' => 'with:410px; height: 310px']) . '</div>',
                        '<div class="text-center">' . Html::img(Yii::$app->request->baseUrl . '/images/CTP2.jpeg', ['style' => 'with:410px; height: 310px']) . '</div>',
                        '<div class="text-center">' . Html::img(Yii::$app->request->baseUrl . '/images/CTP3.jpeg', ['style' => 'with:410px; height: 310px']) . '</div>',
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-6">
                <div class="page-header">
                    <h2>Imprenta</h2>
                </div>
                <?=
                Carousel::widget([
                    'items' => [
                        '<div class="text-center">' . Html::img(Yii::$app->request->baseUrl . '/images/Imprenta1.jpeg', ['style' => 'with:410px; height: 310px']) . '</div>',
                        '<div class="text-center">' . Html::img(Yii::$app->request->baseUrl . '/images/Imprenta2.jpeg', ['style' => 'with:410px; height: 310px']) . '</div>',
                        '<div class="text-center">' . Html::img(Yii::$app->request->baseUrl . '/images/Imprenta3.jpeg', ['style' => 'with:410px; height: 310px']) . '</div>',
                    ],
                ]);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="page-header">
                    <h2>Ubiquenos</h2>
                </div>
                <?php
                $sucursales = \app\models\Sucursal::find()->all();
                $items      = [];
                foreach ($sucursales as $key => $item) {
                    echo Html::tag('dl',
                        Html::tag('dt',$item->nombre,['class'=>'text-capitalize']).
                        Html::tag('dd',
                            $item->descripcion. ' - ' . Html::a('Ver Mapa', "#", [
                                'onclick' => "setModal('" . $item->nombre . "','" . $item->gmap . "'); return false;"
                            ])
                            ,['class'=>'text-capitalize']),
                        ['class'=>'dl-horizontal']);
                }
                ?>
            </div>
        </div>
    </div>

<?php
Modal::begin([
    'id'     => 'viewModal',
    'footer' =>
        Html::a(
            'Cerrar',
            "#",
            [
                'data-dismiss' => 'modal',
                'class'        => 'btn btn-default'
            ]
        ),
]);
Modal::end();

$script = <<<JS
    function setModal(nombre,gmap)
    {
    data="";
    $('#viewModal .modal-header').html('<h3 class="text-center">'+nombre+'</h3>');
    $('#viewModal .modal-body').html('<div class="row"><iframe class="col-xs-12" height="400px" src="'+gmap+'"></iframe></div>');
    $('#viewModal').modal();
    }
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);