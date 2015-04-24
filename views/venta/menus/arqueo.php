<?php
    echo \yii\bootstrap\Nav::widget([
                                        'options' => ['class' => 'nav-tabs'],
                                        'items' => [
                                            [
                                                'label'=>'Hoy',
                                                'url'=>['venta/arqueo','d'=>date('d')]
                                            ],
                                            [
                                                'label'=>'Ayer',
                                                'url'=>['venta/arqueo','d'=>(date('d')-1)]
                                            ],
                                            [
                                                'label'=>'Reporte de Arqueos',
                                                'url'=>['venta/arqueo','list'=>true]
                                            ]
                                        ],
                                    ]);

