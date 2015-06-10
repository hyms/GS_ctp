<?php
    use kartik\grid\GridView;
    use yii\bootstrap\Modal;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Historial de ordenes de trabajo</strong>
        </div>
        <div>
            <?php
                $columns = [
                    [
                        'header'=>'Correlativo',
                        'attribute'=>'correlativo',
                    ],
                    [
                        'header'=>'Responsable',
                        'attribute'=>'responsable',
                    ],
                    [
                        'header'=>'Telefono',
                        'attribute'=>'telefono',
                    ],
                    [
                        'header'=>'Operador',
                        'attribute'=>function($model)
                        {
                            echo $model->fkIdUserD->nombre." ".$model->fkIdUserD->apellido;
                        }
                    ],
                    [
                        'header'=>'Fecha',
                        'attribute'=>'fechaGenerada',
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template'=>'{view}',
                        'buttons'=>[
                            'view'=>function($url,$model) {
                                $options = array_merge([
                                                           'data-original-title' => 'Ver Orden de Trabajo',
                                                           'data-toggle'         => 'tooltip',
                                                           'title'               => '',
                                                           'onclick'             => "
                                                        $.ajax({
                                                            type    :'get',
                                                            cache   : false,
                                                            url     : '" . Url::to(['diseno/review','op'=>'cliente','id'=>$model->idOrdenCTP]) . "',
                                                            success : function(data) {
                                                                if(data.length>0){
                                                                    $('#viewModal .modal-header').html('<h3 class=\"text-center\">Orden de Trabajo ".$model->correlativo."</h3>');
                                                                    $('#viewModal .modal-body').html(data);
                                                                    $('#viewModal').modal();
                                                                }
                                                            }
                                                        });return false;"
                                                       ]);
                                $url     = "#";
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                            },
                        ]
                    ],
                ];
                echo GridView::widget([
                                          'dataProvider'=> $orden,
                                          'filterModel' => $search,
                                          'columns' => $columns,
                                          'responsive'=>true,
                                          'condensed'=>true,
                                          'hover'=>true,
                                          'bordered'=>false,
                                      ]);
            ?>
        </div>
    </div>

<?php
    Modal::begin([
                     'id'=>'viewModal',
                     'size'=>Modal::SIZE_LARGE,
                 ]);
    Modal::end();
?>