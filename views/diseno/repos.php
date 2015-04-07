<div class="col-xs-2">
    <?php $this->renderPartial('menus/principal'); ?>
</div>

<div class="col-xs-10">
    <?php
        switch ($render){
            case "interna":
                $this->renderPartial('interna',array('productos'=>$productos,'orden'=>$orden,'detalle'=>$detalle));
                $this->renderPartial('/scripts/save');
                $this->renderPartial('/scripts/reset');
                break;
            case "internas":
                $this->renderPartial('tables/buscarI',array('ordenes'=>$ordenes,'criterio'=>$criterio));
                break;
            case "reposiciones":
                $this->renderPartial('tables/buscarR',array('ordenes'=>$ordenes,'criterio'=>$criterio));
                break;
            case "rep":
                $this->renderPartial('menus/repos');
                //$this->renderPartial('tables/repos',array('ordenes'=>$ordenes));
                break;
            case "repC":
                $this->renderPartial('menus/repos');
                $this->renderPartial('tables/rep',array('ordenes'=>$ordenes,'condicion'=>$condicion));
                break;
             case "repI":
                $this->renderPartial('menus/repos');
                $this->renderPartial('tables/repI',array('ordenes'=>$ordenes,'condicion'=>$condicion));
                break;
            case "repos":
                $this->renderPartial('forms/repos',array('orden'=>$orden,'detalle'=>$detalle,'repos'=>$repos,'detalleRep'=>$detalleRep));
                $this->renderPartial('/scripts/save');
                $this->renderPartial('/scripts/reset');
                $this->renderPartial('/scripts/operaciones');
                Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/addList.js',CClientScript::POS_HEAD);
                break;
            /*case "buscar":
                $this->renderPartial('tables/buscar',array('ordenes'=>$ordenes));
                break;
            case "modificarR":
                $this->renderPartial('cliente',array('cliente'=>$cliente,'detalle'=>$detalle,'ctp'=>$ctp,'productos'=>$productos));
                $this->renderPartial('scripts/save');
                $this->renderPartial('scripts/reset');
                break;
            */
            default:
                echo "";
                break;
        }
    ?>
</div>