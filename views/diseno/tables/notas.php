<?php
    use kartik\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo en processo</strong>
    </div>
    <div class="panel-body">
        <?=
            Html::a('Nuevo', "#", [
                'class'=>'btn btn-default',
                'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '" . Url::to(['diseno/nota', 'tipo' => '0']) . "',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<h3 class=\"text-center\">Ingreso</h3>');
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
                'header'=>'Fecha',
                'value'=>'fechaCreacion',
            ],
            [
                'header'=>'Contenido',
                'value'=>'texto',
            ],
        ];

        echo GridView::widget([
                                  'dataProvider'=> $notas,
                                  'filterModel' => $search,
                                  'columns' => $columns,
                                  'responsive'=>true,
                                  'hover'=>true
                              ]);
    ?>
</div>
