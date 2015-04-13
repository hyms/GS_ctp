<?php
use yii\helpers\Html;

?>
    <tr class="tabular-input">
        <td >
            <p class="form-control-static"><?= Html::encode($index + 1) ?></p>
            <?= Html::activeHiddenInput($model,"[$index]fk_idProductoStock") ?>
        </td>

        <td>
            <p class="form-control-static"><?= Html::encode($almacen->fkIdProducto->formato) ?></p>
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

        <td>
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
        if(isset($costo)){
            if($costo=="cliente")
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