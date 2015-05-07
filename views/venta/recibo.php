<?php
    /* @var $this yii\web\View */
    $this->title = 'Venta-Recibo';
?>
<div class="row">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "recibos":
                    echo $this->render('tables/recibos', ['recibos' => $recibos, 'search' => $search]);
                    echo $this->render('scripts/modal');
                    break;
            }
        }
    ?>
</div>