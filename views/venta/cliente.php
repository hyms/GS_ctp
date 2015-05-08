<?php
    /* @var $this yii\web\View */
    $this->title = 'Venta-Clientes';
?>
<div class="row">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "list":
                    echo $this->render('tables/clientes', ['clientes' => $clientes, 'search' => $search]);
                    echo $this->render('scripts/tooltip');
                    echo $this->render('scripts/modal');
                    break;
            }
        }
    ?>
</div>