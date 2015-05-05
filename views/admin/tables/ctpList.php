<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<div><?= Html::a(
        '<span class="glyphicon glyphicon-export"></span> Exportar',
        Url::to(["contabilidad/matrizPrecios",'excel'=>true]),
        ["class"=>"btn btn-default hidden-print",'title'=>'Exportar Precios']
    ); ?>
</div>
<br>
<div class="list-group">
    <?php
        foreach($placas as $placa) {
            echo Html::a(
                "<strong>" . $placa->fkIdProducto->material . "</strong> " . $placa->fkIdProducto->formato." ".$placa->fkIdProducto->dimension,
                "#",
                [
                    'class'=>'col-xs-4 list-group-item',
                    'title' => 'Ver Precios',
                    'onclick'  => "
                    $.ajax({
                        type    :'POST',
                        cache   : false,
                        url     : '" . Url::to(['admin/costo','op'=>'precio', 'id' => $placa->idProductoStock]) . "',
                        success : function(data) {
                            if(data.length>0){
                                $('#viewModal .modal-header').html('<strong>" . $placa->fkIdProducto->material . "</strong> " . $placa->fkIdProducto->formato." ".$placa->fkIdProducto->dimension."');
                                $('#viewModal .modal-body').html(data);
                                $('#viewModal').modal();
                            }
                        }
                    });return false;"
                ]
            );
        }
    ?>
</div>
