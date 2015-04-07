<?php
    $atribuibles = array(
        "CTP"=>"CTP",
        "Falla de Fabrica"=>"Falla de Fabrica",
        "Proceso"=>"Proceso",
        "Empleado"=>"Empleado",
        "Otro"=>"Otro",
    );
?>
    <h3>Repociciones</h3>

    <div class = "row">
        <h3 class="col-xs-4">Orden de Trabajo <?php echo (isset($orden->codigoServicio))?$orden->codigoServicio:$orden->codigo;?></h3>
        <h3 class="col-xs-4 text-center"><?php //echo $orden->codigo;?></h3>
        <h3 class="col-xs-4 text-right"><?php echo date("d/m/Y",strtotime((isset($orden->fechaVenta))?$orden->fechaVenta:$orden->fechaRegistro));?></h3>

    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Datos de Orden</strong>
        </div>
        <div class="panel-body" style="overflow: auto;">
            <?php
                if(isset($orden->codigoServicio))
                    $this->renderPartial('forms/detalleOrden',array('detalle'=>$detalle,'orden'=>$orden,'repos'=>true));
                else
                    $this->renderPartial('forms/detalleRepos',array('detalle'=>$detalle,'orden'=>$orden,'repos'=>true));
            ?>
        </div>
    </div>
<?php
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'form',
        'htmlOptions'=>array(
            'class'=>'form-horizontal',
            'role'=>'form'
        ),
    ));

    echo ((!empty($repos->idServicioVentaRI))?CHtml::activeHiddenField($repos,'idServicioVentaRI'):'');
?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Datos de Reposicion</strong>
        </div>
        <div class="panel-body" style="overflow: auto;">
            <div class="form-group col-xs-6">
                <?php echo CHtml::activeLabelEx($repos,'responsable',array('class'=>'control-label col-xs-4')); ?>
                <div class="col-xs-8">
                    <?php echo CHtml::activeDropDownList($repos,'responsable',$atribuibles,array('class'=>'form-control input-sm','id'=>'responsable')); ?>
                </div>
                <?php echo CHtml::error($repos,'responsable',array('class'=>'label label-danger')); ?>
            </div>
            <div class="form-group col-xs-6">
                <?php echo CHtml::activeLabelEx($repos,'fk_idCliente',array('class'=>'control-label col-xs-4')); ?>
                <div class="col-xs-8">
                    <?php echo CHtml::activeDropDownList($repos,'fk_idCliente',CHtml::listData(User::model()->findAll('fk_idSucursal='.$this->sucursal),'idUser','apellido'),array('class'=>'form-control input-sm','empty'=>'','disabled'=>($repos->fk_idCliente!="")?false:true,'id'=>'user')); ?>
                </div>
                <?php echo CHtml::error($repos,'fk_idCliente',array('class'=>'label label-danger')); ?>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Detalle de Reposicion</strong>
        </div>
        <div class="panel-body" style="overflow: auto;">
            <?php $this->renderPartial('forms/detalleRepos',array('detalle'=>$detalleRep,'orden'=>$repos));?>
        </div>
    </div>

    <div class="form-group">
        <div class="text-center">
            <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-remove"></span> Cancelar', "#", array('class' => 'btn btn-default hidden-print','id'=>'reset')); ?>
            <?php echo CHtml::link('<span class="glyphicon glyphicon-floppy-disk"></span> Guardar', "#", array('class' => 'btn btn-default hidden-print','id'=>'save')); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
<?php Yii::app()->clientScript->registerScript('ajax_responsable',"
$('#responsable').on('change', function() {
  if(this.value == 'Empleado')
      $('#user').attr('disabled', false)
  else
      $('#user').attr('disabled', true)
});
",CClientScript::POS_READY); ?>