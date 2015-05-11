<?php
    /* @var $this yii\web\View */
    $this->title = 'Venta-Reportes';
?>
<div class="row">
    <div class="col-xs-3">
        <?= $this->render('forms/report',['clienteNegocio'=>$clienteNegocio,'clienteResponsable'=>$clienteResponsable,'fechaStart'=>$fechaStart,'fechaEnd'=>$fechaEnd]); ?>
    </div>
    <div class="col-xs-9">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "form":
                    echo $this->render('tables/cajaChicas', ['cajasChicas' => $cajasChicas, 'search' => $search]);
                    echo $this->render('scripts/modal');
                    break;
                case "table":
                    echo $this->render('tables/recibos', ['recibos' => $recibos, 'search' => $search]);
                    echo $this->render('scripts/modal');
                    break;
            }
        }
    ?>
    </div>
</div>