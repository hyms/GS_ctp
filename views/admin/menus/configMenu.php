
<?php
    use yii\bootstrap\Nav;

?>

<div class="well well-sm hidden-print">
    <?php
    echo Nav::widget([
        'items' => [
            [
                'label' => 'Sucursal',
                'url' => ['admin/config','op'=>'sucursal'],
            ],
            /*[
                'label' => 'Nuevo Productos',
                'url' => ['admin/config','op'=>'new'],
            ],
            [
                'label' => 'Añadir a Almacen',
                'url' => ['admin/config','op'=>'addProduct'],
            ]*/
        ],
        'options' => ['class' =>'nav-pills nav-stacked'], // set this to nav-tab to get tab-styled navigation
    ]);
    ?>
</div>