<?php

use yii\db\Migration;

/**
 * Handles the data insertion for table `{{%content}}`.
 */
class m211106_075700_insert_data_into_content extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
$this->batchInsert('{{%content}}', ['id','page','page_text','title','title_seo','description','last_mod'], [
			['1','index','
    
            <article>
    <img width=\"250\" height=\"179\" class=\"resp_img\" src=\"/img/main_img/web2.jpg\" alt=\"веб дизайн\" title=\"веб дизайн\">
    <h2 class=\"header_shadow\">Алекс-арт21 — создание только эффективных сайтов</h2>
    <p>
        У нас сформирован профессиональный коллектив из дизайнеров, web-разработчиков, <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>
        специалистов.
        Каждый из нас отлично знает свое дело, будь то
        разработка дизайн-макета сайта-визитки или проектирование базы данных интернет магазина. Все вместе мы
        уже команда способная решить поставленные задачи в установленные сроки.
    </p>
    <p><strong class=\"mark\">Мы не просто делаем сайты \"под ключ\", но и предоставляем комплексные и эффективные решения
            для современного бизнеса.</strong>
    </p>
    <p class=\"strong_text\">
        Разрабатываем только современные сайты и добиваемся роста посещаемости и конверсии.
        <br>
        Применяем только бизнес подход ориентированный не на \"креативность\", а на результат.
        <br>
        Предлагаем только свежие решения.
        <br>
    </p>
    <h3 class=\"h_2 punkt no_border\">Предоставляемые услуги:</h3>
    <div id=\"uslugi_outer\" class=\"list_block\">
        <ul id=\"uslugi\">
            <li>
                <span class=\"l1\"></span> <strong><a title=\"создание сайтов\" class=\"list_link link-anim portf-call\" href=\"/sozdanie\">создание сайтов</a></strong>
            </li>
            <li>
                <span class=\"l1\"></span>
                <strong title=\"редизайн сайтов\">редизайн существующих сайтов</strong>
            </li>
            <li>
                <span class=\"l1\"></span>
                <strong title=\"модернизация сайтов\">модернизация сайтов под стандарты <abbr title=\"англ. HyperText Markup Language, version 5 — язык для структурирования и представления содержимого всемирной паутины\">HTML5</abbr>
                    и <abbr title=\"англ. Cascading Style Sheets, version 3 — каскадные таблицы стилей\">CSS3</abbr></strong>
            </li>
            <li>
                <span class=\"l1\"></span>
                <strong>
                    <a title=\"адаптивная верстка\" class=\"list_link link-anim\" href=\"/sozdanie#response\">адаптивная
                        верстка</a>
                </strong>
            </li>
            <li>
                <span class=\"l1\"></span>
                <strong title=\"постановка статичных html сайтов на движок\">постановка статичных html сайтов на
                    \"движок\"</strong>
            </li>
            <li>
                <span class=\"l1\"></span>
                <strong title=\"разработка системы управления сайтом\">разработка индивидуальной <abbr title=\"англ. Content Management System (система управления содержимым) — информационная система или компьютерная программа для обеспечения и организации совместного процесса создания, редактирования и управления контентом\">CMS</abbr></strong>
            </li>
            <li>
                <span class=\"l1\"></span>
                <strong>
                    <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO </abbr><a title=\"продвижение сайтов\" class=\"list_link link-anim portf-call\" href=\"/prodvijenie\">продвижение
                        сайтов</a>
                </strong>
            </li>
            <li>
                <span class=\"l1\"></span>
                <strong>
                    <a title=\"контекстная реклама\" class=\"list_link link-anim\" href=\"/prodvijenie#context\">контекстная
                        реклама</a>
                    на Яндекс и Google</strong>
            </li>
            <li>
                <span class=\"l1\"></span>
                <strong title=\"рерайт копирайт\">наполнение оригинальным контентом (рерайт, копирайт)</strong>
            </li>
            <li>
                <span class=\"l1\"></span> <strong>консультации, обучение персонала</strong>
            </li>
            <li>
                <span class=\"l1\"></span>
                <strong title=\"техническая и информационная поддержка веб-ресурсов\">техническая и информационная
                    поддержка веб-ресурсов</strong>
            </li>
        </ul>
    </div>
    <br>
    <br>
    <div id=\"site\">
        <div id=\"s1\">
            <div class=\"site_block\">
                <a href=\"/sozdanie#sait_vizitka\" class=\"portf-call\" title=\"сайт визитка\">
                    <h2 class=\"h_2 punkt link-anim\">Сайт визитка</h2>
                </a>
                <p>
                    Идеальный вариант для старта в интернете.
                    <br>
                    В дальнейшем можно улучшать и развивать
                    <br>
                    возможности сайта и его наполнение.
                    <br>
                </p>
                <ul>
                    <li>
                        <span class=\"l2\"></span>
                        до 5 страниц информации
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        размещение прайс листов
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        форма обратной связи
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        срок исполнения от 7 дней
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        цена от
                        <span class=\"red\">7 000</span>
                        <span class=\"rubl\">руб.</span>
                    </li>
                </ul>
                <a href=\"/#contacts\" title=\"заказать сайт визитку\" class=\"zayavka link-anim\"><span class=\"l3\"></span> заказать сайт визитку</a>
            </div>
        </div>
        <div id=\"s2\">
            <div class=\"site_block\">
                <a href=\"/sozdanie#korporativniy_sait\" class=\"portf-call\" title=\"корпоративный сайт\">
                    <h2 class=\"h_2 punkt link-anim\">Корпоративный сайт</h2>
                </a>
                <p>
                    Многофункциональный портал для компании
                    <br>
                    и важный маркетинговый инструмент для
                    <br>
                    продвижения ваших товаров и(или) услуг.
                    <br>
                </p>
                <ul>
                    <li>
                        <span class=\"l2\"></span>
                        каталог товаров и услуг
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        система управления сайтом
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>
                        оптимизация
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        срок исполнения от 21 дня
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        цена от
                        <span>12 000</span>
                        <span class=\"rubl\">руб.</span>
                    </li>
                </ul>
                <a href=\"/#contacts\" title=\"заказать корпоративный сайт\" class=\"zayavka link-anim\"><span class=\"l3\"></span> заказать корпоративный сайт</a>
            </div>
        </div>
        <div id=\"s3\">
            <div class=\"site_block\">
                <a href=\"/sozdanie#internet_magazin\" class=\"portf-call\" title=\"интернет магазин\">
                    <h2 class=\"h_2 punkt link-anim\">Интернет магазин</h2>
                </a>
                <p>
                    Оптимально для увеличения продаж.
                    <br>
                    Обязательно включает системы для добавления
                    товара и оформления заказа.
                    <br>
                </p>
                <ul>
                    <li>
                        <span class=\"l2\"></span>
                        полноценный интернет магазин
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        система управления сайтом
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        система добавления/удаления товаров
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        срок исполнения от 21 дня
                    </li>
                    <li>
                        <span class=\"l2\"></span>
                        цена от
                        <span>20 000</span>
                        <span class=\"rubl\">руб.</span>
                    </li>
                </ul>
                <a href=\"/#contacts\" title=\"заказать интернет магазин\" class=\"zayavka link-anim\"><span class=\"l3\"></span> заказать интернет магазин</a>
            </div>
        </div>
    </div>
    <div id=\"bonus\">
        <h2 class=\"header_shadow\">Для всех сайтов :</h2>
        <ul>
            <li>
                <span class=\"l1\"></span>
                Индивидуальный дизайн
            </li>
            <li>
                <span class=\"l1\"></span>
                Форма обратной связи(заявки)
            </li>
            <li>
                <span class=\"l1\"></span>
                Регистрация домена и размещение на выбранном хостинге
            </li>
            <li>
                <span class=\"l1\"></span>
                Регистрация в поисковых системах Яндекс и Google
            </li>
            <li>
                <span class=\"l1\"></span>
                Счетчик посетителей (по желанию заказчика)
            </li>
        </ul>
    </div>
    <h2 class=\"h_2 header_shadow\">Процесс работы над сайтом и контакты с заказчиком</h2>
    <p>
        Взаимодействие с заказчиком идет на всем процессе создания сайта от первого телефонного звонка.
        На всю свою работу даем бессрочную гарантию. Обучим Ваш персонал если необходимо.
    </p>
    <p>
        Конечно же как и всякий уважающий себя коллектив мы беремся не за все заказы. Если встает выбор взяться
        за заказ или отклонить его то тут у нас действует нехитрое правило которое мы условно называем
        \"правилом двух плюсов\". Если из трех критериев а именно <b>проект</b>
        ,
        <b>гонорар</b>
        и
        <b>заказчик</b>
        нас устраивают минимум два, то мы беремся за заказ. За интересный проект можно взяться и при низкой
        оплате. Другой вариант — проект интересный, гонорар отличный, а заказчик невероятный зануда.
        Конечно же беремся (кто же откажется от денег :) ).
    </p>
    <div id=\"etap\">
        <h2>Этапы создания сайта можно условно разделить на:</h2>
        <br>
        <ul>
            <li class=\"link-anim\">постановку целей</li>
            <li class=\"link-anim\">дизайн</li>
            <li class=\"link-anim\">верстку</li>
            <li class=\"link-anim\">программирование</li>
            <li class=\"link-anim\">наполнение</li>
            <li class=\"link-anim\">тестирование</li>
            <li class=\"link-anim\">запуск</li>
        </ul>
    </div>
    <output id=\"etap_target\"></output>
    <script>
        var etap = [
            \"Уяснение задач заказчика, определение целевой аудитории сайта, написание брифа(в народном фольклоре ТЗ).Прототипирование или составление эскиза где определяются расположения элементов страниц.\",
            \"Определение концепции дизайна.Цветовое и графическое решение будущего сайта, выбор шрифтов и др.\",
            \"Страницы сайта должны корректно отображаться во всех браузерах.Как правило хорошего тона нынче можно говорить об <a class=\\\"portf-call\\\" href=\\\"/sozdanie#response\\\"><b> адаптивной верстке</b></a> т.е. сайт должен быть хорошо читаем без потери функционала и на смартфонах и на планшетах и на настольных пк, и даже на тех устройствах, которые появятся в будущем.\",
            \"Программирование идет параллельно с версткой.Постановка сайта \\\"на движок\\\" выбранный заказчиком(или разработанный нами).Проектирование и наполнение контентом базы данных(если требуется).Можем предложить собственную CMS которая в отличии от \\\"универсальных\\\" будет заточена под Ваш конкретный сайт и очень проста в использовании.\",
            \"Наполнение содержимым.Если сайт будет продвигаться в поисковиках, пишутся грамотные SEO тексты под поисковые запросы по ключевым словам.\",
            \"Здесь идет полная проверка работоспособности сайта.Так же тестируется стойкость к XSS атакам и SQL инъекциям.\",
            \"Собственно выкладка на выбранный хостинг.Этот этап может быть сделан уже в процессе верстки.Например когда коммерческий сайт планируеться к SEO продвижению.Ведь SEO&mdash; процесс нескорый и тут время-деньги.\"
        ];
        var allLi = document.querySelectorAll(\'#etap li\'); // выбрали все li
        for (var i = 0; i < allLi.length; i++) {
            allLi[i].addEventListener(\"click\", target);
        }
        function target(e) {
            e = e || event;
            var obj = e.target || e.srcElement; // перестраховка
            for (var i = 0; i < allLi.length; i++) {
                if (obj == allLi[i]) { // красим нажатую ссылку
                    obj.classList.add(\'etap_active\'); // добавим класс нажатой ссылки
                    obj.classList.remove(\'link-anim\'); // у нажатой не нужна анимация
                } else { // возврат к умолчанию
                    var a = allLi[i].classList;
                    if (a.contains(\'etap_active\')) a.remove(\'etap_active\');
                    if (!a.contains(\'link-anim\')) a.add(\'link-anim\');
                }
            }
            var txt = obj.firstChild.nodeValue; // получаем текст ссылки
            var n; // индекс в массиве описания etap
            switch (txt) {
                case \"постановку целей\":
                    n = 0;
                    break;
                case \"дизайн\":
                    n = 1;
                    break;
                case \"верстку\":
                    n = 2;
                    break;
                case \"программирование\":
                    n = 3;
                    break;
                case \"наполнение\":
                    n = 4;
                    break;
                case \"тестирование\":
                    n = 5;
                    break;
                case \"запуск\":
                    n = 6;
                    break;
            }
            document.getElementById(\'etap_target\').innerHTML = etap[n]; // впендюриваем описание куда надо
        }
    </script>
    <br>
</article>
<div id=\"cms\">
    <strong>Мы используем CMS и фреймворки :</strong>
    <br>
    <div>
        <div id=\"joomla\"></div>
        <div id=\"wordpress\"></div>
        <div id=\"dle\"></div>
        <img width=\"40\" height=\"40\" alt=\"Yii\" src=\"data:image/png;base64,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\">
    </div>
    <br>
    <pre>joomla  wordpress drupal     yii2</pre>
</div>
<!-- </section> -->
    <a name=\"contacts\" rel=\"nofollow\"></a>
    <br>
    <br>
    <br>
<!--noindex-->

<div class=\"h1 text-center\">Возникли вопросы ?</div>
<div class=\"h2 text-center\">Напишите нам и получите исчерпывающую консультацию.</div>','Создание и продвижение сайтов в Чебоксарах','Создание сайтов под ключ в Чебоксарах','','1636108008'],
			['2','sozdanie','
        <img width=\"250\" height=\"167\" class=\"resp_img\" src=\"/img/main_img/sozdanie.jpg\" alt=\"создание сайтов\" title=\"создание сайтов\">
<article>
    <h2 class=\"header_shadow\">Создание сайтов для бизнеса и не только</h2>
    <p>
        Интернет — основная медиа среда сегодняшнего времени.<br>
        <strong>Сайт</strong> сегодня — один из приоритетных инструментов для развития бизнеса.
        Большинство предпринимателей стараются завести в сети интернет свою площадку для привлечения новых клиентов
        и развития своей деятельности.
        Иными словами, отсутствие своего сайта у компании ощутимый минус для неё.
        <br>
        Наша группа готова предложить
        Вам услуги по созданию сайтов любой тематики и направленности и для любого региона. Только
        сделанный профессионально информационно насыщенный сайт сможет дать Вам поток потенциальных клиентов.
        <br>
    </p>
    <p>
        Если говорить о <b>сайтах для бизнеса</b> то их весьма условно можно разделить на 3 основные категории.<br>
    </p>
    <b>Итак:</b><br>
    <h2 id=\"sait_vizitka\" class=\"header_shadow\">Сайт визитка</h2>
    <p>
        <img width=\"250\" height=\"171\" class=\"resp_img no_shadow no_border align-left\" src=\"/img/main_img/vizitka.jpg\" alt=\"сайт визитка\" title=\"сайт визитка\">
        Идеальный вариант для старта в интернете. В дальнейшем можно улучшать и развивать возможности сайта и его
        наполнение.<br>
        <strong>Сайт визитка</strong> — веб-ресурс, основное предназначение которого быстро и в яркой,
        запоминающейся форме представить Вашу компанию в сети интернет.<br>
        Обычно сайт визитка состоит из 5 разделов: <em>Главная страница, О компании, Услуги, Прайс лист, Контакты.</em>
        Несмотря на небольшие размеры такой сайт - основной инструмент для деятельности предпринимателей
        в сети интернет и содержит все необходимое для бизнеса.<br>
    </p>
    <h3>Заказав у нас сайт визитку вы получите:</h3>
    <ul class=\"list list_block\">
        <li><span class=\"l1\"></span>&nbsp;&nbsp;5-7 страниц информации на сайте</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Размещение прайс листов</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Форму обратной связи и(или) заявки на сайте</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Схему проезда до вашей организации</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Регистрацию и покупку домена</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Регистрацию в поисковых системах Яндекс и Google</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Валидный <abbr title=\"англ. HyperText Markup Language, version 5 — язык для структурирования и представления содержимого всемирной паутины\">HTML</abbr>
            код
        </li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Оптимизированную для <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>
            структуру страниц
        </li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Установку счетчика посещений</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>
    </ul>
    <p></p>
    <p>
        Создание сайтов этой категории обычно занимает 5-7 дней после написания брифа
        и утверждения структуры, дизайна.<br>
        <strong>Цена для сайта визитки</strong> от <span class=\"red\">7 000</span> <span class=\"rubl\"> руб.</span><br>
        <a href=\"/#contacts\" title=\"заказать сайт визитку\" class=\"zayavka link-anim\"><span class=\"l3\"></span> сделать заявку на сайт визитку</a>
    </p>
    <div class=\"hr\"></div>
    <h2 id=\"korporativniy_sait\" class=\"header_shadow\">Корпоративный сайт</h2>
    <p>
        <img width=\"250\" height=\"136\" class=\"resp_img no_border no_shadow align-left\" src=\"/img/main_img/corp.jpg\" alt=\"корпоративный сайт\" title=\"корпоративный сайт\">
        Веб-ресурс с множеством задач от повышения престижа организации до
        продвижения товаров.
        Создании сайтов этой категории требует индивидуального подхода и по цене ощутимо выше чем для простых сайтов.
        В первую очередь из за большего объема работ, количества размещаемой информации, более тщательной
        проработки дизайна и других факторов. Работы выполняются после анализа рынка и сайтов конкурирующих
        компаний. По желанию заказчика пишутся положительные отзывы о компании.
    </p>
    <p>
        На <strong>создание корпоративного сайта</strong> как правило
        уходит от трех недель. Корпоративный сайт отличается от сайта визитки в первую очередь
        наличием системы управления контентом (CMS), каталога товаров с возможностью оперативного
        добавления(удаления) или изменения их описания. Возможно как написание индивидуальной CMS, учитывающей
        все потребности Вашего сайта так и вариант с готовыми CMS (Joomla, Wordpress, DLE). Следует сказать
        что \"универсальные\" cms достаточно сложны в использовании для неподготовленного человека и поэтому
        мы готовы написать для Вас систему управления контентом под Ваш конкретный сайт где внесение изменений
        будет не сложнее, чем например поменять фото в соцсетях :).<br>
        <strong>Цена для корпоративного сайта</strong> от <span class=\"red\">12 000</span> <span class=\"rubl\"> руб.</span><br>
    </p>
    <h3>В цену включены:</h3>
    <ul class=\"list list_block\">
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;До 50 страниц информации</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>
            оптимизация всех страниц
        </li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Каталог товаров и услуг</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Микроразметка для товаров и контактов</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Форма обратной связи(заявки)</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Система управления контентом</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Новости или блог</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Регистрация в поисковых системах</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Счетчик посетителей</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Настройка систем Яндекс метрика и Google analitics</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Cопровождение после сдачи в течении 3 месяцев</li>
    </ul>
    <br>
    <a href=\"/#contacts\" title=\"заказать корпоративный сайт\" class=\"zayavka link-anim\"><span class=\"l3\"></span> сделать заявку на корпоративный сайт</a>
    <div class=\"hr\"></div>
    <h2 id=\"internet_magazin\" class=\"header_shadow\">Интернет магазин</h2>
    <p>
        <img width=\"250\" height=\"209\" class=\"resp_img no_border no_shadow align-left\" src=\"/img/main_img/market.jpg\" alt=\"интернет иагазин\" title=\"интернет магазин\">
        <strong>Интернет магазин</strong> — наиболее перспективный и развивающийся вид бизнеса в интернете.
        Создание сайтов такого уровня имеет свои особенности. Это обязательное наличие системы для
        добавления и удаления товара, каталога товаров, корзины покупателя, быстрого поиска товаров, удобной формы для
        заказа товара. Конечно же обязательно наличие базы данных для клиентов.
    </p>
    <p>
        Онлайн магазин наиболее удобный способ для осуществления продаж не требующий затрат на аренду и
        оптимален для их увеличения. Так же минимизированы затраты на персонал в торговом зале. Стоимость
        создания интернет магазина зависит от таких факторов: объема каталога товаров, интеграции с
        платежными системами, интеграции сайта с системой 1С, наличия авторизации пользователей и др.
        Сроки исполнения для <strong>интернет магазина</strong> от трех недель.
        <strong>Цена для интернет магазина</strong> от <span class=\"red\">20 000</span> <span class=\"rubl\"> руб.</span><br>
    </p>
    <h3>Цена включает:</h3>
    <ul class=\"list list_block\">
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Внутреннюю оптимизацию всех страниц</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Наполнение сайта содержимым</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Поиск по товарам</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Систему для добавления/удаления товара</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Корзину покупателя</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Удобную форму для заказа товара покупателем</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Продающие <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>
            тексты
        </li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Счетчик посещений</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Настройку целей в Яндекс метрике</li>
        <li><span class=\"l1\"></span>&nbsp;&nbsp;Техническое сопровождение сайта в течении 3 месяцев</li>
    </ul>
    <br>
    <a href=\"/#contacts\" title=\"заказать разработку интернет магазина\" class=\"zayavka link-anim\"><span class=\"l3\"></span> заказать разработку интернет магазина</a>
    <div class=\"hr\"></div>
    <p>
        На практике получить привлекательный по дизайну (или как минимум не вызывающий отторжения)
        и удобный для посетителя сайт не такая тривиальная задача, как видится
        на первый взгляд. Для создания приятного и простого в использовании сайта, красиво
        представляющего контент, хорошо читаемого и без ненужных излишеств, требуется приложить некоторые усилия.
        Как правило, большинство вебмастеров часто пренебрегают фактором юзабилити(англ. usability — дословно
        «возможность использования», «способность быть использованным», «полезность») сайтов, что немного прискорбно.
        Поэтому создание сайтов нужно доверять слаженной команде специалистов, способных выполнить эту
        многоступенчатую работу в заранее оговоренные сроки.
    </p>
    <div>
        <img width=\"250\" height=\"208\" class=\"resp_img no_border no_shadow align-left slide-in\" src=\"/img/main_img/response.jpg\" alt=\"адаптивная верстка\" title=\"адаптивная верстка\">
        <h2 id=\"response\" class=\"header_shadow\">Создание сайтов с адаптивным дизайном</h2>
        <p>
            <strong>Адаптивная верстка</strong> или <strong>адаптивный дизайн</strong> (респонсивный дизайн, отзывчивый
            дизайн, responsive web design, RWD)—
            направление в веб дизайне, когда ресурс должен быть одинаково удобным для просмотра и без потери функционала
            читаем на
            любых устройствах вне зависимости от ширины экрана. Будь то смартфон, планшет, ноутбук, настольный
            компьютер, проектор или даже устройство, которого еще нет, но появится в будущем.
        </p>
        <p>
            Сайт, который Вы сейчас видите разработан с учетом минимальной ширины экрана 340 пикселей без
            горизонтального скролла. Вы можете попробовать уменьшить окно вашего браузера и нажав кнопку \"обновить\"
            или клавишу F5 увидите, как изменилась страница. При определенной ширине экрана левое меню исчезнет
            и вместо него появиться знакомый многим \"гамбургер\", верхнее меню уменьшится в размерах
            или сложиться \"в два\" или \"в три этажа\", уменьшатся в размерах некоторые изображения и часть шрифтов.
            Это лишь один из возможных способов добиться адаптивного дизайна.
        </p>
        <p>
            <strong>Создание сайтов с адаптивным дизайном</strong> сегодня является правилом хорошего тона при
            веб разработке. Мы готовы предоставить услуги как по созданию адаптивных сайтов,
            так и по редизайну существующих сайтов с учетом адаптивности.
        </p>
    </div>
</article>','Создание сайтов в Чебоксарах','Создание сайтов любой сложности и назначения В Чебоксарах','','1636108090'],
			['3','prodvijenie','
        
    <article>
    <img width=\"250\" height=\"144\" class=\"resp_img\" src=\"/img/main_img/seo.jpg\" alt=\"продвижение сайтов\" title=\"продвижение сайтов\">
    <h2 id=\"base_seo\" class=\"header_shadow\">Продвижение сайта, необходимый минимум и с чего начинается раскрутка
        сайта</h2>
    <h3>Продвижение сайта и базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr><sup class=\"prim\">*</sup> оптимизация</h3>
    <p>
        Обычно вопрос нужно ли продвижение сайта возникает вскоре после того, как Ваш сайт появился в сети интернет.
        Мы профессионально занимаемся оказанием услуг физическим и юридическим лицам, планирующим активную
        маркетинговую деятельность в сети.
    </p>
    <p>
        <mark><strong>Раскрутка сайта</strong> <b>малоэффективна</b></mark>
        ,(или даже бессмысленна) если внутренняя структура страниц не подчиняется
        определенным правилам.
        Что бы добиться структурной и семантической правильности страниц и проводится
        <mark><strong>базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>
                оптимизация.</strong></mark>
        <br>
        Базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>
        оптимизация начинается с написания правильных мета тегов таких как <code>description</code> и наличия
        ключевых слов в теге <code><b>title</b></code>.
        Положительное влияние на продвижение сайта так же оказывает наличие заголовков H1 и далее, их
        правильная структура и наличие ключевых фраз в них, оптимизация изображений и тега <code><b>alt</b></code>,
        написание привлекательного для посетителей сниппета. На этом этапе, который идет в процессе верстки мы
        добиваемся корректности внутренней структуры страниц с точки зрения поисковых машин и соответствия
        стандартам консорциума <abbr title=\"англ. World Wide Web Consortium, W3C — организация, разрабатывающая и внедряющая технологические стандарты для Всемирной паутины\">W3C.</abbr><sup class=\"prim\">**</sup>
    </p>
    <p>
        Благоприятное действие на продвижение сайта оказывает так же их корректное
        отображение на мобильных устройствах.
        Ну и конечно правильная орфография всех текстов Вашего сайта. (Даже если у вас красный диплом филолога
        и вы уверены в правописании необходимо будет проверить текст в специальных сервисах поисковых систем,
        ведь Яндекс может считать по другому).
    </p>
    <p>
        Сразу же после выкладки на выбранный хостинг мы регистрируем Ваш
        сайт в поисковых системах Яндекс и Google и(по желанию заказчика) устанавливаем счетчики посещений.
        Настраивается правильная отдача сервером заголовков <code><b>LastModified</b></code>, проводиться склейка
        зеркал.
        Создаются файлы <code><b>sitemap.xml</b></code> и <code><b>robots.txt</b></code>. Возможно сделать
        автоматическую генерацию файла <code><b>sitemap.xml</b></code>.
    </p>
    <p>
        <b class=\"underline\">Примечания:</b><br>
        <em>
            <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\"><b>SEO</b></abbr>
            (search engine optimization) — оптимизация для поисковых машин, в народном фольклоре
            продвижение или раскрутка сайта.<br>
            <abbr title=\"англ. World Wide Web Consortium, W3C — организация, разрабатывающая и внедряющая технологические стандарты для Всемирной паутины\"><b>W3C</b></abbr>
            (World Wide Web Consortium) — всемирный консорциум по интернету.
        </em>
    </p>
</article>
<div class=\"hr\"></div>
<article>
    <h2 id=\"key_seo\" class=\"header_shadow\">Продвижение сайта (раскрутка сайта) по ключевым фразам</h2>
    <p>
        В первую очередь необходимо ответить на несколько важных вопросов:<br>
        Для чего вам нужен сайт ?<br>
        Для чего сайт нужен вашим пользователям ?<br>
        Чем он лучше/хуже других похожих сайтов ?<br>
        Какая целевая аудитория Вашего сайта ?<br>
        Ведь вполне может быть что именно для Вашего сайта эффективней окажется не <strong><abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>
            продвижение</strong> а например,&nbsp;<b><a href=\"#reklama\" class=\"list_link\">контекстная реклама</a></b>.
    </p>
    <p>
        Следует сразу сказать что поисковые машины не <i>индексируют сайты,</i> они <strong>индексируют
            страницы!</strong><br>
        И тут самая частая ошибка горе seo-оптимизаторов это приземление всех запросов на главную страницу сайта.
        Но раз термин <strong>продвижение сайта</strong> уже давно закрепился то и мы будем использовать его.<br>
        На этапе продвижения по ключевым словам проводиться анализ конкурентов, составление семантического ядра сайта и
        выбор приземляющих страниц(
        <b>ключевая страница</b>, <b>приземляющая страница</b>, <b>jump page</b>, <b>landing page</b>, <b>точка
            входа</b>) однозначно отвечающих на запрос пользователя
        (запросы семантического ядра), привязка запросов к страницам сайта, внутренняя перелинковка и другая
        оказывающая важное влияние на продвижение сайта работа.<br>
        Обязательно проверяется текст на удобочитаемость, уникальность, плотность ключевых слов, заспамленность и
        рекламный шум.
        При необходимости пишутся и размещаются положительные отзывы о компании.

    </p>
    <p>
        После того как работа над внутренней структурой сайта закончена начинается продвижение сайта
        с учетом внешних факторов.Это в первую очередь наращивание ссылочной массы за счет регистрации в
        \"белых\" каталогах, покупки \"вечных\" ссылок, использования сервис агрегаторов а так же блоговое и
        статейное продвижение сайта. Проводиться настройка целей в системах Яндекс метрика и Google analitics.<br>
        Мы используем <b>только легальные способы продвижения</b>. \"Черная\" SEO оптимизация не наш профиль!
    </p>
    <div id=\"seo_list\">
        <h3 class=\"header_shadow\">SEO продвижение сайта, основные требования к ресурсу:</h3>
        <ul>
            <li>Сайт сделан не на flash, java script, iframe (возможны AJAX сайты при соблюдении определенных правил)
            </li>
            <li>Все доступы и права принадлежат владельцу сайта</li>
            <li>Возраст ресурса превышает 1 год</li>
            <li>Сайт находиться в работоспособном состоянии</li>
            <li>Хостинг соответствует заявленным требованиям скорости/нагрузки</li>
            <li>Сайт не аффилирован и не имеет однотипного поддомена</li>
            <li>Сайт является основным зеркалом</li>
            <li>Сбалансированное семантическое ядро</li>
            <li>Контент</li>
            <li>Сайт не содержит запрещенных законом материалов</li>
            <li>На сайте информативная входная страница</li>
        </ul>
    </div>
    <br>
    <p>
        Стоимость на продвижение сайта по ключевым фразам зависит от многих факторов: <br>
        коммерческой популярности запроса, возраста сайта и др.
    </p>
    <a href=\"/#contacts\" title=\"продвижение сайта стоимость\" class=\"zayavka link-anim\"><span class=\"l3\"></span> узнать стоимость продвижения для Вашего сайта</a><br>
    <br>
</article>
<div class=\"hr\"></div>
<article>
    <h2 id=\"context\" class=\"header_shadow\">Контекстная реклама</h2>
    <!-- <h3 class=\"header_shadow\">Контекстная реклама. Что это?</h3> -->
    <p>
        SEO продвижение сайта в топ 10 яндекса может занять от 3 до 6 месяцев в зависимости от ряда
        факторов. Да и стоит это ощутимых денег. Совсем нередко стоимость SEO продвижения сайта превышает стоимость
        разработки самого сайта.Что же делать если коммерческая отдача нужна незамедлительно?
    </p>
    <p>
        Выход есть! Вам на помощь придет <strong>контекстная реклама</strong>.<br>
    </p>
    <p>Пользователи ежедневно заходят на разные тематические сайты раздраженно выключая всевозможные
        рекламные баннеры и игнорируя назойливые объявления. Совсем другой случай когда пользователь при
        посещении Яндекса видит текстовый блок по интересующей его тематике. Вкратце это и есть контекстная
        реклама. При этом информация о Вашем сайте попадает в топ выдачи Яндекса независимо от того на
        какой позиции он реально находиться.
    </p>
    <p>
        Если вы обращали внимание на надпись \"реклама\" в поисковой выдаче Яндекса или Google то это оно и есть.<br>
        Пользователь заходит на поисковик, вводит свой запрос и видит примерно
        следующее:
    </p>
    <figure class=\"kontext_img\">
        <img width=\"400\" height=\"382\" class=\"resp_img\" src=\"/img/main_img/yandex.jpg\" alt=\"контекстная реклама на Яндекс\" title=\"контекстная реклама на Яндекс\">
        <figcaption class=\"strong_text\">Так может выглядеть реклама на Яндекс</figcaption>
    </figure>
    <figure class=\"kontext_img\">
        <img width=\"400\" height=\"382\" class=\"resp_img\" src=\"/img/main_img/google.jpg\" alt=\"контекстная реклама на Google\" title=\"контекстная реклама на Google\">
        <figcaption class=\"strong_text\">Контекстная реклама на Google Adwords</figcaption>
    </figure>
    <p class=\"clear\">
        То, что выделено на фото красной рамкой и есть контекстная реклама. Туда можете попасть
        и Вы.
        Для этого нужно составить грамотный список ключевых фраз наиболее релевантных
        роду деятельности Вашей фирмы и уже на их основании написать привлекательные для потенциальных клиентов
        объявления с
        заголовками.
    </p>
    <p>
        К плюсам контекстной рекламы относиться также то, что Вы платите лишь за непосредственный переход
        на Ваш сайт и сами устанавливаете цену за клик. Чем выше Вы заявили стоимость перехода,
        тем выше будет Ваша позиция на странице выдачи поисковика (действует аукционный принцип). Можно также настроить
        выдачу в зависимости
        от времени суток или от географической привязки. Например, объявление \"доставка пиццы\" показывать
        с 11<sup>00</sup> до 14<sup>00</sup>(т.е. в обеденное время) в регионе Чебоксары.
    </p>
    <h3 class=\"header_shadow\">Настройка контекстной рекламы</h3>
    <p>
        Мы готовы профессионально провести рекламную компанию Вашей фирмы в Яндекс и Google
        по современным маркетинговым техникам. Составим объявления, подберем популярные ключевые слова, соответствующие
        роду деятельности Вашей организации.
    </p>
    <p>
    </p><ul>
        <li><strong>Настройка рекламы на Яндекс</strong> <span class=\"red\">3 000</span> <span class=\"rubl\"> руб.</span></li>
        <li><strong>Настройка рекламы на Google</strong> <span class=\"red\">3 000</span> <span class=\"rubl\"> руб.</span></li>
        <li><strong>Настройка рекламы на Яндекс Директ и Google Adwords</strong> <span class=\"red\">4 500</span>
            <span class=\"rubl\"> руб.</span> (единоразово)
        </li>
    </ul>
    <strong>Профессиональное ведение рекламной кампании</strong> от <span class=\"red\">3 000</span> <span class=\"rubl\"> руб.</span>/месяц<br>
    <span class=\"strong_text\">При заказе сайта от 40 000 <span class=\"rubl\"> руб.</span> настройку проведем <b class=\"underline\">БЕСПЛАТНО.</b></span>
    <p></p>
    <h2>Продвижение сайта методами <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>
        или контекстная реклама, что выбрать?</h2>
    <p>
        Следует сказать, что контекстная реклама абсолютно не влияет на позицию сайта в поисковой выдаче.
        Поэтому большинство компаний используют оба инструмента (и <b>контекстную рекламу</b> и <b>SEO продвижение</b>)
        для наибольшей эффективности. Еще отметим что результат от контекстной рекламы очень скор, но и пропадет сразу
        как закончатся Ваши деньги на счету того же яндекса т.е. платить придется
        постоянно (впрочем, как и в любой другой рекламе). Для продвижения сайта ситуация другая —
        результата приходится ждать обычно до 3 месяцев (иногда более) но и результат долгосрочный. При грамотном
        продвижении
        сайта подвинуть его из топа будет не так просто (мы не занимаемся \"черным\" продвижением когда сайт
        за 2 недели попадает в топ а затем вылетает в бан). В нашей практике были случаи когда сайт уже после
        прекращения <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr> продвижения висел в топе еще 2 года.<br> Поэтому наша рекомендация — применяйте
        и <b>продвижение сайта</b> и <b>контекстную рекламу!</b>
    </p>
</article>','Продвижение сайтов в Чебоксарах','Продвижение в поисковых системах и раскрутка в сети в Чебоксарах','','1636108080'],
			['4','portfolio','
    test','Создание и продвижение сайтов от Alex-art21','','','1636108119'],
			['5','parsing','<img width=\"250\" height=\"167\" class=\"resp_img\" src=\"/img/main_img/parsing.jpg\" alt=\"парсинг сайтов\"
     title=\"парсинг сайтов\">
<article>
    <h2 class=\"header_shadow\">Парсинг сайтов</h2>
    <p>
        <span class=\"mark\">Создали сайт и не знаете чем его наполнить ?</span><br/>
        Подобная проблема совсем не редкость.Где же взять контент?
        Конечно же в интернете.
    </p>
    <p>
        Другая ситуация - Вам необходим постоянный мониторинг сайтов например конкурентов.И в этом случае
        Вам на помощь придут программы парсеры.
    </p>
    <h3 class=\"header_shadow\">Что же такое парсинг сайтов и кому это может понадобится</h3>
    <p>
        Говоря по простому парсинг сайтов это получение любых необходимых структурированных
        данных из сети интернет.Т.е. добывание нужной информации как то статьи,картинки,
        видео или любой другой контент.Конечно все это можно сделать и вручную. <b>Но !</b><br/>
        Если вам нужно найти и скачать несколько фотографий или статей то конечно яндекс с
        гуглом вам в помощь.<br/>
        При больших же объемах информации делать это вручную весьма утомительно.
        Этот процесс можно автоматизировать.Тут Вам на помощь придут программы парсеры.
    </p>
    <p>
        <strong>Достоинства парсинга:</strong>
    <ul>
        <li><span class=\"l1\"></span>
            Программа парсер быстро и и безошибочно отделит служебную и техническую информацию
            от нужной.
        </li>
        <li><span class=\"l1\"></span>
            Парсер легко справляется с большими объемами информации.
        </li>
        <li><span class=\"l1\"></span>
            Минимальное участие человека.Практически весь процесс автоматизирован.
        </li>
    </ul>
    <br/>
    <strong>Недостатки:</strong>
    <br/>
    <p>
        Недостаток пожалуй единственный но достаточно серьезный. Это <b>Копипаст!</b><br/>
        Копипаст первейший враг поисковых машин!<br/>
        Поэтому всегда старайтесь использовать уникальный контент.

    </p>
    <p>
        Стоимость парсинга сайта начинается от <span class=\"red\">1&#8202;500 </span><span class=\"rubl\">руб.</span>
    </p>
    <p>
        Если Вам нужен парсинг сайта свяжитесь с нами любым удобным для Вас способом.Мы осуществим
        парсинг любых сайтов в том числе и сайтов с авторизацией и соцсетей.<br>
        Полученные данные предоставим в любом удобном для Вас формате(CSV,XLS,или дамп базы данных).
    </p>
</article>','Парсинг сайтов в Чебоксарах','','','1636107978']]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
               
$this->truncateTable('{{%content}}');
    }
}
