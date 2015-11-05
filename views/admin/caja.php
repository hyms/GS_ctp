<?php
use kartik\date\DatePicker;
use kartik\helpers\Html;

$this->title = 'Caja';
?>
<div class="row">
    <div class="col-md-2">
        <?= $this->render('menus/cajaMenu'); ?>
    </div>
    <div class="col-md-10">
        <?php
        if(isset($r)) {
            switch ($r) {
                case "cajaChica":
                    echo $this->render('tables/cajaChicas', ['cajasChicas' => $cajasChicas, 'search' => $search]);
                    break;
                case "recibos":
                    echo $this->render('tables/recibos', ['recibos' => $recibos, 'search' => $search]);
                    break;
                case "arqueos":
                    echo $this->render('tables/arqueos', ['arqueos' => $arqueos, 'search' => $search]);
                    break;
                case "arqueo":
                    echo $this->render('menus/menuArqueo', ['sucursales' => $sucursales]);
                    if (isset($saldo)) {
                        echo Html::beginTag('div', ['class' => 'row']);
                        echo Html::tag('div',
                            $this->render('tables/registroDiario',
                                [
                                    'fecha' => $fecha,
                                    'saldo' => $saldo,
                                    'ventas' => $ventas,
                                    'deudas' => $deudas,
                                    'recibos' => $recibos,
                                    'cajas' => $cajas,
                                    'caja' => $caja,
                                    'arqueo' => '',
                                ]),
                            ['class' => 'col-md-12']);
                        echo Html::endTag('div');
                    }
                    break;
                case "admin":
                    echo Html::beginTag('div', ['class' => 'row']);
                    echo Html::beginTag('div', ['class' => 'well']);
                    $form = \yii\bootstrap\ActiveForm::begin(['layout' => 'inline']);
                    echo Html::beginTag('div', ['class' => 'form-group']);
                    echo Html::label('Fecha','fecha').' ';
                    echo DatePicker::widget([
                        'name' => 'fecha',
                        //'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'type' => DatePicker::TYPE_INPUT,
                        'language'=>'es',
                        'value' => $fecha,
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]);
                    echo Html::endTag('div');
                    echo Html::submitButton('Generar',['class'=>'btn btn-default']);
                    $form->end();
                    echo Html::endTag('div');
                    if ($fecha != '') {
                        echo Html::tag('div',
                            $this->render('tables/registroAdmin',
                                [
                                    'fecha' => $fecha,
                                    'saldo' => $saldo,
                                    'recibos' => $recibos,
                                    'cajas' => $cajas,
                                    'caja' => $caja,
                                    'arqueo' => $arqueo,
                                ]),
                            ['class' => 'col-md-12']);
                    }
                    echo Html::endTag('div');
                    break;
            }
        }
        ?>
    </div>
</div>