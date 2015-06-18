<?php
    use kartik\grid\GridView;

?>
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Clientes</strong></div>
        <div class="panel-body">
<?php
    $columns=[
        [
            'header'=>'Nit/Ci',
            'attribute'=>'nitCi',
        ],
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
    </div>