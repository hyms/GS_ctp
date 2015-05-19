<div class="row">
    <?= $this->render('menus/reposicionMenu'); ?>
</div>
<br>
<div class="row">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "nuevo":
                    echo $this->render('forms/repos', ['tipo' => $tipo]);
                    break;

                case "0":
                    echo $this->render('forms/reposN', ['producto' => $producto, 'tipo' => $tipo, 'detalle' => $detalle, 'orden' => $orden]);
                    break;
                case "1":
                    echo $this->render('forms/reposC', ['idParent' => $idParent, 'ordenes' => $ordenes, 'search' => $search, 'tipo' => $tipo, 'detalle' => $detalle, 'orden' => $orden]);
                    break;
                case "2":
                    echo $this->render('forms/reposC', ['idParent' => $idParent, 'ordenes' => $ordenes, 'search' => $search, 'tipo' => $tipo, 'detalle' => $detalle, 'orden' => $orden]);
                    break;
                case "list":
                    break;
            }
        }
    ?>
</div>