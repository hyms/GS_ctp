<?php

namespace app\controllers;

use app\models\Producto;
use app\models\ProductoSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AdminController extends Controller
{
    public $layout = "admin";

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

    public function actionProducto()
    {
        $get = Yii::$app->request->get();
        $render = "";
        if(isset($get['op']))
        {
            switch($get['op']){
                case "new":
                    $render="new";
                    $producto=new Producto();
                    if($producto->load(Yii::$app->request->post()))
                    {
                        if($producto->save())
                            $this->redirect(['admin/producto','op'=>'list']);
                    }
                    return $this->render('producto', ['r' => $render,'producto'=>$producto]);
                    break;
                case "list":
                    $render="list";
                    $search = new ProductoSearch();
                    $producto = $search->search(Yii::$app->request->queryParams);

                    return $this->render('producto', ['r' => $render,'producto'=>$producto,'search'=>$search]);
            }
        }
        return $this->render('producto', ['r' => $render]);
    }
}
