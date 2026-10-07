<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$slides = [
    [
        'image' => 'hero-office.jpg',
        'kicker' => 'Дополнительная',
        'title' => 'Скидка 5%',
        'text' => 'при визите в офис продаж Space Fox',
    ],
    [
        'image' => 'hero-park.jpg',
        'kicker' => 'Старт продаж',
        'title' => 'Охтинский парк',
        'text' => 'третья очередь, квартиры с отделкой',
    ],
    [
        'image' => 'hero-ready.jpg',
        'kicker' => 'Уже скоро',
        'title' => 'Ключи в 2026',
        'text' => 'готовые квартиры в «Северной сосне»',
    ],
];
?>
<section class="sf-hero">
    <div class="sf-wrap">
        <div class="sf-hero__viewport">
            <?php foreach ($slides as $index => $slide): ?>
                <article class="sf-hero__slide<?= $index === 0 ? ' is-active' : '' ?>" data-hero-slide style="background-image: url('<?= SITE_TEMPLATE_PATH ?>/images/<?= sf_e($slide['image']) ?>')">
                    <div class="sf-hero__copy">
                        <p class="sf-hero__kicker"><?= sf_e($slide['kicker']) ?></p>
                        <p class="sf-hero__title"><?= sf_e($slide['title']) ?></p>
                        <p class="sf-hero__text"><?= sf_e($slide['text']) ?></p>
                        <a class="sf-btn sf-btn--white" href="#catalog">Узнать подробности</a>
                    </div>
                </article>
            <?php endforeach; ?>
            <div class="sf-hero__count"><span data-hero-index>1</span> из <?= count($slides) ?></div>
        </div>
    </div>
</section>
