<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Lista de Usuarios</strong>
    </div>
    <div class="panel-body">
        <?=
            Html::a('Nuevo Usuario', "#", [
                'class'=>'btn btn-default',
                'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '".Url::to(['admin/config','op'=>'user','frm'=>true])."',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<h3 class=\"text-center\">Nuevo Usuario</h3>');
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
                'header'=>'Nombre',
                'value'=>'nombre',
            ],
            [
                'header'=>'Apellido',
                'value'=>'apellido',
            ],
            [
                'header'=>'CI',
                'value'=>'CI',
            ],
            [
                'header'=>'Telefono',
                'value'=>'telefono',
            ],
            [
                'header'=>'Surcursal',
                'value'=>function($model){
                    return $model->fkIdSucursal->nombre;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update'=>function($url,$model) {
                        $options = array_merge([
                                                   //'class'=>'btn btn-success',
                                                   'data-original-title' => 'Añadir a Stock',
                                                   'data-toggle'         => 'tooltip',
                                                   'title'               => '',
                                                   'onclick'             => "
                                                        $.ajax({
                                                            type     :'POST',
                                                            cache    : false,
                                                            url  : '" . Url::to(['admin/config','op'=>'user','id'=>$model->idUser,'frm'=>true]) . "',
                                                            success  : function(data) {
                                                                if(data.length>0){
                                                                    $('#viewModal .modal-header').html('<h3 class=\"text-center\">Usuario ".$model->nombre.' '.$model->apellido."</h3>');
                                                                    $('#viewModal .modal-body').html(data);
                                                                    $('#viewModal').modal();
                                                                }
                                                            }
                                                        });return false;"
                                               ]);
                        return Html::a('<span class="glyphicon glyphicon-import"></span>', "#", $options);
                    },
                ]
            ],
        ];
        echo GridView::widget([
                                  'dataProvider'=> $usuarios,
                                  //'filterModel' => $search,
                                  'columns' => $columns,
                                  'responsive'=>true,
                                  'condensed'=>true,
                                  'hover'=>true,
                                  'bordered'=>false,
                              ]);
    ?>
</div>