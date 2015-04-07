<div class="well well-sm hidden-print">
    <?php
        $this->widget(
            'booster.widgets.TbMenu',
            array(
                'type' => 'list',
                'items'=>array(
                    array('label'=>'Nueva O. Interna', 'url'=>array('repos/interna')),
                    array('label'=>'Buscar Internas', 'url'=>array('repos/buscar','i'=>true)),
                    '',
                    array('label'=>'Nueva Reposicion', 'url'=>array('repos/rep')),
                    array('label'=>'Buscar Reposicion', 'url'=>array('repos/buscar','i'=>false)),
                )
            )
        );
    ?>
</div>