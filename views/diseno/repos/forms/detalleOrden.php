<div class="table-responsive">
    <?php
        if(!isset($repos)) {
            echo '<table id="ywventa" class="table table-condensed">';
        }
        else {
            echo '<table id="ywrepos" class="table table-condensed">';
        }
    ?>

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
                <td></td>
            </tr></thead>
            <tbody class="tabular-input-container">
            <?php
                if(count($detalle)>=1){
                    if(!isset($detalle->isNewRecord)){
                        foreach ($detalle as $key=>$item){
                            if($item->fk_idProductoStock!=null){
                                if(!isset($repos))
                                    $this->renderPartial('forms/_newRowDetalle', array(
                                                                                   'model'=>$item,
                                                                                   'index'=>$key,
                                                                                   'almacen'=>ProductoStock::model()
                                                                                       ->with("fkIdProducto")
                                                                                       ->findByPk($item->fk_idProductoStock),
                                                                               )
                                    );
                                else
                                    $this->renderPartial('forms/_newRowDetalle', array(
                                                                                   'model'=>$item,
                                                                                   'index'=>$key,
                                                                                   'almacen'=>ProductoStock::model()
                                                                                       ->with("fkIdProducto")
                                                                                       ->findByPk($item->fk_idProductoStock),
                                                                                   'repos'=>$repos,
                                                                               )
                                    );
                            }
                        }
                    }
                }
            ?>
            </tbody></table>
</div>

<div class="col-xs-7">
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($orden,"obseraciones",array('class'=>'control-label col-xs-4'))?>
        <div class="col-xs-8">
            <?php echo CHtml::activeTextArea($orden,"obseraciones",array('class'=>'form-control'))?>
        </div>
        <?php echo CHtml::error($orden,"obseraciones",array('class'=>'label label-danger')); ?>
    </div>
</div>

<?php
    $this->renderPartial('/scripts/operaciones');
    $this->renderPartial('/scripts/removeList');
