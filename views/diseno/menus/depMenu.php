<?php
    use kartik\widgets\SideNav;

    if(isset($menu)) {
        $items = [];
        foreach ($menu as $item) {
            array_push($items, [
                'label' => 'Suc. ' . $item->nombre,
                'url'   => ['diseno/dependientes', 'id' => $item->idSucursal],
            ]);
        }
        echo SideNav::widget([
                                 'type'         => SideNav::TYPE_PRIMARY,
                                 'encodeLabels' => false,
                                 'heading'      => false,
                                 'items'        => $items,
                             ]);
    }
