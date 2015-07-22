<?php
    use kartik\widgets\Affix;

    /* @var $this yii\web\View */
    $this->title = 'Nosotros';
    /* Initializing the items */
    $historia='<p class="text-justify">En el año 2006, se crea <strong>GRAFICA SINGULAR</strong>, en la zona Central, en la calle Juan de la Riva, de ciudad de la Paz – Bolivia.  Desde entonces, impulsada por sólidos valores siempre vigentes no há dejado de crecer.
<br>En un principio realizando sólo el servicio de diseño gráfico y publicidad, posteriormente se incorporó maquinaria offset, y por último sistemas de preprensa (CTP), sistemas de impresión indispensable para acompañar el pujante crecimiento del mercado gráfico y editorial del país.
<br>En la actualidad se mantienen vigentes los valores que vieron nacer y crecer la empresa.</p>';

    $valores='<p class="text-justify"><strong>GRAFICA SINGULAR</strong>, es una empresa con más de 9 años de experiencia.  Su sólida trayectoria refleja que siempre supo crecer, respondiendo a los desafíos de cada modelo económico adoptado en el páis.
<br>En la actualidad el mercado se presenta cada vez más competitivo: la demanda y las necesidades de los clientes crecen año tras año.
<br>Ante este escenario tan complejo, <strong>GRAFICA SINGULAR</strong>, se distingue por un valor fundamental: <strong><em>Un servicio de excelencia</em></strong>.
<br>La fidelidad de nuestros clientes es nuestro mayor orgullo. Hoy contamos con clientes que nos acompañan desde hace años, quienes confían en nosotros y valoran nuestros servicios.
<br><strong>GRAFICA SINGULAR</strong>, tiene una cartera con más de 250 clientes activos y su staff trabaja las 24 horas del día para brindar un servicio integral, respondiendo con profesionalismo a las necesidades actuales del mercado.</p>';

    $recursos='recursos';

    $icon = 'arrow-right';
    $items = [
        [
            'url' => '#hist',
            'label' => 'Historia',
            'icon' => 'circle-arrow-right',
            'content' => $historia,
        ],
        [
            'url' => '#val',
            'label' => 'Valores',
            'icon' => 'circle-arrow-right',
            'content' => $valores,
        ],
        [
            'url' => '#rec',
            'label' => 'Recursos',
            'icon' => 'circle-arrow-right',
            'content' => $recursos,
        ],
    ];
    /* Display both menu and body aside each other */
?>
<div class="row">
    <div class="col-sm-3">
        <?php
            echo Affix::widget([
                                   'type' => 'menu',
                                   'items' => $items
                               ]);?>
    </div>
    <div class="col-sm-9">
        <?php
            echo Affix::widget([
                                   'type' => 'body',
                                   'items' => $items
                               ]);?>
    </div>
</div>