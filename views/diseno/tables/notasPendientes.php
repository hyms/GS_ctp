<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Notas pendientes</strong>
    </div>
    <?php
    $columns = [
        [
            'header'=>'Contenido',
            'format'=>'raw',
            'value'=>function($model){
                return '<p>'.
                $model->texto.
                '</p>'.
                '<p>'.
                Html::a('Visto', "#", [
                    //'class'=>'btn btn-default',
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
                '</p>';
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
