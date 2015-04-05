<?php
use kartik\grid\GridView;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body">
        <?php
        /*
            $columns = array(
                array(
                    'header'=>'Correlativo',
                    'value'=>'$data->correlativo',
                    'filter'=>CHtml::activeTextField($ordenes,'correlativo',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Codigo',
                    'value'=>'$data->codigoServicio',
                    'filter'=>CHtml::activeTextField($ordenes,'codigoServicio',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Cliente',
                    'value'=>'$data->fkIdCliente["nombreNegocio"]',
                    'filter'=>CHtml::activeTextField($ordenes,'negocio',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'responsable',
                    'value'=>'$data->responsable',
                    'filter'=>CHtml::activeTextField($ordenes,'responsable',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Fecha',
                    'type'=>'raw',
                    'value'=>'$data->fechaGenerada',
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker',
                                            array(
                                                'name'=>'fechaGenerada',
                                                'attribute'=>'fechaGenerada',
                                                'language'=>'es',
                                                'model'=>$ordenes,
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
                                'url'=>'array("orden/modificar","id"=>$data->idServicioVenta)',
                                'label'=>'Modificar',
                            ),
                    ),
                ),
            );
            /*
            $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$ordenes->search(null,'`t`.fechaGenerada DESC'),'filter'=>$ordenes));
            */
        $columns = [
            [
                'header'=>'Correlativo',
                'value'=>'$data->correlativo',
            ],

        ];
        echo GridView::widget([
            'dataProvider'=> $orden,
            //'filterModel' => $searchModel,
            'columns' => $columns,
            'responsive'=>true,
            'hover'=>true
        ]);
        ?>
    </div>
</div>
