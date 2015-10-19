<?php
    $this->title = 'Administracion-Placas';
?>
<div class="row">
    <div class="col-md-3">
        <?= $this->render('forms/placas',[
            'fechaStart'=>$fechaStart,
            'fechaEnd'=>$fechaEnd,
            'sucursal'=>$sucursal,
            'tipoOrden'=>$tipoOrden,
        ]); ?>
    </div>
    <div class="col-md-9">
        <div id="table">
            <?php
                if(isset($r)) {
                    switch ($r) {
                        case "all":
                            //echo $this->render('prints/report', ['data' => $data]);
                            echo $this->render('tables/placas', ['data' => $data,'fechaStart'=>$fechaStart,'fechaEnd'=>$fechaEnd,'sucursal'=>$sucursal,'total'=>$total]);
                            break;
                        case "formato":
                            echo $this->render('tables/placas', ['data' => $data,'fechaStart'=>$fechaStart,'fechaEnd'=>$fechaEnd]);
                            break;
                    }
                }
            ?>
        </div>
    </div>
</div>