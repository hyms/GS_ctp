<?php
    $mes = array(
        '01'=>'Enero',
        '02'=>'Febrero',
        '03'=>'Marzo',
        '04'=>'Abril',
        '05'=>'Mayo',
        '06'=>'Junio',
        '07'=>'Julio',
        '08'=>'Agosto',
        '09'=>'Septiembre',
        '10'=>'Octubre',
        '11'=>'Noviembre',
        '12'=>'Diciembre',
    );
    ?>
<div style="width:793px; height:529px;">
    <div class="col-xs-12">
        <div class="row">
            <h2 class="col-xs-offset-3 col-xs-5 text-center"><strong><?php echo "Recibo de ".(($recibo->tipoRecibo)?"Egreso":"Ingreso");?></strong></h2>
            <div class="col-xs-3"><div class="well well-sm" style="border-color: #000000;"><strong>BS: </strong><?php echo $recibo->monto?></div></div>
        </div>
        <p>
            <strong><?php echo (($recibo->tipoRecibo)?"Pagué a:   ":"Recibí de:   ")?></strong> <?php echo $recibo->nombre; ?>
        </p>
        <p>
            <strong>La Suma de:  </strong><?php $this->widget('ext.numerosALetras', array('valor'=>$recibo->monto,'despues'=>''))?> Bolivianos.
        </p>
        <p>
            <strong>Por concepto de:  </strong><?php echo $recibo->detalle; ?>
        </p>
        <div class="row">
            <div class="col-xs-3"><div class="well well-sm" style="border-color: #000000;"><strong>A/C:</strong><?php echo $recibo->acuenta?></div></div>
            <div class="col-xs-3"><div class="well well-sm" style="border-color: #000000;"><strong>Saldo:</strong><?php echo $recibo->saldo?></div></div>
            <h5 class="col-xs-4"><?php echo "La Paz, ";?><?php echo date("d",strtotime($recibo->fechaRegistro))." de ".$mes[date("m",strtotime($recibo->fechaRegistro))]." de ". date("Y",strtotime($recibo->fechaRegistro));?></h5>
        </div>
        <div class="row">
            <div class="col-xs-5">
                <div class="row">
                    <div class="col-xs-11 well well-sm" style="border-color: #000000;">
                        <br><br><br>
                        <div class="text-center" style="font-size: 11px"><?php echo "firma";?></div>
                        <div><?php echo "Nombre: ".(($recibo->tipoRecibo)?($recibo->fkIdUser->nombre." ".$recibo->fkIdUser->apellido):$recibo->nombre)?></div>
                        <div class="text-center" style="font-size: 11px"><small><?php echo "Entregué Conforme";?></small></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-5 col-xs-offset-1">
            <div class="row">
                <div class="col-xs-11 well well-sm" style="border-color: #000000;">
                    <br><br><br>
                    <div class="text-center" style="font-size: 11px"><?php echo "firma";?></div>
                    <div><?php echo "Nombre: ".(($recibo->tipoRecibo)?$recibo->nombre:($recibo->fkIdUser->nombre." ".$recibo->fkIdUser->apellido))?></div>
                    <div class="text-center" style="font-size: 11px"><small><?php echo "Recibí Confirme";?></small></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>