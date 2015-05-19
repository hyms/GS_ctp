<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<div class="col-xs-4">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group">
                <?= Html::label('Seleccione Tipo de Repocicion',null,['class'=>'form-label'])?>
                <?= Html::dropDownList('tipo',
                                       $tipo,
                                       [
                                           'Nueva Reposicion',
                                           'Reposicion de Cliente',
                                           'Reposicion de una Interna'
                                       ],
                                       [
                                           'prompt'=>'Seleccione una opcion',
                                           'class'=>'form-control',
                                           'onChange'=>'select(this.value,"'.Url::to(['diseno/reposicion']).'")',
                                       ])
                ?>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="panel-title">Ordenes</strong>
        </div>
        <?= $this->render('../tables/oRepos',['ordenes'=>$ordenes,'search'=>$search,'tipo'=>2])?>
    </div>
</div>

<div class="col-xs-8">
    <div class="well well-sm">
        <h4 class="text-center"><strong>Nueva Reposicion</strong></h4>
        <div id="orden">
            <?php
                if(!empty($orden)) {
                    echo $this->render('oRepos', ['idParent' => $idParent, 'orden' => $orden, 'detalle' => $detalle]);
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
