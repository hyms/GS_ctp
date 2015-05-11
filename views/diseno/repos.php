<div class="row">
    <?= $this->render('menus/reposicionMenu'); ?>
</div>
<br>
<div class="row">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "nueva":

                    break;
                case "reposiciones":
                    $this->renderPartial('tables/buscarR', array('ordenes' => $ordenes, 'criterio' => $criterio));
                    break;
                case "rep":
                    $this->renderPartial('menus/repos');
                    //$this->renderPartial('tables/repos',array('ordenes'=>$ordenes));
                    break;
                case "repC":
                    $this->renderPartial('menus/repos');
                    $this->renderPartial('tables/rep', array('ordenes' => $ordenes, 'condicion' => $condicion));
                    break;
                case "repI":
                    $this->renderPartial('menus/repos');
                    $this->renderPartial('tables/repI', array('ordenes' => $ordenes, 'condicion' => $condicion));
                    break;
                case "repos":
                    $this->renderPartial('forms/repos', array('orden' => $orden, 'detalle' => $detalle, 'repos' => $repos, 'detalleRep' => $detalleRep));
                    $this->renderPartial('/scripts/save');
                    $this->renderPartial('/scripts/reset');
                    $this->renderPartial('/scripts/operaciones');
                    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/addList.js', CClientScript::POS_HEAD);
                    break;
                default:
                    echo "";
                    break;
            }
        }
    ?>
</div>