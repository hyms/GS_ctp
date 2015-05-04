<?php
$this->title = 'Administracion-Productos';
?>
<div class="col-xs-2">
    <?php echo $this->render('menus/productoMenu'); ?>
</div>
<div class="col-xs-10">
    <?php
    if(isset($r))
    {
        switch($r){
            case "new":
                echo "<div class='panel panel-default'>";
                echo "<div class='panel-heading'><strong>Producto Nuevo</strong></div>";
                echo "<div class='panel-body'>";
                echo $this->render('forms/producto',['model'=>$producto]);
                echo "</div>";
                echo "</div>";
                break;
            case "list":
                echo $this->render('tables/productos',['producto'=>$producto,'search'=>$search]);
                break;
            case "addRemove":
                echo $this->render('menus/almacenes', ['submenu' => $submenu]);

                if(isset($idSucursal)) {
                    $nombre = "";
                    foreach ($submenu as $item) {
                        if ($item->idSucursal == $idSucursal) {
                            $nombre = $item->nombre;
                            break;
                        }
                    }
                    echo $this->render('tables/productosAdd', ['productos' => $productos, 'search' => $search, 'idSucursal' => $idSucursal, 'nombre' => $nombre]);
                }
                break;
            default:
                break;
        }
    }
        /*switch ($render) {
            case "list":
                $this->renderPartial('tables/productos', array('productos' => $productos,));
                break;
            case "new":
                echo '<h3><strong>Nuevo Producto</strong></h3>';
                $this->renderPartial('forms/_form', array('model' => $model));
                $this->renderPartial('/scripts/save');
                $this->renderPartial('/scripts/reset');
                break;
            case "edit":
                echo '<h3><strong">Producto: </strong>' . $model->codigo . '</h3>';
                $this->renderPartial('forms/_form', array('model' => $model));
                $this->renderPartial('/scripts/save');
                $this->renderPartial('/scripts/reset');
                break;
            case "addRemove":
                $nombre = "";
                foreach ($submenu as $item) {
                    if ($item->idAlmacen == $idAlmacen) {
                        $nombre = $item->nombre;
                        break;
                    }
                }
                $this->renderpartial('menus/almacenes', array('submenu' => $submenu));
                $this->renderPartial('tables/productosAdd', array('productos' => $productos, 'idAlmacen' => $idAlmacen, 'nombre' => $nombre));
                break;
            default:
                break;
        }*/
    ?>
</div>
