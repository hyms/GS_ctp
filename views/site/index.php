<?php
    /* @var $this yii\web\View */
    $this->title = 'Grafica Singular';

    if(Yii::$app->user->isGuest) {
        echo $this->render('indexGuest');
    }
    else
    {
        echo $this->render('indexLogin');
    }