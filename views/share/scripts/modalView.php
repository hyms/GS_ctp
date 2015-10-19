<?php
use yii\bootstrap\Modal;

$s=Modal::SIZE_DEFAULT;
    if(isset($size)) {
        switch ($size) {
            case "large":
                $s = Modal::SIZE_LARGE;
                break;
            case "small":
                $s = Modal::SIZE_SMALL;
                break;
        }
    }

    Modal::begin([
                     'id'=>'modal',
                     'size'=>$s,
        'header' => '<h4 class="modal-title text-center"></h4>',
                 ]);
    Modal::end();

    $script = <<<JS
function clickmodal(url,title){
    $.ajax({
        type    :'GET',
        //cache   : false,
        url     : url,
        success : function(data) {
            if(data.length>0){
                $('#modal .modal-header .modal-title').html(title);
                $('#modal .modal-body').html(data);
                $('#modal').modal();
            }
        }
    });
    return false;
}
JS;
    $this->registerJs($script, \yii\web\View::POS_HEAD);