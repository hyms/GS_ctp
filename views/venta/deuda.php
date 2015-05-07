<?php
    /* @var $this yii\web\View */
    $this->title = 'Venta-Deuda';
?>
<div class="row">
    <?php echo $this->render('menus/deudaMenu'); ?>
</div>
<br>
<div class="row">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "deuda":
                    echo $this->render('tables/deudores', ['orden' => $orden, 'search' => $search]);
                    echo $this->render('scripts/tooltip');
                    break;
                case "pagoDeuda":
                    echo $this->render('forms/deuda', ['orden' => $orden, 'deuda' => $deuda, 'model' => $model]);
                    break;
                case "deudas":
                    echo $this->render('tables/deudas', ['deudas' => $deudas, 'search' => $search]);
                    break;
            }
        }
    ?>
</div>