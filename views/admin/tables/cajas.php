<?php
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::tag('strong','Lista de Cajas',['class'=>'panel-title']); ?>
    </div>
    <div class="panel-body">
        <?= Html::button('Nueva Caja',
                         [
                             'class'=>'btn btn-default',
                             'onclick' => 'clickmodal("' . Url::to(['admin/config','op'=>'caja','frm'=>true]) . '","Nueva Caja")',
                             'data-toggle' => "modal",
                             'data-target' => "#modal"
                         ]);?>
    </div>
        <?php
            $columns =
                [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'header'=>'nombre',
                        'value'=>'nombre'
                    ],
                    [
                        'header'=>'Descripcion',
                        'value'=>'descripcion'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{update}',
                        'buttons'=>[
                            'update'=>function($url,$model) {
                                return Html::a(Html::icon('import') . ' Modificar',
                                               "#",
                                               [
                                                   'onclick'     => 'clickmodal("' . Url::to(['admin/config', 'op' => 'caja', 'id' => $model->idCaja, 'frm' => true]) . '","Modificar Caja")',
                                                   'data-toggle' => "modal",
                                                   'data-target' => "#modal"
                                               ]);
                            },
                        ]
                    ],
                ];

            Pjax::begin(['id' => 'cajas']);
            echo GridView::widget([
                                      'dataProvider'=> $cajas,
                                      //'filterModel' => $search,
                                      'columns' => $columns,
                                      'responsive'=>true,
                                      'condensed'=>true,
                                      'hover'=>true,
                                      'bordered'=>false,
                                  ]);
            Pjax::end();?>
</div>
