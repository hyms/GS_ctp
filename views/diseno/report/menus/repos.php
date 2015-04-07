<?php
    $this->widget(
        'booster.widgets.TbMenu',
        array(
            'type' => 'tabs',
            'activeCssClass'	=> 'active',
            'items'=>array(
                array('label'=>'0. Internas', 'url'=>array('report/reposInt','i'=>true)),
                array('label'=>'Reposiciones', 'url'=>array('report/reposInt','i'=>false)),
                //array('label'=>'Ordenes Internas', 'url'=>array('repos/rep','o'=>false)),
            )
        )
    );