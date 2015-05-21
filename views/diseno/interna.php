<?php
    /* @var $this yii\web\View */
    $this->title = 'Diseño-Ordenes Internas';
?>

<div class="row">
    <div class="col-xs-2">
        <?= $this->render('menus/internaMenu',['sucursales'=>$sucursales]); ?>
    </div>
    <div class="col-xs-10">
        <?php
            if(isset($r)) {
                switch ($r) {
                    case 'nuevo':
                        echo $this->render('forms/cliente',[
                            'orden'=>$orden,
                            'detalle'=>$detalle,
                            'producto'=>$producto,
                        ]);
                        break;
                    case 'buscar':
                        echo $this->render('tables/buscarRI',['orden'=>$orden]);
                        break;
                    default:
                        break;
                }
            }
        ?>
    </div>
</div>