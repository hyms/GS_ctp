<?php
    use app\models\Sucursal;
    use kartik\grid\GridView;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<?php
$columns = [
    [
        'header'=>'Sucursal',
        'attribute'=>'sucursal',
        //'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(Sucursal::find()->all(),'idSucursal','nombre'),
        //'filterWidgetOptions'=>[
        //    'pluginOptions'=>['allowClear'=>true],
        //],
        //'filterInputOptions'=>['placeholder'=>'Seleccionar'],
        'format'=>'raw',
        'value'=>function($model){
            return $model->fkIdCajaOrigen->fkIdSucursal->nombre;
        },
    ],
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
        'pageSummary'=>true,
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
        'class'=>'kartik\grid\ActionColumn',
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
                if(!empty($model->fechaCierre))
                    return "";
                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', "#", $options);
            },
        ]
    ],
];
echo GridView::widget([
    'dataProvider'=> $cajasChicas,
    'filterModel' => $search,
    'columns' => $columns,
    'showPageSummary' => true,
    'toolbar' =>  [
        [
            'content'=>
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
                ]),
            'options' => ['class' => 'btn-group']
        ],
        '{export}',
        '{toggleData}',
    ],
    // set export properties
    'export' => [
        'fontAwesome' => true,
        'target'=>GridView::TARGET_BLANK,
    ],
    'responsive'=>true,
    'hover'=>true,
    'bordered'=>false,
    'panel' => [
        'type' => GridView::TYPE_DEFAULT,
        'heading' => 'Caja Chica',
        'footer'=>false,
    ],
    'exportConfig' => [
        GridView::EXCEL => [
            'label' => 'Excel',
            'filename' => 'Reporte Caja Chica',
            'alertMsg' => 'El EXCEL se generara para la descarga.',
            'showPageSummary' => true,
        ],
        GridView::PDF => [
            'label' => 'PDF',
            'filename' => 'Reporte Caja Chica',
            'alertMsg' => 'El PDF se generara para la descarga.',
            'config' => [
                'format' => 'Letter-L',
                'marginTop' => 5,
                'marginBottom' => 5,
                'marginLeft' => 5,
                'marginRight' => 5,
            ]
        ],
    ],
]);
?>
