<?php
    use kartik\editable\Editable;
    use kartik\grid\GridView;
    use kartik\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Pjax;

    $columns = [];
    array_push($columns,[
        'header'=>'Correlativo',
        'attribute'=>'correlativo',
    ]);
    array_push($columns,[
        'header'=>'Codigo',
        'attribute'=>'codigoServicio',
    ]);
    array_push($columns,[
        'header'=>'Cliente',
        'attribute'=>'nombreCliente',
        'value'=>function($model){
            if(empty($model->fkIdCliente))
                return "";
            return $model->fkIdCliente->nombreNegocio;
        },
    ]);
    array_push($columns, [
        'header'=>'Responsable',
        'attribute'=>'responsable',
    ]);
    array_push($columns, [
        'header'=>'Fecha Generada',
        'attribute'=>'fechaGenerada',
    ]);
    array_push($columns, [
        'header'=>'Fecha Venta',
        'attribute'=>'fechaCobro',
    ]);
    array_push($columns, [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'factura',
        'editableOptions'=>[
            'header'=>'Factura',
            'inputType'=>Editable::INPUT_TEXT,
            'format' => Editable::FORMAT_BUTTON,
            'size'=>'md',
        ],
    ]);
    array_push($columns, [
        'class' => 'yii\grid\ActionColumn',
        'template'=>'{update} {anular} {print}',
        'buttons'=>[
            'update'=>function($url,$model){
                $options = array_merge([
                                           //'class'=>'btn btn-success',
                                           'data-toggle'=>'tooltip',
                                           'title'=>'Modificar'
                                       ]);
                $url = Url::to(['venta/venta','id'=>$model->idOrdenCTP]);
                if(empty($model->fechaCierre))
                    return Html::a(Html::icon('pencil'), $url, $options);
                else
                    return "";
            },
            'print'=>function($url,$model){
                $url = Url::to(['venta/print','op'=>'orden','id'=>$model->idOrdenCTP]);
                $options = array_merge([
                                           //'class'=>'btn btn-success',
                                           'data-toggle'=>'tooltip',
                                           'title'=>'Imprimir',
                                           'data-target' => "#modalPage",
                                           'onClick'=>'printView("'.$url.'")'
                                       ]);
                return Html::a(Html::icon('print'), '#', $options);
            },
        ]
    ]);

    Pjax::begin();
    echo GridView::widget([
                              'dataProvider'=> $orden,
                              'filterModel' => $search,
                              'columns' => $columns,
                              'toolbar' =>  [
                              ],
                              // set export properties
                              'responsive'=>true,
                              'hover'=>true,
                              'bordered'=>false,
                              'panel' => [
                                  'type' => GridView::TYPE_DEFAULT,
                                  'heading' => Html::tag('strong','Ordenes de Trabajo - Transaccionadas'),
                              ],
                          ]);
    Pjax::end();
    echo $this->render('@app/views/share/scripts/modalPage');