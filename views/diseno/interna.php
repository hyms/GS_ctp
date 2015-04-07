<?php
/* @var $this yii\web\View */
$this->title = 'Diseño-Ordenes';
?>

<div class="row">
<?php echo $this->render('menus/ordenMenu'); ?>
</div>
<br>
<div class="row">
    <?php
    if(isset($r)) {
        switch ($r) {
            case 'nuevo':
                echo $this->render('forms/interna',[
                    'orden'=>$orden,
                    'detalle'=>$detalle,
                    'producto'=>$producto,
                ]);
                break;
            case 'buscar':
                echo $this->render('tables/buscar',['orden'=>$orden]);
                break;
            default:
                break;
        }
    }
    ?>
</div>