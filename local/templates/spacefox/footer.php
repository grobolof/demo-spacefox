<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$sfPhone = '8 (800) 100-26-14';
?>
</main>
<footer class="sf-footer">
    <div class="sf-wrap sf-footer__grid">
        <div>
            <a class="sf-logo" href="/">
                <span class="sf-logo__mark">S</span>
                <span class="sf-logo__mark">F</span>
                <span class="sf-logo__word">Space Fox</span>
            </a>
            <p class="sf-footer__lead">Кварталы в Санкт-Петербурге со дворами без машин, готовой отделкой и коммерцией на первых этажах.</p>
        </div>
        <div>
            <h2>Компания</h2>
            <a href="/about/">О нас</a>
            <a href="/novosti/">Новости</a>
            <a href="/about/#bonus">Fox Бонус</a>
            <a href="/about/#dolshchikam">Дольщикам</a>
        </div>
        <div>
            <h2>Квартиры</h2>
            <a href="/kvartiry/">Каталог</a>
            <a href="/?rooms=0#catalog">Студии</a>
            <a href="/?rooms=1#catalog">1-комнатные</a>
            <a href="/?rooms=2#catalog">2-комнатные</a>
            <a href="/?finishing=yes#catalog">С отделкой</a>
        </div>
        <div>
            <h2>Контакты</h2>
            <a class="sf-footer__phone" href="tel:+78001002614"><?= sf_e($sfPhone) ?></a>
            <p>Санкт-Петербург,<br>Невский проспект, 48</p>
            <p>Ежедневно с 10:00 до 20:00</p>
            <button class="sf-btn sf-btn--red" type="button" data-callback>Заказать звонок</button>
        </div>
    </div>
    <div class="sf-wrap sf-footer__legal">
        <span>© <?= date('Y') ?> Space Fox. Демонстрационный сайт, предложения не являются офертой.</span>
        <a href="/about/#kontakty">Офис продаж</a>
    </div>
</footer>

<div class="sf-modal" id="sf-callback" hidden>
    <div class="sf-modal__backdrop" data-close></div>
    <div class="sf-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="sf-callback-title">
        <button class="sf-modal__close" type="button" data-close aria-label="Закрыть">×</button>
        <h2 id="sf-callback-title">Заказать звонок</h2>
        <p class="sf-modal__flat" data-callback-flat hidden></p>
        <form id="sf-callback-form">
            <label>Имя
                <input name="name" autocomplete="name" required>
            </label>
            <label>Телефон
                <input name="phone" type="tel" inputmode="tel" placeholder="+7 (000) 000-00-00" required>
            </label>
            <button class="sf-btn sf-btn--red" type="submit">Отправить</button>
        </form>
        <p class="sf-modal__success" hidden>Спасибо! Менеджер Space Fox перезвонит в рабочее время.</p>
    </div>
</div>

<div class="sf-modal" id="sf-map" hidden>
    <div class="sf-modal__backdrop" data-close></div>
    <div class="sf-modal__dialog sf-modal__dialog--map" role="dialog" aria-modal="true" aria-labelledby="sf-map-title">
        <button class="sf-modal__close" type="button" data-close aria-label="Закрыть">×</button>
        <h2 id="sf-map-title">Кварталы на карте</h2>
        <div class="sf-map">
            <?php foreach (sf_complexes() as $complex): ?>
                <a class="sf-map__pin" style="left: <?= (int) $complex['x'] ?>%; top: <?= (int) $complex['y'] ?>%" href="/?complex=<?= sf_e($complex['code']) ?>#catalog">
                    <span><?= sf_e($complex['name']) ?></span>
                    <small>от <?= sf_e(sf_millions($complex['price'])) ?> млн</small>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script src="<?= SITE_TEMPLATE_PATH ?>/script.js?v=1"></script>
</body>
</html>
