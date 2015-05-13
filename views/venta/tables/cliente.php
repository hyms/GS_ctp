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
            'value'=> function ($model,$idOrdenCTP) {
                //return Html::a("<i class=\"glyphicon glyphicon-pencil\"></i>",["orden/modificar","id"=>$model->idOrdenCtp],['data-original-title'=>'Modificar','data-toggle'=>'tooltip']);
                return Html::a('<i class="glyphicon glyphicon-plus"></i>','#',
                               [
                                   'onclick'=>'clienteCosto("'.\yii\helpers\Url::to(array("venta/ajaxfactura")).'",'.$idOrdenCTP.','.$model->fk_idTipoCliente.',"'.$model->nombreNegocio.'","'.$model->nitCi.'","'.$model->idCliente.'");return false;',
                                   'class'=>'btn btn-success',
                                   'data-original-title'=>'Aceptar',
                                   'data-toggle'=>'tooltip',
                                   'title'=>''
                               ]
                );
            },
        ]
    ];

    echo GridView::widget([
                              'dataProvider'=> $cliente,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'responsive'=>true,
                              'hover'=>true,
                              'pjax'=>true,
                          ]);
    echo $this->render('../scripts/tooltip');
    $script = "
    function clienteCosto(url,idOrden,tipoCliente,nombre,nit,id)
    {
        //var tipo = $('input:radio[name=OrdenCTP[tipoPago]]:checked').val();
        //factura(tipo,url,idventa,tipoCliente);
        $('#cliente').val(nombre+\" - \"+nit);
        $('#idCliente').val(id);
        $('#tipoCliente').val(tipoCliente);
        var val = $('form input[type=\"radio\"]:checked').val();
        if(val!=undefined)
            factura(val,url,idOrden,$('#tipoCliente').val());
    }
";
    $this->registerJs($script, \yii\web\View::POS_HEAD);
