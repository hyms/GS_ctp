<?php
    use yii\helpers\Html;

?>
    <tr class="tabular-input">
        <td >
            <p class="form-control-static"><?php echo Html::encode($index + 1)?></p>
            <?php echo Html::activeHiddenInput($model,"[$index]fk_idProductoStock")?>
        </td>

        <td>
            <p class="form-control-static"><?php //echo Html::encode($almacen->fkIdProducto->color) ?></p>
            <?php echo Html::activeHiddenInput($model,"[$index]fk_idProductoStock")?>
        </td>

        <td>
            <?php echo Html::activeTextInput($model,"[$index]cantidad",['class'=>'form-control input-sm','id'=>'cantidad_'.$index]); ?>
        </td>
        <td>
            <?php echo Html::checkbox("[$index]F",false,array('id'=>'f_'.$index)); ?>
        </td>
        <td>
            <?php echo Html::activeCheckbox($model,"[$index]C",array('id'=>'c_'.$index)); ?>
        </td>
        <td>
            <?php echo Html::activeCheckBox($model,"[$index]M",array('id'=>'m_'.$index)); ?>
        </td>
        <td>
            <?php echo Html::activeCheckBox($model,"[$index]Y",array('id'=>'y_'.$index)); ?>
        </td>
        <td>
            <?php echo Html::activeCheckBox($model,"[$index]K",array('id'=>'k_'.$index)); ?>
        </td>

        <td>
            <?php echo Html::activeTextInput($model,"[$index]trabajo",array('class'=>'form-control input-sm','id'=>'trabajo_'.$index)); ?>
        </td>

        <td>
            <?php echo Html::activeTextInput($model,"[$index]pinza",array('class'=>'form-control input-sm','id'=>'pinza_'.$index)); ?>
        </td>
        <td>
            <?php echo Html::activeTextInput($model,"[$index]resolucion",array('class'=>'form-control input-sm','id'=>'resolucion_'.$index)); ?>
        </td>
        <?php
            if(isset($costo)){
                if($costo=="cliente")
                {
                    ?>
                    <td class="col-xs-1">
                        <?php echo Html::activeTextInput($model,"[$index]adicional",array('class'=>'form-control input-sm','id'=>'adicional_'.$index)); ?>
                    </td>
                <?php
                }
            }
        ?>
        <td class="col-xs-1">
            <?php echo Html::a('<span class="glyphicon glyphicon-remove"></span> Quitar', '#', array("class"=>"btn btn-danger btn-sm tabular-input-remove")).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />'; ?>
        </td>
    </tr>
<?php
    echo $this->render('../scripts/checkbox',['index'=>$index])
?>