<?php
    use kartik\grid\GridView;
    use kartik\popover\PopoverX;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>

    <div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Recibos</strong>
    </div>
    <div class="panel-body">
        <?php
            PopoverX::begin([
                                'placement' => PopoverX::ALIGN_RIGHT,
                                'size' => PopoverX::SIZE_LARGE,
                                'toggleButton' => ['label'=>'Recibo Ingreso', 'class'=>'btn btn-default','onclick'=>"
                                            $.ajax({
                                            type     :'POST',
                                            cache    : false,
                                            url  : '".Url::to(['venta/recibos','op'=>'i'])."',
                                            success  : function(data) {
                                                if(data.length>0){
                                                $('#poper').html(data);
                                                }
                                            }
                                            });return false;"],
                                'header' => '<i class="glyphicon glyphicon-lock"></i>',
                                //'footer'=> Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
                            ]);
            echo "<div id='poper'></div>";
            PopoverX::end();
        ?>
        <?php
            PopoverX::begin([
                                'placement' => PopoverX::ALIGN_RIGHT,
                                'size' => PopoverX::SIZE_LARGE,
                                'toggleButton' => ['label'=>'Recibo Egreso', 'class'=>'btn btn-default','onclick'=>"
                                            $.ajax({
                                            type     :'POST',
                                            cache    : false,
                                            url  : '".Url::to(['venta/recibos','op'=>'e'])."',
                                            success  : function(data) {
                                                if(data.length>0){
                                                $('#poperE').html(data);
                                                }
                                            }
                                            });return false;"],
                                'header' => '<i class="glyphicon glyphicon-lock"></i>',
                            ]);
            echo "<div id='poperE'></div>";
            PopoverX::end();
        ?>
    </div>
<?php
    $columns = [
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
                'update'=>function($url,$model){
                    $options = array_merge([
                                               //'class'=>'btn btn-success',
                                               'data-original-title'=>'Modificar',
                                               'data-toggle'=>'tooltip',
                                               'title'=>''
                                           ]);
                    $url = Url::to(['venta/recibos','op'=>'recibo','id'=>$model->idRecibo]);
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

    \yii\bootstrap\Modal::begin([
      'header' => '<h2>Hello world</h2>',
      'toggleButton' => ['label' => 'click me'],
      'footer'=>"<button>click</button>"
  ]);

  echo 'Say hello...';

  \yii\bootstrap\Modal::end();

?>