<?php
    $script = <<<JS
    //var isProcessing = false;
//$("#save").click(function(){
//if(isProcessing){
           // return;
        //}
        //isProcessing = true;
        $("form").submit();});
JS;
    $this->registerJs($script, \yii\web\View::POS_END);