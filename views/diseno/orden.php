<?php
    use yii\helpers\Html;

    $this->title = 'Diseño-Ordenes';

    echo Html::beginTag('div',['class'=>'row']);

    echo Html::tag('div',
                   $this->render('menus/ordenMenu'),
                   ['class'=>'col-md-2']);

    echo Html::beginTag('div',['class'=>'col-md-10']);
    if(isset($r)) {
        switch ($r) {
            case 'nuevo':
                echo $this->render('forms/cliente', [
                    'orden'    => $orden,
                    'detalle'  => $detalle,
                    'producto' => $producto,
                ]);
                echo $this->render('scripts/save');
                break;
            case 'buscar':
                echo $this->render('tables/buscar', ['orden' => $orden]);
                break;
            case 'list':
                echo $this->render('tables/ordenes', ['orden' => $orden, 'search' => $search]);
                echo $this->render('@app/views/share/scripts/modalView',['size'=>'large']);
                break;
            case 'nota':
                echo $this->render('tables/notas', ['notas' => $notas, 'search' => $search, 'tipo' => 0]);
                break;
        }
    }
    else {
        echo Html::beginTag('div',['class'=>'col-md-offset-6 col-md-6']);
        echo $this->render('tables/notasPendientes', ['notas' => $notas]);
        echo Html::endTag('div');
    }
    echo Html::endTag('div');


    echo Html::endTag('div');

