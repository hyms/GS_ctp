<div style="width:793px; height:529px;">
    <div class="col-xs-12">
        <div class="row">
            <h3 class="col-xs-offset-2 col-xs-7 text-center"><strong><?php echo "Pago de Deuda";?></strong></h3>
            <div class="col-xs-5"><strong><?php echo "CODIGO:";?></strong> <?php echo $orden->codigoServicio;?></div>
            <div class="col-xs-5"><strong><?php echo "FECHA:";?></strong> <?php echo date("d-m-Y",strtotime($deuda->fecha));?></div>
        </div>

        <div class="row">
            <div class="col-xs-5"><strong>Cliente: </strong><?php echo $orden->fkIdCliente->nombreNegocio; ?></div>
            <div class="col-xs-5"><strong>NitCi: </strong><?php echo $orden->fkIdCliente->nitCi; ?></div>
        </div>
        <div class="row">
            <div class="col-xs-5"><strong>Responsable: </strong><?php echo $orden->responsable; ?></div>
            <div class="col-xs-5"><strong>Telefono: </strong><?php echo $orden->telefono; ?></div>
        </div>

        <div class="row well well-sm" style="height:180px; font-size: 11px; border-color: #000000">
            <table class="table table-condensed">
                <thead><tr>
                    <th><?php echo "Nº"; ?></th>
                    <th><?php echo "Nº Placas"; ?></th>
                    <th><?php echo "Colores"; ?></th>
                    <th><?php echo "Formato"; ?></th>
                    <th><?php echo "Trabajo"; ?></th>
                    <th><?php echo "Pinza"; ?></th>
                    <th><?php echo "Resol."; ?></th>
                    <th><?php echo "Costo"; ?></th>
                    <th><?php echo "Adicional"; ?></th>
                    <th><?php echo "Total"; ?></th>
                </tr></thead>

                <tbody>
                <?php $i=0; foreach ($orden->detalleServicios as $producto){ $i++;?>
                    <tr>
                        <td>
                            <?php echo $i;?>
                        </td>
                        <td>
                            <?php echo $producto->cantidad; ?>
                        </td>
                        <td>
                            <?php echo (($producto->C)?"<strong>C </strong>":"").(($producto->M)?"<strong>M </strong>":"").(($producto->Y)?"<strong>Y </strong>":"").(($producto->K)?"<strong>K </strong>":"");?>
                        </td>
                        <td>
                            <?php echo $producto->fkIdProductoStock->fkIdProducto->color;?>
                        </td>
                        <td>
                            <?php echo $producto->trabajo;?>
                        </td>
                        <td>
                            <?php echo $producto->pinza;?>
                        </td>
                        <td>
                            <?php echo $producto->resolucion;?>
                        </td>
                        <td>
                            <?php echo $producto->costo;?>
                        </td>
                        <td>
                            <?php echo $producto->adicional;?>
                        </td>
                        <td>
                            <?php echo $producto->total;?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <strong>Total:  </strong><?php $this->widget('ext.numerosALetras', array('valor'=>$orden->montoVenta,'despues'=>''))?> Bs.
        </div>
        <div class="row">
            <div class="col-xs-5">
                <div class="row">
                    <div class="col-xs-11 well well-sm" style="border-color: #000000;">
                        <h5><strong>Deuda</strong></h5>
                        <div class="row col-xs-5"><strong>Cancel.:</strong> <?php echo $deuda->montoPagado." Bs";?></div>
                        <div class="row col-xs-5"><strong>Saldo:</strong> <?php echo ($orden->montoVenta - $deuda->montoPagado)." Bs";?></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-5 col-xs-offset-1">
                <div class="row">
                    <div class="col-xs-11 well well-sm" style="border-color: #000000;">
                        <h5><strong>Cancelado</strong></h5>
                        <div class="row col-xs-5"><strong>A/C:</strong> <?php echo $deuda->acuenta." Bs";?></div>
                        <div class="row col-xs-5"><strong>Saldo:</strong> <?php echo $deuda->saldo." Bs";?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
