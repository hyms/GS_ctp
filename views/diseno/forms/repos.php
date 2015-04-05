<?php
$listaResp=array("CTP"=>"CTP","Falla de Fabrica"=>"Falla de Fabrica","Proceso"=>"Proceso","Otro"=>"Otro");
$i=0;
if($repos->responsable!="")
{
    foreach ($listaResp as $item)
    {
        if($repos->responsable!=$item)
            $i++;
    }
    if($i==4)
    {
        $otro=$repos->responsable;
        $repos->responsable = "Otro";
    }
}
?>

    <h3><?php echo "Reposiciones";?></h3>

    <div class = "row">
        <h3 class="col-xs-4">Orden de Trabajo <?php echo $ctp->codigo;?></h3>
        <h3 class="col-xs-4 text-center"><?php //echo $ctp->codigo;?></h3>
        <h3 class="col-xs-4 text-right"><?php echo date("d/m/Y",strtotime($ctp->fechaOrden));?></h3>

    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Detalle de Orden</strong>
        </div>
        <div class="panel-body" style="overflow: auto;">
            <?php $this->renderPartial('repo/detalleOrden',array('detalle'=>$ctp->detalleCTPs,'ctp'=>$ctp));?>
        </div>
    </div>

<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'form',
    //'action'=>CHtml::normalizeUrl(array((empty($ctp->idCtp))?'/orden/cliente':"/ctp/modificar")),
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'role'=>'form'
    ),
));

echo ((!empty($ctp->idCtp))?CHtml::activeHiddenField($ctp,'idCtp'):'');
?>

    <div class="form-group">
        <div class="col-xs-9">
            <div class="col-xs-2"><div class="text-right">Atribuible:</div></div>
            <div class="col-xs-4"><?php echo CHtml::activeDropDownList($repos,'responsable',$listaResp,array('class'=>'form-control input-sm','id'=>'resp'))?></div>
            <div class="col-xs-2"><div class="text-right"><?php echo "Diseñador:";?></div></div>
            <div class="col-xs-4"><?php echo CHtml::textField('respOtro',$otro,array('class'=>'form-control input-sm','id'=>'respOtro','disabled'=>(($otro=="")?true:false)))?></div>
        </div>
        <div class="col-xs-3"></div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Detalle de Repeticion</strong>
        </div>
        <div class="panel-body" style="overflow: auto;">
            <?php $this->renderPartial('repo/detalleRepos',array('detalle'=>$detalle,'ctp'=>$repos));?>
            <div class="form-group col-xs-8">
                <?php echo $form->labelEx($repos,'obs',array('class'=>'col-xs-2 control-label')); ?>
                <div class="col-xs-10">
                    <?php echo CHtml::activeTextArea($repos,'obs',array('class'=>'form-control input-sm','id'=>'resp'))?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="text-center">
            <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
            <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>

<?php Yii::app()->clientScript->registerScript('otro',"
	/*function total()
	{
		var importe_total = 0;
		$('.costo*').each(
			function(index, value) {
				importe_total = importe_total + ($('#costo_'+index).val()*$('#nroPlacas_'+index).val());
			}
		);
		$('#total').val(redondeo(importe_total));
	}*/

	$('#resp').change(function() {
	  	if($('#resp').val()=='Otro')
		{
			$('#respOtro').prop( 'disabled', false );
			//total();
		}
		else
		{
			$('#respOtro').prop( 'disabled', true );
			$('#total').val('');
		}
	});
",CClientScript::POS_READY); ?>