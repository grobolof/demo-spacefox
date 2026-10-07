<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

function sf_e(string $value): string
{
    return htmlspecialcharsbx($value);
}

function sf_price(int $value): string
{
    return number_format($value, 0, '', ' ') . ' ₽';
}

function sf_area(float $value): string
{
    $formatted = number_format($value, 1, ',', '');
    $formatted = preg_replace('/,0$/', '', $formatted);

    return $formatted . ' м²';
}

function sf_millions(int $value): string
{
    return number_format($value / 1000000, 1, ',', '');
}

function sf_mortgage(int $price): int
{
    $loan = $price * 0.8;
    $rate = 0.06 / 12;
    $periods = 360;
    $factor = (1 + $rate) ** $periods;

    return (int) round($loan * ($rate * $factor) / ($factor - 1));
}

function sf_date_short(string $iso): string
{
    $timestamp = strtotime($iso);

    return $timestamp ? date('d.m.Y', $timestamp) : $iso;
}

function sf_date_long(string $iso): string
{
    $timestamp = strtotime($iso);
    if (!$timestamp) {
        return $iso;
    }

    $months = [
        1 => 'января',
        2 => 'февраля',
        3 => 'марта',
        4 => 'апреля',
        5 => 'мая',
        6 => 'июня',
        7 => 'июля',
        8 => 'августа',
        9 => 'сентября',
        10 => 'октября',
        11 => 'ноября',
        12 => 'декабря',
    ];

    return (int) date('j', $timestamp) . ' ' . $months[(int) date('n', $timestamp)] . ' ' . date('Y', $timestamp);
}

function sf_plural(int $number, string $one, string $few, string $many): string
{
    $abs = abs($number) % 100;
    $tail = $abs % 10;
    if ($abs > 10 && $abs < 20) {
        return $many;
    }
    if ($tail > 1 && $tail < 5) {
        return $few;
    }
    if ($tail === 1) {
        return $one;
    }

    return $many;
}

