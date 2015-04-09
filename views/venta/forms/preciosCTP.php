<?php
    $form = $this->beginWidget(
        'booster.widgets.TbActiveForm',
        array(
            'id'=>'form',
            'type' => 'horizontal',
        )
    );
?>
    <strong><?php echo $placa->fkIdProducto->material; ?></strong> <small><?php echo $placa->fkIdProducto->descripcion; ?></small>
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
                    echo ($keyh == 0) ? ('<td>' . CHtml::textField('cantidad[' . $keyc . ']', $cantidad->cantidad, array('class' => 'form-control','readonly' => true)) . '</td>') : ('<td></td>');
                    echo '<td>' . CHtml::textField('hora[' . $keyh . ']', $hora->hora, array('class' => 'form-control', 'readonly' => true)) . '</td>';
                    foreach ($clienteTipos as $clienteTipo) {
                        echo '<td class="text-center">';
                        $precios = precios::preciosServicio($placa->fk_idProducto, $placa->fk_idAlmacen, $clienteTipo->idTipoCliente, $cantidad->cantidad, $hora->hora);
                        if ($model != "") {
                            $precios[0]->attributes = $model[precios::getPrecio($model, $precios[0]->idPrecioProducto)]->attributes;
                        }
                        echo '<div class="col-xs-6">';
                        echo CHtml::activeTextField($precios[0], '[' . $precios[0]->idPrecioProducto . ']precioCF', array('class' => 'form-control','readonly' => true));
                        echo '</div>';
                        echo '<div class="col-xs-6">';
                        echo CHtml::activeTextField($precios[0], '[' . $precios[0]->idPrecioProducto . ']precioSF', array('class' => 'form-control','readonly' => true));
                        echo '</div>';
                        echo '</td>';
                    }
                    echo '</tr>';
                }
            }
            ?>
    </table>
<?php
    $this->endWidget();
    unset($form);
?>