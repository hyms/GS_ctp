<?php
    /* @var $this yii\web\View */
    $this->title = 'Diseño-Ordenes';
?>

<div class="row">
    <div class="col-xs-2">
        <?php echo $this->render('menus/ordenMenu'); ?>
    </div>
    <div class="col-xs-10">
        <?php
            if(isset($r)) {
                switch ($r) {
                    case 'nuevo':
                        echo $this->render('forms/cliente', [
                            'orden'    => $orden,
                            'detalle'  => $detalle,
                            'producto' => $producto,
                        ]);
                        break;
                    case 'buscar':
                        echo $this->render('tables/buscar', ['orden' => $orden]);
                        break;
                    case 'list':
                        echo $this->render('tables/ordenes', ['orden' => $orden, 'search' => $search]);
                        echo $this->render('scripts/tooltip');
                        break;
                }
            }
        ?>
    </div>
</div>