function sf_flats(): array
{
    static $items = null;
    if ($items !== null) {
        return $items;
    }

    $items = [
        [
            'code' => 'lisiy-bereg-4',
            'rooms' => 0,
            'euro' => false,
            'number' => '4',
            'title' => 'Студия №4',
            'area' => 19.8,
            'price' => 3890000,
            'old_price' => null,
            'complex' => 'Лисий берег',
            'complex_code' => 'lisiy-bereg',
            'address' => 'Лисий берег, 2 очередь, дом 12',
            'house' => '12',
            'floor' => 1,
            'floors' => 14,
            'deadline' => 'IV кв. 2028',
            'deadline_code' => '2028-4',
            'finishing' => 'Без отделки',
            'finishing_code' => 'none',
            'district' => 'Красносельский',
            'street' => 'ул. Маршала Казакова, 12',
            'plan' => 'ST-12-1',
            'windows' => 'Во двор, юг',
            'recommended' => true,
            'layout' => 'studio',
            'map' => ['x' => 28, 'y' => 72],
            'features' => ['Ниша под кухню', 'Совмещённый санузел', 'Окно во двор'],
            'description' => [
                'Компактная студия на первом жилом этаже дома 12. Высота потолков 2,7 м, место под кухню уже отмечено выводами, санузел совмещённый. Подходит тем, кто хочет собственную квартиру у пешеходного бульвара и не готов переплачивать за лишние метры.',
                'Дом второй очереди «Лисьего берега» сдаётся с закрытым двором и коммерцией на первом этаже. Отделка не входит в стоимость: можно сразу заехать с ремонтом от Space Fox или сделать его самостоятельно.',
            ],
        ],
        [
            'code' => 'ohtinskiy-park-12',
            'rooms' => 1,
            'euro' => true,
            'number' => '12',
            'title' => '1-комнатная евро квартира №12',
            'area' => 36.4,
            'price' => 10240000,
            'old_price' => 12180000,
            'complex' => 'Охтинский парк',
            'complex_code' => 'ohtinskiy-park',
            'address' => 'Охтинский парк, 3 очередь, дом 8',
            'house' => '8',
            'floor' => 3,
            'floors' => 25,
            'deadline' => 'IV кв. 2027',
            'deadline_code' => '2027-4',
            'finishing' => 'С отделкой',
            'finishing_code' => 'yes',
            'district' => 'Красногвардейский',
            'street' => 'Охтинская аллея, 8',
            'plan' => '1eG-3-8',
            'windows' => 'Юго-запад',
            'recommended' => true,
            'layout' => 'euro',
            'map' => ['x' => 74, 'y' => 38],
            'features' => ['Кухня-гостиная 16,4 м²', 'Спальня с окном', 'Готовая отделка', 'Лоджия'],
            'description' => [
                'Евродвушка в третьей очереди «Охтинского парка»: спальня отделена от кухни-гостиной, так что дневная зона не мешает сну. Квартира на третьем этаже, окна смотрят на юго-запад, во внутренний двор без машин.',
                'Отделка Space Fox уже включена: светлые стены, ламинат, плитка в санузле и кухня с базовым комплектом. Дом на Охтинской аллее, в нескольких минутах от набережной и новых детских садов квартала.',
            ],
        ],
        [
            'code' => 'severnaya-sosna-550',
            'rooms' => 1,
            'euro' => false,
            'number' => '550',
            'title' => '1-комнатная квартира №550',
            'area' => 31.7,
            'price' => 6890000,
            'old_price' => null,
            'complex' => 'Северная сосна',
            'complex_code' => 'severnaya-sosna',
            'address' => 'Северная сосна, квартал 4, дом 7',
            'house' => '7',
            'floor' => 21,
            'floors' => 25,
            'deadline' => 'III кв. 2026',
            'deadline_code' => '2026-3',
            'finishing' => 'С отделкой',
            'finishing_code' => 'yes',
            'district' => 'Выборгский',
            'street' => 'Северный проспект, 7',
            'plan' => '1k-21-7',
            'windows' => 'Северо-восток',
            'recommended' => true,
            'layout' => 'one',
            'map' => ['x' => 48, 'y' => 18],
            'features' => ['Изолированная комната', 'Раздельный санузел', 'Вид на сосны'],
            'description' => [
                'Классическая однокомнатная на 21 этаже: комната отделена от кухни, на рассвете сюда заходит мягкий свет. С этой высоты виден сосновый клин, из-за которого квартал и получил имя.',
                'Сдача в третьем квартале 2026 года, отделка уже в договоре. Дом 7 стоит внутри квартала, проезд к нему только для службы двора, поэтому вечером под окнами тихо.',
            ],
        ],
        [
            'code' => 'severnaya-sosna-55',
            'rooms' => 2,
            'euro' => false,
            'number' => '55',
            'title' => '2-комнатная квартира №55',
            'area' => 51.7,
            'price' => 10650000,
            'old_price' => 11890000,
            'complex' => 'Северная сосна',
            'complex_code' => 'severnaya-sosna',
            'address' => 'Северная сосна, квартал 4, дом 7',
            'house' => '7',
            'floor' => 12,
            'floors' => 25,
            'deadline' => 'III кв. 2026',
            'deadline_code' => '2026-3',
            'finishing' => 'С отделкой',
            'finishing_code' => 'yes',
            'district' => 'Выборгский',
            'street' => 'Северный проспект, 7',
            'plan' => '2k-12-7',
            'windows' => 'Восток и юг',
            'recommended' => true,
            'layout' => 'two',
            'map' => ['x' => 48, 'y' => 18],
            'features' => ['Две изолированные комнаты', 'Кухня-гостиная', 'Два санузла', 'Гардеробная'],
            'description' => [
                'Двухкомнатная для семьи: кухня-гостиная и две спальни по разные стороны квартиры, чтобы детская не делила стену с лифтовым холлом. Гардеробная забирает сезонные вещи, которые обычно живут на балконе.',
                'Квартира в том же доме 7, что и студии квартала, но с мастер-спальней и вторым санузлом. Отделка нейтральная, мебель можно ставить в день получения ключей.',
            ],
        ],
        [
            'code' => 'fontannyy-18',
            'rooms' => 2,
            'euro' => false,
            'number' => '18',
            'title' => '2-комнатная квартира №18',
            'area' => 54.2,
            'price' => 12430000,
            'old_price' => null,
            'complex' => 'Фонтанный',
            'complex_code' => 'fontannyy',
            'address' => 'Фонтанный, дом 3',
            'house' => '3',
            'floor' => 8,
            'floors' => 18,
            'deadline' => 'II кв. 2027',
            'deadline_code' => '2027-2',
            'finishing' => 'С отделкой',
            'finishing_code' => 'yes',
            'district' => 'Московский',
            'street' => 'ул. Варшавская, 3',
            'plan' => '2k-8-3',
            'windows' => 'На бульвар',
            'recommended' => false,
            'layout' => 'two',
            'map' => ['x' => 36, 'y' => 58],
            'features' => ['Окна на пешеходный бульвар', 'Кухня 11 м²', 'Потолки 2,85 м'],
            'description' => [
                'Квартира в камерном доме на 18 этажей у Московского проспекта. Окна гостиной выходят на внутренний бульвар с фонтаном, а спальня смотрит во двор. Потолки выше стандартных — 2,85 метра.',
                '«Фонтанный» строится небольшим контуром: три дома, общая гостиная для жителей на первом этаже и колясочные в каждом холле. Отделка входит в цену.',
            ],
        ],
        [
            'code' => 'nebesnaya-milya-41',
            'rooms' => 3,
            'euro' => false,
            'number' => '41',
            'title' => '3-комнатная квартира №41',
            'area' => 78.5,
            'price' => 16900000,
            'old_price' => null,
            'complex' => 'Небесная миля',
            'complex_code' => 'nebesnaya-milya',
            'address' => 'Небесная миля, дом 2',
            'house' => '2',
            'floor' => 15,
            'floors' => 22,
            'deadline' => 'I кв. 2028',
            'deadline_code' => '2028-1',
            'finishing' => 'Без отделки',
            'finishing_code' => 'none',
            'district' => 'Приморский',
            'street' => 'Приморский проспект, 72',
            'plan' => '3k-15-2',
            'windows' => 'На залив',
            'recommended' => false,
            'layout' => 'three',
            'map' => ['x' => 18, 'y' => 28],
            'features' => ['Три комнаты', 'Кухня-столовая', 'Два санузла', 'Вид на воду'],
            'description' => [
                'Трёхкомнатная в доме у Приморского проспекта. Гостиная и кухня объединены, две спальни разведены по краям квартиры, у мастер-спальни свой санузел. С 15 этажа в ясную погоду виден залив.',
                'Квартира без отделки: пространство можно собрать под себя, выводы под кухню и мокрые точки уже стоят по проекту. Срок сдачи дома — первый квартал 2028 года.',
            ],
        ],
        [
            'code' => 'fontannyy-7',
            'rooms' => 0,
            'euro' => false,
            'number' => '7',
            'title' => 'Студия №7',
            'area' => 24.1,
            'price' => 5450000,
            'old_price' => 6120000,
            'complex' => 'Фонтанный',
            'complex_code' => 'fontannyy',
            'address' => 'Фонтанный, дом 1',
            'house' => '1',
            'floor' => 5,
            'floors' => 18,
            'deadline' => 'II кв. 2026',
            'deadline_code' => '2026-2',
            'finishing' => 'С отделкой',
            'finishing_code' => 'yes',
            'district' => 'Московский',
            'street' => 'ул. Варшавская, 1',
            'plan' => 'ST-5-1',
            'windows' => 'Запад',
            'recommended' => false,
            'layout' => 'studio-wide',
            'map' => ['x' => 36, 'y' => 58],
            'features' => ['Готовая отделка', 'Полноценная кухня-ниша', 'Близко к метро'],
            'description' => [
                'Студия чуть просторнее базовой: 24,1 м² позволяют поставить кровать отдельно от кухни, а не вплотную к плите. Отделка готова, дом 1 выходит на улицу Варшавскую.',
                'Ключи планируются во втором квартале 2026 года. Для этой квартиры действует осенняя цена Space Fox — базовая стоимость перечёркнута в карточке.',
            ],
        ],
        [
            'code' => 'nebesnaya-milya-2',
            'rooms' => 4,
            'euro' => false,
            'number' => '2',
            'title' => '4-комнатная квартира №2',
            'area' => 112.4,
            'price' => 28750000,
            'old_price' => 31200000,
            'complex' => 'Небесная миля',
            'complex_code' => 'nebesnaya-milya',
            'address' => 'Небесная миля, дом 2',
            'house' => '2',
            'floor' => 20,
            'floors' => 22,
            'deadline' => 'I кв. 2028',
            'deadline_code' => '2028-1',
            'finishing' => 'С отделкой',
            'finishing_code' => 'yes',
            'district' => 'Приморский',
            'street' => 'Приморский проспект, 72',
            'plan' => '4k-20-2',
            'windows' => 'Панорама на залив',
            'recommended' => true,
            'layout' => 'four',
            'map' => ['x' => 18, 'y' => 28],
            'features' => ['Четыре комнаты', 'Мастер-спальня', 'Гардеробная', 'Два санузла', 'Панорамные окна'],
            'description' => [
                'Семейная квартира на 20 этаже «Небесной мили». Четыре комнаты, кухня-столовая на 16 м² и гардеробная при мастер-спальне. Окна угловые: днём здесь светло без верхней подсветки.',
                'Отделка премиальной линейки Space Fox — дубовый шпон, матовая сантехника и скрытые плинтусы. Специальная цена действует до конца октября 2026 года.',
            ],
        ],
    ];

    return $items;
}

