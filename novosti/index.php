<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Новости — Space Fox');
$APPLICATION->SetPageProperty('description', 'Новости Space Fox: старт продаж, скидки и рассрочка на квартиры в Санкт-Петербурге.');

$articles = sf_news();
$complexes = [];
foreach ($articles as $article) {
    if ($article['complex_code'] !== '') {
        $complexes[$article['complex_code']] = $article['complex'];
    }
}
?>
<div class="sf-wrap" data-news>
    <?php sf_crumbs([
        ['label' => 'Главная', 'href' => '/'],
        ['label' => 'Новости'],
    ]); ?>
    <div class="sf-pagehead sf-pagehead--center">
        <h1>Новости</h1>
    </div>
    <div class="sf-news-tools">
        <label class="sf-field">
            <span>Жилые комплексы</span>
            <select class="sf-select" data-news-complex>
                <option value="">Все</option>
                <?php foreach ($complexes as $code => $name): ?>
                    <option value="<?= sf_e($code) ?>"><?= sf_e($name) ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <div class="sf-tags" role="group" aria-label="Рубрики">
            <button type="button" data-news-tag="" class="is-active">Все новости</button>
            <button type="button" data-news-tag="Рассрочка">Рассрочка</button>
            <button type="button" data-news-tag="Скидки">Скидки</button>
            <button type="button" data-news-tag="Старт продаж">Старт продаж</button>
        </div>
        <label class="sf-field">
            <span>Поиск по новостям</span>
            <span class="sf-search">
                <input type="search" placeholder="Поиск..." data-news-search>
            </span>
        </label>
    </div>
    <div class="sf-news-grid">
        <?php foreach ($articles as $article): ?>
            <a
                class="sf-news-card"
                data-news-card
                data-tag="<?= sf_e($article['tag']) ?>"
                data-complex="<?= sf_e($article['complex_code']) ?>"
                data-text="<?= sf_e(mb_strtolower($article['title'] . ' ' . $article['lead'])) ?>"
                href="/novosti/<?= sf_e($article['code']) ?>/"
            >
                <h2><?= sf_e($article['title']) ?></h2>
                <div class="sf-news-card__meta">
                    <span class="sf-news-card__go" aria-hidden="true">→</span>
                    <time datetime="<?= sf_e($article['date']) ?>"><?= sf_e(sf_date_short($article['date'])) ?></time>
                    <span class="sf-tag"><?= sf_e($article['tag']) ?></span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="sf-empty" data-news-empty hidden>
        <p>Ничего не нашли. Смените рубрику или запрос.</p>
    </div>
</div>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
