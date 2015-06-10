<div class="row">
    <div class="col-xs-2">
        <?= $this->render('menus/reposicionMenu'); ?>
    </div>
    <div class="col-xs-10">
        <?php
        if(isset($r)) {
            switch ($r) {
                case "nuevo":
                    echo $this->render('forms/repos', [
                        'tipo' => $tipo
                    ]);
                    break;
                case "null":
                    echo $this->render('forms/reposNull', [
                        'detalle' => $detalle,
                        'orden' => $orden
                    ]);
                    break;

                case "0":
                    echo $this->render('forms/reposN', [
                        'producto' => $producto,
                        'tipo' => $tipo,
                        'detalle' => $detalle,
                        'orden' => $orden
                    ]);
                    break;
                case "1":
                    echo $this->render('forms/reposC', [
                        'idParent' => $idParent,
                        'ordenes' => $ordenes,
                        'search' => $search,
                        'tipo' => $tipo,
                        'detalle' => $detalle,
                        'orden' => $orden
                    ]);
                    break;
                case "2":
                    echo $this->render('forms/reposC', [
                        'idParent' => $idParent,
                        'ordenes' => $ordenes,
                        'search' => $search,
                        'tipo' => $tipo,
                        'detalle' => $detalle,
                        'orden' => $orden,
                        'producto' => $producto
                    ]);
                    break;
                case "list":
                    echo $this->render('tables/buscarR', ['orden' => $orden]);
                    break;
                case 'nota':
                    echo $this->render('tables/notas', ['notas' => $notas, 'search' => $search, 'tipo' => 2]);
                    break;
            }
        }
        else
        {
            echo '<div class="col-xs-offset-6 col-xs-6">';
            echo $this->render('tables/notasPendientes',['notas'=>$notas]);
            echo '</div>';
        }
        ?>
    </div>
</div>