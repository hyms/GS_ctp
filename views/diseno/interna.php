<?php
    use yii\helpers\Html;

    $this->title = 'Diseño-Ordenes Internas';
?>
<div class="row">
    <div class="col-md-2">
        <?= $this->render('menus/internaMenu'); ?>
    </div>
    <div class="col-md-10">
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
                        echo $this->render('tables/buscarI', ['orden' => $orden,'search'=>$search]);
                        break;
                    case 'nota':
                        echo $this->render('tables/notas', ['notas' => $notas, 'search' => $search, 'tipo' => 1]);
                        break;
                    default:
                        break;
                }
            }
            else {
                echo Html::tag('div',
                          $this->render('tables/notasPendientes', ['notas' => $notas]),
                    ['class'=>'col-md-offset-6 col-md-6']);
            }
        ?>
    </div>
</div>