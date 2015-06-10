<?php
    echo \yii\bootstrap\Nav::widget([
                                        'options' => ['class' => 'nav-tabs'],
                                        'items' => [
                                            [
                                                'label'=>'Hoy',
                                                'url'=>['venta/caja','op'=>'arqueo','d'=>date('d')]
                                            ],
                                            [
                                                'label'=>'Ayer',
                                                'url'=>['venta/caja','op'=>'arqueo','d'=>(date('d')-1)]
                                            ],
                                        ],
                                    ]);

