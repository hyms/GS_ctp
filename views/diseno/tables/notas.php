<?php
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::tag('strong','Historial Notas',['class'=>'panel-title']);?>
        </div>
        <div class="panel-body">
            <?= Html::button('Nuevo',
                [
                    'class'=>'btn btn-default',
                    'onclick' => 'clickmodal("' . Url::to(['diseno/notas', 'tipo' => $tipo]) . '","Nota")',
                    'data-toggle' => "modal",
                    'data-target' => "#modal"
                ]);?>
        </div>
        <?php
        $columns = [
            [
                'header'=>'Fecha Creada',
                'value'=>function($model)
                {
                    return date("Y-m-d H:i",strtotime($model->fechaCreacion));
                }
            ],
            [
                'header'=>'Creado Por',
                'value'=>function($model)
                {
                    return $model->fkIdUserCreador->nombre.' '.$model->fkIdUserCreador->apellido;
                },
            ],
            [
                'header'=>'Contenido',
                'value'=>'texto',
            ],
            [
                'header'=>'Visto por',
                'value'=>function($model) {
                    if (isset($model->fkIdUserVisto))
                        return $model->fkIdUserVisto->nombre . ' ' . $model->fkIdUserVisto->apellido;
                    else
                        return '';
                },
            ],
            [
                'header'=>'Fecha Visto',
                'value'=>function($model) {
                    if (empty($model->fechaVisto))
                        return "";
                    return date("Y-m-d H:i", strtotime($model->fechaVisto));
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update'=>function($url,$model) {
                        $options = [
                            'onclick' => 'clickmodal("' . Url::to(['diseno/notas', 'id' => $model->idNotas]) . '","Modificar Nota")',
                            'data-toggle' => 'tooltip',
                            'data-target' => "#modal",
                            'title' => 'Modificar',
                        ];
                        if ($model->fk_idUserCreador == Yii::$app->user->id)
                            return Html::a(Html::icon('pencil'), '#', $options);
                        else
                            return "";
                    },
                ]
            ],
        ];

        echo GridView::widget([
            'dataProvider'=> $notas,
            //'filterModel' => $search,
            'columns' => $columns,
            'responsive'=>true,
            'hover'=>true,
            'bordered'=>false,
        ]);
        ?>
    </div>
<?= $this->render('@app/views/share/scripts/modal'); ?>