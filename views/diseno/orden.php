<?php
/* @var $this yii\web\View */
$this->title = 'Diseño-Ordenes';
?>

<div class="col-sm-2">
<?php echo $this->render('menus/ordenMenu'); ?>
</div>

<div class="col-sm-10">
    <?php
    if(isset($r)) {
        switch ($r) {
            case 'nuevo':
                echo $this->render('forms/ordenCliente',[
                    'orden'=>$orden,
                    'producto'=>$producto,
                    'search'=>$search,
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