<?php
    $this->title = 'Administracion-Configuracion';
?>
<div class="col-xs-2">
    <?php echo $this->render('menus/configMenu'); ?>
</div>
<div class="col-xs-10">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "suc":
                    echo $this->render('forms/sucursal', ['model' => $sucursal]);
                    break;
                case "sucursales":
                    echo $this->render('tables/sucursales', ['sucursales' => $sucursales]);
                    echo $this->render('scripts/modal');
                    break;
                case "usuarios":
                    echo $this->render('tables/users', ['usuarios' => $usuarios]);
                    echo $this->render('scripts/modal');
                    break;
            }
        }
    ?>
</div>
