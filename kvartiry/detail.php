<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$code = sf_request_code();
$flat = $code !== '' ? sf_flat($code) : null;

if (!$flat) {
    $APPLICATION->SetTitle('Квартира не найдена — Space Fox');
    if (class_exists('CHTTP')) {
        CHTTP::SetStatus('404 Not Found');
    }
    ?>
    <div class="sf-wrap">
        <?php sf_crumbs([
            ['label' => 'Главная', 'href' => '/'],
            ['label' => 'Квартиры', 'href' => '/kvartiry/'],
            ['label' => 'Не найдена'],
        ]); ?>
        <div class="sf-empty">
            <h1>Такой квартиры нет</h1>
            <p>Ссылка устарела или номер лота указан с ошибкой.</p>
            <a class="sf-btn sf-btn--red" href="/kvartiry/">Вернуться в каталог</a>
        </div>
    </div>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
    return;
}

$APPLICATION->SetTitle($flat['title'] . ' — Space Fox');
$APPLICATION->SetPageProperty('description', $flat['title'] . ' в ЖК «' . $flat['complex'] . '», ' . sf_area($flat['area']) . ', ' . sf_price($flat['price']));
$mortgage = sf_mortgage($flat['price']);
?>
<div class="sf-wrap" data-detail>
    <?php sf_crumbs([
        ['label' => 'Главная', 'href' => '/'],
        ['label' => 'Квартиры', 'href' => '/kvartiry/'],
        ['label' => 'ЖК «' . $flat['complex'] . '»', 'href' => '/?complex=' . $flat['complex_code'] . '#catalog'],
        ['label' => 'Этаж ' . $flat['floor']],
        ['label' => $flat['title']],
    ]); ?>

    <div class="sf-detail">
        <div class="sf-detail__switch">
            <button type="button" class="is-active" data-show="plan">
                <small>Планировка</small>
                <?= sf_plan_svg($flat) ?>
            </button>
            <button type="button" data-show="floor">
                <small>Этаж</small>
                <?= sf_floor_svg($flat) ?>
            </button>
        </div>
        <div class="sf-detail__stage">
            <div class="sf-pills"><span><?= sf_e($flat['finishing']) ?></span></div>
            <h2 data-stage-title>Планировка</h2>
            <div data-view="plan"><?= sf_plan_svg($flat) ?></div>
            <div data-view="floor" hidden><?= sf_floor_svg($flat) ?></div>
        </div>
        <aside class="sf-specs">
            <div class="sf-specs__tools">
                <button class="sf-btn sf-btn--ghost" type="button" data-print>Скачать PDF</button>
                <button class="sf-card__fav" type="button" data-fav="<?= sf_e($flat['code']) ?>" aria-label="В избранное">
                    <svg viewBox="0 0 24 24"><path d="M12 20s-7-4.4-7-9a4 4 0 0 1 7-2 4 4 0 0 1 7 2c0 4.6-7 9-7 9z"/></svg>
                </button>
            </div>
            <h1><?= sf_e($flat['title']) ?></h1>
            <dl>
                <dt>Общая площадь</dt>
                <dd><?= sf_e(sf_area($flat['area'])) ?></dd>
                <dt>Срок сдачи</dt>
                <dd><?= sf_e($flat['deadline']) ?></dd>
                <dt>Отделка</dt>
                <dd><?= sf_e($flat['finishing']) ?></dd>
            </dl>
            <h2>Все характеристики</h2>
            <dl>
                <dt>ЖК</dt>
                <dd><?= sf_e($flat['complex']) ?></dd>
                <dt>Район</dt>
                <dd><?= sf_e($flat['district']) ?></dd>
                <dt>Адрес</dt>
                <dd><?= sf_e($flat['street']) ?></dd>
                <dt>Дом</dt>
                <dd><?= sf_e($flat['house']) ?></dd>
                <dt>Этаж</dt>
                <dd><?= (int) $flat['floor'] ?> из <?= (int) $flat['floors'] ?></dd>
                <dt>Тип планировки</dt>
                <dd><?= sf_e($flat['plan']) ?></dd>
                <dt>Окна</dt>
                <dd><?= sf_e($flat['windows']) ?></dd>
                <dt>Номер</dt>
                <dd><?= sf_e($flat['number']) ?></dd>
            </dl>
            <div class="sf-price__row">
                <div>
                    <p class="sf-price"><?= sf_e(sf_price($flat['price'])) ?></p>
                    <p class="sf-price__note"><?= !empty($flat['old_price']) ? 'Спецпредложение' : 'Стоимость' ?></p>
                </div>
                <?php if (!empty($flat['old_price'])): ?>
                    <div>
                        <p class="sf-price__old"><?= sf_e(sf_price($flat['old_price'])) ?></p>
                        <p class="sf-price__note">Базовая</p>
                    </div>
                <?php endif; ?>
            </div>
            <p class="sf-mortgage">Ипотека от <?= sf_e(sf_price($mortgage)) ?>/мес при взносе 20% на 30 лет</p>
            <div class="sf-specs__actions">
                <button class="sf-btn sf-btn--dark" type="button" data-callback data-flat="<?= sf_e($flat['title'] . ', ЖК «' . $flat['complex'] . '»') ?>">Забронировать</button>
                <a class="sf-btn sf-btn--ghost" href="/about/#ipoteka">Условия покупки</a>
            </div>
        </aside>
    </div>

    <article class="sf-prose">
        <h2>Описание</h2>
        <?php foreach ($flat['description'] as $paragraph): ?>
            <p><?= sf_e($paragraph) ?></p>
        <?php endforeach; ?>
        <div class="sf-chips">
            <?php foreach ($flat['features'] as $feature): ?>
                <span><?= sf_e($feature) ?></span>
            <?php endforeach; ?>
        </div>
    </article>
</div>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
