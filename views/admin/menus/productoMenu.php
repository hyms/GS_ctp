<?php
    use yii\bootstrap\Nav;

?>

<div class="well well-sm hidden-print">
    <?php
        echo Nav::widget([
                             'items' => [
                                 [
                                     'label' => 'Listar Productos',
                                     'url' => ['admin/producto','op'=>'list'],
                                 ],
                                 [
                                     'label' => 'Nuevo Productos',
                                     'url' => ['admin/producto','op'=>'new'],
                                 ],
                                 [
                                     'label' => 'Añadir a Almacen',
                                     'url' => ['admin/producto','op'=>'add'],
                                 ],
                                 [
                                     'label' => 'Stocks',
                                     'url' => ['admin/stock'],
                                 ],
                                 [
                                     'label' => 'Costos',
                                     'url' => ['admin/costo'],
                                 ],
                             ],
                             'options' => ['class' =>'nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
                         ]);
    ?>
</div>