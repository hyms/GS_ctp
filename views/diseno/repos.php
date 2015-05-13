<div class="row">
    <?= $this->render('menus/reposicionMenu'); ?>
</div>
<br>
<div class="row">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "nuevo":
                    echo $this->render('forms/repos',['tipo'=>$tipo]);
                    break;

                case "list":
                    break;
            }
        }
    ?>
</div>