function sf_flat(string $code): ?array
{
    foreach (sf_flats() as $flat) {
        if ($flat['code'] === $code) {
            return $flat;
        }
    }

    return null;
}

function sf_complexes(): array
{
    $complexes = [];
    foreach (sf_flats() as $flat) {
        if (!isset($complexes[$flat['complex_code']])) {
            $complexes[$flat['complex_code']] = [
                'code' => $flat['complex_code'],
                'name' => $flat['complex'],
                'x' => $flat['map']['x'],
                'y' => $flat['map']['y'],
                'price' => $flat['price'],
                'district' => $flat['district'],
            ];
            continue;
        }
        $complexes[$flat['complex_code']]['price'] = min($complexes[$flat['complex_code']]['price'], $flat['price']);
    }

    return array_values($complexes);
}

function sf_deadlines(): array
{
    $items = [];
    foreach (sf_flats() as $flat) {
        $items[$flat['deadline_code']] = $flat['deadline'];
    }
    ksort($items);

    return $items;
}

function sf_districts(): array
{
    $items = [];
    foreach (sf_flats() as $flat) {
        $items[$flat['district']] = $flat['district'];
    }
    ksort($items);

    return array_values($items);
}

function sf_news(): array
{
    static $items = null;
    if ($items !== null) {
        return $items;
    }

    $items = [
        [
            'code' => 'novye-kommercheskie-pomeshcheniya-v-zhk-lisiy-bereg',
            'title' => 'Новые коммерческие помещения в ЖК «Лисий берег»',
            'date' => '2026-10-02',
            'tag' => 'Старт продаж',
            'complex' => 'Лисий берег',
            'complex_code' => 'lisiy-bereg',
            'image' => 'news-commerce.jpg',
            'lead' => 'Во второй очереди «Лисьего берега» открылись продажи помещений для небольшого бизнеса. Первые этажи выходят на пешеходный бульвар и рассчитаны на кафе, сервисы и пункты выдачи.',
            'blocks' => [
                ['type' => 'p', 'text' => 'В продаже восемь лотов в домах 12 и 14. Площадь — от 32 до 86 м², потолки 3,6 метра, витринное остекление и отдельный вход с улицы. Стоимость начинается от 14,2 млн рублей. Помещения передаются со стяжкой, разводкой под мокрые точки и выделенной мощностью от 15 кВт.'],
                ['type' => 'p', 'text' => 'Почему коммерция в «Лисьем береге» собирает заявки ещё до ввода домов:'],
                ['type' => 'list', 'items' => [
                    'Бульвар с постоянным потоком жителей квартала и соседних домов, а не транзитная магистраль.',
                    'Рядом остановка и прямой выезд на проспект Маршала Казакова, разгрузка возможна со стороны двора.',
                    'На первых этажах уже заложены витрины разной ширины: можно взять узкий лот под кофейню или угол под магазин у дома.',
                    'Дефицит готовых помещений в этой части Красносельского района держит арендный спрос выше, чем в новых полях без инфраструктуры.',
                ]],
                ['type' => 'p', 'text' => 'Показ планировок и расчёт окупаемости проходят в офисе Space Fox на Невском проспекте, 48. Бронь помещения держится пять рабочих дней и не требует оплаты, пока юристы готовят договор.'],
            ],
        ],
        [
            'code' => 'vygodnaya-osen-skidki-na-kvartiry',
            'title' => 'Выгодная осень: скидки до 15% на квартиры Space Fox',
            'date' => '2026-10-01',
            'tag' => 'Скидки',
            'complex' => '',
            'complex_code' => '',
            'image' => 'news-sale.jpg',
            'lead' => 'До 31 октября 2026 года в пяти кварталах Space Fox действует осенняя цена. Скидка зависит от корпуса и уже вычтена в карточках, где рядом с суммой есть перечёркнутая базовая стоимость.',
            'blocks' => [
                ['type' => 'p', 'text' => 'Максимальные 15% стоят на отдельных лотах «Небесной мили» и «Фонтанного». В «Северной сосне» скидка меньше, зато срок сдачи ближе: ключи третьего квартала 2026 года. Студии «Лисьего берега» в акцию не входят — там и так стартовая цена очереди.'],
                ['type' => 'p', 'text' => 'Чтобы зафиксировать осеннюю цену, достаточно брони на семь дней. Если ипотечное решение банка задерживается, бронь продлевают один раз без изменения стоимости.'],
            ],
        ],
        [
            'code' => 'rassrochka-na-gotovye-kvartiry',
            'title' => 'Рассрочка на готовые квартиры: первый взнос от 20%',
            'date' => '2026-10-05',
            'tag' => 'Рассрочка',
            'complex' => 'Северная сосна',
            'complex_code' => 'severnaya-sosna',
            'image' => 'news-keys.jpg',
            'lead' => 'На квартиры с близким сроком сдачи Space Fox запустил рассрочку от застройщика. Первый взнос — от 20%, остаток делится равными платежами до ввода дома, без удорожания относительно цены в договоре.',
            'blocks' => [
                ['type' => 'p', 'text' => 'Программа распространяется на дом 7 в «Северной сосне» и дом 1 в «Фонтанном». Платёж считается от цены со скидкой, если лот участвует в осенней акции. Промежуточных комиссий нет: график прошит в договор, а не в отдельное соглашение с банком.'],
                ['type' => 'list', 'items' => [
                    'Взнос от 20% в день брони.',
                    'Остаток — ежемесячно или ежеквартально, как удобнее семье.',
                    'Досрочное погашение не штрафуется.',
                    'После ввода дома остаток можно закрыть ипотекой.',
                ]],
            ],
        ],
        [
            'code' => 'start-prodazh-ohtinskiy-park',
            'title' => 'Старт продаж третьей очереди ЖК «Охтинский парк»',
            'date' => '2026-09-18',
            'tag' => 'Старт продаж',
            'complex' => 'Охтинский парк',
            'complex_code' => 'ohtinskiy-park',
            'image' => 'hero-park.jpg',
            'lead' => 'В продажу вышел дом 8 на Охтинской аллее. Это третья очередь парка: дворы предыдущих домов уже засажены, школа на соседнем участке строится вместе с корпусом.',
            'blocks' => [
                ['type' => 'p', 'text' => 'В доме европланировки, классические однушки и двухкомнатные квартиры с готовой отделкой. Высота секции — 25 этажей, первый этаж отдан под кафе и сервис, жилые окна начинаются с третьего. Срок сдачи — четвёртый квартал 2027 года.'],
                ['type' => 'p', 'text' => 'На старте держат цену для первых пятидесяти договоров. Дальше прайс пересматривают по мере заполнения шахматки, поэтому лоты с видом во двор сейчас дешевле угловых.'],
            ],
        ],
        [
            'code' => 'klyuchi-severnaya-sosna',
            'title' => 'Ключи в первой очереди ЖК «Северная сосна»',
            'date' => '2026-09-04',
            'tag' => 'Старт продаж',
            'complex' => 'Северная сосна',
            'complex_code' => 'severnaya-sosna',
            'image' => 'hero-ready.jpg',
            'lead' => 'Жители домов 1–3 «Северной сосны» начали получать ключи. Осмотр проходит по записи, чтобы в холле не скапливались сразу несколько семей с коробками.',
            'blocks' => [
                ['type' => 'p', 'text' => 'Вместе с ключами выдают памятку по отделке и контакты управляющей компании двора. Детская площадка и контур озеленения приняты вместе с домом, а не отложены на следующий сезон. Гостевые машины остаются на внешней стоянке.'],
                ['type' => 'p', 'text' => 'Квартиры четвертого квартала, включая дом 7, по-прежнему в продаже: это следующая очередь, не путать с уже сданными корпусами.'],
            ],
        ],
        [
            'code' => 'skidka-dlya-sosedej',
            'title' => 'Дополнительная скидка для жителей кварталов Space Fox',
            'date' => '2026-09-27',
            'tag' => 'Скидки',
            'complex' => '',
            'complex_code' => '',
            'image' => 'about-city.jpg',
            'lead' => 'Тем, кто уже купил квартиру Space Fox и берёт следующую — себе, детям или родителям, — начисляется ещё 1% к действующей акции. Скидка не сгорает, если вторая сделка закрывается в течение года.',
            'blocks' => [
                ['type' => 'p', 'text' => 'Программа называется Fox Бонус. Чтобы её применить, менеджеру достаточно номера первого договора. Скидка суммируется с осенней ценой, но не суммируется с корпоративными предложениями для сотрудников партнёров.'],
                ['type' => 'p', 'text' => 'Тот же процент получает человек, по чьей рекомендации заключён новый договор. Сертификат на мебель для кухни добавляется, если обе квартиры в одном квартале.'],
            ],
        ],
    ];

    usort($items, static function (array $a, array $b): int {
        return strcmp($b['date'], $a['date']);
    });

    return $items;
}

