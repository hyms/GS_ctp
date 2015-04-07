<?php

namespace app\controllers;

use app\components\SGOrdenes;
use app\components\SGProducto;
use app\models\OrdenCTP;
use app\models\OrdenDetalle;
use app\models\ProductoStock;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class DisenoController extends Controller
{
    public $layout = "diseno";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
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
        $render = "";
        $ordenes = "";
        if (isset($get['op'])) {
            switch($get['op']){
                case "cliente":
                    $ordenes= new OrdenCTP();
                    $detalle= [];
                    $producto =SGProducto::getProductos(true,10);
                    $post = Yii::$app->request->post();
                    if(!empty($post))
                    {
                        $operacion = new SGOrdenes();
                        $datos = ['orden'=>$post['OrdenCTP'],'detalle'=>$post['OrdenDetalle']];
                        $datos=$operacion->grabar($datos);
                        $ordenes->validate();
                    }
                    return $this->render('orden', [
                        'r' => 'nuevo',
                        'orden'=>$ordenes,
                        'detalle'=>$detalle,
                        'producto'=>$producto,
                    ]);
                case 'buscar':
                    $render="buscar";
                    $ordenes = SGOrdenes::getOrdenes();
                    break;
            }
        }
        return $this->render('orden', ['r' => $render,'orden'=>$ordenes]);
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
            if (isset($_GET['al'])) {
                $almacen = ProductoStock::findOne(['idProductoStock'=>$get['al']]);
            }
            if(empty($almacen))
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
        } else
            throw new CHttpException(400);
    }
}
