<?php
    namespace app\components;

    use app\models\PrecioProductoOrden;
    use Yii;
    use yii\base\Component;

    class precios extends Component
{
    var $precioSF;
    var $precioCF;

    var $precio;

    var $model;
    var $cantidadModel;

    var $error;
    var $success;

    public function init()
    {
        $this->model         = "";
        $this->cantidadModel = 0;
        $this->error         = "";
        $this->success       = false;
    }

    public function load($id = null)
    {

        $this->precio = new PrecioProductoOrden();
        if ($id != null) {
            $this->precio = PrecioProductoOrden::findOne($id);
        }
    }

    public function pullPrecios($models)
    {
        $precios = array();
        foreach ($models as $id => $model) {
            $precio             = PrecioProductoOrden::findOne($id);
            $precio->attributes = $model;
            if (!$precio->validate()) {
                $this->error = "error en validacion";
            }
            array_push($precios, $precio);
        }
        $this->model         = $precios;
        $this->cantidadModel = count($this->model);
    }

    public function update($cantidades, $oldCantidades, $horas, $oldHoras)
    {
        foreach ($cantidades as $keyc => $cantidad) {
            if ($cantidad != $oldCantidades[$keyc]->cantidad) {
                $this->updateKey('cantidad', $oldCantidades[$keyc]->cantidad, $cantidad);
            }
        }
        foreach ($horas as $keyh => $hora) {
            if (strtotime(date("H:i",strtotime($hora))) != strtotime(date("H:i",strtotime($oldHoras[$keyh]->hora)))) {
                $this->updateKey('hora', $oldHoras[$keyh]->hora, $hora);
            }
        }
        $this->save();
    }

    public function save()
    {
        foreach ($this->model as $item) {
            if (!$item->validate()) {
                $this->error = "Error en validacion";
                return false;
            }
        }
        $this->success = true;
        foreach ($this->model as $item) {
            $item->save();
        }
        return true;
    }

    private function updateKey($parameter, $value, $newValue)
    {
        for ($i = 0; $i < $this->cantidadModel; $i++) {
            if ($this->model[$i][$parameter] == $value) {
                $this->model[$i][$parameter] = $newValue;
            }
        }
    }

    //bulks
    public static function preciosServicio($productoStock, $tipoCliente = null, $cantidad = null, $hora = null)
    {
        $precios = PrecioProductoOrden::find();
        $precios->where(['fk_idProductoStock' => $productoStock]);
        if ($tipoCliente != null)
            $precios->andWhere('fk_idTipoCliente', $tipoCliente);
        if ($cantidad != null)
            $precios->andWhere('<=', 'cantidad', $cantidad);
        if ($hora != null)
            $precios->andWhere('<=', 'hora', $hora);
        return $precios->all();
    }

    public static function getPrecio($models, $id)
    {
        foreach ($models as $key => $model) {
            if ($model->idPrecioProductoOrden == $id) {
                return $key;
            }
        }
    }

    //getters
    public static function getDatoPrecioOrden($dato, $idProductoStock)
    {
        $datos = PrecioProductoOrden::find();
        $datos->where(['fk_idProductoStock' => $idProductoStock]);
        $datos->orderBy($dato." ASC");
        $datos->groupBy($dato);
        $datos->select($dato);
        return $datos->all();
    }
}