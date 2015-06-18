<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<?=
    Html::a('Nueva Transaccion', "#", [
        'class'=>'btn btn-default',
        'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '".Url::to(['venta/chica','op'=>'new'])."',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<h3 class=\"text-center\">Caja Chica</h3>');
                                $('#viewModal .modal-body').html(data);
                                $('#viewModal').modal();
                            }
                        }
                    });return false;"
    ]);
?>
<?php
    $columns = [
        [
            'header'=>'Usuario',
            'attribute'=>function($model)
            {
                return $model->fkIdUser->username;
            }
        ],
        [
            'header'=>'Nombre',
            'attribute'=>'nombreUsuario',
            'value'=>function($model)
            {
                return $model->fkIdUser->nombre." ".$model->fkIdUser->apellido;
            }
        ],
        [
            'header'=>'Monto',
            'attribute'=>'monto',
        ],
        [
            'header'=>'Detalle',
            'attribute'=>'observaciones',
        ],
        [
            'header'=>'Fecha',
            'attribute'=>'time',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update}',
            'buttons'=>[
                'update'=>function($url,$model){
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title'=>'Modificar',
                                               'data-toggle'=>'tooltip',
                                               'title'=>'',
                                               'onclick'             => "
                                                        $.ajax({
                                                            type     :'POST',
                                                            cache    : false,
                                                            url  : '" . Url::to(['venta/chica','id'=>$model->idMovimientoCaja,'op'=>'mod']) . "',
                                                            success  : function(data) {
                                                                if(data.length>0){
                                                                    $('#viewModal .modal-header').html('<h3 class=\"text-center\">Caja Chica</h3>');
                                                                    $('#viewModal .modal-body').html(data);
                                                                    $('#viewModal').modal();
                                                                }
                                                            }
                                                        });return false;"
                                           ]);
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', "#", $options);
                },
            ]
        ],
    ];
    echo GridView::widget([
                              'dataProvider'=> $cajasChicas,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'toolbar' =>  [
                                  '{export}',
                                  '{toggleData}',
                              ],
                              // set export properties
                              'export' => [
                                  'fontAwesome' => true
                              ],
                              'responsive'=>true,
                              'hover'=>true,
                              'bordered'=>false,
                              'panel' => [
                                  'type' => GridView::TYPE_DEFAULT,
                                  'heading' => 'Caja Chica',
                              ],
                              'exportConfig' => [
                                  GridView::EXCEL => [
                                      'label' => 'Excel',
                                      'filename' => 'Caja Chica',
                                      'alertMsg' => 'El EXCEL se generara para la descarga.',
                                  ],
                                  GridView::PDF => [
                                      'label' => 'PDF',
                                      'filename' => 'Caja Chica',
                                      'alertMsg' => 'El PDF se generara para la descarga.',
                                  ],
                              ],
                          ]);
?>
