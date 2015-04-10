<?php

namespace app\controllers;

use app\components\SGOrdenes;
use app\models\Caja;
use app\models\ClienteSearch;
use app\models\OrdenCTP;
use app\models\OrdenDetalle;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
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
                    $ordenes = OrdenCTP::find(['estado'=>1,'fk_sucursal'=>1]);
                    return $this->render('orden',['r'=>'pendiente','orden'=>$ordenes]);
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
            $orden   = OrdenCTP::find(['idOrdenCTP' => $get['id']])->one();
            $detalle = OrdenDetalle::find(['fk_idOrden' => $orden->idOrdenCTP])->all();

            $search  = new ClienteSearch();
            $cliente = $search->search(Yii::$app->request->queryParams);
            $post    = yii::$app->request->post();
            if (isset($post['OrdenCTP']) && isset($post['OrdenDetalle'])) {
                $orden->load($post);
                foreach ($detalle as $key => $item) {
                    $detalle[$key]->attributes = $post['OrdenDetalle'][$key];
                }
                $op   = new SGOrdenes();
                $data = $op->grabar(['venta' => $orden, 'detalle' => $detalle, 'caja' => Caja::findOne(['idCaja' => 1]), 'monto' => 0], true);
                if ($op->success) {
                    $this->redirect(['buscar']);
                }
                $orden   = $data['venta'];
                $detalle = $data['detalle'];
            }
            return $this->render('orden', [
                'r'        => 'venta',
                'orden'    => $orden,
                'detalle'  => $detalle,
                'clientes' => $cliente,
                'search'   => $search,
            ]);
        } else
            $this->redirect(Url::previous());
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
                $detalle = OrdenDetalle::find(['fk_idOrden' =>$post['id']])->all();
                foreach ($detalle as $key => $item) {
                    $detalle[$key]->costo = SGOrdenes::costos($item->fk_idProductoStock,$post['tipoCliente'],date("H:m:s"),$item->cantidad,$tipo);
                    $detalle[$key]->total = ($detalle[$key]->costo * $detalle[$key]->cantidad) + $detalle[$key]->adicional;
                    $resultado[$key]      = $detalle[$key];
                    $total                += $detalle[$key]->total;
                }
                $resultado['total']  = $total;
                echo CJSON::encode($resultado);
            }
        }
    }
}
