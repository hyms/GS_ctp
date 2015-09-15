<?php
use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
    /* @var $content string */

    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="shortcut icon" href="<?= Yii::$app->request->baseUrl."/favicon.png"?>" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php
    if(Yii::$app->user->isGuest) {
$script = <<<JS
var LHCChatOptions = {};
LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500,domain:'graficasingular.com'};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
po.src = '//chat.graficasingular.com/index.php/esp/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(top)/350/(units)/pixels/(leaveamessage)/true?r='+referrer+'&l='+location;
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
JS;
        $this->registerJs($script, \yii\web\View::POS_END);
    }
?>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
        NavBar::begin([
                          'brandLabel' => 'Grafica Singular',
                          'brandUrl' => Yii::$app->homeUrl,
                          'options' => [
                              'class' => 'navbar-inverse',
                          ],
                      ]);

        $items = [['label' => 'Home', 'url' => ['/site/index']]];
        if(Yii::$app->user->isGuest) {
            array_push($items, ['label' => 'Nosotros', 'url' => ['/site/nosotros']]);
            array_push($items, ['label' => 'Servicios', 'url' => ['/site/servicios']]);
            //array_push($items, ['label' => 'Cotizaciones', 'url' => ['/site/cotizacion']]);
            array_push($items, ['label' => 'Contacto', 'url' => ['/site/contacto']]);
            array_push($items, ['label' => 'Login', 'url' => ['/site/login']]);
        }
        else {
            array_push($items,
                       ['label'       => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url'         => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']]
            );
        }
        echo Nav::widget([
                             'options' => ['class' => 'navbar-nav navbar-right'],
                             'items' => $items,
                         ]);
        NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-center">&copy; Grafica Singular <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
