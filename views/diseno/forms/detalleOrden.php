<?php
    use yii\helpers\Html;

?>
    <div class="table-responsive">
        <table id="ywventa" class="table table-condensed table-hover">
            <thead class="tabular-header"><tr>
                <?= Html::tag('td', Html::label('Nº','number')) ?>
                <?= Html::tag('td', Html::label('Formato','formato')) ?>
                <?= Html::tag('td', Html::label('Nº de placas','nro placas')) ?>
                <?= Html::tag('td', Html::label('Full','f')) ?>
                <?= Html::tag('td', Html::label('C','c')) ?>
                <?= Html::tag('td', Html::label('M','m')) ?>
                <?= Html::tag('td', Html::label('Y','y')) ?>
                <?= Html::tag('td', Html::label('B','k')) ?>
                <?= Html::tag('td', Html::label('Trabajo','trabajo')) ?>
                <?= Html::tag('td', Html::label('Pinza','pinza')) ?>
                <?= Html::tag('td', Html::label('Resol.','resolucion')) ?>

                <?php if($orden->tipoOrden==0) {
                    echo Html::tag('td', Html::label('Adicional', 'adicional'));
                } ?>
                <?= Html::tag('td', '') ?>
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
                                    'tipo'=>$orden->tipoOrden,
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
<?= $this->render('../scripts/removeList'); ?>