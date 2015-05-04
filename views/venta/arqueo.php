<?php
    /* @var $this yii\web\View */
    $this->title = 'Venta-Ordenes';
?>
<div class="row">
    <?php echo $this->render('menus/arqueo');; ?>
</div>
<br>
<div class="row">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "arqueo":
                    echo $this->render("forms/arqueo",
                        array(
                            'saldo'   => $saldo,
                            'arqueo'  => $arqueo,
                            'caja'    => $caja,
                            'fecha'   => $fecha,
                            'ventas'  => $ventas,
                            'recibos' => $recibos,
                            'dia'     => $dia,
                        ));
                    $comprobante = '';
                    $detalle     = '';
                    $arqueo      = '';
                    echo $this->render('tables/registroDiario',
                        [
                            'sucursal'    => "LA PAZ",
                            'fecha'       => $fecha,
                            'saldo'       => $saldo,
                            'ventas'      => $ventas,
                            'deudas'      => $deudas,
                            'recibos'     => $recibos,
                            'cajas'       => $cajas,
                            'comprobante' => $comprobante,
                            'detalle'     => $detalle,
                            'arqueo'      => $arqueo,
                        ]);
                    break;
                case "arqueos":
                    //$this->renderPartial('tables/arqueos', array('arqueos' => $arqueos,));
                    break;
            }
        }
    ?>
</div>