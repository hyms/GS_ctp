<?php
    use yii\helpers\Html;

?>
<table id="ywventa" class="table table-condensed table-hover">
    <thead class="tabular-header"><tr>
        <td><?php echo Html::label('Nº','number')?></td>
        <td><?php echo Html::label('Formato','formato')?></td>
        <td><?php echo Html::label('Nº de placas','nro placas')?></td>
        <td><?php echo Html::label('C','c')?></td>
        <td><?php echo Html::label('M','m')?></td>
        <td><?php echo Html::label('Y','y')?></td>
        <td><?php echo Html::label('B','k')?></td>
        <td><?php echo Html::label('Trabajo','trabajo')?></td>
        <td><?php echo Html::label('Pinza','pinza')?></td>
        <td><?php echo Html::label('Resolucion','resolucion')?></td>
        <td><?php echo Html::label('Costo','costo')?></td>
        <td><?php echo Html::label('Adicional','adicional')?></td>
        <td><?php echo Html::label('Total','total')?></td>
        <td></td>
    </tr></thead>
    <tbody class="tabular-input-container">
    <?php
        if(count($detalle)>=1){
            if(!isset($detalle->isNewRecord)){
                foreach ($detalle as $key=>$item){
                    if(!empty($item['fk_idProductoStock'])){
                        echo $this->render('_newRowDetalleVenta', array(
                            'model'=>$item,
                            'index'=>$key,
                            'costo'=>"cliente",
                            'almacen'=>\app\models\ProductoStock::findOne(['idProductoStock'=>$item['fk_idProductoStock']]),
                        ));
                    }
                }
            }
        }
    ?>
    </tbody>
</table>