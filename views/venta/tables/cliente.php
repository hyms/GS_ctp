<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;

    $columns = [
        /*[
            'header'=>'Nit/Ci',
            'attribute'=>'nitCi',
        ],*/
        [
            'header' => 'Negocio',
            'attribute'=>'nombreNegocio',
        ],
        [
            'header' => 'Responsable',
            'attribute'=>'nombreResponsable',
        ],
        [
            'header'=>'',
            'format' => 'raw',
            'value'=> function ($model) {
                return Html::a(Html::icon('plus'),'#',
                               [
                                   'onclick'=>'cliente("'.$model->nombreNegocio.'","'.$model->nitCi.'","'.$model->idCliente.'","'.$model->codigoCliente.'");return false;',
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
    /*$script = "
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
    }";*/
    $script = "
    function cliente(nombre,nit,id,categoria)
    {
        $('#cliente').val(nombre+\" - \"+nit);
        $('#idCliente').val(id);
        $('#categoria').html(categoria);
    }
    ";
    $this->registerJs($script, \yii\web\View::POS_HEAD);
