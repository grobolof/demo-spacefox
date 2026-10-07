<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$code = sf_request_code();
$article = $code !== '' ? sf_article($code) : null;

if (!$article) {
    $APPLICATION->SetTitle('Новость не найдена — Space Fox');
    if (class_exists('CHTTP')) {
        CHTTP::SetStatus('404 Not Found');
    }
    ?>
    <div class="sf-wrap">
        <?php sf_crumbs([
            ['label' => 'Главная', 'href' => '/'],
            ['label' => 'Новости', 'href' => '/novosti/'],
            ['label' => 'Не найдена'],
        ]); ?>
        <div class="sf-empty">
            <h1>Новость не найдена</h1>
            <a class="sf-btn sf-btn--red" href="/novosti/">Ко всем новостям</a>
        </div>
    </div>
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
    return;
}

$APPLICATION->SetTitle($article['title'] . ' — Space Fox');
$APPLICATION->SetPageProperty('description', $article['lead']);
$image = SITE_TEMPLATE_PATH . '/images/' . $article['image'];
?>
<div class="sf-wrap">
    <?php sf_crumbs([
        ['label' => 'Главная', 'href' => '/'],
        ['label' => 'Новости', 'href' => '/novosti/'],
        ['label' => $article['title']],
    ]); ?>
    <article class="sf-article">
        <div class="sf-article__top">
            <a class="sf-back" href="/novosti/">← Ко всем новостям</a>
            <time datetime="<?= sf_e($article['date']) ?>"><?= sf_e(sf_date_long($article['date'])) ?></time>
        </div>
        <p style="text-align:center"><span class="sf-tag"><?= sf_e($article['tag']) ?></span></p>
        <h1><?= sf_e($article['title']) ?></h1>
        <p class="sf-article__lead"><?= sf_e($article['lead']) ?></p>
        <img class="sf-article__hero" src="<?= sf_e($image) ?>" alt="<?= sf_e($article['title']) ?>">
        <?php foreach ($article['blocks'] as $block): ?>
            <?php if ($block['type'] === 'list'): ?>
                <ul>
                    <?php foreach ($block['items'] as $item): ?>
                        <li><?= sf_e($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p><?= sf_e($block['text']) ?></p>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($article['complex_code'] !== ''): ?>
            <p><a class="sf-btn sf-btn--red" href="/?complex=<?= sf_e($article['complex_code']) ?>#catalog">Квартиры в ЖК «<?= sf_e($article['complex']) ?>»</a></p>
        <?php endif; ?>
    </article>
</div>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
