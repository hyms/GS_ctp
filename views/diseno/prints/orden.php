<?php
    use kartik\grid\GridView;
    use yii\data\ArrayDataProvider;
    use yii\helpers\Html;

    echo Html::beginTag('div',['class'=>'row']);

    echo Html::beginTag('div',['class'=>'col-xs-12']);

    echo Html::tag('div',
                   Html::tag('div',
                             Html::tag('strong',$orden->fkIdSucursal->nombre),
                             ['class'=>'col-xs-7']).
                   Html::tag('div',
                             Html::tag('strong','FECHA RECEPCION:').' '.$orden->fechaGenerada,
                             ['class'=>'col-xs-5']),
                   ['class'=>'row']);
    echo Html::tag('div',
                   Html::tag('div',
                             Html::tag('strong','Responsable:').' '.
                             Html::tag('span',$orden->responsable,['class'=>'text-capitalize']),
                             ['class'=>'col-xs-7']).
                   Html::tag('div',
                             Html::tag('strong','Telefono:').' '.$orden->telefono,
                             ['class'=>'col-xs-5']),
                   ['class'=>'row']);
    $data = new ArrayDataProvider();
    $data->models = $orden->ordenDetalles;
    $columns = [
        [
            'class'=>'kartik\grid\SerialColumn',
            'header'=>'Nro.',
        ],
        [
            'header'=>'Formato',
            'value'=>function($model){
                return $model->fkIdProductoStock->fkIdProducto->formato;
            }
        ],
        [
            'header'=>'Cant.',
            'value'=>'cantidad'
        ],
        [
            'header'=>'Colores',
            'format'=>'raw',
            'value'=>function($model)
            {
                return (($model->C)?Html::tag('strong','C'):'').
                (($model->M)?Html::tag('strong','M'):'').
                (($model->Y)?Html::tag('strong','Y'):'').
                (($model->K)?Html::tag('strong','K'):'');
            }
        ],
        [
            'header'=>'Trabajo',
            'value'=>'trabajo',
        ],
        [
            'header'=>'Pinza',
            'value'=>'pinza',
        ],
        [
            'header'=>'Resol.',
            'value'=>'resolucion',
        ],

    ];
    echo GridView::widget([
                              'dataProvider'=> $data,
                              'columns' => $columns,
                              'responsive'=>true,
                              'condensed'=>true,
                              'hover'=>true,
                              'layout'=>'{items}'
                          ]);

    echo Html::tag('div',
                   Html::tag('div',
                             Html::tag('strong','Diseñador/a:'). ' '.$orden->fkIdUserD->nombre.' '.$orden->fkIdUserD->apellido,
                             ['class'=>'col-xs-6']).
                   Html::tag('div',
                             Html::tag('strong','Obs:').' '.$orden->observaciones,
                             ['class'=>'col-xs-6']),
                   ['class'=>'row']);

    echo Html::endTag('div');
    echo Html::endTag('div');
