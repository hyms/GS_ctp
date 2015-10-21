<?php
use kartik\helpers\Html;

?>
    <tr class="tabular-input">
        <td >
            <?= Html::tag('p',Html::encode($index + 1),['class'=>'form-control-static'])?>
            <?= Html::activeHiddenInput($model,"[$index]fk_idProductoStock") ?>
        </td>

        <td>
            <?= Html::tag('p',Html::encode($almacen->fkIdProducto->formato),['class'=>'form-control-static'])?>
        </td>

        <td>
            <div <?= ($model->hasErrors('cantidad'))?'class="has-error"':''; ?> >
                <?= Html::activeTextInput($model,"[$index]cantidad",['class'=>'form-control input-sm','id'=>'cantidad_'.$index]); ?>
            </div>
        </td>
        <td>
            <?= Html::checkbox("F",false,['id'=>'f_'.$index]); ?>
        </td>
        <td>
            <?= Html::activeCheckbox($model,"[$index]C",['id'=>'c_'.$index,'label' => null]); ?>
        </td>
        <td>
            <?= Html::activeCheckBox($model,"[$index]M",['id'=>'m_'.$index,'label' => null]); ?>
        </td>
        <td>
            <?= Html::activeCheckBox($model,"[$index]Y",['id'=>'y_'.$index,'label' => null]); ?>
        </td>
        <td>
            <?= Html::activeCheckBox($model,"[$index]K",['id'=>'k_'.$index,'label' => null]); ?>
        </td>

        <td style="min-width: 100px">
            <div <?= ($model->hasErrors('trabajo'))?'class="has-error"':''; ?> >
                <?= Html::activeTextInput($model,"[$index]trabajo",['class'=>'form-control input-sm','id'=>'trabajo_'.$index]); ?>
            </div>
        </td>

        <td>
            <div <?= ($model->hasErrors('pinza'))?'class="has-error"':''; ?> >
                <?= Html::activeTextInput($model,"[$index]pinza",['class'=>'form-control input-sm','id'=>'pinza_'.$index]); ?>
            </div>
        </td>
        <td>
            <div <?= ($model->hasErrors('resolucion'))?'class="has-error"':''; ?> >
                <?= Html::activeTextInput($model,"[$index]resolucion",['class'=>'form-control input-sm','id'=>'resolucion_'.$index]); ?>
            </div>
        </td>
        <?php
            if(isset($tipo)){
                if($tipo==0)
                {
                    ?>
                    <td class="col-xs-1">
                        <div <?= ($model->hasErrors('adicional'))?'class="has-error"':''; ?> >
                            <?= Html::activeTextInput($model,"[$index]adicional",['class'=>'form-control input-sm','id'=>'adicional_'.$index]); ?>
                        </div>
                    </td>
                <?php
                }
            }
        ?>
        <td class="col-xs-1">
            <?= Html::a(Html::icon('remove'),'#',
                             [
                                 'class'=>'btn btn-danger tabular-input-remove',
                                 'data-toggle'=>'tooltip',
                                 'title'=>'Quitar'
                             ]
                    ).Html::hiddenInput('cancel',$index,['class'=>'tabular-input-index']);
            ?>
        </td>
    </tr>
<?= $this->render('../scripts/checkbox',['index'=>$index]); ?>