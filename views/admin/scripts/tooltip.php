<?php
    $script= <<< JS
$('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
JS;
    $this->registerJs($script, \yii\web\View::POS_END);