<?php
/* @var $this yii\web\View */
$this->title = 'Diseño-Ordenes';
?>

<div class="row">
<?= $this->render('menus/internaMenu'); ?>
</div>
<br>
<div class="row">
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