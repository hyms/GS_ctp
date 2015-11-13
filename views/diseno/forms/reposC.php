<div class="col-xs-3">
    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('optionRepos',['tipo'=>$tipo]) ?>
        </div>
    </div>

    <?= $this->render('../tables/oRepos',['ordenes'=>$ordenes,'search'=>$search,'tipo'=>$tipo])?>
    <?php
    if($tipo==2) {
        echo $this->render('../tables/producto', ['producto' => $producto, 'tipo' => 2]);
    }
    ?>
</div>

<div class="col-xs-9">
    <div class="well well-sm">
        <h4 class="text-center"><strong>Nueva Reposicion</strong></h4>
        <div id="orden">
            <?php
            if(!empty($orden)) {
                echo $this->render('oRepos', ['idParent' => $idParent, 'orden' => $orden, 'detalle' => $detalle,'tipo'=>$tipo]);
            }
            ?>
        </div>
    </div>
</div>
<?php
$script = <<<JS
function select(val,url)
{
    if(val!="")
        document.location.href = url+'?'+'tipo='+val;
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);
?>
