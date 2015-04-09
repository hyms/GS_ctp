<?php
/* $columns = array(
     array(
         'header' => 'NitCi',
         'value' => '$data->nitCi',
         'filter' => CHtml::activeTelField($clientes, 'nitCi', array('class' => 'form-control input-sm')),
     ),
     array(
         'header' => 'Negocio',
         'value' => '$data->nombreNegocio',
         'filter' => CHtml::activeTelField($clientes, 'nombreNegocio', array('class' => 'form-control input-sm')),
     ),
     array(
         'header' => 'Dueño',
         'value' => '$data->nombreCompleto',
         'filter' => CHtml::activeTelField($clientes, 'nombreCompleto', array('class' => 'form-control input-sm')),
     ),
     array(
         'header' => 'Responsable',
         'value' => '$data->nombreResponsable',
         'filter' => CHtml::activeTelField($clientes, 'nombreResponsable', array('class' => 'form-control input-sm')),
     ),
     array(
         'header'=>'',
         'type'=>'raw',
         'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-ok\"></span> Añadir","#",array("onClick"=>"clienteCosto(\"".CHtml::normalizeUrl(array("ctp/ajaxFactura"))."\",'.$idServicioVenta.',".$data->fk_idTipoCliente.",\"".$data->nombreNegocio."\",\"".$data->nitCi."\",".$data->idCliente.");return false;","class"=>"btn btn-success btn-xs"))',
     )
 );
 $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$clientes->search(),'filter'=>$clientes));
?>
<?php echo CHtml::activeHiddenField($cliente,"fk_idTipoCliente",array('class'=>'form-control input-sm',"id"=>"idTipoCliente")); ?>
<div class="col-xs-12">
<div class="form-group col-xs-6">
 <?php echo CHtml::activeLabelEx($cliente,'nitCi',array('class'=>'control-label col-xs-4')); ?>
 <div class="col-xs-8">
     <?php echo CHtml::activeTextField($cliente,'nitCi',array('class'=>'form-control input-sm',"id"=>"NitCi")); ?>
 </div>
 <?php echo CHtml::error($cliente,'nitCi',array('class'=>'label label-danger')); ?>
</div>
<div class="form-group col-xs-6">
 <?php echo CHtml::activeLabelEx($cliente,'nombreNegocio',array('class'=>'control-label col-xs-4')); ?>
 <div class="col-xs-8">
     <?php echo CHtml::activeTextField($cliente,'nombreNegocio',array('class'=>'form-control input-sm',"id"=>"negocio")); ?>
 </div>
 <?php echo CHtml::error($cliente,'nombreNegocio',array('class'=>'label label-danger')); ?>
</div>
</div>
<?php
$this->renderPartial('/scripts/cliente');
Yii::app()->getClientScript()->registerScript("ajax_factura","
function clienteCosto(url,idventa,tipoCliente,nombre,nit,id)
{

 if($('#ServicioVenta_tipoVenta_1').is(':checked'))
 tipo=1;
 else
 tipo=0;
 factura(tipo,url,idventa,tipoCliente);
 $('#negocio').val(nombre);
 $('#NitCi').val(nit);
 $('#idCliente').val(id);
 $('#idTipoCliente').val(tipoCliente);
}
",CClientScript::POS_HEAD);
