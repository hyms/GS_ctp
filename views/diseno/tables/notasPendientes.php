<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <strong class="panel-title">Notas</strong>
    </div>
    <?php
        $columns = [
            [
                'header'=>'Contenido',
                'format'=>'raw',
                'value'=>function($model){
                    return '<div class="alert alert-warning" role="alert"><p>'.
                    $model->texto.
                    '</p>'.
                    '<p class="text-right">'.
                    'Creado por <b>'.$model->fkIdUserCreador->nombre.' '.$model->fkIdUserCreador->apellido.'</b>'.
                    '</p>'.
                    '<p class="text-right">'.
                    'En fecha <b>'.$model->fechaCreacion.'</b>'.
                    '</p>'.
                    '<p class="text-right">'.
                    Html::a('Visto<span class="glyphicon glyphicon-ok"></span>', "#", [
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
                    ]).
                    '</p></div>';
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
