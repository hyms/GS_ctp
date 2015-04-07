<div class="well well-sm">
    <?php
        $this->widget(
            'booster.widgets.TbMenu',
            array(
                'type' => 'list',
                'items' => array(
                    array('label'=>'Ordenes', 'url'=>array('report/ordenes')),
                    array('label'=>'Placas', 'url'=>array('report/placas')),
                    '',
                    array('label'=>'Repos/Int', 'url'=>array('report/reposInt')),
                    //array('label'=>'Deudas', 'url'=>array('report/deuda')),
                )
            )
        );
    ?>
</div>