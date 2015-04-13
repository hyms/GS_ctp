<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
?>
<div class="cliente-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cliente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idCliente',
            'fk_idTipoCliente',
            'nombreCompleto',
            'nombreNegocio',
            'nombreResponsable',
            // 'correo',
            // 'fechaRegistro',
            // 'telefono',
            // 'direccion',
            // 'nitCi',
            // 'codigoCliente',
            // 'enable',
            // 'fk_idSucursal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
