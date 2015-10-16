<?php
    $this->title = 'Venta-Caja';
    use yii\helpers\Html;

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
                        echo $this->render('@app/views/share/scripts/modal',['nameTable'=>'cajaChica']);
                        break;
                    case "recibos":
                        echo $this->render('tables/recibos', ['recibos' => $recibos, 'search' => $search]);
                        echo $this->render('@app/views/share/scripts/modal',['nameTable'=>'recibo']);
                        break;
                    case "arqueos":
                        echo $this->render('tables/arqueos', ['arqueos' => $arqueos, 'search' => $search]);
                        break;
                    case "arqueo":
                        //echo $this->render('menus/arqueo');
                            echo Html::beginTag('div',['class'=>'row']);
                            echo Html::tag('div',
                                           $this->render('tables/registroDiario',
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
                                                         ]),
                                           ['class'=>'col-md-9']);
                            echo Html::tag('div',
                                           $this->render("forms/arqueo",
                                                         [
                                                             'saldo'   => $saldo,
                                                             'arqueo'  => $arqueo,
                                                             'caja'    => $caja,
                                                             'fecha'   => $fecha,
                                                             'ventas'  => $ventas,
                                                             'recibos' => $recibos,
                                                             'dia'     => $dia,
                                                         ]),
                                           ['class'=>'col-md-3']);
                            echo Html::endTag('div');
                        break;
                }
            }
        ?>
    </div>
</div>