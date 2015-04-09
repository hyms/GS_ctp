<?php /*
<div class="col-xs-2">
    <?php echo CHtml::activeRadioButtonList($venta,'tipoPago',array('Contado','Credito'))?>
</div>
 */ ?>
<div class="col-xs-2">
    <?php echo CHtml::activeRadioButtonList($venta,'tipoVenta',array('Con Factura','Sin Factura'))?>
</div>
<div class="col-xs-5">
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($venta,'fechaPlazo',array('class'=>'col-xs-5 control-label')); ?>
        <div class="col-xs-7">
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name'=>'fechaPlazo',
                'attribute'=>'fechaPlazo',
                'language'=>'es',
                'model'=>$venta,
                'options'=>array(
                    'showAnim'=>'fold',
                    'dateFormat'=>'yy-mm-dd',
                ),
                'htmlOptions'=>array(
                    'class'=>'form-control input-sm',
                    'disabled'=>(($venta->tipoPago==0)?true:false),
                ),
            ));
            ?>
        </div>
        <?php echo CHtml::error($venta,"fechaPlazo",array('class'=>'label label-danger')); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($venta,'autorizado',array('class'=>'col-xs-5 control-label')); ?>
        <div class="col-xs-7">
            <?php echo CHtml::activeDropDownList($venta, 'autorizado',array('Erick Paredes','Miriam Martinez'),array('class'=>'form-control input-sm','disabled'=>(($venta->tipoPago==0)?true:false),'id'=>"autorizado",'empty' => 'Selecciona Responsable')); ?>
        </div>
    </div>
</div>
<div class="col-xs-5">
    <div class="form-group ">
        <div class="col-xs-6">
            <?php echo CHtml::checkBoxList('Descuento',false,array('Descuento')); ?>
        </div>
        <div class="col-xs-6">
            <?php echo CHtml::activeTextField($venta,'montoDescuento',array('class'=>'form-control input-sm','disabled'=>(empty($venta->montoDescuento)?true:false),'id'=>'descuento')); ?>
        </div>
    </div>
</div>

<?php
    Yii::app()->getClientScript()->registerScript("ajax_factura","
    $('#ServicioVenta_tipoVenta_0').change(function() {
        factura(0,'".CHtml::normalizeUrl(array("ctp/ajaxFactura"))."',".$venta->idServicioVenta.",$('#idTipoCliente').val());
    });

    $('#ServicioVenta_tipoVenta_1').change(function() {
        factura(1,'".CHtml::normalizeUrl(array("ctp/ajaxFactura"))."',".$venta->idServicioVenta.",$('#idTipoCliente').val());
    });

    $('#ServicioVenta_tipoPago_0').change(function(){
        formaPago(true);
    });

    $('#ServicioVenta_tipoPago_1').change(function(){
        formaPago(false);
    });
",CClientScript::POS_READY);

    $this->renderPartial('/scripts/factura');
    $this->renderPartial('/scripts/condicionesVenta');
?>
