<?php
    use kartik\grid\GridView;

?>
<div class="panel panel-default">
    <div class="panel-heading"><strong>Clientes</strong></div>
    <?php
        $columns=[
            [
                'header' => 'Negocio',
                'attribute'=>'nombreNegocio',
            ],
            [
                'header' => 'Dueño',
                'attribute'=>'nombreCompleto',
            ],
            [
                'header' => 'Responsable',
                'attribute'=>'nombreResponsable',
            ],
            [
                'header' => 'Telefono',
                'attribute'=>'telefono',
            ],
            [
                'header' => 'Correo',
                'attribute'=>'correo',
            ],
        ];
        echo GridView::widget([
                                  'dataProvider'=> $clientes,
                                  'filterModel' => $search,
                                  'columns' => $columns,
                                  'responsive'=>true,
                                  'hover'=>true,
                                  'bordered'=>false,
                              ]);
    ?>
</div>