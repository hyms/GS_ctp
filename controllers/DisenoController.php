<?php

namespace app\controllers;

use app\components\SGOrdenes;
use app\components\SGProducto;
use app\models\OrdenCTP;
use app\models\OrdenCTPSearch;
use app\models\OrdenDetalle;
use app\models\ProductoStock;
use app\models\Sucursal;
use kartik\mpdf\Pdf;
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
        if (!empty(yii::$app->user->identity)) {
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
                case 'list':
                    $searchModel                = new OrdenCTPSearch();
                    $searchModel->fk_idSucursal = $this->idSucursal;
                    $ordenes                    = $searchModel->search(Yii::$app->request->getQueryParams());
                    $ordenes->query
                        ->andWhere(['estado' => 0])
                        ->orWhere(['estado' => 2])
                        ->andWhere(['tipoOrden' => 0])
                        ->orderBy(['fechaCobro' => SORT_DESC]);
                    return $this->render('orden', ['r' => 'list', 'orden' => $ordenes,'search'=>$searchModel]);
                    break;
            }
        }
        return $this->render('orden');
    }

    public function actionInterna()
    {
        $get = Yii::$app->request->get();
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
                    $ordenes = SGOrdenes::getOrdenes($this->idSucursal, 1);
                    return $this->render('interna', ['r' => 'buscar', 'orden' => $ordenes]);
                    break;
            }
        }
        return $this->render('interna');
    }

    public function actionReposicion()
    {
        $get = Yii::$app->request->get();
        if(isset($get['tipo']))
        {
            switch($get['tipo']){
                case 0:
                    $producto = SGProducto::getProductos(true, 10, $this->idSucursal);
                    return $this->render('forms/reposN',['producto'=>$producto,'tipo'=>$get['tipo']]);
                    break;
                case 1:
                    return "";
                    break;
                case 2:
                    return "";
                    break;
            }
        }
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "nueva":
                    $producto = SGProducto::getProductos(true, 10, $this->idSucursal);
                    $ordenes  = new OrdenCTP();
                    $detalle  = [];
                    if (isset($get['id'])) {
                        $ordenes = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                        $detalle = $ordenes->ordenDetalles;
                    } else {
                        $ordenes->fk_idSucursal  = $this->idSucursal;
                        $ordenes->estado         = 1;
                        $ordenes->tipoOrden      = 2;
                        $ordenes->correlativo    = SGOrdenes::correlativo($ordenes->fk_idSucursal, 2);
                        $ordenes->codigoServicio = SGOrdenes::codigo($ordenes->fk_idSucursal, 2);
                        $ordenes->fechaGenerada  = date('Y-m-d H:i:s');
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
                        $datos = $operacion->grabar(['orden' => $ordenes, 'detalle' => $detalle]);
                        if ($operacion->success)
                            return $this->redirect(['repos', 'op' => 'list']);
                        $ordenes = $datos['orden'];
                        $detalle = $datos['detalle'];
                    }

                    return $this->render('repos', [
                        'r'        => 'nuevo',
                        'tipo'=>'',
                        'orden'    => $ordenes,
                        'detalle'  => $detalle,
                        'producto' => $producto,
                    ]);

                case 'list':
                    $ordenes = SGOrdenes::getOrdenes($this->idSucursal, 2);
                    return $this->render('repos', ['r' => 'buscar', 'orden' => $ordenes]);
                    break;
            }
        }
        return $this->render('repos');
    }

    private function ordenes($get, $tipo)
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
            if ($tipo != 0)
                $ordenes->codigoServicio = SGOrdenes::codigo($ordenes->fk_idSucursal, $tipo);
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
        return ['orden' => $ordenes, 'detalle' => $detalle];
    }

    public function actionPrint()
    {
        $get = Yii::$app->request->get();
        if (isset($get['op']) && isset($get['id'])) {
            switch ($get['op']) {
                case "orden":
                    $orden      = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                    $num        = new numerosALetras();
                    $num->valor = $orden->montoVenta;
                    $content    = $this->renderPartial('prints/orden', ['orden' => $orden, 'monto' => $num->mostrar()]);
                    $title      = "Orden de Venta Nro " . $orden->correlativo;
                    break;
                case "interna":
                    $orden = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                    $content = $this->renderPartial('prints/interna', ['orden' => $orden]);
                    $title = "Orden Interna " . $orden->codigoServicio;
                    break;
                case "reposicion":
                    $orden = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                    $content = $this->renderPartial('prints/repos', ['orden' => $orden]);
                    $title = "Reposicion " . $orden->codigoServicio;
                    break;
            }
            $pdf = new Pdf([
                               // set to use core fonts only
                               'mode' => Pdf::MODE_CORE,
                               'format' => Pdf::FORMAT_LETTER,
                               'orientation' => Pdf::ORIENT_PORTRAIT,
                               'destination' => Pdf::DEST_BROWSER,
                               'content' => $content,
                               // format content from your own css file if needed or use the
                               // enhanced bootstrap css built by Krajee for mPDF formatting
                               'cssFile' => '@webroot/css/bootstrap.min.readable.css',
                               // set mPDF properties on the fly
                               'marginLeft' => 10, // margin_left. Sets the page margins for the new document.
                               'marginRight' => 10, // margin_right
                               'marginTop' => 5, // margin_top
                               'marginBottom' => 5, // margin_bottom
                               'marginHeader' => 9, // margin_header
                               'marginFooter' => 9, // margin_footer
                               'options' => ['title' => $title],
                           ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        }
    }

    public function actionAdd_detalle()
    {
        $get = Yii::$app->request->get();
        if (isset($get)) {
            //if (Yii::$app->request->isAjax && isset($get)) {
            $tipo    = 0;
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
                'tipo'    => $tipo,
                'almacen' => $almacen,
            ));
        }
    }
}
