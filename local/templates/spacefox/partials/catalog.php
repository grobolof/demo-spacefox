<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

$flats = sf_flats();
$minPrice = min(array_column($flats, 'price'));
$maxPrice = max(array_column($flats, 'price'));
$minMillion = floor($minPrice / 100000) / 10;
$maxMillion = ceil($maxPrice / 100000) / 10;
?>
<section class="sf-catalog" id="catalog" data-catalog data-mode="flats">
    <div class="sf-wrap">
        <div class="sf-panel">
            <div class="sf-panel__head">
                <h1>Выберите
                    <span class="sf-pick-menu" data-pick-menu>
                        <button class="sf-pick" type="button" data-pick>квартиру ▾</button>
                        <span class="sf-pick-menu__list">
                            <button type="button" data-mode="flats" data-label="квартиру ▾" class="is-active">Квартиру</button>
                            <button type="button" data-mode="commerce" data-label="коммерцию ▾">Коммерцию</button>
                        </span>
                    </span>
                </h1>
                <button class="sf-btn sf-btn--ghost" type="button" data-map-open>Искать на карте</button>
            </div>

            <div class="sf-filters">
                <label class="sf-field">
                    <span>Комнатность</span>
                    <span class="sf-rooms">
                        <button type="button" data-rooms="0">С</button>
                        <button type="button" data-rooms="1">1</button>
                        <button type="button" data-rooms="2">2</button>
                        <button type="button" data-rooms="3">3</button>
                        <button type="button" data-rooms="4">4+</button>
                    </span>
                </label>
                <div class="sf-field">
                    <span>Стоимость, млн ₽</span>
                    <div class="sf-range">
                        <div class="sf-range__values">
                            <b data-price-min-label><?= sf_e(number_format($minMillion, 1, ',', '')) ?></b>
                            <b data-price-max-label><?= sf_e(number_format($maxMillion, 1, ',', '')) ?></b>
                        </div>
                        <div class="sf-range__track">
                            <input type="range" min="<?= sf_e((string) $minMillion) ?>" max="<?= sf_e((string) $maxMillion) ?>" step="0.1" value="<?= sf_e((string) $minMillion) ?>" data-price-min aria-label="Цена от">
                            <input type="range" min="<?= sf_e((string) $minMillion) ?>" max="<?= sf_e((string) $maxMillion) ?>" step="0.1" value="<?= sf_e((string) $maxMillion) ?>" data-price-max aria-label="Цена до">
                        </div>
                    </div>
                </div>
                <label class="sf-field">
                    <span>Срок сдачи</span>
                    <select class="sf-select" data-deadline>
                        <option value="">Не выбрано</option>
                        <?php foreach (sf_deadlines() as $code => $label): ?>
                            <option value="<?= sf_e($code) ?>"><?= sf_e($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label class="sf-field">
                    <span>Жилые комплексы</span>
                    <select class="sf-select" data-complex>
                        <option value="">Не выбрано</option>
                        <?php foreach (sf_complexes() as $complex): ?>
                            <option value="<?= sf_e($complex['code']) ?>"><?= sf_e($complex['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <button class="sf-btn sf-btn--ghost" type="button" data-more-toggle aria-expanded="false">Все фильтры</button>
                <button class="sf-btn sf-btn--red" type="button" data-count><?= count($flats) ?> <?= sf_e(sf_plural(count($flats), 'квартира', 'квартиры', 'квартир')) ?></button>
                <div class="sf-filters__more" data-more>
                    <label class="sf-field">
                        <span>Площадь, м²</span>
                        <span class="sf-pair">
                            <input class="sf-input" type="number" min="10" max="200" placeholder="от" data-area-min>
                            <input class="sf-input" type="number" min="10" max="200" placeholder="до" data-area-max>
                        </span>
                    </label>
                    <label class="sf-field">
                        <span>Отделка</span>
                        <select class="sf-select" data-finishing>
                            <option value="">Не выбрано</option>
                            <option value="yes">С отделкой</option>
                            <option value="none">Без отделки</option>
                        </select>
                    </label>
                    <label class="sf-field">
                        <span>Район</span>
                        <select class="sf-select" data-district>
                            <option value="">Не выбрано</option>
                            <?php foreach (sf_districts() as $district): ?>
                                <option value="<?= sf_e($district) ?>"><?= sf_e($district) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
            </div>
            <div class="sf-filters__top">
                <span></span>
                <button class="sf-linkish" type="button" data-reset>Сбросить фильтр ×</button>
            </div>
        </div>

        <h2 class="sf-catalog__title">Подобрали для вас</h2>
        <div class="sf-grid" data-grid>
            <?php foreach ($flats as $flat): ?>
                <article
                    class="sf-card"
                    data-card
                    data-code="<?= sf_e($flat['code']) ?>"
                    data-rooms="<?= (int) $flat['rooms'] ?>"
                    data-price="<?= (int) $flat['price'] ?>"
                    data-area="<?= sf_e((string) $flat['area']) ?>"
                    data-deadline="<?= sf_e($flat['deadline_code']) ?>"
                    data-complex="<?= sf_e($flat['complex_code']) ?>"
                    data-finishing="<?= sf_e($flat['finishing_code']) ?>"
                    data-district="<?= sf_e($flat['district']) ?>"
                >
                    <button class="sf-card__fav" type="button" data-fav="<?= sf_e($flat['code']) ?>" aria-label="В избранное">
                        <svg viewBox="0 0 24 24"><path d="M12 20s-7-4.4-7-9a4 4 0 0 1 7-2 4 4 0 0 1 7 2c0 4.6-7 9-7 9z"/></svg>
                    </button>
                    <a class="sf-card__body" href="/kvartiry/<?= sf_e($flat['code']) ?>/">
                        <?php if (!empty($flat['recommended'])): ?>
                            <span class="sf-badge">Рекомендуем</span>
                        <?php endif; ?>
                        <p class="sf-card__address"><?= sf_e($flat['address']) ?> · эт. <?= (int) $flat['floor'] ?>/<?= (int) $flat['floors'] ?></p>
                        <h3 class="sf-card__title">
                            <span><?= sf_e($flat['title']) ?></span>
                            <b><?= sf_e(sf_area($flat['area'])) ?></b>
                        </h3>
                        <div class="sf-pills">
                            <span><?= sf_e($flat['deadline']) ?></span>
                            <span><?= sf_e($flat['finishing']) ?></span>
                        </div>
                        <div class="sf-card__plan"><?= sf_plan_svg($flat) ?></div>
                        <p class="sf-card__price">
                            <?= sf_e(sf_price($flat['price'])) ?>
                            <?php if (!empty($flat['old_price'])): ?>
                                <span class="sf-card__old"><?= sf_e(sf_price($flat['old_price'])) ?></span>
                            <?php endif; ?>
                        </p>
                    </a>
                    <div class="sf-card__actions">
                        <a class="sf-btn sf-btn--ghost" href="/kvartiry/<?= sf_e($flat['code']) ?>/">Подробнее</a>
                        <button class="sf-btn sf-btn--dark" type="button" data-callback data-flat="<?= sf_e($flat['title'] . ', ' . $flat['complex']) ?>">Забронировать</button>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="sf-empty" data-empty hidden>
            <p>По этим условиям квартир нет. Сбросьте фильтр или расширьте цену и комнатность.</p>
            <button class="sf-btn sf-btn--red" type="button" data-reset>Сбросить фильтр</button>
        </div>
        <div class="sf-commerce" data-commerce>
            <h2>Коммерческие помещения</h2>
            <p>В «Лисьем береге» открылись лоты на первых этажах: от 32 до 86 м², отдельные входы и витрины на бульвар. Стоимость от 14,2 млн ₽.</p>
            <a class="sf-btn sf-btn--red" href="/novosti/novye-kommercheskie-pomeshcheniya-v-zhk-lisiy-bereg/">Смотреть новость</a>
        </div>
    </div>
</section>
