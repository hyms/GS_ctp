<?php
    use yii\bootstrap\Modal;
    use yii\helpers\Html;

    Modal::begin([
                     'id'=>'modal',
                     'footer'=>Html::a(
                             'Guardar',
                             "#",
                             [
                                 'onclick' => 'formSubmit("'.((isset($nameTable))?$nameTable:"").'");',
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
function formSubmit(nameTable)
{
    data=$("form").serialize();
    //alert ($("form").attr("action"));
    $.ajax({
        type: "POST",
        data: data,
        url: $("form").attr("action"),
        success: function(data){
            if(data=="done"){
                $('#modal').modal('hide');
                if(nameTable.length>0)
                    $.pjax.reload({container:"#"+nameTable});
            }
            else
                $("#modal .modal-body ").html(data);
        }
    });
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);

    $script = <<<JS
function clickmodal(url,title){
    $.ajax({
        type    :'GET',
        //cache   : false,
        url     : url,
        success : function(data) {
            if(data.length>0){
                $('#modal .modal-header').html('<h3 class="text-center">'+title+'</h3>');
                $('#modal .modal-body').html(data);
                $('#modal').modal();
            }
        }
    });
    return false;
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);