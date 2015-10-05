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
        'attribute'=>'fk_idSucursal',
        //'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(Sucursal::find()->all(),'idSucursal','nombre'),
        //'filterWidgetOptions'=>[
        //    'pluginOptions'=>['allowClear'=>true],
        //],
        //'filterInputOptions'=>['placeholder'=>'Seleccionar'],
        'format'=>'raw',
        'value'=>function($model){
            return $model->fkIdSucursal->nombre;
        },
    ],
    [
        'header'=>'Tipo',
        //'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>["Egreso","Ingreso"],
        //'filterWidgetOptions'=>[
        //    'pluginOptions'=>['allowClear'=>true],
        //],
        //'filterInputOptions'=>['placeholder'=>'Seleccionar'],
        'format'=>'raw',
        'value'=>function($model) {
            return (($model->tipoRecibo)?"Ingreso":"Egreso");
        },
        'attribute'=>'tipoRecibo',
    ],

    /*[
        'header'=>'Codigo',
        'attribute'=>'codigo',
    ],*/
    [
        'header'=>'Nombre',
        'attribute'=>'nombre',
    ],
    [
        'header'=>'Monto',
        'attribute'=>'monto',
        'pageSummary'=>true,
    ],
    [
        'header'=>'Detalle',
        'attribute'=>'detalle',
    ],
    [
        'header'=>'Fecha',
        'attribute'=>'fechaRegistro',
    ],
    [
        'class'=>'kartik\grid\ActionColumn',
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
                if(!empty($model->fkIdMovimientoCaja))
                    if(!empty($model->fkIdMovimientoCaja->fechaCierre))
                        return "";
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
    'showPageSummary' => true,
    'toolbar' =>  [
        [
            'content'=>
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
                ])
                ." ".
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
        'heading' => 'Recibos',
        'footer'=>false,
    ],
    'exportConfig' => [
        GridView::EXCEL => [
            'label' => 'Excel',
            'filename' => 'Reporte Recibos',
            'alertMsg' => 'El EXCEL se generara para la descarga.',
            'showPageSummary' => true,
        ],
        GridView::PDF => [
            'label' => 'PDF',
            'filename' => 'Reporte Recibos',
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
