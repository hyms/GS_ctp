<?php

namespace app\controllers;

use app\models\User;
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
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

    public function actionUser()
    {
        $user = User::findOne(['idUser' => Yii::$app->user->id]);
        if ($user->load(Yii::$app->request->post())) {
            $userBpk = User::findOne($user->idUser);
            if ($userBpk->password != $user->password)
                $user->password = md5($user->password);

            if ($user->save()) {
                Yii::$app->session->setFlash('success', 'Guardado de datos Exitoso');
                return $this->redirect(['user']);
            } else {
                Yii::$app->session->setFlash('error', $user->getError());
                return $this->redirect(['user']);
            }
        }
        return $this->render('@app/views/all/forms/user', ['model' => $user]);
        //return $this->render('forms/user', ['model' => $user]);
    }
}
