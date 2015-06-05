<?php

namespace app\controllers;

use app\components\numerosALetras;
use app\components\SGCaja;
use app\components\SGOperation;
use app\components\SGOrdenes;
use app\components\SGRecibo;
use app\models\Caja;
use app\models\Cliente;
use app\models\ClienteSearch;
use app\models\MovimientoCaja;
use app\models\MovimientoCajaSearch;
use app\models\OrdenCTP;
use app\models\OrdenCTPSearch;
use app\models\Recibo;
use app\models\ReciboSearch;
use app\models\Sucursal;
use kartik\mpdf\Pdf;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\HttpException;

class VentaController extends Controller
{
    public $layout = "venta";

    private $idCaja;
    private $idSucursal;
    private $idServicio = 2;

    public function init()
    {
        if (!empty(yii::$app->user->identity)) {
            $sucursal = Sucursal::findOne(['idSucursal' => yii::$app->user->identity->fk_idSucursal]);
            if (empty($sucursal))
                throw new HttpException(412, SGOperation::getError(412));
            else
                $this->idSucursal = $sucursal->idSucursal;
            $caja = Caja::findOne(['fk_idSucursal' => $this->idSucursal]);
            if (empty($caja))
                throw new HttpException(411, SGOperation::getError(411));
            else
                $this->idCaja = $caja->idCaja;
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
            /*'access' => [
                'class' => AccessControl::className(),
                // We will override the default rule config with the new AccessRule class
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [
                            User::ROLE_USER,
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        // Allow moderators and admins to update
                        'roles' => [
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        // Allow admins to delete
                        'roles' => [
                            User::ROLE_ADMIN
                        ],
                    ],
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
                        ->andWhere(['fk_idSucursal' => $this->idSucursal])
                        ->andWhere(['tipoOrden' => 0])
                        ->orderBy(['secuencia' => SORT_ASC]);
                    return $this->render('orden', ['r' => 'pendiente', 'orden' => $ordenes]);
                    break;
                case "buscar":
                    $searchModel                = new OrdenCTPSearch();
                    $searchModel->fk_idSucursal = $this->idSucursal;
                    $ordenes                    = $searchModel->search(Yii::$app->request->getQueryParams());
                    $ordenes->query
                        ->andWhere(['estado' => 0])
                        ->orWhere(['estado' => 2])
                        ->andWhere(['tipoOrden' => 0])
                        ->orderBy(['fechaCobro' => SORT_DESC]);
                    if (Yii::$app->request->post('hasEditable')) {
                        $idOrdenCTP       = Yii::$app->request->post('editableKey');
                        $model            = OrdenCTP::findOne(['idOrdenCTP'=>$idOrdenCTP]);
                        $out              = Json::encode(['output' => '', 'message' => '']);
                        $post             = Yii::$app->request->post();
                        $post['OrdenCTP'] = current($post['OrdenCTP']);
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
                case "diario":
                    $search                = new OrdenCTPSearch();
                    $search->fk_idSucursal = $this->idSucursal;
                    $ordenes               = $search->search(yii::$app->request->getQueryParams());
                    $ordenes->query->andWhere(['!=', 'estado', '1'])->andWhere(['tipoOrden' => 0]);
                    return $this->render('orden', ['r' => 'diario', 'ordenes' => $ordenes, 'search' => $search]);
                    break;

                case "deuda":
                    $searchModel                = new OrdenCTPSearch();
                    $searchModel->fk_idSucursal = $this->idSucursal;
                    $searchModel->estado        = 2;
                    $ordenes                    = $searchModel->search(Yii::$app->request->getQueryParams());
                    $ordenes->query->orderBy(['fechaCobro' => SORT_DESC]);
                    $ordenes->query->andWhere(['tipoOrden' => 0]);
                    return $this->render('orden', ['r' => 'deuda', 'orden' => $ordenes, 'search' => $searchModel]);
                    break;
                case "deudas":
                    //$deudas = MovimientoCaja::findAll('idParent NOT NULL');
                    $searchModel                   = new MovimientoCajaSearch();
                    $searchModel->fk_idCajaDestino = $this->idCaja;
                    $deudas                        = $searchModel->search(Yii::$app->request->getQueryParams());
                    //$deudas->query->andFilterWhere(['is not', 'idParent', NULL]);
                    $deudas->query->andWhere(['is not', 'idParent', null]);
                    $deudas->query->orderBy(['time' => SORT_DESC]);
                    return $this->render('orden', ['r' => 'deudas', 'deudas' => $deudas, 'search' => $searchModel]);
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
            $detalle           = $orden->ordenDetalles;
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
                $data                      = $op->grabar(['orden' => $orden, 'detalle' => $detalle, 'caja' => Caja::findOne(['idCaja' => $this->idCaja]), 'monto' => $monto], true);
                if ($op->success)
                    return $this->redirect(['venta/orden', 'op' => 'buscar', 'print' => $data['orden']->idOrdenCTP]);

                $orden   = $data['orden'];
                $detalle = $data['detalle'];
            }
            /*return $this->render('orden', [
                'r' => 'venta',
                'orden' => $orden,
                'detalle' => $detalle,
                'clientes' => $cliente,
                'search' => $search,
                'monto' => $monto,
            ]);*/
            return $this->render('forms/venta', [
                'clientes' => $cliente,
                'search'   => $search,
                'orden'    => $orden,
                'detalle'  => $detalle,
                'monto'    => $monto,
            ]);
        } else
            return $this->redirect(Url::previous());
    }

