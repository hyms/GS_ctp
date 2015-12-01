<?php
    $script = <<<JS
var isProcessing = false;
function save()
{
    if(isProcessing){ return; }
    isProcessing = true;

        $.ajax({
            url: $("form").action,
            type: "post",
            data: $("form").serialize(),
            success: function(data) {
                if(data == "error"){
                    isProcessing = false;
                    alert('Hubo un error al procesar la informacion INTENTELO DE NUEVO');
                }
            }
        });
    //$("form").submit();
    return false;
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);