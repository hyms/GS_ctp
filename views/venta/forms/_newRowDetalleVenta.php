<?php
use yii\helpers\Html;

?>
    <tr class="tabular-input">
        <td >
            <?= Html::tag('p',Html::encode($index + 1),['class'=>'form-control-static'])?>
            <?= Html::activeHiddenInput($model,"[$index]fk_idProductoStock" )?>
        </td>

        <td>
            <?= Html::tag('p',Html::encode($almacen->fkIdProducto->formato),['class'=>'form-control-static'])?>
        </td>

        <td>
            <?= Html::activeTextInput($model,"[$index]cantidad",['class'=>'form-control input-sm','id'=>'cantidad_'.$index]); ?>
        </td>
        <td>
            <?= Html::activeCheckBox($model,"[$index]C",['id'=>'c_'.$index,'onClick'=>"return false",'label' => null]); ?>
        </td>
        <td>
            <?= Html::activeCheckBox($model,"[$index]M",['id'=>'m_'.$index,'onClick'=>"return false",'label' => null]); ?>
        </td>
        <td>
            <?= Html::activeCheckBox($model,"[$index]Y",['id'=>'y_'.$index,'onClick'=>"return false",'label' => null]); ?>
        </td>
        <td>
            <?= Html::activeCheckBox($model,"[$index]K",['id'=>'k_'.$index,'onClick'=>"return false",'label' => null]); ?>
        </td>

        <td>
            <?= Html::activeTextInput($model,"[$index]trabajo",['class'=>'form-control input-sm','id'=>'trabajo_'.$index,'readonly'=>true]); ?>
        </td>

        <td>
            <?= Html::activeTextInput($model,"[$index]pinza",['class'=>'form-control input-sm','id'=>'pinza_'.$index,'readonly'=>true]); ?>
        </td>
        <td>
            <?= Html::activeTextInput($model,"[$index]resolucion",['class'=>'form-control input-sm','id'=>'resolucion_'.$index,'readonly'=>true]); ?>
        </td>
        <td class="col-xs-1 <?= ($model->hasErrors('resolucion'))?'class="has-error"':''; ?>">
            <?= Html::activeTextInput($model,"[$index]costo",['class'=>'form-control input-sm','id'=>'costo_'.$index]); ?>
        </td>
        <td class="col-xs-1">
            <?= Html::activeTextInput($model,"[$index]adicional",['class'=>'form-control input-sm','id'=>'adicional_'.$index]); ?>
        </td>

        <td class="col-xs-1">
            <?= Html::activeTextInput($model,"[$index]total",['class'=>'costo form-control input-sm','readonly'=>true,'id'=>'costoTotal_'.$index]); ?>
        </td>
    </tr>
<?php
    echo "
<script>
    $('#cantidad_". $index ."').blur(function(e){
        $('#costoTotal_". $index ."').val(redondeo(suma($('#cantidad_".  $index ."').val()*$('#costo_". $index ."').val(),$('#adicional_". $index ."').val())));
        calcular_total();
        return true;
    });
    $('#costo_". $index ."').blur(function(e){
        $('#costoTotal_". $index ."').val(redondeo(suma($('#cantidad_".  $index ."').val()*$('#costo_". $index ."').val(),$('#adicional_". $index ."').val())));
        calcular_total();
        return true;
    });

    $('#adicional_". $index ."').blur(function(e){
        $('#costoTotal_". $index ."').val(redondeo(suma($('#cantidad_". $index ."').val()*$('#costo_". $index ."').val(),$('#adicional_". $index ."').val())));
        calcular_total();
        return true;
    });
    $('#costoTotal_". $index ."').change(function(e){
        calcular_total();
        return true;
    })

    $('#cantidad_". $index ."').keydown(function(e){
        if(e.keyCode==13 || e.keyCode==9)
        {
            $('#costo_". $index ."').focus();
            return true;
        }
    });
</script>
";?>