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
        $render  = "";
        $ordenes = "";
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "cliente":
                    $ordenes = new OrdenCTP();
                    $detalle = [];
                    if (isset($get['id'])) {
                        $ordenes = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                        $detalle = $ordenes->ordenDetalles;
                    } else {
                        $ordenes->fk_idSucursal = $this->idSucursal;
                        $ordenes->estado        = 1;
                        $ordenes->correlativo   = SGOrdenes::correlativo($ordenes->fk_idSucursal);
                        $ordenes->fechaGenerada = date('Y-m-d H:i:s');
                    }
                    $ordenes->fk_idUserD = yii::$app->user->id;
                    $producto            = SGProducto::getProductos(true, 10, $this->idSucursal);
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
                            $this->redirect(['orden', 'op' => 'buscar']);
                        $ordenes = $datos['orden'];
                        $detalle = $datos['detalle'];
                    }
                    return $this->render('orden', [
                        'r'        => 'nuevo',
                        'orden'    => $ordenes,
                        'detalle'  => $detalle,
                        'producto' => $producto,
                    ]);
                case 'buscar':
                    $render  = "buscar";
                    $ordenes = SGOrdenes::getOrdenes($this->idSucursal);
                    break;
            }
        }
        return $this->render('orden', ['r' => $render, 'orden' => $ordenes]);
    }

    public function actionOrdenInterna()
    {

    }

    public function actionOrdenReposicion()
    {

    }

    public function actionAdd_detalle()
    {
        $get = Yii::$app->request->get();
        if (isset($get)) {
            //if (Yii::$app->request->isAjax && isset($get)) {
            $costo   = "";
            $detalle = new OrdenDetalle();
            $almacen = null;
            if (isset($get['al'])) {
                $almacen = ProductoStock::findOne(['idProductoStock' => $get['al']]);
            }
            if (empty($almacen))
                $almacen = new ProductoStock();
            if (isset($get['costo']))
                $costo = $get['costo'];

            $detalle->fk_idProductoStock = $almacen->idProductoStock;

            echo $this->renderAjax('forms/_newRowDetalleVenta', array(
                'model'   => $detalle,
                'index'   => $get['index'],
                'costo'   => $costo,
                'almacen' => $almacen,
            ));
        }
    }
}
