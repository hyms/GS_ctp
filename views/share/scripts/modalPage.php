<?php
    use yii\bootstrap\Modal;

    Modal::begin([
    'id'=>'modal',
    'size'=>Modal::SIZE_LARGE,
]);
Modal::end();

$script = <<<JS
function printView(url){
    $('#modal .modal-header').html('<h4 class="modal-title text-center">Vista previa</h4>');
    $('#modal .modal-body').html('<object type="text/html" style="width:100%;min-height:480px" data="'+url+'" ></object>');
    $('#modal').modal();
    return false;
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);