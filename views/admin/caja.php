<?php
    $this->title = 'Venta-Caja';
?>
<div class="row">
    <div class="col-md-2">
        <?= $this->render('menus/cajaMenu'); ?>
    </div>
    <div class="col-md-10">
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
                        echo $this->render('tables/arqueos', ['arqueos' => $arqueos, 'search' => $search]);
                        break;
                    case "arqueo":
                        echo $this->render('menus/menuArqueo', ['sucursales' => $sucursales]);
                        if (isset($saldo)) {
                            echo "<br><div class='row'>";
                            echo "<div class='col-md-12'>";
                            echo $this->render('tables/registroDiario',
                                               [
                                                   'fecha'   => $fecha,
                                                   'saldo'   => $saldo,
                                                   'ventas'  => $ventas,
                                                   'deudas'  => $deudas,
                                                   'recibos' => $recibos,
                                                   'cajas'   => $cajas,
                                                   'caja'    => $caja,
                                                   'arqueo'  => '',
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