<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><strong>Reportes</strong></h3>
    </div>
    <div class="panel-body">

        <?php $form = $this->beginWidget(
            'booster.widgets.TbActiveForm',
            array(
                'id' => 'form',
                'type' => 'horizontal',
            )
        );
        ?>

        <div class="row">
            <div class="col-xs-6">
                <?php
                    echo '<div class="form-group">';
                    echo CHtml::label('Cliente:','clienteNegocio',array('class'=>'col-xs-3 control-label'));
                    echo '<div class="col-xs-9">';
                    echo CHtml::textField('clienteNegocio',$clienteNegocio,array('class'=>'form-control'));
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    echo CHtml::label('Responsable:','clienteResponsable',array('class'=>'col-xs-3 control-label'));
                    echo '<div class="col-xs-9">';
                    echo CHtml::textField('clienteResponsable',$clienteResponsable,array('class'=>'form-control'));
                    echo '</div>';
                    echo '</div>';

                    echo '<h3>Fecha</h3>';
                    echo '<div id="error"></div>';
                    echo CHtml::hiddenField('tipo','');
                    echo '<div class="form-group">';
                    echo CHtml::label('De','fechaStart',array('class'=>'col-xs-2 control-label'));
                    echo '<div class="col-xs-4">';
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                                      'name'=>'fechaStart',
                                                                      'attribute'=>$fechaStart,
                                                                      'language'=>'es',
                                                                      'options'=>array(
                                                                          'showAnim'=>'fold',
                                                                          'dateFormat'=>'yy-mm-dd',
                                                                      ),
                                                                      'htmlOptions'=>array(
                                                                          'class'=>'form-control',
                                                                      ),
                                                                  )
                    );
                    echo '</div>';

                    echo CHtml::label('A','fechaEnd',array('class'=>'col-xs-2 control-label'));
                    echo '<div class="col-xs-4">';
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                                           'name'=>'fechaEnd',
                                                                           'attribute'=>$fechaEnd,
                                                                           'language'=>'es',
                                                                           'options'=>array(
                                                                               'showAnim'=>'fold',
                                                                               'dateFormat'=>'yy-mm-dd',
                                                                           ),
                                                                           'htmlOptions'=>array(
                                                                               'class'=>'form-control',
                                                                           ),
                                                                       )
                    );
                    echo '</div>';
                    echo '</div>';

                ?>
            </div>

            <div class="col-xs-6">
                <h3>Generadores</h3>
                <div class="list-group">
                    <?php

                        echo CHtml::link('Reporte de Ventas','#',array('class'=>'list-group-item','onclick'=>'report("v")'));
                        echo CHtml::link('Reporte de Deudores','#',array('class'=>'list-group-item','onclick'=>'report("d")'));
                        echo CHtml::link('Reporte de Pagos de Deudores','#',array('class'=>'list-group-item','onclick'=>'report("pd")'));
                    ?>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>

<?php
    Yii::app()->clientScript->registerScript("report",'
	function report(tipo)
	{
	    //data=$("#form").serialize();
	    $("#tipo").val(tipo);
	    $("#form").submit();
	}
',CClientScript::POS_HEAD);