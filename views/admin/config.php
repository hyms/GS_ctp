<?php
    $this->title = 'Administracion-Configuracion';
?>
<div class="col-md-2">
    <?= $this->render('menus/configMenu'); ?>
</div>
<div class="col-md-10">
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
                case "cajas":
                    echo $this->render('tables/cajas', ['cajas' => $cajas]);
                    echo $this->render('@app/views/share/scripts/modal',['nameTable'=>'cajas']);
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
