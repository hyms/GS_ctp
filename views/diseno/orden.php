<?php
    use yii\helpers\Html;

    $this->title = 'Diseño-Ordenes';
?>
<div class="row">


    <?= Html::tag('div',
                  $this->render('menus/ordenMenu'),
                  ['class'=>'col-md-2']); ?>
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
                        echo $this->render('scripts/save');
                        break;
                    case 'buscar':
                        echo $this->render('tables/buscar', ['orden' => $orden]);
                        break;
                    case 'list':
                        echo $this->render('tables/ordenes', ['orden' => $orden, 'search' => $search]);
                        echo $this->render('@app/views/share/scripts/modalView',['size'=>'large']);
                        break;
                    case 'nota':
                        echo $this->render('tables/notas', ['notas' => $notas, 'search' => $search, 'tipo' => 0]);
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
