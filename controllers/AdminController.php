<?php

namespace app\controllers;

use app\components\precios;
use app\components\SGProducto;
use app\models\Producto;
use app\models\ProductoSearch;
use app\models\ProductoStock;
use app\models\ProductoStockSearch;
use app\models\Sucursal;
use app\models\TipoCliente;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{
    public $layout = "admin";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only'  => ['*'],
                'rules' => [
                    [
                        //'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            /*'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionProducto()
    {
        $get = Yii::$app->request->get();
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "new":
                    $render   = "new";
                    $producto = new Producto();
                    if ($producto->load(Yii::$app->request->post())) {
                        if ($producto->save())
                            $this->redirect(['admin/producto', 'op' => 'list']);
                    }
                    return $this->render('producto', ['r' => $render, 'producto' => $producto]);
                case "list":
                    $search   = new ProductoSearch();
                    $producto = $search->search(Yii::$app->request->queryParams);
                    return $this->render('producto', ['r' => "list", 'producto' => $producto, 'search' => $search]);
                case "edit":
                    break;
                case "del":
                    break;
                case "add":
                    $submenu = Sucursal::find()->all();
                    if (isset($get['id'])) {
                        $search    = new ProductoStockSearch();
                        $productos = $search->search(yii::$app->request->queryParams);
                        $productos->query->andWhere(['is', 'fk_idSucursal', null]);
                        if (isset($get['producto'])) {
                            SGProducto::initStock($get['producto'], $get['id']);
                        }
                        return $this->render('producto', ['r' => 'addRemove', 'productos' => $productos, 'search' => $search, 'idSucursal' => $get['id'], 'submenu' => $submenu]);
                    } else {
                        return $this->render('producto', ['r' => 'addRemove', 'submenu' => $submenu]);
                    }
                case "rem":
                    $submenu = Sucursal::find()->all();
                    if (isset($get['producto']) && isset($get['id'])) {
                        $almacen = ProductoStock::findOne(['idProductoStock' => $get['producto']]);
                        if ($almacen->cantidad > 0) {
                            $almacen0 = ProductoStock::find()
                                ->where(['is', 'fk_idSucursal', null])
                                ->andWhere(['fk_idProducto' => $almacen->fk_idProducto])
                                ->one();
                            $almacen0->cantidad += $almacen->cantidad;
                            $almacen0->save();
                        }
                        if (!$almacen->delete()) {
                            $almacen->enable = false;
                        }
                        $this->redirect(array('admin/producto', 'op' => 'add', 'id' => $get['id']));
                    } else {
                        return $this->render('producto', ['r' => 'addRemove', 'submenu' => $submenu]);
                    }
                    break;
            }
        }
        return $this->render('producto');
    }

    public function actionStock()
    {
        $get     = Yii::$app->request->get();
        $submenu = Sucursal::find()->all();
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "list":
                    $search    = new ProductoStockSearch;
                    $productos = $search->search(yii::$app->request->queryParams);
                    if ($get['id'] == 0) {
                        $productos->query->andWhere(['is', 'fk_idSucursal', null]);
                        $nombre = "Deposito";
                    } else {
                        $productos->query->andWhere(['fk_idSucursal' => $get['id']]);
                        foreach ($submenu as $item) {
                            if ($item->idSucursal == $get['id']) {
                                $nombre = $item->nombre;
                                break;
                            }
                        }
                    }
                    return $this->render('producto', ['r' => 'stocks', 'submenu' => $submenu, 'productos' => $productos, 'search' => $search, 'nombre' => $nombre]);
                    break;
                case "add":
                    if (isset($get['id'])) {
                        $almacen  = ProductoStock::findOne(['idProductoStock' => $get['id']]);
                        $deposito = null;
                        if (!empty($almacen->fkIdSucursal)) {
                            $deposito = ProductoStock::find()
                                ->where(['fk_idProducto' => $almacen->fk_idProducto])
                                ->andWhere(['fk_idSucursal' => $almacen->fkIdSucursal->fk_idParent])
                                ->one();
                        }
                        $model = SGProducto::movimientoStockCompra(null, $almacen, "Añadir a Stock", $deposito);
                        $post  = Yii::$app->request->post();
                        if (isset($post['MovimientoStock'])) {
                            $model->attributes = $post['MovimientoStock'];

                            if ($model->save()) {
                                echo "done";
                                Yii::$app->end();
                            }
                        }

                        return $this->renderAjax('forms/add_reduce', array('model' => $model, 'almacen' => $almacen, 'deposito' => $deposito));
                    }
                    break;
            }
        }
        return $this->render('producto', ['r' => 'stocks', 'submenu' => $submenu]);
    }

    public function actionCosto()
    {
        $get     = Yii::$app->request->get();
        $submenu = Sucursal::find()->all();
        if (isset($get['op'])) {
            switch ($get['op']) {
                case 'list':
                    if (isset($get['id'])) {
                        $placas = ProductoStock::findAll(['fk_idSucursal' => $get['id']]);
                        return $this->render('producto', ['r' => 'costo', 'submenu' => $submenu, 'placas' => $placas]);
                    }
                    break;
                case 'precio':
                    if(isset($get['id'])) {
                        $placa        = ProductoStock::findOne(['idProductoStock' => $get['id']]);
                        $clienteTipos = TipoCliente::find()->all();
                        $cantidades   = precios::getDatoPrecioOrden('cantidad', $placa->idProductoStock);
                        $horas        = precios::getDatoPrecioOrden('hora', $placa->idProductoStock);

                        $precio = new precios;
                        $post   = Yii::$app->request->post();
                        if (isset($post['PrecioProductoOrden']) && isset($post['cantidad']) && isset($post['hora'])) {
                            $precio->pullPrecios($post['PrecioProductoOrden']);
                            $precio->update($post['cantidad'], $cantidades, $post['hora'], $horas);
                            if ($precio->success) {
                                echo "done";
                                Yii::app()->end();
                            }
                        }
                        return $this->renderAjax('forms/preciosCTP', array('clienteTipos' => $clienteTipos, 'placa' => $placa, 'cantidades' => $cantidades, 'horas' => $horas, 'model' => $precio->model));
                    }
                    break;
            }
        }
        return $this->render('producto', ['r' => 'costo', 'submenu' => $submenu]);
    }

    public function actionConfig()
    {
        $get = Yii::$app->request->get();

        if (isset($get['op'])) {
            switch ($get['op']) {
                case 'sucursal':
                    $sucursal = New Sucursal();
                    if ($sucursal->load(Yii::$app->request->post())) {
                        if ($sucursal->save()) {
                            $this->redirect(['config']);
                        }
                    }
                    return $this->render('config', ['r' => 'suc', 'sucursal' => $sucursal]);
                    break;
            }
        }
        return $this->render('config');
    }
}
