<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\widgets\Pjax;

    $columns=[
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
            'header' => 'Telefono',
            'attribute'=>'telefono',
        ],
        [
            'header' => 'Correo',
            'attribute'=>'correo',
        ],
    ];
    Pjax::begin();
    echo GridView::widget([
                              'dataProvider'=> $clientes,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'toolbar' =>  [],
                              // set export properties
                              'responsive'=>true,
                              'hover'=>true,
                              'bordered'=>false,
                              'panel' => [
                                  'type' => GridView::TYPE_DEFAULT,
                                  'heading' =>Html::tag('strong','Clientes'),
                              ],
                          ]);
    Pjax::end();
