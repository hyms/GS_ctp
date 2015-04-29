<?php
    use yii\bootstrap\Modal;
    use yii\helpers\Html;

    Modal::begin([
                     'id'=>'viewModal',
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
function formSubmit()
{
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