<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Arqueos Realizados</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php
        $columns = [
            [
                'header'=>'Usuario',
                'value'=>function($model){
                    return $model->fkIdUser->nombre." ".$model->fkIdUser->apellido;
                },
            ],
            [
                'header'=>'Monto',
                'value'=>'monto',
            ],
            [
                'header'=>'Fecha de Arqueo',
                'attribute'=>'time',
            ],
            [
                'header'=>'Correlativo',
                'attribute'=>'correlativoCierre',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{print} {registro}',
                'buttons'=>[
                    'print'=>function($url,$model){
                        $options = array_merge([
                            //'class'=>'btn btn-success',
                            'data-original-title'=>'Imprimir',
                            'data-toggle'=>'tooltip',
                            'title'=>''
                        ]);
                        $url = Url::to(['venta/print','op'=>'arqueo','id'=>$model->idMovimientoCaja]);
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                    },
                    'registro'=>function($url,$model){
                        $options = array_merge([
                            //'class'=>'btn btn-success',
                            'data-original-title'=>'Registro',
                            'data-toggle'=>'tooltip',
                            'title'=>''
                        ]);
                        $url = Url::to(['venta/print','op'=>'registro','id'=>$model->idMovimientoCaja]);
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', $url, $options);
                    },
                ]
            ],
        ];

        /*$columns=array(
            array(
                'header'=>'',
                'class'=>'booster.widgets.TbButtonColumn',
                'template'=>'{update} {print} {registro}',
                'buttons'=>array(
                    'update'=>
                        array(
                            'url'=>'#',
                            'label'=>'Modificar',
                            'visible'=>'false',
                        ),
                    'print'=>
                        array(
                            'url'=>'array("ctp/comprobante","id"=>$data->idArqueoCaja)',
                            'label'=>'imprimir',
                            'icon'=>'print',
                        ),
                    'registro'=>
                        array(
                            'url'=>'array("ctp/registroDiario","id"=>$data->idArqueoCaja)',
                            'label'=>'Registro Diario',
                            'icon'=>'list-alt',
                        ),
                ),
            ),
        */
        echo GridView::widget([
            'dataProvider'=> $arqueos,
            'filterModel' => $search,
            'columns' => $columns,
            'responsive'=>true,
            'condensed'=>true,
            'hover'=>true,
            'bordered'=>false,
        ]);
        ?>
    </div>
</div>
