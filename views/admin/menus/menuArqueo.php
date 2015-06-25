<?php
    $items = [];
    foreach($sucursales as $key=>$sucursal)
    {
        array_push($items,[
                             'label'=>$sucursal->nombre,
                             'url'=>['admin/arqueos','op'=>'arqueo','ic'=>$sucursal->idSucursal]
                         ]
        );
    }
    echo \yii\bootstrap\Nav::widget([
                                        'options' => ['class' => 'nav-tabs'],
                                        'items' => $items,
                                    ]);

