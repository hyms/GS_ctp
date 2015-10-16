<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\widgets\Pjax;

?>
<?php
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

    echo Html::panel(
        [
            'heading' => Html::tag('strong','Clientes',['class'=>'panel-title']),
            'postBody' => GridView::widget([
                                               'dataProvider'=> $clientes,
                                               'filterModel' => $search,
                                               'columns' => $columns,
                                               'responsive'=>true,
                                               'hover'=>true,
                                               'bordered'=>false,
                                           ])
        ],
        Html::TYPE_DEFAULT
    );
    Pjax::end();
