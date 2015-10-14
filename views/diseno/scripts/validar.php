<?php
    $script = <<<JS
function validar(url,id)
{
    $.ajax({
        type: "POST",
        data:{id:id},
        url: url,
        success: function(data){
            if(data=="done"){
                location.reload();
            }
        }
    });
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);