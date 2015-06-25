<div class="form-group" style="width:793px; height:529px;">

    <h3 class="text-right">COMPROBANTE DE ENTREGA <?= $arqueo->correlativoCierre;?></h3>
    <div class="text-right"><strong><?= date("d/m/Y - H:i",strtotime($arqueo->time));?></strong></div>
    <div class="col-xs-12"><strong>Recivo de:</strong><span class="text-capitalize"><?= " ".$arqueo->fkIdUser->nombre." ".$arqueo->fkIdUser->apellido;?></span></div>
    <div class="col-xs-4"><strong>La suma de:</strong><?= " ".$arqueo->monto;?> Bs.</div>
    <div class="col-xs-4"><strong>Saldo de:</strong><?= " ".$arqueo->saldoCierre?></div>
    <div class="col-xs-12"><strong>Por concepto:</strong><?= " ".$arqueo->observaciones;?></div>

    <div class="col-xs-12">
        <div class="col-xs-offset-1 col-xs-4 well" style="border-color: #000000; background-color: #FFFFFF">
            <br><br><br>
            <div class="text-center"><small><?= "firma";?></small></div>
            <div class="text-justify"><strong><span class="text-capitalize"><?= "Nombre y AP: ";?></strong></span></div>
            <div class="text-justify"><strong><?= "CI: ";?></strong></div>
            <div class="text-center"><small><?= "Entregue conforme";?></small></div>
        </div>
        <div class="col-xs-offset-1 col-xs-4 well" style="border-color: #000000; background-color: #FFFFFF">
            <br><br><br>
            <div class="text-center"><small><?= "firma";?></small></div>
            <div class="text-justify"><strong><?= "Nombre y AP:";?></strong></div>
            <div class="text-justify"><strong><?= "CI:";?></strong></div>
            <div class="text-center"><small><?= "Recibi conforme";?></small></div>
        </div>
    </div>

</div>