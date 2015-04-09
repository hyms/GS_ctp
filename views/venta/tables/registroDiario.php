<?php
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $fecha=$dias[date('w',strtotime($fecha))]." ".date('d',strtotime($fecha))." de ".$meses[date('n',strtotime($fecha))-1]. " del ".date('Y',strtotime($fecha));
?>
<div >
    <h3 class="text-center"><strong><?php echo "REGISTRO DIARIO"?></strong></h3>
    <p class="text-right"><?php echo "La Paz, ".$fecha;?></p>
    <?php $total=0;?>
    <table class="table table-hover table-condensed">
        <thead>
        <tr>
            <th <?php echo ($arqueo!="")?'style="border: 1px solid black; text-align: center;"':''?>>Comprobante</th>
            <th <?php echo ($arqueo!="")?'style="border: 1px solid black; text-align: center;"':''?>>Detalle</th>
            <th <?php echo ($arqueo!="")?'style="border: 1px solid black; text-align: center;"':''?>>Ingreso</th>
            <th <?php echo ($arqueo!="")?'style="border: 1px solid black; text-align: center;"':''?>>Egreso</th>
            <th <?php echo ($arqueo!="")?'style="border: 1px solid black; text-align: center;"':''?>>Saldo</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo "SALDO";?></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo $saldo;?></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php $total=$saldo;	echo $total;?></td>
        </tr>
        <tr>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo "TOTAL DE INGRESOS";?></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo ($ventas+$deudas);?></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php $total=$total+$ventas+$deudas; 	echo $total;?></td>
        </tr>
        <?php if(is_array($recibos)){?>
            <?php foreach($recibos as $recibo){?>
                <tr>
                    <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo $recibo->codigo;?></td>
                    <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo "RECIBO DE ".(($recibo->fkIdMovimientoCaja->tipoMovimiento)?"EGRESO":"INGRESO");?></td>
                    <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo (!$recibo->fkIdMovimientoCaja->tipoMovimiento)?$recibo->fkIdMovimientoCaja->monto:"";?></td>
                    <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo ($recibo->fkIdMovimientoCaja->tipoMovimiento)?$recibo->fkIdMovimientoCaja->monto:"";?></td>
                    <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php $total=($recibo->fkIdMovimientoCaja->tipoMovimiento)?($total-$recibo->fkIdMovimientoCaja->monto):($total+$recibo->fkIdMovimientoCaja->monto);	echo $total;?></td>
                </tr>
            <?php }?>
        <?php }else{?>
            <tr>
                <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>></td>
                <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo "Recibos del día";?></td>
                <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo $recibos;?></td>
                <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>></td>
                <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php $total=$total+$recibos;	echo $total;?></td>
            </tr>
        <?php }?>
        <tr>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo "CAJA CHICA GASTOS";?></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo $cajas;?></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php $total=$total-$cajas;	echo $total;?></td>
        </tr>
        <?php if($arqueo!=""){?>
            <tr>
                <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo $arqueo->correlativo;?></td>
                <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo $arqueo->fkIdMovimientoCaja->obseraciones;?></td>
                <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>></td>
                <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo $arqueo->fkIdMovimientoCaja->monto;?></td>
                <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php $total=$total-$arqueo->fkIdMovimientoCaja->monto; 	echo $total;?></td>
            </tr>
        <?php }?>
        <tr>
            <td colspan="4" class="text-right"><strong>Total Saldo</strong></td>
            <td <?php echo ($arqueo!="")?'style="border: 1px solid black;"':''?>><?php echo $total;?></td>
        </tr>
        </tbody>
    </table>
    <?php if($arqueo!=""){?>
        <div class="row">
            <div class="col-xs-offset-1 col-xs-4 well">
                <br><br>
                <p class="text-center"><?php echo "firma";?></p>
                <?php $empleado=User::model()->findByPk(Yii::app()->user->id)?>
                <span><?php echo "Nombre: ".$empleado->nombre." ".$empleado->apellido?></span>
                <p class="text-center"><?php echo "Entregue conforme";?></p>
            </div>
            <div class="col-xs-offset-1 col-xs-4 well">
                <br><br>
                <p class="text-center"><?php echo "firma";?></p>
                <span><?php echo "Nombre: Miriam Martinez";?></span>
                <p class="text-center"><?php echo "Recibi conforme";?></p>
            </div>
        </div>
    <?php }?>
</div>