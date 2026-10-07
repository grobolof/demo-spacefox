<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Space Fox — квартиры в Санкт-Петербурге');
$APPLICATION->SetPageProperty('description', 'Квартиры в кварталах Space Fox: баннер акций, фильтры по комнатности и цене, карточки с планировками.');

require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/spacefox/partials/hero.php';
require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/spacefox/partials/catalog.php';

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
