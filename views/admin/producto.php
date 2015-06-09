<?php
    $this->title = 'Administracion-Productos';
?>
<div class="row">
    <div class="col-sm-2">
        <?php echo $this->render('menus/productoMenu'); ?>
    </div>
    <div class="col-sm-10">
        <?php
            if(isset($r)) {
                switch ($r) {
                    case "new":
                        echo "<div class='panel panel-default'>";
                        echo "<div class='panel-heading'><strong>Producto Nuevo</strong></div>";
                        echo "<div class='panel-body'>";
                        echo $this->render('forms/producto', ['model' => $producto]);
                        echo "</div>";
                        echo "</div>";
                        break;
                    case "list":
                        echo $this->render('tables/productos', ['producto' => $producto, 'search' => $search]);
                        break;
                    case "addRemove":
                        echo $this->render('menus/almacenes', ['submenu' => $submenu]);

                        if (isset($idSucursal)) {
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

                    case "stocks":
                        echo $this->render("menus/stocksMenu", ['submenu' => $submenu]);
                        if (isset($productos)) {
                            echo $this->render("tables/stock", ['productos' => $productos, 'search' => $search, 'nombre' => $nombre]);
                            echo $this->render('scripts/modal');
                        }
                        break;

                    case "costo":
                        echo $this->render('menus/costoMenu', ['submenu' => $submenu]);
                        if (isset($placas)) {
                            echo $this->render('tables/ctpList', ['placas' => $placas]);
                            echo $this->render('scripts/modal', ['size' => 'L']);
                        }
                        break;

                    default:
                        break;
                }
            }
        ?>
    </div>
</div>