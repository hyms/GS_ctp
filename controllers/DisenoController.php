<?php

namespace app\controllers;

use app\components\SGOrdenes;
use app\components\SGProducto;
use app\models\Cliente;
use app\models\ClienteSearch;
use app\models\Notas;
use app\models\NotasSearch;
use app\models\OrdenCTP;
use app\models\OrdenCTPSearch;
use app\models\OrdenDetalle;
use app\models\ProductoStock;
use app\models\Sucursal;
use app\models\User;
use kartik\mpdf\Pdf;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\HttpException;

class DisenoController extends Controller
{
    public $layout = "diseno";

    private $idSucursal;

    public function init()
    {
        if (!empty(Yii::$app->user->identity)) {
            if (Yii::$app->user->identity->role == 3 || Yii::$app->user->identity->role == 6) {
                return $this->redirect(Yii::$app->homeUrl);
            }
            $sucursal = Sucursal::findOne(['idSucursal' => Yii::$app->user->identity->fk_idSucursal]);
            if (empty($sucursal))
                throw new HttpException(412, SGOperation::getError(412));
            else
                $this->idSucursal = $sucursal->idSucursal;
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
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'Yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'Yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $notasC = Notas::find()->andWhere(['is', 'fk_idUserVisto', null]);
        $notasC->andWhere(['tipoNota' => 0]);
        $notasC->andWhere(['fk_idSucursal' => $this->idSucursal]);
        $data1 = new ActiveDataProvider([
            'query' => $notasC,
        ]);
        $notasI = Notas::find()->andWhere(['is', 'fk_idUserVisto', null]);
        $notasI->andWhere(['tipoNota' => 1]);
        $notasC->andWhere(['fk_idSucursal' => $this->idSucursal]);
        $data2 = new ActiveDataProvider([
            'query' => $notasI,
        ]);
        $notasR = Notas::find()->andWhere(['is', 'fk_idUserVisto', null]);
        $notasR->andWhere(['tipoNota' => 2]);
        $notasC->andWhere(['fk_idSucursal' => $this->idSucursal]);
        $data3 = new ActiveDataProvider([
            'query' => $notasR,
        ]);
        //return $this->render('orden', ['notas' => $data]);

        return $this->render('index', [
            'notas1' => $data1,
            'notas2' => $data2,
            'notas3' => $data3,
        ]);
    }

    public function actionOrden()
    {
        $get = Yii::$app->request->get();
        //$post=Yii::$app->request->post();
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "cliente":
                    $producto = SGProducto::getProductos(true, 10, $this->idSucursal);
                    $datos = $this->ordenes($get, 0);
                    if (!is_array($datos))
                        return $this->redirect(['orden', 'op' => 'buscar']);
                    $ordenes = $datos['orden'];
                    $detalle = $datos['detalle'];
                    return $this->render('orden', [
                        'r' => 'nuevo',
                        'orden' => $ordenes,
                        'detalle' => $detalle,
                        'producto' => $producto,
                    ]);
                case 'buscar':
                    $ordenes = SGOrdenes::getOrdenes($this->idSucursal);
                    return $this->render('orden', ['r' => 'buscar', 'orden' => $ordenes]);
                    break;
                case 'list':
                    $searchModel = new OrdenCTPSearch();
                    $ordenes = $searchModel->search(Yii::$app->request->getQueryParams());
                    $ordenes->query
                        ->andWhere('`OrdenCTP`.`fk_idSucursal` = ' . $this->idSucursal)
                        ->andWhere('`estado`=0 or `estado`=2')
                        ->andWhere(['tipoOrden' => 0])
                        ->orderBy(['fechaCobro' => SORT_DESC]);
                    return $this->render('orden', ['r' => 'list', 'orden' => $ordenes, 'search' => $searchModel]);
                    break;
                case 'nota':
                    $search = new NotasSearch();
                    $notas = $search->search(Yii::$app->request->getQueryParams());
                    $notas->query
                        ->andWhere(['fk_idSucursal' => $this->idSucursal])
                        ->andWhere(['tipoNota' => 0])
                        ->orderBy(['fechaCreacion' => SORT_DESC]);
                    return $this->render('orden', ['r' => 'nota', 'notas' => $notas, 'search' => $search]);
                    break;
            }
        }
        $notas = Notas::find()->andWhere(['is', 'fk_idUserVisto', null]);
        $notas->andWhere(['fk_idSucursal' => $this->idSucursal]);
        $notas->andWhere(['tipoNota' => 0]);
        $data = new ActiveDataProvider([
            'query' => $notas,
        ]);
        return $this->render('orden', ['notas' => $data]);
    }

    public function actionInterna()
    {
        $get = Yii::$app->request->get();
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "nueva":
                    $producto = SGProducto::getProductos(true, 10, $this->idSucursal);
                    $nulled = false;
                    if ($post = Yii::$app->request->post())
                        if (isset($post['anular']))
                            $nulled = $post['anular'];
                    $datos = $this->ordenes($get, 1, null, $nulled);
                    if (!is_array($datos))
                        return $this->redirect(['interna', 'op' => 'list']);
                    $ordenes = $datos['orden'];
                    $detalle = $datos['detalle'];
                    return $this->render('interna', [
                        'r' => 'nuevo',
                        'orden' => $ordenes,
                        'detalle' => $detalle,
                        'producto' => $producto,
                    ]);
                case 'list':
                    $searchModel = new OrdenCTPSearch();
                    $ordenes = $searchModel->search(Yii::$app->request->getQueryParams());
                    $ordenes->query
                        ->andWhere('`OrdenCTP`.`fk_idSucursal` = ' . $this->idSucursal)
                        ->andWhere(['tipoOrden' => 1])
                        ->orderBy(['fechaGenerada' => SORT_DESC]);

                    return $this->render('interna', ['r' => 'buscar', 'orden' => $ordenes, 'search' => $searchModel]);
                    break;
                case 'nota':
                    $search = new NotasSearch();
                    $notas = $search->search(Yii::$app->request->getQueryParams());
                    $notas->query
                        ->andWhere(['fk_idSucursal' => $this->idSucursal])
                        ->andWhere(['tipoNota' => 1])
                        ->orderBy(['fechaCreacion' => SORT_DESC]);
                    return $this->render('interna', ['r' => 'nota', 'notas' => $notas, 'search' => $search]);
                    break;
            }
        }
        $notas = Notas::find()->andWhere(['is', 'fk_idUserVisto', null]);
        $notas->andWhere(['tipoNota' => 1]);
        $notas->andWhere(['fk_idSucursal' => $this->idSucursal]);
        $data = new ActiveDataProvider([
            'query' => $notas,
        ]);
        return $this->render('interna', ['notas' => $data]);
    }

    public function actionReposicion()
    {
        $get = Yii::$app->request->get();
        if (isset($get['tipo'])) {
            switch ($get['tipo']) {
                case 0:
                    $producto = SGProducto::getProductos(true, 10, $this->idSucursal);
                    $datos = $this->ordenes($get, 2);
                    if (!is_array($datos))
                        return $this->redirect(['reposicion', 'op' => 'list']);
                    $orden = $datos['orden'];
                    $detalle = $datos['detalle'];
                    return $this->render('repos', ['r' => '0', 'producto' => $producto, 'tipo' => $get['tipo'], 'detalle' => $detalle, 'orden' => $orden]);
                    break;
                case 1:
                    $search = new OrdenCTPSearch();
                    $ordenes = $search->search(Yii::$app->request->queryParams);
                    $ordenes->pagination = ['pageSize' => 10];
                    $ordenes->query
                        ->andWhere(['tipoOrden' => 0, '`OrdenCTP`.`fk_idSucursal`' => $this->idSucursal])
                        ->andWhere('`estado`=0 or `estado`=2');
                    $idParent = '';
                    if ($post = Yii::$app->request->post())
                        $idParent = $post['idParent'];
                    $datos = $this->ordenes($get, 2, $idParent);
                    if (!is_array($datos))
                        return $this->redirect(['reposicion', 'op' => 'list']);
                    $orden = $datos['orden'];
                    $detalle = $datos['detalle'];
                    return $this->render('repos', [
                        'r' => '1',
                        'idParent' => $idParent,
                        'ordenes' => $ordenes,
                        'search' => $search,
                        'tipo' => $get['tipo'],
                        'detalle' => $detalle,
                        'orden' => $orden,
                    ]);
                    break;
                case 2:
                    $producto = SGProducto::getProductos(true, 10, $this->idSucursal);
                    $search = new OrdenCTPSearch();
                    $ordenes = $search->search(Yii::$app->request->queryParams);
                    $ordenes->pagination = ['pageSize' => 10];
                    $ordenes->query->andWhere(['tipoOrden' => 1, '`OrdenCTP`.`fk_idSucursal`' => $this->idSucursal]);
                    $idParent = '';
                    if ($post = Yii::$app->request->post())
                        $idParent = $post['idParent'];
                    $datos = $this->ordenes($get, 2, $idParent);
                    if (!is_array($datos))
                        return $this->redirect(['reposicion', 'op' => 'list']);
                    $orden = $datos['orden'];
                    $detalle = $datos['detalle'];
                    return $this->render('repos', ['r' => '2', 'idParent' => $idParent, 'ordenes' => $ordenes, 'search' => $search, 'tipo' => $get['tipo'], 'detalle' => $detalle, 'orden' => $orden, 'producto' => $producto]);
                    break;
                case 3:
                    $sucursal = \app\models\Sucursal::findOne(Yii::$app->user->identity->fk_idSucursal);
                    $cond = "";
                    if (!empty($sucursal->sucursals)) {
                        foreach ($sucursal->sucursals as $key => $suc) {
                            if ($key > 0)
                                $cond .= " or ";
                            $cond = $cond . "`OrdenCTP`.`fk_idSucursal`=" . $suc->idSucursal;
                        }
                    }
                    $search = new \app\models\OrdenCTPSearchSucursal();
                    $ordenes = $search->search(Yii::$app->request->queryParams);
                    $ordenes->pagination = ['pageSize' => 10];
                    $ordenes->query
                        ->andWhere(['tipoOrden' => 0])
                        ->andWhere('`estado`=0 or `estado`=2')
                        ->andWhere($cond);
                    $idParent = '';
                    if ($post = Yii::$app->request->post())
                        $idParent = $post['idParent'];
                    $datos = $this->ordenes($get, 2, $idParent);
                    if (!is_array($datos))
                        return $this->redirect(['reposicion', 'op' => 'list']);
                    $orden = $datos['orden'];
                    $detalle = $datos['detalle'];
                    return $this->render('repos', [
                        'r' => '1',
                        'idParent' => $idParent,
                        'ordenes' => $ordenes,
                        'search' => $search,
                        'tipo' => $get['tipo'],
                        'detalle' => $detalle,
                        'orden' => $orden,
                    ]);
                case 5:
                    $idParent = '';
                    if ($post = Yii::$app->request->post())
                        $idParent = $post['idParent'];
                    $datos = $this->ordenes($get, 2, $idParent, true);
                    if (!is_array($datos))
                        return $this->redirect(['reposicion', 'op' => 'list']);
                    $orden = $datos['orden'];
                    $detalle = $datos['detalle'];
                    return $this->render('repos', ['r' => 'null', 'idParent' => $idParent, 'detalle' => $detalle, 'orden' => $orden]);
            }
        }
        if (isset($get['op'])) {
            switch ($get['op']) {
                case "nueva":
                    return $this->render('repos', [
                        'r' => 'nuevo',
                        'tipo' => '',
                    ]);

                case 'list':
                    $search = new OrdenCTPSearch();
                    $ordenes = $search->search(Yii::$app->request->getQueryParams());
                    $ordenes->query
                        ->andWhere(['`OrdenCTP`.`fk_idSucursal`' => $this->idSucursal])
                        ->andWhere(['tipoOrden' => 2])
                        ->orderBy(['fechaGenerada' => SORT_DESC]);

                    return $this->render('repos', ['r' => 'list', 'orden' => $ordenes, 'search' => $search]);
                    break;
                case 'nota':
                    $search = new NotasSearch();
                    $notas = $search->search(Yii::$app->request->getQueryParams());
                    $notas->query
                        ->andWhere(['fk_idSucursal' => $this->idSucursal])
                        ->andWhere(['tipoNota' => 2])
                        ->orderBy(['fechaCreacion' => SORT_DESC]);
                    return $this->render('repos', ['r' => 'nota', 'notas' => $notas, 'search' => $search]);
                    break;
            }
        }
        $notas = Notas::find()
            ->andWhere(['is', 'fk_idUserVisto', null])
            ->andWhere(['fk_idSucursal' => $this->idSucursal])
            ->andWhere(['tipoNota' => 2]);
        $data = new ActiveDataProvider([
            'query' => $notas,
        ]);
        return $this->render('repos', ['notas' => $data]);
    }

    private function ordenes($get, $tipo, $idParent = null, $null = false)
    {
        $ordenes = new OrdenCTP();
        $detalle = [];
        if (isset($get['id'])) {
            $ordenes = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
            $detalle = $ordenes->ordenDetalles;
        } else {
            $ordenes->fk_idSucursal = $this->idSucursal;
            $ordenes->estado = 1;
            $ordenes->tipoOrden = $tipo;
            $ordenes->correlativo = SGOrdenes::correlativo($ordenes->fk_idSucursal, $tipo);
            if ($tipo != 0)
                $ordenes->codigoServicio = SGOrdenes::codigo($ordenes->fk_idSucursal, $tipo);

            if (empty($ordenes->fechaGenerada))
                $ordenes->fechaGenerada = date('Y-m-d H:i:s');
        }
        if ($idParent != null)
            $ordenes->fk_idParent = $idParent;

        $ordenes->fk_idUserD = Yii::$app->user->id;
        $post = Yii::$app->request->post();
        if (!empty($post)) {
            if (isset($post['OrdenCTP']) && isset($post['OrdenDetalle'])) {
                $operacion = new SGOrdenes();
                if (isset($get['id'])) {
                    $ordenes = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                    $detalle = OrdenDetalle::findAll(['fk_idOrden' => $ordenes->idOrdenCTP]);
                    $cp = count($post['OrdenDetalle']);
                    $cs = count($detalle);
                    if ($cp != $cs)
                        if ($cs == OrdenDetalle::deleteAll(['fk_idOrden' => $ordenes->idOrdenCTP]))
                            for ($i = 0; $i < count($post['OrdenDetalle']); ++$i)
                                $detalle[$i] = new OrdenDetalle();
                } else {
                    for ($i = 0; $i < count($post['OrdenDetalle']); ++$i)
                        $detalle[$i] = new OrdenDetalle();
                }
                $ordenes->load($post);
                Model::loadMultiple($detalle, $post);
                //$datos = ;
                if ($null)
                    $datos = $operacion->grabar(['orden' => $ordenes, 'detalle' => $detalle], false, true);
                else
                    $datos = $operacion->grabar(['orden' => $ordenes, 'detalle' => $detalle]);
                if ($operacion->success)
                    return true;
                return $datos;
            } else {
                if (isset($post['OrdenCTP'])) {
                    $ordenes = $post['OrdenCTP'];
                }
                if (isset($post['OrdenDetalle'])) {
                    $detalle = $post['OrdenDetalle'];
                }
            }
        }
        return ['orden' => $ordenes, 'detalle' => $detalle];
    }

    public function actionPrint()
    {
        $get = Yii::$app->request->get();
        if (isset($get['op']) && isset($get['id'])) {
            switch ($get['op']) {
                case "orden":
                    $orden = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                    $content = $this->renderPartial('prints/ordenPrint', ['orden' => $orden]);
                    $title = "Orden de Venta Nro " . $orden->correlativo;
                    break;
                case "interna":
                    $orden = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                    $content = $this->renderPartial('prints/interna', ['orden' => $orden]);
                    $title = "Orden Interna " . $orden->codigoServicio;
                    break;
                case "reposicion":
                    $orden = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                    $content = $this->renderPartial('prints/repos', ['orden' => $orden]);
                    $title = "Reposicion " . $orden->codigoServicio;
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
                'cssFile'      => '@webroot/css/bootstrap.min.journal.css',
                // set mPDF properties on the fly
                'marginLeft' => 5, // margin_left. Sets the page margins for the new document.
                'marginRight' => 5, // margin_right
                'marginTop' => 8, // margin_top
                'marginBottom' => 8, // margin_bottom
                'marginHeader' => 9, // margin_header
                'marginFooter' => 9, // margin_footer
                'options' => ['title' => $title],
            ]);

            // return the pdf output as per the destination setting
            return $pdf->render();
        }
    }

    public function actionAdd_detalle()
    {
        $get = Yii::$app->request->get();
        //if (isset($get)) {
        if (Yii::$app->request->isAjax && isset($get)) {
            $tipo = 0;
            $detalle = new OrdenDetalle();
            $almacen = null;
            if (isset($get['al'])) {
                $almacen = ProductoStock::findOne(['idProductoStock' => $get['al']]);
            }
            if (empty($almacen))
                $almacen = new ProductoStock();
            if (isset($get['tipo']))
                $tipo = $get['tipo'];

            $detalle->fk_idProductoStock = $almacen->idProductoStock;

            return $this->renderAjax('forms/_newRowDetalleVenta', array(
                'model' => $detalle,
                'index' => $get['index'],
                'tipo' => $tipo,
                'almacen' => $almacen,
            ));
        }
    }

    public function actionAddreposicion()
    {
        $get = Yii::$app->request->get();
        if (Yii::$app->request->isAjax && isset($get['id'])) {
            //if (isset($get['id'])) {
            //if (Yii::$app->request->isAjax && isset($get)) {
            $orden = OrdenCTP::findOne($get['id']);
            $detalle = $orden->ordenDetalles;
            return $this->renderAjax('forms/oRepos', ['idParent' => $orden->idOrdenCTP, 'orden' => $orden, 'detalle' => $detalle, 'tipo' => $get['tipo']]);
        }
    }

    public function actionNotas()
    {
        if (Yii::$app->request->isAjax) {
            $get = Yii::$app->request->get();
            $nota = new Notas();
            if (isset($get['id'])) {
                $nota = Notas::findOne($get['id']);
            } else {
                $nota->fk_idSucursal = $this->idSucursal;
                $nota->fk_idUserCreador = Yii::$app->user->id;
                $nota->tipoNota = $get['tipo'];
                if (empty($nota->fechaCreacion))
                    $nota->fechaCreacion = date('Y-m-d H:i:s');
            }
            $post = Yii::$app->request->post();
            if (isset($post['Notas'])) {
                $nota->attributes = $post['Notas'];
                if ($nota->save()) {
                    return "done";
                }
            }
            return $this->renderAjax('forms/nota', ['nota' => $nota]);
        }
    }

    public function actionVisto()
    {
        if (Yii::$app->request->isAjax) {
            $get = Yii::$app->request->get();
            if (isset($get['id'])) {
                $nota = Notas::findOne($get['id']);
                $nota->fk_idUserVisto = Yii::$app->user->id;
                $nota->fechaVisto = date('Y-m-d H:i:s');
                if ($nota->save()) {
                    return "done";
                }
            }
        }
    }

    public function actionCliente()
    {
        $post = Yii::$app->request->post();
        if (isset($post['name'])) {
            $cliente = Cliente::find()
                ->andWhere(['fk_idSucursal' => $this->idSucursal])
                ->andWhere(['nombreNegocio' => $post['name']])
                ->one();
            return $cliente->telefono;
        }
    }

    public function actionReview()
    {
        if (Yii::$app->request->isAjax) {
            $get = Yii::$app->request->get();
            if (isset($get['op']) && isset($get['id'])) {
                switch ($get['op']) {
                    case "cliente":
                        $orden = OrdenCTP::findOne(['idOrdenCTP' => $get['id']]);
                        return $this->renderAjax('prints/orden', ['orden' => $orden]);
                        break;
                }
            }
        }
    }

    public function actionDependientes()
    {
        $get = Yii::$app->request->get();
        $suc = Sucursal::findAll(['fk_idParent' => $this->idSucursal]);
        if (isset($get['id'])) {
            $searchModel = new OrdenCTPSearch();
            $ordenes = $searchModel->search(Yii::$app->request->getQueryParams());
            $ordenes->query
                ->andWhere('`OrdenCTP`.`fk_idSucursal`=' . $get['id'])
                ->andWhere(['tipoOrden' => 0])
                ->andWhere('`estado`=0 OR `estado`=2 OR `estado`=(-1)')
                ->orderBy(['fechaCobro' => SORT_DESC]);
            return $this->render('dependientes', ['r' => 'list', 'menu' => $suc, 'orden' => $ordenes, 'search' => $searchModel]);
        }
        $post = Yii::$app->request->post();
        if (isset($post['id'])) {
            $orden = OrdenCTP::findOne(['idOrdenCTP' => $post['id']]);
            $orden->fk_idUserD2 = Yii::$app->user->id;
            if ($orden->save()) {
                return "done";
                //$this->redirect(['diseno/dependientes','id'=>$orden->fk_idSucursal]);
            }
        }
        return $this->render('dependientes', ['menu' => $suc]);
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
                return $this->redirect(['diseno/user']);
            } else {
                Yii::$app->session->setFlash('error', $user->getError());
                return $this->redirect(['diseno/user']);
            }
        }
        return $this->render('forms/user', ['model' => $user]);
    }

    public function actionClientes()
    {
        $search = new ClienteSearch();
        $clientes = $search->search(Yii::$app->request->getQueryParams());
        $clientes->query
            ->andWhere(['fk_idSucursal' => $this->idSucursal]);
        return $this->render('tables/clientes', ['clientes' => $clientes, 'search' => $search]);
    }
}