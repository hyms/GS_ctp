<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ImprentaController extends Controller
{
    public $layout = "imprenta";

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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            /*'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],*/
        ];
    }

    public function init()
    {
        if (!empty(Yii::$app->user->identity)) {
            if (Yii::$app->user->identity->role != 1 && Yii::$app->user->identity->role != 2) {
                return $this->redirect(Yii::$app->homeUrl);
            }
        }
        parent::init();
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionConfig()
    {
        $get = Yii::$app->request->get();
        if(isset($get['op']))
        {
            switch($get['op'])
            {
                case 'newi':
                    break;
                case 'link':
                    break;
                case 'list':
                    break;
            }
        }
        return $this->render('config');
    }

    public function actionCotizar()
    {
        return $this->render('cotizar');
    }

    public function actionReport()
    {
        return $this->render('report');
    }
}
