<?php if(!empty($arqueos)){?>
    <div class="panel panel-default">
        <div class="panel-body" style="overflow: auto;">
            <?php

                $columns=array(
                    array(
                        'header'=>'Nro',
                        'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                    ),
                    array(
                        'header'=>'Usuario',
                        'value'=>'$data->fkIdMovimientoCaja->fkIdUser->nombre." ".$data->fkIdMovimientoCaja->fkIdUser->apellido',
                    ),
                    array(
                        'header'=>'Monto',
                        'value'=>'$data->monto',
                    ),
                    array(
                        'header'=>'Fecha de Arqueo',
                        'value'=>'$data->fechaArqueo',
                    ),
                    array(
                        'header'=>'Correlativo',
                        'value'=>'$data->correlativo',
                    ),
                    array(
                        'header'=>'',
                        'class'=>'booster.widgets.TbButtonColumn',
                        'template'=>'{update} {print} {registro}',
                        'buttons'=>array(
                            'update'=>
                                array(
                                    'url'=>'#',
                                    'label'=>'Modificar',
                                    'visible'=>'false',
                                ),
                            'print'=>
                                array(
                                    'url'=>'array("ctp/comprobante","id"=>$data->idArqueoCaja)',
                                    'label'=>'imprimir',
                                    'icon'=>'print',
                                ),
                            'registro'=>
                                array(
                                    'url'=>'array("ctp/registroDiario","id"=>$data->idArqueoCaja)',
                                    'label'=>'Registro Diario',
                                    'icon'=>'list-alt',
                                ),
                        ),
                    ),
                    /*array(
                        'header'=>'',
                        'type'=>'raw',
                        'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-print\"></span>", array("ctp/comprobante","id"=>$data->idArqueoCaja))',
                    ),
                    array(
                        'header'=>'',
                        'type'=>'raw',
                        'value'=>'CHtml::link("<span class=\"glyphicon glyphicon-list-alt\"></span> Registro Diario", array("ctp/registroDiario","id"=>$data->idArqueoCaja))',
                    ),*/
                );
                $this->renderPartial('/baseTable',array('columns'=>$columns,'data'=>$arqueos))
            ?>
        </div>
    </div>
<?php } ?>