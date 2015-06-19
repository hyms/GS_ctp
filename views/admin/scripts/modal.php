<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;

if(isset($size)) {
        if ($size == "L")
            $size = Modal::SIZE_LARGE;
        if ($size == "S")
            $size = Modal::SIZE_SMALL;
    }
    else
        $size = Modal::SIZE_DEFAULT;
    Modal::begin([
                     'id'=>'viewModal',
                     'size'=>$size,
                     'footer'=>Html::a(
                             'Guardar',
                             "#",
                             [
                                 'onclick' => 'formSubmit();',
                                 'class'=>'btn btn-success'
                             ]
                         )
                         ." ".
                         Html::a(
                             'Cancelar',
                             "#",
                             [
                                 'data-dismiss' => 'modal',
                                 'class'=>'btn btn-danger'
                             ]
                         ),
                 ]);
    Modal::end();

    $script = <<<JS
var isProcessing = false;
function formSubmit()
{
    if(isProcessing){
            return;
        }
        isProcessing = true;
    data=$("#form").serialize();
    $.ajax({
        type: "POST",
        data:data,
        url: $("#form").attr("action"),
        success: function(data){
            if(data=="done")
                location.reload();
            else
                $("#viewModal .modal-body ").html(data);
        }
    });
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);