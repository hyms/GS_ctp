<?php
    /* @var $this yii\web\View */
    $this->title = 'Venta-Ordenes';
?>
<div class="row">
    <?php echo $this->render('menus/ordenMenu'); ?>
</div>
<br>
<div class="row">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "pendiente":
                    echo $this->render('tables/ordenes', ['orden' => $orden]);
                    break;
                case "buscar":
                    echo $this->render('tables/buscar', ['orden' => $orden, 'search' => $search]);
                    echo $this->render('scripts/tooltip');
                    break;
                case "deuda":
                    echo $this->render('tables/deudores', ['orden' => $orden, 'search' => $search]);
                    echo $this->render('scripts/tooltip');
                    break;
                case "venta":
                    echo $this->render('forms/venta', [
                        'clientes' => $clientes,
                        'search'   => $search,
                        'orden'    => $orden,
                        'detalle'  => $detalle,
                        'monto'    => $monto,
                    ]);
                    break;
                case "pagoDeuda":
                    echo $this->render('forms/deuda', ['orden' => $orden, 'deuda' => $deuda, 'model' => $model]);
                    break;
                case "deudas":
                    echo $this->render('tables/deudas', ['deudas' => $deudas, 'search' => $search]);
                    break;
                case "diario":
                    echo $this->render('tables/movimientos', ['ordenes' => $ordenes, 'search' => $search]);
                    break;
                case "recibos":
                    echo $this->render('tables/recibos', ['recibos' => $recibos, 'search' => $search]);
                    echo $this->render('scripts/modal');
                    break;
                case "cajaChica":
                    echo $this->render('tables/cajaChicas', ['cajasChicas' => $cajasChicas, 'search' => $search]);
                    echo $this->render('scripts/modal');
                    break;
                case "arqueo":
                    echo $this->render('menus/arqueo');
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
                    echo $this->render('menus/arqueo');
                    //$this->renderPartial('tables/arqueos', array('arqueos' => $arqueos,));
                    break;
            }
        }
    ?>
</div>