<?php
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\Url;

?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <?= Html::tag('strong','Notas',['class'=>'panel-title']);?>
    </div>
    <?php
        $columns = [
            [
                'header'=>'Contenido',
                'format'=>'raw',
                'value'=>function($model){
                    return '<div class="alert alert-warning" role="alert">'.
                    Html::tag('p',$model->texto).
                    Html::tag('p','Creado por <b>'.$model->fkIdUserCreador->nombre.' '.$model->fkIdUserCreador->apellido.'</b>',['class'=>'text-right']).
                    Html::tag('p','En fecha <b>'.$model->fechaCreacion.'</b>',['class'=>'text-right']).
                    Html::tag('p',
                        Html::a('Visto'.Html::icon('ok'), "#", [
                            'class'=>'btn btn-success btn-sm',
                            'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '" . Url::to(['diseno/visto', 'id'=>$model->idNotas]) . "',
                        success : function(data) {
                            if(data.length>0){
                                if(data==\"done\")
                                { location.reload();}
                            }
                        }
                    });return false;"
                        ]),
                        ['class'=>'text-right']);
                },
            ],
        ];

        echo GridView::widget([
                                  'dataProvider'=> $notas,
                                  'columns' => $columns,
                                  'responsive'=>true,
                                  'hover'=>true
                              ]);
    ?>
</div>
