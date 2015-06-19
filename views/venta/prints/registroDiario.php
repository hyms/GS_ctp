<?php
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $fecha = $dias[date('w',strtotime($fecha))]." ".date('d',strtotime($fecha))." de ".$meses[date('n',strtotime($fecha))-1]. " del ".date('Y',strtotime($fecha));
?>
<div>
    <h3 class="text-center"><strong><?php echo "REGISTRO DIARIO"?></strong></h3>
    <div class="text-right"><?php echo ((!empty(Yii::$app->user->identity->fk_idSucursal))?Yii::$app->user->identity->fkIdSucursal->nombre:"").", ".$fecha;?></div>
    <?php $total=0;?>
    <table class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="border: 1px solid black; text-align: center;">Comprobante</th>
            <th style="border: 1px solid black; text-align: center;">Detalle</th>
            <th style="border: 1px solid black; text-align: center;">Ingreso</th>
            <th style="border: 1px solid black; text-align: center;">Egreso</th>
            <th style="border: 1px solid black; text-align: center;">Saldo</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"><?php echo "SALDO";?></td>
            <td style="border: 1px solid black;"><?php echo $saldo;?></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"><?php $total=$saldo;	echo $total;?></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"><?php echo "TOTAL DE INGRESOS";?></td>
            <td style="border: 1px solid black;"><?php echo ($ventas+$deudas);?></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"><?php $total=$total+$ventas+$deudas; 	echo $total;?></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;">Recibos de Ingreso</td>
            <td style="border: 1px solid black;"><?= $recibos[1];?></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"><?php $total=$total+$recibos[1];	echo $total;?></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;">Recibos de Engreso</td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"><?= $recibos[0];?></td>
            <td style="border: 1px solid black;"><?php $total=$total-$recibos[0];	echo $total;?></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"><?php echo "CAJA CHICA GASTOS";?></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"><?php echo $cajas;?></td>
            <td style="border: 1px solid black;"><?php $total=$total-$cajas;	echo $total;?></td>
        </tr>
        <tr>
            <td style="border: 1px solid black;"><?php echo $arqueo->correlativoCierre;?></td>
            <td style="border: 1px solid black;"><?php echo $arqueo->observaciones;?></td>
            <td style="border: 1px solid black;"></td>
            <td style="border: 1px solid black;"><?php echo $arqueo->monto;?></td>
            <td style="border: 1px solid black;"><?php $total=$total-$arqueo->monto; 	echo $total;?></td>
        </tr>
        <tr>
            <td colspan="4" class="text-right"><strong>Total Saldo</strong></td>
            <td style="border: 1px solid black;"><?php echo $total;?></td>
        </tr>
        </tbody>
    </table>
    <div class="row">
        <div class="col-xs-offset-1 col-xs-4 well">
            <br><br>
            <p class="text-center"><?php echo "firma";?></p>
            <span><?php echo "Nombre: ".Yii::$app->user->identity->nombre." ".Yii::$app->user->identity->apellido?></span>
            <p class="text-center"><?php echo "Entregue conforme";?></p>
        </div>
        <div class="col-xs-offset-1 col-xs-4 well">
            <br><br>
            <p class="text-center"><?php echo "firma";?></p>
            <span><?php echo "Nombre: Miriam Martinez";?></span>
            <p class="text-center"><?php echo "Recibi conforme";?></p>
        </div>
    </div>
</div>