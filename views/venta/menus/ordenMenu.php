<?php
    use kartik\widgets\SideNav;

    echo SideNav::widget([
                             'type' => SideNav::TYPE_PRIMARY,
                             'encodeLabels' => false,
                             'heading' => false,
                             'items' => [
                                 [
                                     'label'=>'Pendientes',
                                     'url'=>['venta/orden','op'=>'pendiente']
                                 ],
                                 [
                                     'label'=>'Buscar',
                                     'url'=>['venta/orden','op'=>'buscar']
                                 ],
                                 /*[
                                     'label'=>'Historial Ventas',
                                     'url'=>['venta/orden','op'=>'diario']
                                 ],*/
                                 [
                                     'label'=>'Deudores',
                                     'url'=>['venta/orden','op'=>'deuda']
                                 ],
                                 [
                                     'label'=>'H. Pago de Deudas',
                                     'url'=>['venta/orden','op'=>'deudas']
                                 ],
                                 [
                                     'label'=>'Ingresar Factura',
                                     'url'=>['venta/orden','op'=>'factura']
                                 ],

                             ],
                         ]);
