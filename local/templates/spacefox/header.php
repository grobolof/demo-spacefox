<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/spacefox.php';

$sfPath = $APPLICATION->GetCurPage(false);
$sfHome = $sfPath === '/' || $sfPath === SITE_DIR;
$sfPhone = '8 (800) 100-26-14';
$sfPhoneHref = 'tel:+78001002614';

$sfNav = [
    ['label' => 'О нас', 'href' => '/about/'],
    ['label' => 'Новости', 'href' => '/novosti/'],
    ['label' => 'Контакты', 'href' => '/about/#kontakty'],
];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php $APPLICATION->ShowTitle(); ?></title>
    <link rel="icon" href="<?= SITE_TEMPLATE_PATH ?>/favicon.svg" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= SITE_TEMPLATE_PATH ?>/styles.css?v=2">
    <?php $APPLICATION->ShowHead(); ?>
</head>
<body class="<?= $sfHome ? 'sf-home' : 'sf-inner' ?>">
<div id="panel"><?php $APPLICATION->ShowPanel(); ?></div>
<header class="sf-header">
    <div class="sf-wrap sf-header__bar">
        <a class="sf-logo" href="/" aria-label="Space Fox">
            <span class="sf-logo__mark">S</span>
            <span class="sf-logo__mark">F</span>
            <span class="sf-logo__word">Space Fox</span>
        </a>

        <div class="sf-objects">
            <button class="sf-objects__btn" type="button" aria-expanded="false" data-dropdown="objects">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-5v-6H10v6H5a1 1 0 0 1-1-1v-9.5z"/></svg>
                Объекты
            </button>
            <div class="sf-drop sf-drop--wide" data-menu="objects">
                <?php foreach (sf_complexes() as $complex): ?>
                    <a href="/?complex=<?= sf_e($complex['code']) ?>#catalog">
                        <strong><?= sf_e($complex['name']) ?></strong>
                        <span>от <?= sf_e(sf_millions($complex['price'])) ?> млн ₽</span>
                    </a>
                <?php endforeach; ?>
                <a class="sf-drop__all" href="/kvartiry/">Все квартиры</a>
            </div>
        </div>

        <nav class="sf-nav" id="sf-nav" data-nav>
            <div class="sf-nav__row">
                <?php foreach ($sfNav as $item): ?>
                    <?php
                    $itemPath = rtrim((string) parse_url($item['href'], PHP_URL_PATH), '/');
                    $isCurrent = $itemPath === rtrim($sfPath, '/');
                    ?>
                    <a class="<?= !empty($item['hot']) ? 'is-hot' : '' ?><?= $isCurrent ? ' is-current' : '' ?>" href="<?= sf_e($item['href']) ?>"><?= sf_e($item['label']) ?></a>
                <?php endforeach; ?>
            </div>
        </nav>

        <a class="sf-phone" href="<?= sf_e($sfPhoneHref) ?>"><?= sf_e($sfPhone) ?></a>
        <button class="sf-btn sf-btn--red sf-header__call" type="button" data-callback>Заказать звонок</button>
        <button class="sf-burger" type="button" aria-label="Меню" aria-expanded="false" data-burger>
            <span></span><span></span><span></span>
        </button>
    </div>
</header>
<main class="sf-main">
