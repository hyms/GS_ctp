<?php

namespace app\controllers;

use app\components\numerosALetras;
use app\components\SGOrdenes;
use app\models\Caja;
use app\models\ClienteSearch;
use app\models\MovimientoCaja;
use app\models\OrdenCTP;
use app\models\OrdenDetalle;
use kartik\mpdf\Pdf;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;

class VentaController extends Controller
{
    public $layout = "venta";

    public function init()
    {
        Yii::$app->session->set('user.id',1);
        parent::init();
    }
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
        $get=Yii::$app->request->get();
        if (isset($get['op'])) {
            switch($get['op']){
                case "pendiente":
                    $ordenes = OrdenCTP::find()
                        ->where(['estado'=>1])
                        ->andWhere(['fk_idSucursal'=>1]);
                    return $this->render('orden',['r'=>'pendiente','orden'=>$ordenes]);
                    break;
                case "buscar":
                    $ordenes = OrdenCTP::find()
                        ->where(['estado'=>0])
                        ->orWhere(['estado'=>2])
                        ->andWhere(['fk_idSucursal'=>1]);
                    return $this->render('orden',['r'=>'buscar','orden'=>$ordenes]);
                    break;
                default:
                    break;
            }
        }
        return $this->render('orden');
    }

    public function actionVenta()
    {
        $get = yii::$app->request->get();

        if (isset($get['id'])) {
            $orden = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
            //$orden->tipoPago = 1;
            $orden->fechaCobro = date("Y-m-d H:i:s");
            $detalle = OrdenDetalle::findAll(['fk_idOrden' => $orden->idOrdenCTP]);
            $monto ="";
            if(!empty($orden->fk_idMovimientoCaja))
                $monto = MovimientoCaja::findOne(['idMovimientoCaja'=>$orden->fk_idMovimientoCaja])->monto;

            $search = new ClienteSearch();
            $cliente = $search->search(Yii::$app->request->queryParams);
            $post = yii::$app->request->post();
            if (isset($post['OrdenCTP']) && isset($post['OrdenDetalle'])) {
                $orden->load($post);
                foreach ($detalle as $key => $item)
                    $detalle[$key]->attributes = $post['OrdenDetalle'][$key];

                $monto = (!empty($post['monto']))?$post['monto']:0;
                $op = new SGOrdenes();
                $op->observacionMovimiento="Orden CTP";
                $data = $op->grabar(['orden' => $orden, 'detalle' => $detalle, 'caja' => Caja::findOne(['idCaja' => 1]), 'monto' => $monto], true);
                if ($op->success)
                    $this->redirect(['venta/orden','op'=>'buscar']);

                $orden = $data['orden'];
                $detalle = $data['detalle'];
            }
            return $this->render('orden', [
                'r' => 'venta',
                'orden' => $orden,
                'detalle' => $detalle,
                'clientes' => $cliente,
                'search' => $search,
                'monto' => $monto,
            ]);
        } else
            $this->redirect(Url::previous());
    }

    public function actionPrint()
    {
        $get = Yii::$app->request->get();
        if (isset($get['op']) && isset($get['id'])) {
            switch ($get['op']) {
                case "orden":
                    $orden = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                    $num = new numerosALetras();
                    $num->valor = $orden->montoVenta;
                    $content = $this->renderPartial('prints/orden', ['orden' => $orden, 'monto' => $num->mostrar()]);
                    $title = "Orden de Venta Nro " . $orden->correlativo;
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

    public function actionAjaxfactura()
    {
        if (yii::$app->request->isAjax) {
            $tipo = 0;
            $post = yii::$app->request->post();
            if (isset($post['tipo'])) {
                $tipo = $post['tipo'];
            }

            if (isset($post['detalle']) && isset($post['id']) && isset($post['tipoCliente'])) {

                $resultado = array();
                $total   = 0;
                $detalle = OrdenDetalle::findAll(['fk_idOrden' =>$post['id']]);
                foreach ($detalle as $key => $item) {
                    $detalle[$key]->costo = SGOrdenes::costos($item->fk_idProductoStock,$post['tipoCliente'],date("H:m:s"),$item->cantidad,$tipo);
                    $detalle[$key]->total = ($detalle[$key]->costo * $detalle[$key]->cantidad) + $detalle[$key]->adicional;
                    $resultado[$key]      = $detalle[$key];
                    $total                += $detalle[$key]->total;
                }
                $resultado['total']  = $total;

                echo Json::encode($resultado);
            }
        }
    }

    public function actionAddfactura()
    {
        $get = Yii::$app->request->get();
        if (isset($get['id'])) {
            /*$orden = $this->verifyModel(ServicioVenta::model()->findByPk($_GET['id']));
            if (!$orden->tipoVenta) {
                $criteria = new CDbCriteria();
                $criteria->compare('fk_idSucursal', $orden->fk_idSucursal);
                $criteria->compare('fk_idMovimientoCaja', $orden->fk_idMovimientoCaja);
                $factura = Factura::model()->find($criteria);

                if (empty($factura)) {
                    $factura = new Factura();
                }
                if (isset($_POST['Factura'])) {
                    $factura->attributes = $_POST['Factura'];
                    if ($factura->isNewRecord) {
                        $factura->fk_idMovimientoCaja = $orden->fk_idMovimientoCaja;
                        $factura->fk_idSucursal       = $orden->fk_idSucursal;
                    }
                    if ($factura->save()) {
                        $orden->fk_idFactura = $factura->idFactura;
                        $orden->save();
                        echo "done";
                        Yii::app()->end();
                    }
                }

                $this->renderPartial('forms/factura', array('model' => $factura, 'orden' => $orden->correlativo . "(" . $orden->codigoServicio . ")"));
            */
            echo "funciona";
        }
    }
}
