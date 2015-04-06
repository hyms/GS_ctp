<?php
$items = array();
foreach($submenu as $key => $item)
{
    if($item->idAlmacen > 1)
    {
        $items[$key]=array('label'=>$item->nombre, 'url'=>array('producto/almacenAdd','id'=>$item->idAlmacen));
    }
}

$this->widget(
    'booster.widgets.TbMenu',
    array(
        'type' => 'tabs',
        'activeCssClass'	=> 'active',
        'items'=>$items
    )
);
