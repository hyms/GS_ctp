<?php

namespace app\controllers;

use app\components\numerosALetras;
use app\components\SGOrdenes;
use app\components\SGRecibo;
use app\models\Caja;
use app\models\ClienteSearch;
use app\models\MovimientoCaja;
use app\models\MovimientoCajaSearch;
use app\models\OrdenCTP;
use app\models\OrdenCTPSearch;
use app\models\OrdenDetalle;
use app\models\Recibo;
use app\models\ReciboSearch;
use kartik\mpdf\Pdf;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;

class VentaController extends Controller
{
    public $layout = "venta";

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
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "pendiente":
                    $ordenes = OrdenCTP::find()
                        ->where(['estado' => 1])
                        ->andWhere(['fk_idSucursal' => 1]);
                    return $this->render('orden', ['r' => 'pendiente', 'orden' => $ordenes]);
                    break;
                case "buscar":
                    $searchModel                = new OrdenCTPSearch();
                    $searchModel->fk_idSucursal = 1;
                    $ordenes                    = $searchModel->search(Yii::$app->request->getQueryParams());
                    $ordenes->query
                        ->andWhere(['estado' => 0])
                        ->orWhere(['estado' => 2])
                        ->orderBy(['fechaCobro' => SORT_DESC]);
                    /*$ordenes = OrdenCTP::find()
                        ->where(['estado' => 0])
                        ->orWhere(['estado' => 2])
                      *  ->andWhere(['fk_idSucursal' => 1]);
                    */
                    if (Yii::$app->request->post('hasEditable')) {
                        $idOrdenCTP       = Yii::$app->request->post('editableKey');
                        $model            = OrdenCTP::findOne($idOrdenCTP);
                        $out              = Json::encode(['output' => '', 'message' => '']);
                        $post             = [];
                        $post['OrdenCTP'] = current($_POST['OrdenCTP']);
                        // load model like any single model validation
                        if ($model->load($post)) {
                            $model->save();
                            $output = '';
                            // specific use case where you need to validate a specific
                            // editable column posted when you have more than one
                            // EditableColumn in the grid view. We evaluate here a
                            // check to see if buy_amount was posted for the Book model
                            if (isset($posted['factura'])) {
                                $output = $model->factura;
                            }
                            // similarly you can check if the name attribute was posted as well
                            // if (isset($posted['name'])) {
                            //   $output =  ''; // process as you need
                            // }
                            $out = Json::encode(['output' => $output, 'message' => '']);
                        }
                        echo $out;
                        return;
                    }

                    return $this->render('orden', ['r' => 'buscar', 'orden' => $ordenes, 'search' => $searchModel]);
                    break;
                case "deuda":
                    $searchModel                = new OrdenCTPSearch();
                    $searchModel->fk_idSucursal = 1;
                    $searchModel->estado        = 2;
                    $ordenes                    = $searchModel->search(Yii::$app->request->getQueryParams());
                    $ordenes->query->orderBy(['fechaCobro' => SORT_DESC]);
                    return $this->render('orden', ['r' => 'deuda', 'orden' => $ordenes, 'search' => $searchModel]);
                    break;
                case "deudas":
                    //$deudas = MovimientoCaja::findAll('idParent NOT NULL');
                    $searchModel                   = new MovimientoCajaSearch();
                    $searchModel->fk_idCajaDestino = 1;
                    $deudas                        = $searchModel->search(Yii::$app->request->getQueryParams());
                    //$deudas->query->andFilterWhere(['is not', 'idParent', NULL]);
                    $deudas->query->andWhere(['is not', 'idParent', null]);
                    $deudas->query->orderBy(['time' => SORT_DESC]);
                    return $this->render('orden', ['r' => 'deudas', 'deudas' => $deudas, 'search' => $searchModel]);
                    break;
                case "diario":
                    $search = new OrdenCTPSearch();
                    $search->fk_idSucursal=1;
                    $ordenes = $search->search(yii::$app->request->getQueryParams());
                    $ordenes->query->andWhere(['!=','estado','1']);
                    return $this->render('orden',['r'=>'diario','ordenes'=>$ordenes,'search'=>$search]);
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
            $orden->fk_idUserV = yii::$app->user->id;
            $detalle           = OrdenDetalle::findAll(['fk_idOrden' => $orden->idOrdenCTP]);
            $monto             = "";
            if (!empty($orden->fk_idMovimientoCaja))
                $monto = MovimientoCaja::findOne(['idMovimientoCaja' => $orden->fk_idMovimientoCaja])->monto;

