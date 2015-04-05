<table id="ywventa" class="items table table-condensed table-hover">
    <thead class="tabular-header"><tr>
        <td><?php echo CHtml::label('Nº','number')?></td>
        <td><?php echo CHtml::label('Formato','formato')?></td>
        <td><?php echo CHtml::label('Nº de placas','nro placas')?></td>
        <td><?php echo CHtml::label('Full','f')?></td>
        <td><?php echo CHtml::label('C','c')?></td>
        <td><?php echo CHtml::label('M','m')?></td>
        <td><?php echo CHtml::label('Y','y')?></td>
        <td><?php echo CHtml::label('B','k')?></td>
        <td><?php echo CHtml::label('Trabajo','trabajo')?></td>
        <td><?php echo CHtml::label('Pinza','pinza')?></td>
        <td><?php echo CHtml::label('Resolucion','resolucion')?></td>
        <td><?php echo CHtml::label('Adicional','adicional')?></td>
        <td></td>
    </tr></thead>
    <tbody class="tabular-input-container">
    <?php
    if(count($detalle)>=1){
        if(!isset($detalle->isNewRecord)){
            foreach ($detalle as $key=>$item){
                if($item->fk_idProductoStock!=null){
                    $this->renderPartial('forms/_newRowDetalleVenta', array(
                        'model'=>$item,
                        'index'=>$key,
                        'costo'=>"cliente",
                        'almacen'=>ProductoStock::model()
                            ->with("fkIdProducto")
                            ->findByPk($item->fk_idProductoStock),
                    ));
                }
            }
        }
    }
    ?>
    </tbody>
</table>
<?php echo $form->textAreaGroup($venta, 'obseraciones'); ?>
<?php
$this->renderPartial('/scripts/operaciones');
$this->renderPartial('/scripts/removeList');