<div class="row">
<div class="col-xs-12">
    <div class="row">
        <h4 class="text-right"><strong><?php echo $venta->codigoServicio; ?></strong></h4>
        <h5 class="col-xs-offset-8 text-right"><strong><?php echo "FECHA:";?></strong> <?php echo date("d-m-Y",strtotime($venta->fechaVenta));?></h5>
        <small class="col-xs-offset-3 col-xs-5 text-center"><?php echo $tipo?></small>
    </div>

    <?php
    if(!empty($venta->fkIdCliente))
    {
        ?>
        <div class="row">
            <div class="col-xs-4"><strong><?php echo "CLIENTE:";?></strong> <?php echo $venta->fkIdCliente->nombreNegocio;?></div>
            <div class="col-xs-2"><strong><?php echo "NIT:";?></strong> <?php echo $venta->fkIdCliente->nitCi;?></div>
            <div class="col-xs-6"><strong><?php echo "RESPONSABLE:";?></strong> <?php echo $venta->fkIdCliente->nombreResponsable;?></div>
        </div>
    <?php
    }
    ?>
    <div class="row">
        <div class="col-xs-4"><strong><?php echo "responsable:";?></strong> <?php echo $venta->responsable;?></div>
        <div class="col-xs-4"><strong><?php echo "telefono:";?></strong> <?php echo $venta->telefono;?></div>
    </div>
    <table class="table table-bordered table-hover table-condensed">
        <thead><tr>
            <th><?php echo "Nº"; ?></th>
            <th><?php echo "Nº Placas"; ?></th>
            <th><?php echo "Colores"; ?></th>
            <th><?php echo "Formato"; ?></th>
            <th><?php echo "Trabajo"; ?></th>
            <th><?php echo "Pinza"; ?></th>
            <th><?php echo "Resol."; ?></th>
            <th><?php echo "Adicional"; ?></th>
            <th><?php echo "Total"; ?></th>
        </tr></thead>

        <tbody>
        <?php $i=0; foreach ($venta->detalleServicios as $key => $item){ ;?>
            <tr>
                <td>
                    <?php echo ($key +1);?>
                </td>
                <td>
                    <?php echo $item->cantidad; ?>
                </td>
                <td>
                    <?php echo (($item->C)?"<strong>C </strong>":"").(($item->M)?"<strong>M </strong>":"").(($item->Y)?"<strong>Y </strong>":"").(($item->K)?"<strong>B </strong>":"");?>
                </td>
                <td>
                    <?php echo $item->fkIdProductoStock->fkIdProducto->color;//$item->formato;?>
                </td>
                <td>
                    <?php echo $item->trabajo;?>
                </td>
                <td>
                    <?php echo $item->pinza;?>
                </td>
                <td>
                    <?php echo $item->resolucion;?>
                </td>
                <td>
                    <?php echo $item->adicional;?>
                </td>
                <td>
                    <?php echo $item->total;?>
                </td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <!--   </div> -->


    <div class="row">
        <div class="col-xs-7">
            <div class="col-xs-8"><strong>Recepcionado Por:</strong> <?php echo $venta->fkIdUserD->nombre." ".$venta->fkIdUserD->apellido;?></div>
            <div class="col-xs-4">
                <?php if(empty($tipo)){?>
                <?php }else{?>
                    <strong>Atrib. a:</strong> <?php echo $venta->fkIdCliente->nombreResponsable;?>
                <?php }?>
            </div>
        </div>
        <div class="col-xs-5">
            <div class="col-xs-12"><strong>obs: </strong><?php if(!empty($venta->obseraciones)){?><br><strong>Diseño: </strong><?php echo $venta->obseraciones;}?><?php if(!empty($venta->obseracionesVenta)){?><br><strong>Caja: </strong><?php $venta->obseracionesVenta;}?></div>
            <div class="col-xs-12"><?php echo $venta->obseracionesAdicional?></div>
        </div>

    </div>

</div></div>