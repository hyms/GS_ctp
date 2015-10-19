<?php
use yii\bootstrap\Modal;

Modal::begin([
    'id'=>'modalPage',
    'size'=>Modal::SIZE_LARGE,
    'header' => '<h4 class="modal-title text-center"></h4>',
]);
Modal::end();

$script = <<<JS
function printView(url){
    $('#modalPage .modal-header .modal-title').html('Vista previa');
    $('#modalPage .modal-body').html('<object type="text/html" style="width:100%;min-height:480px" data="'+url+'" ></object>');
    $('#modalPage').modal();
    return false;
}
JS;
$this->registerJs($script, \yii\web\View::POS_HEAD);