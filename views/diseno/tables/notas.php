<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Block de Notas</strong>
        </div>
        <div class="panel-body">
            <?=
            Html::a('Nuevo', "#", [
                'class'=>'btn btn-default',
                'onclick'  => "
                    $.ajax({
                        type    :'get',
                        cache   : false,
                        url     : '" . Url::to(['diseno/notas', 'tipo' => $tipo]) . "',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<h3 class=\"text-center\">Nota</h3>');
                                $('#viewModal .modal-body').html(data);
                                $('#viewModal').modal();
                            }
                        }
                    });return false;"
            ]);
            ?>
        </div>
        <?php
        $columns = [
            [
                'header'=>'Fecha Creada',
                'value'=>'fechaCreacion',
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
                'value'=>'fechaVisto',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update'=>function($url,$model){
                        $options = array_merge([
                            'data-original-title' => 'Modificar',
                            'data-toggle'         => 'tooltip',
                            'title'               => '',
                            'onclick'             => "
                                                        $.ajax({
                                                            type    :'get',
                                                            cache   : false,
                                                            url     : '" . Url::to(['diseno/notas', 'id'=>$model->idNotas]) . "',
                                                            success : function(data) {
                                                                if(data.length>0){
                                                                    $('#viewModal .modal-header').html('<h3 class=\"text-center\">Nota</h3>');
                                                                    $('#viewModal .modal-body').html(data);
                                                                    $('#viewModal').modal();
                                                                }
                                                            }
                                                        });return false;"
                        ]);
                        $url     = "#";
                        if($model->fk_idUserCreador==Yii::$app->user->id)
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
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
            'hover'=>true
        ]);
        ?>
    </div>
<?php
echo $this->render('../scripts/modal');
?>