<?php
/* @var $this yii\web\View */
$this->title = 'Venta-Ordenes';
?>
<div class="row">
    <?php echo $this->render('menus/ordenMenu'); ?>
</div>
<br>
<div class="row">
    <?php
    if(isset($r)){
        switch($r){
            case "pendiente":
                echo $this->render('tables/ordenes',['orden'=>$orden]);
                break;
            case "venta":
                echo $this->render('forms/venta',[
                    'clientes'=>$clientes,
                    'search'=>$search,
                    'orden'=>$orden,
                    'detalle'=>$detalle,
                ]);
                break;
        }
    }
    ?>
</div>