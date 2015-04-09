<div class="form-group" style="width:793px; height:529px;">

    <h3 class="text-right">COMPROBANTE DE ENTREGA <?php echo $arqueo->correlativo;?></h3>
    <div class="text-right"><strong><?php echo date("d/m/Y",strtotime($arqueo->fechaMovimientos));?></strong></div>
    <div class="col-xs-12"><strong>Recivo de:</strong><?php echo " ".$arqueo->fkIdMovimientoCaja->fkIdUser->nombre." ".$arqueo->fkIdMovimientoCaja->fkIdUser->apellido;?></div>
    <div class="col-xs-3"><strong>La suma de:</strong><?php echo " ".$arqueo->monto;?> Bs.</div>
    <div class="col-xs-5"><strong>Por concepto:</strong><?php echo " ".$arqueo->fkIdMovimientoCaja->obseraciones;?></div>
    <div class="col-xs-5"><strong>Cancelado a:</strong><?php echo " ADMINISTRACION"?></div>
    <div class="col-xs-12">
        <div class="col-xs-offset-1 col-xs-4 well">
            <br><br><br>
            <div class="text-center"><small><?php echo "firma";?></small></div>
            <div class="text-justify"><strong><?php echo "Nombre y AP: ";?></strong><?php echo $arqueo->fkIdMovimientoCaja->fkIdUser->nombre." ".$arqueo->fkIdMovimientoCaja->fkIdUser->apellido;?></div>
            <div class="text-justify"><strong><?php echo "CI: ";?></strong><?php echo $arqueo->fkIdMovimientoCaja->fkIdUser->CI;?></div>
            <div class="text-center"><small><?php echo "Entregue conforme";?></small></div>
        </div>
        <div class="col-xs-offset-1 col-xs-4 well">
            <br><br><br>
            <div class="text-center"><small><?php echo "firma";?></small></div>
            <div class="text-justify"><strong><?php echo "Nombre y AP:";?></strong></div>
            <div class="text-justify"><strong><?php echo "CI:";?></strong></div>
            <div class="text-center"><small><?php echo "Recibi conforme";?></small></div>
        </div>
    </div>

</div>