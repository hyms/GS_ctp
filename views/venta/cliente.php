<?php
    /* @var $this yii\web\View */
    $this->title = 'Venta-Clientes';
?>
<div class="row">
    <?php echo $this->render('menus/ordenMenu'); ?>
</div>
<br>
<div class="row">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "new":
                    echo $this->render('tables/ordenes', ['orden' => $orden]);
                    break;
                case "list":
                    echo $this->render('tables/buscar', ['orden' => $orden, 'search' => $search]);
                    echo $this->render('scripts/tooltip');
                    break;
            }
        }
    ?>
</div>