<?php
    /* @var $this yii\web\View */
    $this->title = 'Venta-Caja';
?>
<div class="row">
    <div class="col-xs-2">
        <?= $this->render('menus/cajaMenu'); ?>
    </div>
    <div class="col-xs-10">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "cajaChica":
                    echo $this->render('tables/cajaChicas', ['cajasChicas' => $cajasChicas, 'search' => $search]);
                    echo $this->render('scripts/modal');
                    break;
                case "recibos":
                    echo $this->render('tables/recibos', ['recibos' => $recibos, 'search' => $search]);
                    echo $this->render('scripts/modal');
                    break;
                case "arqueos":
                    echo $this->render('tables/arqueos', ['arqueos' => $arqueos,'search'=>$search]);
                    break;
                case "arqueo":
                    echo $this->render('menus/arqueo');
                    if(isset($saldo)) {
                        echo  "<br><div class='row'>";
                        echo "<div class='col-xs-9'>";
                        echo $this->render('tables/registroDiario',
                            [
                                'fecha'       => $fecha,
                                'saldo'       => $saldo,
                                'ventas'      => $ventas,
                                'deudas'      => $deudas,
                                'recibos'     => $recibos,
                                'cajas'       => $cajas,
                                'comprobante' => '',
                                'detalle'     => '',
                                'arqueo'      => '',
                            ]);
                        echo "</div>";
                        echo "<div class='col-xs-3'>";
                        echo $this->render("forms/arqueo",
                                           [
                                               'saldo'   => $saldo,
                                               'arqueo'  => $arqueo,
                                               'caja'    => $caja,
                                               'fecha'   => $fecha,
                                               'ventas'  => $ventas,
                                               'recibos' => $recibos,
                                               'dia'     => $dia,
                                           ]);
                        echo "</div>";

                        echo "</div>";
                    }
                    break;
            }
        }
    ?>
    </div>
</div>