<?php
    $this->widget(
        'booster.widgets.TbMenu',
        array(
            'type' => 'tabs',
            'activeCssClass'	=> 'active',
            'items'=>array(
                array('label'=>'Ordenes Clientes', 'url'=>array('repos/rep','o'=>true)),
                array('label'=>'Ordenes Internas', 'url'=>array('repos/rep','o'=>false)),
            )
        )
    );