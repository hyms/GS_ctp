<?php

namespace app\controllers;

use app\components\SGOrdenes;
use app\models\OrdenCTP;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                    if($ordenes->load(Yii::$app->request->post()))
                    {
                        $ordenes->validate();
                    }
                    $render="nuevo";
                    break;
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

}