function sf_article(string $code): ?array
{
    foreach (sf_news() as $article) {
        if ($article['code'] === $code) {
            return $article;
        }
    }

    return null;
}

function sf_layouts(): array
{
    return [
        'studio' => [
            'vb' => '0 0 180 230',
            'rooms' => [
                ['x' => 14, 'y' => 14, 'w' => 152, 'h' => 128, 'fill' => '#f6d7c8', 'label' => 'Комната', 'dim' => '14,6'],
                ['x' => 14, 'y' => 150, 'w' => 72, 'h' => 66, 'fill' => '#ececf1', 'label' => 'СУ', 'dim' => '3,1'],
                ['x' => 94, 'y' => 150, 'w' => 72, 'h' => 66, 'fill' => '#f7f7f7', 'label' => 'Холл', 'dim' => '2,1'],
            ],
        ],
        'studio-wide' => [
            'vb' => '0 0 200 210',
            'rooms' => [
                ['x' => 14, 'y' => 14, 'w' => 172, 'h' => 118, 'fill' => '#f6d7c8', 'label' => 'Комната', 'dim' => '17,4'],
                ['x' => 14, 'y' => 140, 'w' => 84, 'h' => 56, 'fill' => '#d9f0df', 'label' => 'Кухня', 'dim' => '3,8'],
                ['x' => 106, 'y' => 140, 'w' => 80, 'h' => 56, 'fill' => '#ececf1', 'label' => 'СУ', 'dim' => '2,9'],
            ],
        ],
        'euro' => [
            'vb' => '0 0 220 250',
            'rooms' => [
                ['x' => 14, 'y' => 14, 'w' => 118, 'h' => 156, 'fill' => '#f6d7c8', 'label' => 'Кухня-гостиная', 'dim' => '16,4'],
                ['x' => 140, 'y' => 14, 'w' => 66, 'h' => 96, 'fill' => '#d9e4f5', 'label' => 'Спальня', 'dim' => '13,4'],
                ['x' => 140, 'y' => 118, 'w' => 66, 'h' => 52, 'fill' => '#ececf1', 'label' => 'СУ', 'dim' => '3,4'],
                ['x' => 14, 'y' => 178, 'w' => 192, 'h' => 56, 'fill' => '#f7f7f7', 'label' => 'Холл', 'dim' => '3,2'],
            ],
        ],
        'one' => [
            'vb' => '0 0 220 240',
            'rooms' => [
                ['x' => 14, 'y' => 14, 'w' => 110, 'h' => 120, 'fill' => '#d9e4f5', 'label' => 'Комната', 'dim' => '12,8'],
                ['x' => 132, 'y' => 14, 'w' => 74, 'h' => 78, 'fill' => '#d9f0df', 'label' => 'Кухня', 'dim' => '8,4'],
                ['x' => 132, 'y' => 100, 'w' => 74, 'h' => 50, 'fill' => '#ececf1', 'label' => 'СУ', 'dim' => '3,2'],
                ['x' => 14, 'y' => 142, 'w' => 110, 'h' => 80, 'fill' => '#f7f7f7', 'label' => 'Холл', 'dim' => '4,1'],
                ['x' => 132, 'y' => 158, 'w' => 74, 'h' => 64, 'fill' => '#f3efe4', 'label' => 'Лоджия', 'dim' => '3,2'],
            ],
        ],
        'two' => [
            'vb' => '0 0 230 260',
            'rooms' => [
                ['x' => 14, 'y' => 14, 'w' => 128, 'h' => 118, 'fill' => '#f6d7c8', 'label' => 'Гостиная', 'dim' => '18,5'],
                ['x' => 150, 'y' => 14, 'w' => 66, 'h' => 78, 'fill' => '#d9e4f5', 'label' => 'Спальня', 'dim' => '12,4'],
                ['x' => 150, 'y' => 100, 'w' => 66, 'h' => 70, 'fill' => '#e7f0d8', 'label' => 'Детская', 'dim' => '10,2'],
                ['x' => 14, 'y' => 140, 'w' => 62, 'h' => 58, 'fill' => '#ececf1', 'label' => 'СУ', 'dim' => '4,1'],
                ['x' => 84, 'y' => 140, 'w' => 58, 'h' => 58, 'fill' => '#f7f7f7', 'label' => 'Холл', 'dim' => '6,5'],
                ['x' => 14, 'y' => 206, 'w' => 202, 'h' => 38, 'fill' => '#f3efe4', 'label' => 'Лоджия', 'dim' => '3,0'],
            ],
        ],
        'three' => [
            'vb' => '0 0 250 280',
            'rooms' => [
                ['x' => 14, 'y' => 14, 'w' => 130, 'h' => 100, 'fill' => '#f6d7c8', 'label' => 'Гостиная', 'dim' => '20,4'],
                ['x' => 152, 'y' => 14, 'w' => 84, 'h' => 70, 'fill' => '#d9f0df', 'label' => 'Кухня', 'dim' => '11,2'],
                ['x' => 152, 'y' => 92, 'w' => 84, 'h' => 58, 'fill' => '#ececf1', 'label' => 'СУ', 'dim' => '5,2'],
                ['x' => 14, 'y' => 122, 'w' => 70, 'h' => 90, 'fill' => '#d9e4f5', 'label' => 'Спальня', 'dim' => '14,2'],
                ['x' => 92, 'y' => 122, 'w' => 52, 'h' => 90, 'fill' => '#e7f0d8', 'label' => 'Детская', 'dim' => '12,1'],
                ['x' => 152, 'y' => 158, 'w' => 84, 'h' => 54, 'fill' => '#efe6f6', 'label' => 'Кабинет', 'dim' => '10,4'],
                ['x' => 14, 'y' => 220, 'w' => 222, 'h' => 44, 'fill' => '#f7f7f7', 'label' => 'Холл', 'dim' => '5,0'],
            ],
        ],
        'four' => [
            'vb' => '0 0 280 300',
            'rooms' => [
                ['x' => 14, 'y' => 14, 'w' => 150, 'h' => 110, 'fill' => '#f6d7c8', 'label' => 'Гостиная', 'dim' => '28'],
                ['x' => 172, 'y' => 14, 'w' => 94, 'h' => 70, 'fill' => '#d9f0df', 'label' => 'Кухня', 'dim' => '16'],
                ['x' => 172, 'y' => 92, 'w' => 94, 'h' => 50, 'fill' => '#f7f7f7', 'label' => 'Холл', 'dim' => '11'],
                ['x' => 14, 'y' => 132, 'w' => 78, 'h' => 90, 'fill' => '#d9e4f5', 'label' => 'Спальня', 'dim' => '16'],
                ['x' => 100, 'y' => 132, 'w' => 64, 'h' => 90, 'fill' => '#e7f0d8', 'label' => 'Детская', 'dim' => '13'],
                ['x' => 172, 'y' => 150, 'w' => 94, 'h' => 72, 'fill' => '#efe6f6', 'label' => 'Кабинет', 'dim' => '14'],
                ['x' => 14, 'y' => 230, 'w' => 70, 'h' => 54, 'fill' => '#ececf1', 'label' => 'СУ', 'dim' => '8'],
                ['x' => 92, 'y' => 230, 'w' => 72, 'h' => 54, 'fill' => '#f3efe4', 'label' => 'Гардероб', 'dim' => '6'],
            ],
        ],
    ];
}

