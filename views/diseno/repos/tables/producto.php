<?php
if(isset($clientes))
{
    ?>
    <div class="row">
    <div class="col-xs-6">
    <h3><span class="label label-default">Placas</span></h3>
<?php
}
$columns = array(
    array(
        'header'=>'Formato',
        'value'=>'$data->fkIdProducto->color',
    ),
    array(
        'header'=>'Tamaño',
        'value'=>'$data->fkIdProducto->descripcion',
    ),
    array(
        'header'=>'Stock',
        'value'=>'$data->cantidad',
    ),
    array(
        'header'=>'',
        'type'=>'raw',
        'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-ok\"></span> Añadir","#",array("onclick"=>\'newRow("\'.$data->idProductoStock.\'","\'.CHtml::normalizeUrl(array("repos/addDetalleI")).\'");return false;\',"class"=>"btn btn-success btn-sm"))',
    ),
);
$this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$productos->searchProducto()));
?>
<?php
if(isset($clientes)) {
    echo "</div>";
    $this->renderPartial('tables/clientes', array('clientes' => $clientes));
    echo "</div>";
}
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/addList.js',CClientScript::POS_HEAD); ?>