            $search  = new ClienteSearch();
            $cliente = $search->search(Yii::$app->request->queryParams);
            $post    = yii::$app->request->post();
            if (isset($post['OrdenCTP']) && isset($post['OrdenDetalle'])) {
                $orden->load($post);
                foreach ($detalle as $key => $item)
                    $detalle[$key]->attributes = $post['OrdenDetalle'][$key];

                $monto                     = (!empty($post['monto'])) ? $post['monto'] : 0;
                $op                        = new SGOrdenes();
                $op->observacionMovimiento = "Orden CTP";
                $data                      = $op->grabar(['orden' => $orden, 'detalle' => $detalle, 'caja' => Caja::findOne(['idCaja' => 1]), 'monto' => $monto], true);
                if ($op->success)
                    $this->redirect(['venta/orden', 'op' => 'buscar']);

                $orden   = $data['orden'];
                $detalle = $data['detalle'];
            }
            return $this->render('orden', [
                'r'        => 'venta',
                'orden'    => $orden,
                'detalle'  => $detalle,
                'clientes' => $cliente,
                'search'   => $search,
                'monto'    => $monto,
            ]);
        } else
            $this->redirect(Url::previous());
    }

    public function actionPagodeuda()
    {
        $get = yii::$app->request->get();
        if (isset($get['id'])) {
            $orden = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);

            if (isset($_GET['deuda']))
                $model = MovimientoCaja::findOne(['idMovimientoCaja' => $get['deuda']]);
            else
                $model = new MovimientoCaja();

            $deudaOld = MovimientoCaja::findOne(['idMovimientoCaja' => $orden->fk_idMovimientoCaja]);
            if (!empty($deudaOld->movimientoCajas)) {
                $c = count($deudaOld->movimientoCajas);
                for ($i = 0; $i < $c; ++$i) {
                    if ($model->isNewRecord) {
                        $deudaOld->monto += $deudaOld->movimientoCajas[$i]->monto;
                    } else {
                        if (($i + 1) != $c) {
                            $deudaOld->monto += $deudaOld->movimientoCajas[$i]->monto;
                        }
                    }
                }
            }

            $post = yii::$app->request->post();
            if (isset($post['MovimientoCaja'])) {
                $caja = Caja::findOne(['idCaja' => 1]);

                $datos = array('orden' => $orden, 'oldDeuda' => $deudaOld, 'deuda' => $model, 'caja' => $caja, 'post' => $post['MovimientoCaja']);
                $pago  = new SGOrdenes();
                $datos = $pago->deuda($datos, true);
                if ($pago->success) {
                    $this->redirect(array('venta/orden', 'op' => 'deudas'));
                } else {
                    $model = $datos['deuda'];
                }
            }

            return $this->render('orden', array('r' => 'pagoDeuda', 'orden' => $orden, 'deuda' => $deudaOld->monto, 'model' => $model));
        }
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
                case "deuda":
                    $deuda = MovimientoCaja::findOne(['idMovimientoCaja'=>$get['id']]);
                    $oldDeuda = $deuda->idParent0;
                    $orden = $oldDeuda->ordenCTPs[0];
                    if (!empty($oldDeuda->movimientoCajas)) {
                        $c = count($oldDeuda->movimientoCajas);
                        for ($i = 0; $i < $c; ++$i) {
                                if (($i + 1) != $c) {
                                    $oldDeuda->monto += $oldDeuda->movimientoCajas[$i]->monto;
                                }
                        }
                    }
                    $num        = new numerosALetras();
                    $num->valor = $orden->montoVenta;
                    $content = $this->renderPartial('prints/deuda',['orden'=>$orden,'deuda'=>$deuda,'oldDeuda'=>$oldDeuda->monto,'num'=>$num->mostrar()]);
                    $title      = "Pago de Deuda - Orden Nro " . $orden->correlativo;
                    break;
                case "recibo":
                    $recibo = Recibo::findOne(['idRecibo'=>$get['id']]);


            }
            $pdf = new Pdf([
                               // set to use core fonts only
                               'mode'         => Pdf::MODE_CORE,
                               'format'       => Pdf::FORMAT_LETTER,
                               'orientation'  => Pdf::ORIENT_PORTRAIT,
                               'destination'  => Pdf::DEST_BROWSER,
                               'content'      => $content,
                               // format content from your own css file if needed or use the
                               // enhanced bootstrap css built by Krajee for mPDF formatting
                               'cssFile'      => '@webroot/css/bootstrap.min.readable.css',
                               // set mPDF properties on the fly
                               'marginLeft'   => 10, // margin_left. Sets the page margins for the new document.
                               'marginRight'  => 10, // margin_right
                               'marginTop'    => 5, // margin_top
                               'marginBottom' => 5, // margin_bottom
                               'marginHeader' => 9, // margin_header
                               'marginFooter' => 9, // margin_footer
                               'options'      => ['title' => $title],
                           ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        }
    }

    public function actionRecibos()
    {
        $get = yii::$app->request->get();
        if (empty($get['op'])) {
            $search                = new ReciboSearch();
            $search->fk_idSucursal = 1;
            $recibos               = $search->search(yii::$app->request->queryParams);
            return $this->render('orden', ['r' => 'recibos', 'recibos' => $recibos, 'search' => $search]);
        } else {
            if (isset($get['id']))
                $recibo = Recibo::findOne(['idRecibo' => $get['id']]);
            else
                $recibo = new Recibo();
            if ($get['op'] == 'i') {
                $recibo->tipoRecibo = 0;
            } else {
                $recibo->tipoRecibo = 1;
            }

            $post = yii::$app->request->post();
            if (isset($post['Recibo'])) {
                if ($recibo->load($post)) {
                    $op   = new SGRecibo();
                    $data = $op->grabar(['recibo' => $recibo, 'caja' => Caja::findOne(['idCaja' => 1])], 1);
                    if ($op->success)
                        $this->redirect(['venta/recibos']);
                }
            }

            return $this->renderAjax('forms/recibo', ['recibo' => $recibo]);
        }
    }

    public function actionChica()
    {
        $get = yii::$app->request->get();
        if(empty($get['op'])) {
            $search                  = new MovimientoCajaSearch();
            $search->fk_idCajaOrigen = 1;
            $cchica                  = $search->search(yii::$app->request->queryParams);
            if (isset($get['CajaChica'])) {
                $cchica->attributes = $get['CajaChica'];
            }
            return $this->render('orden', ['r' => 'cajaChica', 'cajasChicas' => $cchica, 'search' => $search]);
        }
        else
        {
            $cchica = new MovimientoCaja();
            return $this->renderAjax('forms/cajaChica', ['cajaChica' => $cchica]);
        }
    }

    public function actionArqueo()
    {

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
                $total     = 0;
                $detalle   = OrdenDetalle::findAll(['fk_idOrden' => $post['id']]);
                foreach ($detalle as $key => $item) {
                    $detalle[$key]->costo = SGOrdenes::costos($item->fk_idProductoStock, $post['tipoCliente'], date("H:m:s"), $item->cantidad, $tipo);
                    $detalle[$key]->total = ($detalle[$key]->costo * $detalle[$key]->cantidad) + $detalle[$key]->adicional;
                    $resultado[$key]      = $detalle[$key];
                    $total += $detalle[$key]->total;
                }
                $resultado['total'] = $total;

                echo Json::encode($resultado);
            }
        }
    }

    public function actionAddfactura()
    {
        $get = Yii::$app->request->get();
        if (isset($get['id'])) {
            $orden = OrdenCTP::findOne(['idordenCTP' => $get['id']]);
            if (!empty($orden)) {
                if (!$orden->cfSF) {
                    $post = yii::$app->request->post();
                    if (isset($post['OrdenCTP'])) {
                        $orden->attributes = $post['OrdenCTP'];
                        if ($orden->save()) {
                            echo "done";
                            Yii::app()->end();
                        }
                    }

                    echo $this->renderAjax('forms/factura', ['orden' => $orden]);
                }
            }
        }
    }


}
