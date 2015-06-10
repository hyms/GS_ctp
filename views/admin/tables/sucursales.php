<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Sucursales</strong>
    </div>
    <div class="panel-body">
        <?=
            Html::a('Nueva Sucursal', "#", [
                'class'=>'btn btn-default',
                'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '".Url::to(['admin/config','op'=>'sucursal','frm'=>true])."',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<h3 class=\"text-center\">Nueva Sucursal</h3>');
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
            ['class' => 'yii\grid\SerialColumn'],
            [
                'header'=>'Nombre',
                'value'=>'nombre',
            ],
            [
                'header'=>'Descripcion',
                'value'=>'descripcion',
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
                                                            url  : '" . Url::to(['admin/config','op'=>'sucursal','id'=>$model->idSucursal,'frm'=>true]) . "',
                                                            success  : function(data) {
                                                                if(data.length>0){
                                                                    $('#viewModal .modal-header').html('<h3 class=\"text-center\">Sucursal ".$model->nombre ."</h3>');
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
                                  'dataProvider'=> $sucursales,
                                  //'filterModel' => $search,
                                  'columns' => $columns,
                                  'responsive'=>true,
                                  'condensed'=>true,
                                  'hover'=>true,
                                  'bordered'=>false,
                              ]);
    ?>
</div>