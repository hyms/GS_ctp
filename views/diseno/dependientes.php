<?php
/* @var $this yii\web\View */
$this->title = 'Diseño-Dependientes';
?>

<div class="row">
    <div class="col-xs-2">
        <?php echo $this->render('menus/depMenu',['menu'=>$menu]); ?>
    </div>
    <div class="col-xs-10">
        <?php
        if(isset($r)) {
            switch ($r) {
                case 'buscar':
                    echo $this->render('tables/buscar', ['orden' => $orden]);
                    break;
                case 'list':
                    echo $this->render('tables/ordenesDep', ['orden' => $orden, 'search' => $search]);
                    break;
            }
        }
        ?>
    </div>
</div>