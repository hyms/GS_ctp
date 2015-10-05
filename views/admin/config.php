<?php
    $this->title = 'Administracion-Configuracion';
?>
<div class="col-xs-2">
    <?php echo $this->render('menus/configMenu'); ?>
</div>
<div class="col-xs-10">
    <?php
        if(isset($r)) {
            switch ($r) {
                case "suc":
                    echo $this->render('forms/sucursal', ['model' => $sucursal]);
                    break;
                case "sucursales":
                    echo $this->render('tables/sucursales', ['sucursales' => $sucursales]);
                    echo $this->render('@app/views/share/scripts/modal',['nameTable'=>'sucursales']);
                    break;
                case "usuarios":
                    echo $this->render('tables/users', ['usuarios' => $usuarios]);
                    echo $this->render('@app/views/share/scripts/modal',['nameTable'=>'usuarios']);
                    break;
                case "imprenta":
                    echo $this->render('menus/imprentaMenu');
                    echo "<br>";
                    if(isset($imp))
                    {
                        $nameTable = "";
                        switch($imp)
                        {
                            case 'tdt':
                                $nameTable = "tipoTrabajos";
                                echo $this->render('tables/imprentaTiposTrabajos',['search'=>$search,'models'=>$models]);
                                break;
                        }
                        echo $this->render('@app/views/share/scripts/modal',['nameTable'=>$nameTable]);
                    }
                    break;
            }
        }
    ?>
</div>
