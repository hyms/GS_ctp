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
                    echo "<div class='col-xs-3'>";
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
                    echo "</div>";
                    echo "<div class='col-xs-9'>";
                    $comprobante = '';
                    $detalle     = '';
                    $arqueo      = '';
                    echo $this->render('tables/registroDiario',
                        [
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
                    echo "</div>";
                    break;
                case "arqueos":
                    echo $this->render('tables/arqueos', ['arqueos' => $arqueos,'search'=>$search]);
                    break;
            }
        }
    ?>
</div>