<?php
    use yii\helpers\Html;

?>
    <tr class="tabular-input">
        <td >
            <p class="form-control-static"><?php echo Html::encode($index + 1)?></p>
            <?php echo Html::activeHiddenInput($model,"[$index]fk_idProductoStock")?>
        </td>

        <td>
            <p class="form-control-static"><?php echo Html::encode($almacen->fkIdProducto->color) ?></p>
        </td>

        <td>
            <div <?php echo ($model->hasErrors('cantidad'))?'class="has-error"':''; ?> >
            <?php echo Html::activeTextInput($model,"[$index]cantidad",['class'=>'form-control input-sm','id'=>'cantidad_'.$index]); ?>
            </div>
        </td>
        <td>
            <?php echo Html::checkbox("F",false,['id'=>'f_'.$index]); ?>
        </td>
        <td>
            <?php echo Html::activeCheckbox($model,"[$index]C",['id'=>'c_'.$index,'label' => null]); ?>
        </td>
        <td>
            <?php echo Html::activeCheckBox($model,"[$index]M",['id'=>'m_'.$index,'label' => null]); ?>
        </td>
        <td>
            <?php echo Html::activeCheckBox($model,"[$index]Y",['id'=>'y_'.$index,'label' => null]); ?>
        </td>
        <td>
            <?php echo Html::activeCheckBox($model,"[$index]K",['id'=>'k_'.$index,'label' => null]); ?>
        </td>

        <td>
            <div <?php echo ($model->hasErrors('trabajo'))?'class="has-error"':''; ?> >
                <?php echo Html::activeTextInput($model,"[$index]trabajo",['class'=>'form-control input-sm','id'=>'trabajo_'.$index]); ?>
            </div>
        </td>

        <td>
            <div <?php echo ($model->hasErrors('pinza'))?'class="has-error"':''; ?> >
                <?php echo Html::activeTextInput($model,"[$index]pinza",['class'=>'form-control input-sm','id'=>'pinza_'.$index]); ?>
            </div>
        </td>
        <td>
            <div <?php echo ($model->hasErrors('resolucion'))?'class="has-error"':''; ?> >
                <?php echo Html::activeTextInput($model,"[$index]resolucion",['class'=>'form-control input-sm','id'=>'resolucion_'.$index]); ?>
            </div>
        </td>
        <?php
            if(isset($costo)){
                if($costo=="cliente")
                {
                    ?>
                    <td class="col-xs-1">
                        <div <?php echo ($model->hasErrors('adicional'))?'class="has-error"':''; ?> >
                            <?php echo Html::activeTextInput($model,"[$index]adicional",['class'=>'form-control input-sm','id'=>'adicional_'.$index]); ?>
                        </div>
                    </td>
                <?php
                }
            }
        ?>
        <td class="col-xs-1">
            <?php
                echo Html::a('<i class="glyphicon glyphicon-remove"></i>','#',
                             [
                                 'class'=>'btn btn-danger tabular-input-remove',
                                 'data-original-title'=>'Quitar',
                                 'data-toggle'=>'tooltip',
                                 'title'=>''
                             ]
                    ).'<input type="hidden" class="tabular-input-index" value="'.$index.'" />';
            ?>
        </td>
    </tr>
<?php
    echo $this->render('../scripts/checkbox',['index'=>$index]);
    //echo $this->render('../scripts/tooltip');
?>