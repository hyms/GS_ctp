<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::tag('strong','Sucursales',['class'=>'panel-title']); ?>
    </div>
    <div class="panel-body">
        <?= Html::button('Nueva Sucursal',
            [
                'class'=>'btn btn-default',
                'onclick' => 'clickmodal("' . Url::to(['admin/config','op'=>'sucursal','frm'=>true]) . '","Nueva Sucursal")',
                'data-toggle' => "modal",
                'data-target' => "#modal"
            ]);?>
    </div>
    <?php
    $columns = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'header'=>'Nombre',
            'value'=>'nombre',
        ],
        [
            'header'=>'Descripcion',
            'value'=>'descripcion',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{update}',
            'buttons'=>[
                'update'=>function($url,$model) {
                    return Html::a(Html::icon('import') . ' Modificar',
                        "#",
                        [
                            'onclick'     => 'clickmodal("' . Url::to(['admin/config', 'op' => 'sucursal', 'id' => $model->idSucursal, 'frm' => true]) . '","Modificar Sucursal")',
                            'data-toggle' => "modal",
                            'data-target' => "#modal"
                        ]);
                },
            ]
        ],
    ];

    Pjax::begin(['id' => 'sucursales']);
    echo GridView::widget([
        'dataProvider'=> $sucursales,
        //'filterModel' => $search,
        'columns' => $columns,
        'responsive'=>true,
        'condensed'=>true,
        'hover'=>true,
        'bordered'=>false,
    ]);
    Pjax::end();?>
</div>
