<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Recibos</strong>
    </div>
    <div class="panel-body">
        <?=
            Html::a('Recibo Ingreso', "#", [
                'class'=>'btn btn-default',
                'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '" . Url::to(['venta/recibos', 'op' => 'i']) . "',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<h3 class=\"text-center\">Ingreso</h3>');
                                $('#viewModal .modal-body').html(data);
                                $('#viewModal').modal();
                            }
                        }
                    });return false;"
            ]);
        ?>
        <?=
            Html::a('Recibo Egreso', "#", [
                'class'=>'btn btn-default',
                'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '" . Url::to(['venta/recibos', 'op' => 'e']) . "',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<h3 class=\"text-center\">Egreso</h3>');
                                $('#viewModal .modal-body').html(data);
                                $('#viewModal').modal();
                            }
                        }
                    });return false;"
            ]);
        ?>
    </div>
    <?php
        $columns = [
            [
                'header'=>'Tipo',
                'attribute'=>function($model){
                    return (($model->tipoRecibo)?"Egreso":"Ingreso");
                },
            ],
            [
                'header'=>'Codigo',
                'attribute'=>'codigo',
            ],
            [
                'header'=>'Nombre',
                'attribute'=>'nombre',
            ],
            [
                'header'=>'Monto',
                'attribute'=>'monto',
            ],
            [
                'header'=>'Fecha',
                'attribute'=>'fechaRegistro',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {print}',
                'buttons'=>[
                    'update'=>function($url,$model) {
                        $options = array_merge([
                                                   //'class'=>'btn btn-success',
                                                   'data-original-title' => 'Modificar',
                                                   'data-toggle'         => 'tooltip',
                                                   'title'               => '',
                                                   'onclick'             => "
                                                        $.ajax({
                                                            type     :'POST',
                                                            cache    : false,
                                                            url  : '" . Url::to(['venta/recibos','op'=>'recibo','id'=>$model->idRecibo]) . "',
                                                            success  : function(data) {
                                                                if(data.length>0){
                                                                    $('#viewModal .modal-header').html('<h3 class=\"text-center\">".(($model->tipoRecibo)?'Egreso':'Ingreso')."</h3>');
                                                                    $('#viewModal .modal-body').html(data);
                                                                    $('#viewModal').modal();
                                                                }
                                                            }
                                                        });return false;"
                                               ]);
                        $url     = "#";
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                    'print'=>function($url,$model){
                        $options = array_merge([
                                                   //'class'=>'btn btn-success',
                                                   'data-original-title'=>'Imprimir',
                                                   'data-toggle'=>'tooltip',
                                                   'title'=>''
                                               ]);
                        $url = Url::to(['venta/print','op'=>'recibo','id'=>$model->idRecibo]);
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', $url, $options);
                    },
                ]
            ],
        ];

        echo GridView::widget([
                                  'dataProvider'=> $recibos,
                                  'filterModel' => $search,
                                  'columns' => $columns,
                                  'responsive'=>true,
                                  'condensed'=>true,
                                  'hover'=>true,
                                  'bordered'=>false,
                              ]);
    ?>
</div>