<tr class="tabular-input">
    <td >
        <p class="form-control-static"><?php echo CHtml::encode($index + 1)?></p>
    </td>

    <td>
        <p class="form-control-static"><?php echo CHtml::encode($almacen->fkIdProducto->color) ?></p>
        <?php echo CHtml::activeHiddenField($model,"[$index]fk_idProductoStock")?>
    </td>

    <td>
        <?php echo CHtml::activeTextField($model,"[$index]cantidad",array('class'=>'form-control input-sm','id'=>'cantidad_'.$index)); ?>
    </td>
    <td>
        <?php
            if(isset($repos))
            {
                echo CHtml::checkBox("[$index]F",false,array('onClick'=>'return false;'));
            }
            else
                echo CHtml::checkBox("[$index]F",false,array('id'=>'f_'.$index));
        ?>
    </td>
    <td>
        <?php
            if(isset($repos))
            {
                echo CHtml::activeCheckBox($model,"[$index]C",array('onClick'=>'return false;'));
            }
            else
                echo CHtml::activeCheckBox($model,"[$index]C",array('id'=>'c_'.$index));
        ?>
    </td>
    <td>
        <?php
            if(isset($repos))
            {
                echo CHtml::activeCheckBox($model,"[$index]M",array('onClick'=>'return false;'));
            }
            else
                echo CHtml::activeCheckBox($model,"[$index]M",array('id'=>'m_'.$index));
        ?>
    </td>
    <td>
        <?php
            if(isset($repos))
            {
                echo CHtml::activeCheckBox($model,"[$index]Y",array('onClick'=>'return false;'));
            }
            else
                echo CHtml::activeCheckBox($model,"[$index]Y",array('id'=>'y_'.$index));
        ?>
    </td>
    <td>
        <?php
            if(isset($repos))
            {
                echo CHtml::activeCheckBox($model,"[$index]K",array('onClick'=>'return false;'));
            }
            else
                echo CHtml::activeCheckBox($model,"[$index]K",array('id'=>'k_'.$index));
        ?>

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
    <td class="col-xs-1">
        <?php
            if(isset($repos))
            {
                echo CHtml::link('<span class="glyphicon glyphicon-ok"></span> Añadir','#',array('onclick'=>'newRow("'.$model->fk_idProductoStock.'","'.CHtml::normalizeUrl(array("repos/addDetalleR")).'","'.$model->idDetalleServicio.'");return false;',"class"=>"btn btn-success btn-sm"));
            }
            else
                echo CHtml::link('<span class="glyphicon glyphicon-remove"></span> Quitar', '#', array("class"=>"btn btn-danger btn-sm tabular-input-remove")).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />';
        ?>
    </td>
</tr>
<?php
    if(!isset($repos)) {
        $this->renderpartial('/scripts/checkbox', array('index' => $index));
    }
?>