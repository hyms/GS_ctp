<?php
    use yii\helpers\Html;
    use yii\helpers\Url;

?>
<div class="col-xs-3">
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
                                           'onchange'=>'select(this.value,"'.Url::to(['diseno/reposicion']).'")',
                                       ])
                ?>
            </div>
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
