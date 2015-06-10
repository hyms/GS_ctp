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
                        'orden' => $orden,
                        'detalle' => $detalle,
                        'producto' => $producto,
                    ]);
                    echo $this->render('scripts/save');
                    break;
                case 'buscar':
                    echo $this->render('tables/buscar', ['orden' => $orden]);
                    break;
                case 'list':
                    echo $this->render('tables/ordenes', ['orden' => $orden, 'search' => $search]);
                    break;
                case 'nota':
                    echo $this->render('tables/notas', ['notas' => $notas, 'search' => $search, 'tipo' => 0]);
                    break;
            }
        }
        else {
            echo '<div class="col-xs-offset-6 col-xs-6">';
            echo $this->render('tables/notasPendientes', ['notas' => $notas]);
            echo '</div>';
        }
        ?>
    </div>
</div>