    public function actionCaja()
    {
        $get = Yii::$app->request->get();
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "chica":
                    $search                  = new MovimientoCajaSearch();
                    $search->fk_idCajaOrigen = $this->idCaja;
                    $search->tipoMovimiento  = 2;
                    $cchica                  = $search->search(yii::$app->request->queryParams);
                    if (isset($get['CajaChica'])) {
                        $cchica->attributes = $get['CajaChica'];
                    }
                    return $this->render('caja', ['r' => 'cajaChica', 'cajasChicas' => $cchica, 'search' => $search]);
                    break;
                case "recibo":
                    $search                = new ReciboSearch();
                    $search->fk_idSucursal = $this->idSucursal;
                    $recibos               = $search->search(yii::$app->request->queryParams);
                    return $this->render('caja', ['r' => 'recibos', 'recibos' => $recibos, 'search' => $search]);
                    break;
                case "arqueos":
                    $search  = new MovimientoCajaSearch();
                    $arqueos = $search->search(Yii::$app->request->queryParams);
                    $arqueos->query->andWhere(['tipoMovimiento' => 3]);
                    $arqueos->query->andWhere(["fk_idCajaOrigen" => $this->idCaja]);
                    $arqueos->query->orderBy(["time" => SORT_DESC]);
                    return $this->render('caja', ['r' => 'arqueos', 'arqueos' => $arqueos, 'search' => $search]);
                    break;
                case "arqueo":
                    $arqueo = new MovimientoCaja();
                    $caja   = Caja::findOne(['idCaja' => $this->idCaja]);
                    $post   = Yii::$app->request->post();
                    if (isset($post['MovimientoCaja'])) {
                        $datos             = array('arqueo' => $post['MovimientoCaja'], 'caja' => $caja);
                        $arqueoTransaccion = new SGOrdenes();
                        $datos             = $arqueoTransaccion->arqueo($datos, true);
                        if ($arqueoTransaccion->success) {
                            return $this->redirect(['caja', 'op' => 'arqueos']);
                        }
                    }

                    if (isset($get['d'])) {
                        $d   = $get['d'];
                        $dia = date("w", strtotime(date("Y-m-") . $d));
                        if ($dia == 0)
                            $d -= 1;
                        if (strlen($d) == 1)
                            $d = "0" . $d;
                        $m = date("m");
                        if ($d == 0) {
                            $m--;
                            $d = SGOperation::ultimoDiaMes(date("Y"), $m);
                        }
                        if (date("d") == $d)
                            $end = date("Y-m-d H:i:s");
                        else
                            $end = date("Y") . "-" . $m . "-" . $d . " 23:59:59";

                        $variables = SGCaja::getSaldo($this->idCaja, $end);

                        return $this->render('caja',
                                             [
                                                 'r'       => 'arqueo',
                                                 'saldo'   => $variables['saldo'],
                                                 'arqueo'  => $arqueo,
                                                 'caja'    => $caja,
                                                 'fecha'   => date('Y-m-d H:i:s', strtotime($end)),
                                                 'ventas'  => $variables['ventas'],
                                                 'deudas'  => $variables['deudas'],
                                                 'recibos' => $variables['recibos'],
                                                 'cajas'   => $variables['cajas'],
                                                 'dia'     => $d,
                                             ]);
                        break;
                    }
                    return $this->render('caja', ['r' => 'arqueo']);
            }

        }
        return $this->render('caja');
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
                $caja = Caja::findOne(['idCaja' => $this->idCaja]);

                $datos = array('orden' => $orden, 'oldDeuda' => $deudaOld, 'deuda' => $model, 'caja' => $caja, 'post' => $post['MovimientoCaja']);
                $pago  = new SGOrdenes();
                $datos = $pago->deuda($datos, true);
                if ($pago->success) {
                    return $this->redirect(array('venta/orden', 'op' => 'deudas'));
                } else {
                    $model = $datos['deuda'];
                }
            }

            return $this->render('forms/deuda', array('r' => 'pagoDeuda', 'orden' => $orden, 'deuda' => $deudaOld->monto, 'model' => $model));
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
                    $deuda    = MovimientoCaja::findOne(['idMovimientoCaja' => $get['id']]);
                    $oldDeuda = $deuda->idParent0;
                    $orden    = $oldDeuda->ordenCTPs[0];
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
                    $content    = $this->renderPartial('prints/deuda', ['orden' => $orden, 'deuda' => $deuda, 'oldDeuda' => $oldDeuda->monto, 'num' => $num->mostrar()]);
                    $title      = "Pago de Deuda - Orden Nro " . $orden->correlativo;
                    break;
                case "recibo":
                    $recibo     = Recibo::findOne(['idRecibo' => $get['id']]);
                    $num        = new numerosALetras();
                    $num->valor = $recibo->monto;
                    $content    = $this->renderPartial('prints/recibo', ['recibo' => $recibo, 'monto' => $num->mostrar()]);;
                    $title = "Pago de Deuda - Orden Nro " . $recibo->secuencia;
                    break;
                case "arqueo":
                    $arqueo  = MovimientoCaja::findOne(['idMovimientoCaja' => $get['id']]);
                    $title   = "Comprobante " . date("d-m-Y", strtotime($arqueo->fechaCierre));
                    $content = $this->renderPartial('prints/comprobante', array('render' => 'comprobante', 'arqueo' => $arqueo));
                    break;
                case "registro":
                    $arqueoTmp = MovimientoCaja::findOne(['idMovimientoCaja' => $get['id']]);
                    $arqueo    = MovimientoCaja::find()
                        ->where(['!=', 'idMovimientoCaja', $get['id']])
                        ->andWhere(['<=', 'fechaCierre', $arqueoTmp->fechaCierre])
                        ->andWhere(['fk_idCajaOrigen' => $arqueoTmp->fk_idCajaOrigen])
                        ->andWhere(['tipoMovimiento' => 3])
                        ->one();
                    if (empty($arqueo))
                        $arqueo = new MovimientoCaja();
                    $variables = SGCaja::getSaldo($this->idCaja, $arqueoTmp->time, false, ['recibos' => true, 'arqueo' => $arqueoTmp->fechaCierre]);
                    $content   = $this->renderPartial('prints/registroDiario',
                                                      array(
                                                          'saldo'   => $arqueo->saldoCierre,
                                                          'fecha'   => date("Y-m-d", strtotime($arqueo->fechaCierre)),
                                                          'arqueo'  => $arqueoTmp,
                                                          'ventas'  => $variables['ventas'],
                                                          'recibos' => $variables['recibos'],
                                                          'cajas'   => $variables['cajas'],
                                                          'deudas'  => $variables['deudas'],
                                                      ));
                    $title     = 'Registro Diario ' . date("d-m-Y", strtotime($arqueo->fechaCierre));
                    break;

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
                               'marginTop'    => 8, // margin_top
                               'marginBottom' => 8, // margin_bottom
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
            $search->fk_idSucursal = $this->idSucursal;
            $recibos               = $search->search(yii::$app->request->queryParams);
            return $this->render('recibo', ['r' => 'recibos', 'recibos' => $recibos, 'search' => $search]);
        } else {
            if (isset($get['id']))
                $recibo = Recibo::findOne(['idRecibo' => $get['id']]);
            else {
                $recibo                = new Recibo();
                $recibo->fk_idSucursal = $this->idSucursal;
                //$recibo->fk_idServicio = $this->idServicio;
                $recibo->fechaRegistro = date("Y-m-d H:i:s");
                $recibo->fk_idUser     = Yii::$app->user->id;
            }
            if ($get['op'] == 'i') {
                $recibo->tipoRecibo = 0;
            } else {
                $recibo->tipoRecibo = 1;
            }

            $post = yii::$app->request->post();
            if (isset($post['Recibo'])) {
                if ($recibo->load($post)) {
                    $op   = new SGRecibo();
                    $data = $op->grabar(['recibo' => $recibo, 'caja' => Caja::findOne(['idCaja' => $this->idCaja])]);
                    if ($op->success)
                        return $this->redirect(['venta/recibos']);
                }
            }

            return $this->renderAjax('forms/recibo', ['recibo' => $recibo]);
        }
    }

    public function actionChica()
    {
        $get = yii::$app->request->get();
        if (empty($get['op'])) {
            $search                  = new MovimientoCajaSearch();
            $search->fk_idCajaOrigen = $this->idCaja;
            $search->tipoMovimiento  = 2;
            $cchica                  = $search->search(yii::$app->request->queryParams);
            if (isset($get['CajaChica'])) {
                $cchica->attributes = $get['CajaChica'];
            }
            return $this->render('chica', ['r' => 'cajaChica', 'cajasChicas' => $cchica, 'search' => $search]);
        } else {
            $cchica = new MovimientoCaja();
            if (isset($get['id'])) {
                $cchica = MovimientoCaja::findOne(['idMovimientoCaja' => $get['id']]);
            }

            $post = Yii::$app->request->post();
            if (isset($post['MovimientoCaja'])) {
                $op    = new SGCaja();
                $datos = $op->cajaChica(['cajaChica' => $cchica, 'post' => $post['MovimientoCaja'], 'caja' => Caja::findOne(['idCaja' => $this->idCaja])]);
                if ($op->success) {
                    return $this->redirect(['venta/caja','op'=>'chica']);
                } else {
                    $cchica = $datos['cajaChica'];
                }
            }
            return $this->renderAjax('forms/cajaChica', ['cajaChica' => $cchica]);
        }
    }

    public function actionCliente()
    {
        $get = Yii::$app->request->get();
        if (isset($get['id'])) {
            $model = Cliente::findOne($get['id']);
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['venta/cliente']);
            } else {
                return $this->renderAjax('forms/cliente', [
                    'model' => $model,
                ]);
            }
        }
        if (isset($get['op'])) {
            if ($get['op'] == "new") {
                $model                = new Cliente();
                $model->fechaRegistro = date("Y-m-d H:i:s");
                $model->enable        = 1;
                $model->fk_idSucursal = $this->idSucursal;
                if ($model->load(Yii::$app->request->post()) && $model->save()) {
                    return $this->redirect(['venta/cliente']);
                } else {
                    return $this->renderAjax('forms/cliente', [
                        'model' => $model,
                    ]);
                }
            }
        }
        $search   = new ClienteSearch();
        $clientes = $search->search(Yii::$app->request->queryParams);
        $clientes->query->andWhere(['fk_idSucursal' => $this->idSucursal]);
        return $this->render('cliente', ['r' => 'list', 'clientes' => $clientes, 'search' => $search]);
    }

    public function actionReport()
    {
        $post = Yii::$app->request->post();
        if (isset($post['tipo']) && isset($post['fechaStart']) && isset($post['fechaEnd'])) {
            $post['fechaStart'] = date('Y-m-d', strtotime($post['fechaStart']));
            $post['fechaEnd']   = date('Y-m-d', strtotime($post['fechaEnd']));
            $venta              = OrdenCTP::find();
            $venta->where(['OrdenCTP.fk_idSucursal' => $this->idSucursal]);
            $venta->joinWith('fkIdCliente');
            $swdeuda = false;
            if (!empty($post['clienteNegocio'])) {
                $venta->andWhere(['cliente.nombreNegocio' => $post['clienteNegocio']]);
            }
            if (!empty($post['clienteResponsable'])) {
                $venta->andWhere(['cliente.nombreResponsable' => $post['clienteResponsable']]);
            }

            if ($post['tipo'] == "v")
                $venta->andWhere(['!=', 'estado', '1']);

            if ($post['tipo'] == "d")
                $venta->andWhere(['estado'=> '2']);

            $venta->andWhere(['between', 'fechaCobro', $post['fechaStart'] . ' 00:00:00', $post['fechaEnd'] . ' 23:59:59']);
            $venta->orderBy(['correlativo' => SORT_ASC]);

            //$data = $venta->all();

            if ($post['tipo'] == "pd") {
                $venta              = OrdenCTP::find();
                $venta->joinWith(['fkIdMovimientoCaja']);
                $deudas = MovimientoCaja::find()
                    ->joinWith(['idParent0','ordenCTPs'])
                    ->where(['tipoMovimiento' => 0])
                    ->andWhere(['OrdenCTP.fk_idSucursal' => $this->idSucursal]);
                /*$deudas->where(['tipoMovimiento' => 0]);
                $deudas->joinWith(['ordenCTPs']);
                $deudas->joinWith(['idParent0']);
                $deudas->andWhere(['OrdenCTP.fk_idSucursal' => $this->idSucursal]);
                $deudas->andWhere(['!=', 'OrdenCTP.estado', '1']);
                $deudas->andWhere('DATE(`OrdenCTP`.`fechaCobro`) < DATE(`time`)');
                $deudas->andWhere('`times` between "' . $post['fechaStart'] . ' 00:00:00" and "' . $post['fechaEnd'] . ' 23:59:59"');
                $deudas->orderBy(['OrdenCTP.correlativo' => SORT_ASC]);*/

                $venta = $deudas;
            }
            $data = new ActiveDataProvider([
                'query' => $venta,
            ]);
            return $this->render('reporte', [
                'r'                  => 'table',
                'clienteNegocio'     => $post['clienteNegocio'],
                'clienteResponsable' => $post['clienteResponsable'],
                'fechaStart'         => $post['fechaStart'],
                'fechaEnd'           => $post['fechaEnd'],
                'data'               => $data,
            ]);

            //$mPDF1->WriteHTML($this->renderPartial('prints/report', array('data' => $data, 'deuda' => $deuda), true));
            //Yii::app()->end();
        } else
            return $this->render('reporte', ['clienteNegocio' => '', 'clienteResponsable' => '', 'fechaStart' => '', 'fechaEnd' => '']);
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
                    //$detalle[$key]->costo = SGOrdenes::costos($item->fk_idProductoStock, $post['tipoCliente'], date("H:m:s"), $item->cantidad, $tipo);
                    $detalle[$key]->total = ($detalle[$key]->costo * $detalle[$key]->cantidad) + $detalle[$key]->adicional;
                    $resultado[$key]      = $detalle[$key];
                    $total += $detalle[$key]->total;
                }
                $resultado['total'] = $total;

                return Json::encode($resultado);
            }
        }
    }

    public function actionAddfactura()
    {
        $get = Yii::$app->request->get();
        if (isset($get['id'])) {
            $orden = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
            if (!empty($orden)) {
                if (!$orden->cfSF) {
                    $post = yii::$app->request->post();
                    if (isset($post['OrdenCTP'])) {
                        $orden->attributes = $post['OrdenCTP'];
                        if ($orden->save()) {
                            return "done";
                        }
                    }

                    return $this->renderAjax('forms/factura', ['orden' => $orden]);
                }
            }
        }
    }

}
