<?php
    use yii\bootstrap\Modal;

    Modal::begin([
    'id'=>'modalPage',
    'size'=>Modal::SIZE_LARGE,
]);
Modal::end();

$script = <<<JS
function printView(url){
    $('#modalPage .modal-header').html('<h4 class="modal-title text-center">Vista previa</h4>');
    $('#modalPage .modal-body').html('<object type="text/html" style="width:100%;min-height:480px" data="'+url+'" ></object>');
    $('#modalPage').modal();
    return false;
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);