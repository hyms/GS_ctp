<?php
/* @var $this yii\web\View */
$this->title = 'Diseño-Ordenes';
?>

<div class="col-xs-2">
<? echo $this->render('menus/ordenMenu'); ?>
</div>

<div class="col-xs-10">
    <?php
    if(isset($r)) {
        switch ($r) {
            case 'nuevo':
                echo $this->render('forms/ordenCliente',['orden'=>$orden]);
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