<?php
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $fecha = $dias[date('w',strtotime($fecha))]." ".date('d',strtotime($fecha))." de ".$meses[date('n',strtotime($fecha))-1]. " del ".date('Y',strtotime($fecha));
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <strong>REGISTRO DIARIO</strong>
        </h3>
    </div>
    <div class="panel-body">
        <div class="text-right"><?php echo ((!empty(Yii::$app->user->identity->fk_idSucursal))?Yii::$app->user->identity->fkIdSucursal->nombre:"").", ".$fecha;?></div>
    </div>
    <?php $total=0;?>
    <table class="table table-hover table-condensed">
        <thead>
        <tr>
            <th>Comprobante</th>
            <th>Detalle</th>
            <th>Ingreso</th>
            <th>Egreso</th>
            <th>Saldo</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td></td>
            <td><?php echo "SALDO";?></td>
            <td><?php echo $saldo;?></td>
            <td></td>
            <td><?php $total=$saldo;	echo $total;?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo "TOTAL DE INGRESOS";?></td>
            <td><?php echo ($ventas+$deudas);?></td>
            <td></td>
            <td><?php $total=$total+$ventas+$deudas; 	echo $total;?></td>
        </tr>
        <?php if(is_array($recibos)){?>
            <?php foreach($recibos as $recibo){?>
                <tr>
                    <td><?php echo $recibo->codigo;?></td>
                    <td><?php echo $recibo->fkIdMovimientoCaja->observaciones;?></td>
                    <td><?php echo (!$recibo->tipoRecibo)?$recibo->fkIdMovimientoCaja->monto:"";?></td>
                    <td><?php echo ($recibo->tipoRecibo)?$recibo->fkIdMovimientoCaja->monto:"";?></td>
                    <td><?php $total=($recibo->tipoRecibo)?($total-$recibo->fkIdMovimientoCaja->monto):($total+$recibo->fkIdMovimientoCaja->monto);	echo $total;?></td>
                </tr>
            <?php }?>
        <?php }else{?>
            <tr>
                <td></td>
                <td><?php echo "Recibos del día";?></td>
                <td><?php echo ($recibos>0)?$recibos:"";?></td>
                <td><?php echo ($recibos<0)?($recibos*(-1)):"";?></td>
                <td><?php $total=$total+$recibos;	echo $total;?></td>
            </tr>
        <?php }?>
        <tr>
            <td></td>
            <td>CAJA CHICA GASTOS</td>
            <td></td>
            <td><?php echo $cajas;?></td>
            <td><?php $total=$total-$cajas;	echo $total;?></td>
        </tr>
        <?php if($arqueo!=""){?>
            <tr>
                <td><?php echo $arqueo->correlativo;?></td>
                <td><?php echo $arqueo->fkIdMovimientoCaja->obseraciones;?></td>
                <td></td>
                <td><?php echo $arqueo->fkIdMovimientoCaja->monto;?></td>
                <td><?php $total=$total-$arqueo->fkIdMovimientoCaja->monto; echo $total;?></td>
            </tr>
        <?php }?>
        <tr>
            <td colspan="4" class="text-right"><strong>Total Saldo</strong></td>
            <td><?php echo $total;?></td>
        </tr>
        </tbody>
    </table>
</div>
