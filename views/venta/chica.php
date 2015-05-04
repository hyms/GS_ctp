<?php
    /* @var $this yii\web\View */
    $this->title = 'Venta-Ordenes';
?>
<div class="row">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "cajaChica":
                    echo $this->render('tables/cajaChicas', ['cajasChicas' => $cajasChicas, 'search' => $search]);
                    echo $this->render('scripts/modal');
                    break;
            }
        }
    ?>
</div>