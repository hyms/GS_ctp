<?php
    use kartik\grid\GridView;
    use kartik\popover\PopoverX;
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Caja Chica</strong>
    </div>
    <div class="panel-body">
        <?php
            PopoverX::begin([
                                'placement' => PopoverX::ALIGN_RIGHT,
                                'size' => PopoverX::SIZE_LARGE,
                                'toggleButton' => ['label'=>'Caja Chica', 'class'=>'btn btn-default','onclick'=>"
                                            $.ajax({
                                            type     :'POST',
                                            cache    : false,
                                            url  : '".Url::to(['venta/chica','op'=>'new'])."',
                                            success  : function(data) {
                                                if(data.length>0){
                                                $('#poper').html(data);
                                                }
                                            }
                                            });return false;"],
                                'header' => '<i class="glyphicon glyphicon-lock"></i>',
                                //'footer'=> Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
                            ]);
            echo "<div id='poper'></div>";
            PopoverX::end();
        ?>
    </div>
    <?php
        $columns = [
            [
                'header'=>'Usuario',
                'attribute'=>function($model)
                {
                    return $model->fkIdUser->username;
                }
            ],
            [
                'header'=>'Nombre',
                'attribute'=>function($model)
                {
                    return $model->fkIdUser->nombre." ".$model->fkIdUser->apellido;
                }
            ],
            [
                'header'=>'Monto',
                'attribute'=>'monto',
            ],
            [
                'header'=>'Detalle',
                'attribute'=>'observaciones',
            ],
            [
                'header'=>'Fecha',
                'attribute'=>'time',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                'buttons'=>[
                    'update'=>function($url,$model){
                        $options = array_merge([
                                                   //'class'=>'btn btn-success',
                                                   'data-original-title'=>'Modificar',
                                                   'data-toggle'=>'tooltip',
                                                   'title'=>''
                                               ]);
                        $url = Url::to(['venta/chica','id'=>$model->idMovimientoCaja]);
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, $options);
                    },
                ]
            ],
        ];
        echo GridView::widget([
                                  'dataProvider'=> $cajasChicas,
                                  'filterModel' => $search,
                                  'columns' => $columns,
                                  'responsive'=>true,
                                  'condensed'=>true,
                                  'hover'=>true,
                                  'bordered'=>false,
                              ]);
        /*$columns = array(
            array(
                'header'=>'Usuario',
                'value'=>'$data->fkIdUser->username',
                'filter'=>CHtml::activeTextField($cajasChicas,'user',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Nombre',
                'value'=>'$data->fkIdUser->nombre." ".$data->fkIdUser->apellido',
            ),
            array(
                'header'=>'Monto',
                'value'=>'$data->monto',
                'filter'=>CHtml::activeTextField($cajasChicas,'monto',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Detalle',
                'value'=>'$data->detalle',
                'filter'=>CHtml::activeTextField($cajasChicas,'detalle',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Nro. Factura',
                'value'=>'$data->obseraciones',
                'filter'=>CHtml::activeTextField($cajasChicas,'obseraciones',array('class'=>'form-control input-sm')),
            ),
            array(
                'header'=>'Fecha',
                'value'=>'$data->fechaRegistro',
                'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'name'=>'fechaRegistro',
                    'attribute'=>'fechaRegistro',
                    'language'=>'es',
                    'model'=>$cajasChicas,
                    'options'=>array(
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-control input-sm',
                    ),
                ),
                                        true),
            ),
            array(
                'header'=>'',
                'class'=>'booster.widgets.TbButtonColumn',
                'template'=>'{update}',
                'buttons'=>array(
                    'update'=>
                        array(
                            'url'=>'array("ctp/cajaChica","id"=>$data->idCajaChica)',
                            'label'=>'Modificar',
                            'options'=>array(
                                'ajax'=>array(
                                    'type'=>'POST',
                                    'url'=>"js:$(this).attr('href')",
                                    'success'=>'function(data) {if(data.length>0){ $("#viewModal .modal-body ").html(data); $("#viewModal").modal(); }}'
                                ),
                            ),
                        ),
                ),
            ),
        );

        $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$cajasChicas->search("`t`.fechaRegistro Desc"),'filter'=>$cajasChicas))
        */
    ?>
</div>