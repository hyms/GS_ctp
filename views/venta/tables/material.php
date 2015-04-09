<?php
if(!empty($material)) {
    echo '<div class="panel panel-default">
    <div class="panel-heading">
        <strong class="panel-title">Material CTP</strong>
    </div>
    <div class="panel-body">';

    $material = new CArrayDataProvider($material,
        array(
            'id' => 'idAlmacenProducto',
            'keyField' => 'id',
            'keys' => array('id'),
            'pagination' => array('pageSize' => '20',),
        ));//*/

    $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $material,
        'ajaxUpdate' => true,
        'itemsCssClass' => 'table table-hover table-condensed',
        'htmlOptions' => array('class' => 'table-responsive'),
        'columns' => array(
            array(
                'header' => 'Nro',
                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            ),
            array(
                'header' => 'Codigo',
                'value' => '$data->idProducto0->codigo',
            ),
            array(
                'header' => 'Material',
                'value' => '$data->idProducto0->material',
            ),
            array(
                'header' => 'Color',
                'value' => '$data->idProducto0->color',
            ),
            array(
                'header' => 'Detalle',
                'value' => '$data->idProducto0->detalle',
            ),
            array(
                'header' => 'Stock Unidad',
                'value' => '$data->stockU',
            ),
            array(
                'header' => 'Stock Paquete',
                'value' => '$data->stockP',
            ),
            array(
                'header' => '',
                'type' => 'raw',
                'value' => 'CHtml::link("<span class=\"glyphicon glyphicon-import\"></span> Stock",array("ctp/productos","id"=>$data->idAlmacenProducto), array("class" => "openDlg divDialog","title"=>"Añadir a Stock"))',
            ),
        )
    ));
}
echo ' </div>
</div>';
$this->renderPartial('scripts/modal');
$this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'divDialog',
    'options'=>array( 'title'=>'Añadir a Stock', 'autoOpen'=>false, 'modal'=>true, 'width'=>800)));
?>
    <div class="divForForm"></div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>