function sf_plan_svg(array $flat): string
{
    $layouts = sf_layouts();
    $layout = $layouts[$flat['layout']] ?? $layouts['one'];
    $rooms = '';
    foreach ($layout['rooms'] as $room) {
        $cx = $room['x'] + $room['w'] / 2;
        $cy = $room['y'] + $room['h'] / 2;
        $rooms .= sprintf(
            '<rect x="%s" y="%s" width="%s" height="%s" fill="%s" stroke="#2c2c2c" stroke-width="2.5"/>',
            $room['x'],
            $room['y'],
            $room['w'],
            $room['h'],
            $room['fill']
        );
        $rooms .= sprintf(
            '<text x="%s" y="%s" text-anchor="middle" font-size="8" font-family="Manrope, Arial, sans-serif" fill="#333">%s</text>',
            $cx,
            $cy - 1,
            sf_e($room['label'])
        );
        $rooms .= sprintf(
            '<text x="%s" y="%s" text-anchor="middle" font-size="8" font-family="Manrope, Arial, sans-serif" fill="#666">%s м²</text>',
            $cx,
            $cy + 11,
            sf_e($room['dim'])
        );
    }

    return '<svg class="sf-plan" viewBox="' . $layout['vb'] . '" role="img" aria-label="' . sf_e($flat['title']) . '">' . $rooms . '</svg>';
}

