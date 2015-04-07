<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Ordenes de trabajo</strong>
    </div>
    <div class="panel-body" style="overflow: auto;">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider'=>$deudas->search(),
            'filter'=>$deudas,
            'ajaxUpdate'=>false,
            'itemsCssClass' => 'table table-hover table-condensed',
            'htmlOptions' => array('class' => 'table-responsive'),
            'columns'=>array(
                array(
                    'header'=>'Nro',
                    'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                ),
                array(
                    'header'=>'Codigo',
                    'value'=>'$data->idCtpRep0->codigo',
                    'filter'=>CHtml::activeTextField($deudas,'codigo',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Monto',
                    'value'=>'$data->costoT',
                    'filter'=>CHtml::activeTextField($deudas,'costoT',array('class'=>'form-control input-sm')),
                ),
                array(
                    'header'=>'Fecha',
                    'type'=>'raw',
                    'value'=>'$data->fecha',
                    'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name'=>'fecha',
                                'attribute'=>'fecha',
                                'language'=>'es',
                                'model'=>$deudas,
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
            )
        ));
        ?>
    </div>
</div>
