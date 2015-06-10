<?php
/* @var $this yii\web\View */
$this->title = 'Administracion-Placas';
?>
<div class="row">
    <div class="col-xs-3">
        <?= $this->render('forms/placas',[
            'fechaStart'=>$fechaStart,
            'fechaEnd'=>$fechaEnd,
            'sucursal'=>$sucursal,
            'formato'=>$formato,
        ]); ?>
    </div>
    <div class="col-xs-9">
        <div id="table">
            <?php
            if(isset($r)) {
                switch ($r) {
                    case "table":
                        //echo $this->render('prints/report', ['data' => $data]);
                        echo $this->render('tables/placas', ['data' => $data,'fechaStart'=>$fechaStart,'fechaEnd'=>$fechaEnd]);
                        break;
                    case "deuda":
                        echo $this->render('tables/placas', ['data' => $data,'fechaStart'=>$fechaStart,'fechaEnd'=>$fechaEnd]);
                        break;
                }
            }
            ?>
        </div>
    </div>
</div>