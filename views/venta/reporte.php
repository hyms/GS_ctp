<?php
    /* @var $this yii\web\View */
    $this->title = 'Venta-Reportes';
?>
<div class="row">
    <div class="col-xs-3">
        <?= $this->render('forms/report',['clienteNegocio'=>$clienteNegocio,'clienteResponsable'=>$clienteResponsable,'fechaStart'=>$fechaStart,'fechaEnd'=>$fechaEnd]); ?>
    </div>
    <div class="col-xs-9">
        <div id="table">
            <?php
                if(isset($r)) {
                    switch ($r) {
                        case "table":
                            //echo $this->render('prints/report', ['data' => $data]);
                            echo $this->render('tables/reporte', ['data' => $data,'fechaStart'=>$fechaStart,'fechaEnd'=>$fechaEnd]);
                            break;
                        case "deuda":
                            echo $this->render('tables/reporteD', ['data' => $data,'fechaStart'=>$fechaStart,'fechaEnd'=>$fechaEnd]);
                            break;
                    }
                }
            ?>
        </div>
    </div>
</div>