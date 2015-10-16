<?php
    use yii\helpers\Html;

?>
<div class="table-responsive">
    <table id="ywventa" class="table table-condensed table-hover">
        <thead class="tabular-header"><tr>
            <?= Html::tag('th',Html::label('Nº','number')); ?>
            <?= Html::tag('th',Html::label('Formato','formato')); ?>
            <?= Html::tag('th',Html::label('Nº de placas','nro placas')); ?>
            <?= Html::tag('th',Html::label('C','c')); ?>
            <?= Html::tag('th',Html::label('M','m')); ?>
            <?= Html::tag('th',Html::label('Y','y')); ?>
            <?= Html::tag('th',Html::label('B','k')); ?>
            <?= Html::tag('th',Html::label('Trabajo','trabajo')); ?>
            <?= Html::tag('th',Html::label('Pinza','pinza')); ?>
            <?= Html::tag('th',Html::label('Resol.','resolucion')); ?>
            <?= Html::tag('th',Html::label('Costo','costo')); ?>
            <?= Html::tag('th',Html::label('Adic.','adicional')); ?>
            <?= Html::tag('th',Html::label('Total','total')); ?>
            <?= Html::tag('th',''); ?>
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
</div>