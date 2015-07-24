<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\LoginForm;
use Yii;
use yii\web\Controller;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            /*'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],*/
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

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContacto()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->contact()) {
                Yii::$app->session->setFlash('success', 'Gracias por contactarnos. Tendremos una respuesta lo antes posible.');
            } else {
                Yii::$app->session->setFlash('error', 'Hubo un error al enviar el correo.');
                return $this->render('contacto', [
                    'model' => $model,
                ]);
            }
            return $this->refresh();
        } else {
            return $this->render('contacto', [
                'model' => $model,
            ]);
        }
    }

    public function actionNosotros()
    {
        return $this->render('nosotros');
    }

    public function actionServicios()
    {
        return $this->render('servicios');
    }

    public function actionCotizacion()
    {
        return $this->render('cotizaciones');
    }

}