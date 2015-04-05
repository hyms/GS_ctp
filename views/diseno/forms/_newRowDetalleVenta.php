<tr class="tabular-input">
    <td >
        <p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
        <?php echo CHtml::activeHiddenField($model,"[$index]fk_idProductoStock")?>
    </td>

    <td>
        <p class="form-control-static"><?php echo CHtml::encode($almacen->fkIdProducto->color) ?></p>
        <?php echo CHtml::activeHiddenField($model,"[$index]fk_idProductoStock")?>
    </td>

    <td>
        <?php echo CHtml::activeTextField($model,"[$index]cantidad",array('class'=>'form-control input-sm','id'=>'cantidad_'.$index)); ?>
    </td>
    <td>
        <?php echo CHtml::checkBox("[$index]F",false,array('id'=>'f_'.$index)); ?>
    </td>
    <td>
        <?php echo CHtml::activeCheckBox($model,"[$index]C",array('id'=>'c_'.$index)); ?>
    </td>
    <td>
        <?php echo CHtml::activeCheckBox($model,"[$index]M",array('id'=>'m_'.$index)); ?>
    </td>
    <td>
        <?php echo CHtml::activeCheckBox($model,"[$index]Y",array('id'=>'y_'.$index)); ?>
    </td>
    <td>
        <?php echo CHtml::activeCheckBox($model,"[$index]K",array('id'=>'k_'.$index)); ?>
    </td>

    <td>
        <?php echo CHtml::activeTextField($model,"[$index]trabajo",array('class'=>'form-control input-sm','id'=>'trabajo_'.$index)); ?>
    </td>

    <td>
        <?php echo CHtml::activeTextField($model,"[$index]pinza",array('class'=>'form-control input-sm','id'=>'pinza_'.$index)); ?>
    </td>
    <td>
        <?php echo CHtml::activeTextField($model,"[$index]resolucion",array('class'=>'form-control input-sm','id'=>'resolucion_'.$index)); ?>
    </td>
    <?php
        if(isset($costo)){
            if($costo=="cliente")
            {
                ?>
                <td class="col-xs-1">
                    <?php echo CHtml::activeTextField($model,"[$index]adicional",array('class'=>'form-control input-sm','id'=>'adicional_'.$index)); ?>
                </td>
            <?php
            }
        }
    ?>
    <td class="col-xs-1">
        <?php echo CHtml::link('<span class="glyphicon glyphicon-remove"></span> Quitar', '#', array("class"=>"btn btn-danger btn-sm tabular-input-remove")).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />'; ?>
    </td>
</tr>
<?php
    $this->renderpartial('/scripts/checkbox',array('index'=>$index));
?>