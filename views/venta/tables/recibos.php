<?php
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$columns = [
    [
        'header'=>'Tipo',
        //'filterOptions'=>['class'=>'col-xs-1'],
        //'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>["Egreso","Ingreso"],
        /*'filterWidgetOptions'=>[
        'size' => Select2::SMALL,
            'pluginOptions'=>['allowClear'=>true],
        ],*/

        //'filterInputOptions'=>['placeholder'=>'Seleccionar'],
        //'format'=>'raw',
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
        'class' => 'yii\grid\ActionColumn',
        'template'=>'{update} {print}',
        'buttons'=>[
            'update'=>function($url,$model) {
                if(!empty($model->fkIdMovimientoCaja))
                    if(!empty($model->fkIdMovimientoCaja->fechaCierre))
                        return "";
                return Html::a(Html::icon('pencil') . ' Modificar',
                    "#",
                    [
                        'onclick'     => 'clickmodal("' .Url::to(['venta/recibos','op'=>'recibo','id'=>$model->idRecibo]) . '",".'.(($model->tipoRecibo)?"Ingreso":"Egreso").'")',
                        'data-toggle' => "modal",
                        'data-target' => "#modal"
                    ]);
            },
            'print'=>function($url,$model){
                $url = Url::to(['venta/print','op'=>'recibo','id'=>$model->idRecibo]);
                $options = array_merge([
                    //'class'=>'btn btn-success',
                    'data-toggle'=>'tooltip',
                    'data-target' => "#modalPage",
                    'title'=>'Imprimir',
                    'onClick'=>'printView("'.$url.'")'
                ]);
                return Html::a(Html::icon('print'), '#', $options);
            },
        ]
    ],
];

Pjax::begin(['id'=>'recibo']);
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::tag('strong','Recibos',['class'=>'panel-title']); ?>
        </div>
        <div class="panel-body">

            <?= Html::button('Recibo Ingreso',
                [
                    'class'=>'btn btn-default',
                    'onclick' => 'clickmodal("' . Url::to(['venta/recibos', 'op' => 'i']) . '","Caja Chica")',
                    'data-toggle' => "modal",
                    'data-target' => "#modal"
                ])
            ." ".
            Html::button('Recibo Egreso',
                [
                    'class'=>'btn btn-default',
                    'onclick' => 'clickmodal("' . Url::to(['venta/recibos', 'op' => 'e']) . '","Caja Chica")',
                    'data-toggle' => "modal",
                    'data-target' => "#modal"
                ]); ?>
            <?= ExportMenu::widget([
                'dataProvider' => $recibos,
                'columns' => $columns,
                'fontAwesome' => true,
                'hiddenColumns'=>[5], // SerialColumn, Color, & ActionColumn
                'noExportColumns'=>[5], // Status
                'dropdownOptions' => [
                    'label' => 'Exportar',
                    'class' => 'btn btn-default'
                ],
                'stream' => false, // this will automatically save the file to a folder on web server
                'streamAfterSave' => true, // this will stream the file to browser after its saved on the web folder
                'deleteAfterSave' => true, // this will delete the saved web file after it is streamed to browser,
                'target' => '_blank',
                'exportConfig' => [
                    ExportMenu::FORMAT_HTML =>false,
                    ExportMenu::FORMAT_CSV =>false,
                    ExportMenu::FORMAT_TEXT =>false,
                    ExportMenu::FORMAT_EXCEL =>false,

                    ExportMenu::FORMAT_EXCEL_X => [
                        'label' => 'Excel',
                        'filename' => 'Reporte Recibos',
                        'alertMsg' => 'El EXCEL se generara para la descarga.',
                        'showPageSummary' => true,
                    ],
                    ExportMenu::FORMAT_PDF => [
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
            ]); ?>
            <hr>
        </div>
        <?= GridView::widget([
            'dataProvider'=> $recibos,
            'filterModel' => $search,
            'columns' => $columns,
            'responsive'=>true,
            'hover'=>true,
            'bordered'=>false,
        ]);
        ?>
    </div>

<?php
Pjax::end();
echo $this->render('@app/views/share/scripts/modalPage');