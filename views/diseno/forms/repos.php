<div class="col-xs-3">
    <div class="panel panel-default">
        <div class="panel-body">
            <?= $this->render('optionRepos',['tipo'=>$tipo]) ?>
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
