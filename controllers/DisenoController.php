<?php

namespace app\controllers;

use app\components\SGOrdenes;
use app\components\SGProducto;
use app\models\OrdenCTP;
use app\models\OrdenDetalle;
use app\models\ProductoStock;
use app\models\Sucursal;
use Yii;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;

class DisenoController extends Controller
{
    public $layout = "diseno";

    private $idSucursal;

    public function init()
    {
        if(!empty(yii::$app->user->identity)) {
            $sucursal = Sucursal::findOne(['idSucursal' => yii::$app->user->identity->fk_idSucursal]);
            if (empty($sucursal))
                throw new HttpException(412, SGOperation::getError(412));
            else
                $this->idSucursal = $sucursal->idSucursal;
        }
        parent::init();
    }

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

    public function actionOrden()
    {
        $get = Yii::$app->request->get();
        //$post=Yii::$app->request->post();
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "cliente":
                    $producto = SGProducto::getProductos(true, 10, $this->idSucursal);
                    $datos    = $this->ordenes($get, 0);
                    if (!is_array($datos))
                        return $this->redirect(['orden', 'op' => 'buscar']);
                    $ordenes = $datos['orden'];
                    $detalle = $datos['detalle'];
                    return $this->render('orden', [
                        'r'        => 'nuevo',
                        'orden'    => $ordenes,
                        'detalle'  => $detalle,
                        'producto' => $producto,
                    ]);
                case 'buscar':
                    $ordenes = SGOrdenes::getOrdenes($this->idSucursal);
                    return $this->render('orden', ['r' => 'buscar', 'orden' => $ordenes]);
                    break;
            }
        }
        return $this->render('orden');
    }

    public function actionInterna()
    {
        $get = Yii::$app->request->get();
        //$post=Yii::$app->request->post();
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "nueva":
                    $producto = SGProducto::getProductos(true, 10, $this->idSucursal);
                    $datos    = $this->ordenes($get, 1);
                    if (!is_array($datos))
                        return $this->redirect(['interna', 'op' => 'list']);
                    $ordenes = $datos['orden'];
                    $detalle = $datos['detalle'];
                    return $this->render('interna', [
                        'r'        => 'nuevo',
                        'orden'    => $ordenes,
                        'detalle'  => $detalle,
                        'producto' => $producto,
                    ]);
                case 'list':
                    $ordenes = SGOrdenes::getOrdenes($this->idSucursal,1);
                    return $this->render('interna', ['r' => 'buscar', 'orden' => $ordenes]);
                    break;
            }
        }
        return $this->render('interna');
    }

    public function actionReposicion()
    {
        $get = Yii::$app->request->get();
        //$post=Yii::$app->request->post();
        if (isset($get['op'])) {
            if (isset($_GET['id']) && isset($_GET['o'])) {

                $repos = new ServicioVentaRI();
                if ($_GET['o']) {
                    $orden                     = $this->verifyModel(ServicioVenta::model()->with('detalleServicios')->findByPk($_GET['id']));
                    $detalle                   = $orden->detalleServicios;
                    $repos->fk_idServicioVenta = $orden->idServicioVenta;
                } else {
                    $orden                       = $this->verifyModel(ServicioVentaRI::model()->with('detalleVentaRIs')->findByPk($_GET['id']));
                    $detalle                     = $orden->detalleVentaRIs;
                    $repos->fk_idServicioVentaRI = $orden->idServicioVentaRI;
                }

                $repos->fk_idSucursal = $this->sucursal;
                $repos->fk_idUser     = Yii::app()->user->id;
                $repos->secuencia     = SGServicioVenta::codigoInterRepos($repos->fk_idSucursal, true);
                $repos->codigo        = "OR-" . $repos->secuencia;

                $repos->fechaRegistro = date("Y-m-d H:i:s");
                $detalleRep           = array();
                if (isset($_POST['ServicioVentaRI']) && isset($_POST['DetalleVentaRI'])) {
                    $repos->attributes = $_POST['ServicioVentaRI'];
                    $det               = count($_POST['DetalleVentaRI']);
                    foreach ($_POST['DetalleVentaRI'] as $key => $item) {
                        $detalleRep[$key]             = new DetalleVentaRI;
                        $detalleRep[$key]->attributes = $item;
                        if ($detalle[$key]->validate())
                            $det--;
                    }
                    if (!empty($repos->fk_idCliente)) {
                        $costo = 0;
                        foreach ($detalleRep as $item) {
                            $prod  = ProductoStock::model()->findByPk($item->fk_idProductoStock);
                            $costo = $costo + SGServicioVenta::costosServicio($prod->fk_idAlmacen, $prod->fk_idProducto, 1, date('H:m:s'), $item->cantidad, 1);
                        }
                        $repos->totalCosto = $costo;
                        //print_r($repos);
                    }
                    if ($repos->validate() && $det == 0) {
                        $realizarVenta                       = new SGServicioVenta;
                        $datos                               = array('venta' => $repos, 'detalle' => $detalleRep,);
                        $realizarVenta->obseracionMovimiento = "Reposicion de Ordenes";

                        $datos = $realizarVenta->movimientoMaterial($datos);

                        if (!$realizarVenta->ventaError) {
                            $this->redirect(array("repos/buscar", "i" => false));
                        } else {
                            $detalle = $datos['detalle'];
                        }
                    }

                }

                $this->render('index', array('render' => 'repos', 'orden' => $orden, 'detalle' => $detalle, 'repos' => $repos, 'detalleRep' => $detalleRep));
            } else
                throw new CHttpException(400, 'Petición no válida.');
        }
        return $this->render('repos');
    }


    private function ordenes($get,$tipo)
    {
        $ordenes = new OrdenCTP();
        $detalle = [];
        if (isset($get['id'])) {
            $ordenes = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
            $detalle = $ordenes->ordenDetalles;
        } else {
            $ordenes->fk_idSucursal = $this->idSucursal;
            $ordenes->estado        = 1;
            $ordenes->tipoOrden     = $tipo;
            $ordenes->correlativo   = SGOrdenes::correlativo($ordenes->fk_idSucursal, $tipo);
            $ordenes->fechaGenerada = date('Y-m-d H:i:s');
        }
        $ordenes->fk_idUserD = yii::$app->user->id;
        $post                = Yii::$app->request->post();
        if (!empty($post)) {
            $operacion = new SGOrdenes();
            if (isset($get['id'])) {
                $ordenes = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                $detalle = OrdenDetalle::findAll(['fk_idOrden' => $ordenes->idOrdenCTP]);
                $cp      = count($post['OrdenDetalle']);
                $cs      = count($detalle);
                if ($cp != $cs)
                    if ($cs == OrdenDetalle::deleteAll(['fk_idOrden' => $ordenes->idOrdenCTP]))
                        for ($i = 0; $i < count($post['OrdenDetalle']); ++$i)
                            $detalle[$i] = new OrdenDetalle();
            } else {
                for ($i = 0; $i < count($post['OrdenDetalle']); ++$i)
                    $detalle[$i] = new OrdenDetalle();
            }
            $ordenes->load($post);
            Model::loadMultiple($detalle, $post);
            //$datos = ;
            $datos = $operacion->grabar(['orden' => $ordenes, 'detalle' => $detalle]);
            if ($operacion->success)
                return true;
            return $datos;
        }
        return ['orden'=>$ordenes,'detalle'=>$detalle];
    }

    public function actionAdd_detalle()
    {
        $get = Yii::$app->request->get();
        if (isset($get)) {
            //if (Yii::$app->request->isAjax && isset($get)) {
            $tipo   = 0;
            $detalle = new OrdenDetalle();
            $almacen = null;
            if (isset($get['al'])) {
                $almacen = ProductoStock::findOne(['idProductoStock' => $get['al']]);
            }
            if (empty($almacen))
                $almacen = new ProductoStock();
            if (isset($get['tipo']))
                $tipo = $get['tipo'];

            $detalle->fk_idProductoStock = $almacen->idProductoStock;

            echo $this->renderAjax('forms/_newRowDetalleVenta', array(
                'model'   => $detalle,
                'index'   => $get['index'],
                'tipo'   => $tipo,
                'almacen' => $almacen,
            ));
        }
    }
}