function sf_floor_svg(array $flat): string
{
    $active = ((int) preg_replace('/\D/', '', $flat['number'])) % 6;
    $cells = '';
    for ($i = 0; $i < 6; $i++) {
        $col = $i % 3;
        $row = intdiv($i, 3);
        $x = 16 + $col * 78;
        $y = 36 + $row * 78;
        $fill = $i === $active ? '#f6d7c8' : '#f4f4f5';
        $stroke = $i === $active ? '#e4232b' : '#c8c8c8';
        $cells .= sprintf(
            '<rect x="%d" y="%d" width="70" height="70" rx="6" fill="%s" stroke="%s" stroke-width="2"/>',
            $x,
            $y,
            $fill,
            $stroke
        );
        $cells .= sprintf(
            '<text x="%d" y="%d" text-anchor="middle" font-size="11" font-family="Manrope, Arial, sans-serif" fill="#333">%d</text>',
            $x + 35,
            $y + 40,
            $i + 1
        );
    }

    $caption = sf_e('Этаж ' . $flat['floor'] . ', секция дома ' . $flat['house']);

    return '<svg class="sf-plan" viewBox="0 0 250 230" role="img" aria-label="Квартира на этаже">'
        . '<text x="125" y="22" text-anchor="middle" font-size="12" font-family="Manrope, Arial, sans-serif" fill="#666">' . $caption . '</text>'
        . $cells
        . '<rect x="16" y="196" width="218" height="16" rx="4" fill="#ececf1"/>'
        . '<text x="125" y="208" text-anchor="middle" font-size="9" font-family="Manrope, Arial, sans-serif" fill="#888">коридор</text>'
        . '</svg>';
}

function sf_crumbs(array $crumbs): void
{
    echo '<nav class="sf-crumbs" aria-label="Хлебные крошки">';
    $last = count($crumbs) - 1;
    foreach ($crumbs as $index => $crumb) {
        if ($index > 0) {
            echo '<span class="sf-crumbs__sep" aria-hidden="true">|</span>';
        }
        if ($index === $last || empty($crumb['href'])) {
            echo '<span>' . sf_e($crumb['label']) . '</span>';
        } else {
            echo '<a href="' . sf_e($crumb['href']) . '">' . sf_e($crumb['label']) . '</a>';
        }
    }
    echo '</nav>';
}

function sf_request_code(): string
{
    $code = (string) ($_REQUEST['code'] ?? '');
    $code = strtolower($code);
    if (preg_match('/^[a-z0-9\-]+$/', $code)) {
        return $code;
    }

    $path = (string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    if (preg_match('#/(?:kvartiry|novosti)/([a-z0-9\-]+)/?$#', $path, $matches)) {
        return $matches[1];
    }

    return '';
}
