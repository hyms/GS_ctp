<div class="col-xs-6">
    <h3><span class="label label-default">Clientes</span></h3>
    <?php
    $columns = array(
        array(
            'header' => 'NitCi',
            'value' => '$data->nitCi',
            'filter' => CHtml::activeTelField($clientes, 'nitCi', array('class' => 'form-control input-sm')),
        ),
        array(
            'header' => 'Negocio',
            'value' => '$data->nombreNegocio',
            'filter' => CHtml::activeTelField($clientes, 'nombreNegocio', array('class' => 'form-control input-sm')),
        ),
        array(
            'header'=>'',
            'type'=>'raw',
            'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-ok\"></span> Añadir","#",array("onClick"=>$data->onClick(CHtml::normalizeUrl(array("orden/ajaxCliente"))),"class"=>"btn btn-success btn-xs"))',
        )
    );
    $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$clientes->search(),'filter'=>$clientes));
    ?>
</div>