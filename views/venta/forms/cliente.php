<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$columns = [
    [
        'header'=>'Nit/Ci',
        'attribute'=>'nitCi',
    ],
    [
        'header' => 'Negocio',
        'attribute'=>'nombreNegocio',
    ],
    [
        'header' => 'Dueño',
        'attribute'=>'nombreCompleto',
    ],
    [
        'header' => 'Responsable',
        'attribute'=>'nombreResponsable',
    ],
    [
        'header'=>'',
        'format' => 'raw',
        'value'=> function ($model) {
            //return Html::a("<i class=\"glyphicon glyphicon-pencil\"></i>",["orden/modificar","id"=>$model->idOrdenCtp],['data-original-title'=>'Modificar','data-toggle'=>'tooltip']);
            return Html::a('<i class="glyphicon glyphicon-plus"></i>','#',
                [
                    //'onclick'=>'newRow('.$model->idProductoStock.',"'. Url::toRoute('add_detalle').'","cliente");return false;',
                    'class'=>'btn btn-success',
                    'data-original-title'=>'Aceptar',
                    'data-toggle'=>'tooltip',
                    'title'=>''
                ]
            );
        },
    ]
];
/*
        array(
            'header'=>'',
            'type'=>'raw',
            'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-ok\"></span> Añadir","#",
array("onClick"=>"clienteCosto(\"".CHtml::normalizeUrl(array("ctp/ajaxFactura"))."\",'.$idServicioVenta.',".$data->fk_idTipoCliente.",\"".$data->nombreNegocio."\",\"".$data->nitCi."\",".$data->idCliente.");return false;"
,"class"=>"btn btn-success btn-xs"))',
        )
    );
    $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$clientes->search(),'filter'=>$clientes));
*/
echo GridView::widget([
    'dataProvider'=> $cliente,
    'filterModel' => $search,
    'columns' => $columns,
    'responsive'=>true,
    'hover'=>true
]);
echo $this->render('../scripts/tooltip');
/*$this->renderPartial('/scripts/cliente');
Yii::app()->getClientScript()->registerScript("ajax_factura","
    function clienteCosto(url,idventa,tipoCliente,nombre,nit,id)
    {

        if($('#ServicioVenta_tipoVenta_1').is(':checked'))
        tipo=1;
        else
        tipo=0;
        factura(tipo,url,idventa,tipoCliente);
        $('#negocio').val(nombre);
        $('#NitCi').val(nit);
        $('#idCliente').val(id);
        $('#idTipoCliente').val(tipoCliente);
    }
",CClientScript::POS_HEAD);
