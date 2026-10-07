<?php

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Квартиры — Space Fox');
$APPLICATION->SetPageProperty('description', 'Каталог квартир Space Fox в Санкт-Петербурге с фильтрами по цене, комнатности и сроку сдачи.');
?>
<div class="sf-wrap">
    <?php sf_crumbs([
        ['label' => 'Главная', 'href' => '/'],
        ['label' => 'Квартиры'],
    ]); ?>
</div>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/local/templates/spacefox/partials/catalog.php';
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
