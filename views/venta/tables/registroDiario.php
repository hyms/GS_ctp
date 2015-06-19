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
        <div class="text-right"><?= ((!empty(Yii::$app->user->identity->fk_idSucursal))?Yii::$app->user->identity->fkIdSucursal->nombre:"").", ".$fecha;?></div>
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
            <td><?= "SALDO";?></td>
            <td><?= $saldo;?></td>
            <td></td>
            <td><?php $total=$saldo;	echo $total;?></td>
        </tr>
        <tr>
            <td></td>
            <td><?= "TOTAL DE INGRESOS";?></td>
            <td><?= ($ventas+$deudas);?></td>
            <td></td>
            <td><?php $total=$total+$ventas+$deudas; 	echo $total;?></td>
        </tr>

        <tr>
            <td></td>
            <td>Recibos de Ingreso</td>
            <td><?= $recibos[1];?></td>
            <td></td>
            <td><?php $total=$total+$recibos[1];	echo $total;?></td>
        </tr>
        <tr>
            <td></td>
            <td>Recibos de Engreso</td>
            <td></td>
            <td><?= $recibos[0];?></td>
            <td><?php $total=$total-$recibos[0];	echo $total;?></td>
        </tr>
        <tr>
            <td></td>
            <td>CAJA CHICA GASTOS</td>
            <td></td>
            <td><?= $cajas;?></td>
            <td><?php $total=$total-$cajas;	echo $total;?></td>
        </tr>
        <?php if($arqueo!=""){?>
            <tr>
                <td><?= $arqueo->correlativo;?></td>
                <td><?= $arqueo->fkIdMovimientoCaja->obseraciones;?></td>
                <td></td>
                <td><?= $arqueo->fkIdMovimientoCaja->monto;?></td>
                <td><?php $total=$total-$arqueo->fkIdMovimientoCaja->monto; echo $total;?></td>
            </tr>
        <?php }?>
        <tr>
            <td colspan="4" class="text-right"><strong>Total Saldo</strong></td>
            <td><?= $total;?></td>
        </tr>
        </tbody>
    </table>
</div>
