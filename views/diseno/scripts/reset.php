<?php
    $script = '
$("#reset").click(function(){ window.location = "'.\yii\helpers\Url::previous().'"});
';
    $this->registerJs($script, \yii\web\View::POS_END);