<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

?>
<?php Pjax::begin(); ?>
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
                                       'onChange'=>'select(this.value,"'.Url::to(['diseno/reposicion']).'");return false;',
                                   ])
            ?>
            </div>
        </div>
    </div>

    <div id="select"></div>
</div>

<div class="col-xs-8">
<div id="table"></div>
</div>
<?php Pjax::end(); ?>