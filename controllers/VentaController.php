<?php

namespace app\controllers;

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
        if(isset($get['id']))
        {
            $orden = OrdenCTP::find(['idOrdenCTP'=>$get['id']])->one();
            $detalle = OrdenDetalle::find(['fk_idOrden'=>$orden->idOrdenCTP])->all();

            $search = new ClienteSearch();
            $cliente = $search->search(Yii::$app->request->queryParams);

            return $this->render('orden',[
                'r'=>'venta',
                'orden'=>$orden,
                'detalle'=>$detalle,
                'clientes'=>$cliente,
                'search'=>$search,
            ]);
        }
        else
            $this->redirect(Url::previous());
    }

}
