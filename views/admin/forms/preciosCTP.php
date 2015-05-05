<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    $form = ActiveForm::begin(['layout' => 'horizontal']);
?>
    <table class="table table-condensed table-hover">
        <tr>
            <td></td>
            <td></td>
            <?php foreach ($clienteTipos as $clienteTipo){?>
                <td class="text-center">
                    <strong><?php echo $clienteTipo->nombre; ?></strong>
                </td>
            <?php }?>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <?php foreach ($clienteTipos as $clienteTipo){?>
                <td class="text-center">
                    <div class="col-xs-6 text-center"><strong>CF</strong></div>
                    <div class="col-xs-6 text-center"><strong>SF</strong></div>
                </td>
            <?php }?>
        </tr>
        <?php
            $ccant = count($cantidades);
            foreach($cantidades as $keyc => $cantidad ) {
                foreach ($horas as $keyh => $hora) {
                    echo '<tr>';
                    echo ($keyh == 0) ? ('<td>' . Html::textInput('cantidad[' . $keyc . ']', $cantidad->cantidad, ['class' => 'form-control']) . '</td>') : ('<td></td>');
                    echo '<td>' . Html::textInput('hora[' . $keyh . ']', $hora->hora, ['class' => 'form-control', 'disabled' => ($keyc != 0)]) . '</td>';
                    foreach ($clienteTipos as $clienteTipo) {
                        echo '<td class="text-center">';
                        $precios = precios::preciosServicio($placa->idProductoStock, $clienteTipo->idTipoCliente, $cantidad->cantidad, $hora->hora);
                        if ($model != "") {
                            $precios[0]->attributes = $model[precios::getPrecio($model, $precios[0]->idPrecioProductoOrden)]->attributes;
                        }
                        echo '<div class="col-xs-6">';
                        echo Html::activeTextInput($precios[0], '[' . $precios[0]->idPrecioProductoOrden . ']precioCF', array('class' => 'form-control'));
                        echo '</div>';
                        echo '<div class="col-xs-6">';
                        echo Html::activeTextInput($precios[0], '[' . $precios[0]->idPrecioProductoOrden . ']precioSF', array('class' => 'form-control'));
                        echo '</div>';
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            }
        ?>
    </table>
<?php ActiveForm::end(); ?>