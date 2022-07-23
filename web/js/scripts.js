'use strict'

const screen_w = document.body.clientWidth;
const screen_h = document.body.clientHeight;
/*let scrollHeight = Math.max( // полная высота с прокручиваемой частью
    document.body.scrollHeight, document.documentElement.scrollHeight,
    document.body.offsetHeight, document.documentElement.offsetHeight,
    document.body.clientHeight, document.documentElement.clientHeight
);*/
window.onresize = function () {
    window.screen_w = document.body.clientWidth;
    window.screen_h = document.body.clientHeight;
};

/*Мобильное левое меню*/
function mobLeft() {
    const menuBtn = document.querySelector('.mob-menu-button'); //кнопка
    const menu = document.querySelector('.mob-menu-list'); // выезжающий блок
    menuBtn.addEventListener('click', function () {
        menu.classList.toggle('menu-animate');
        menuBtn.classList.toggle('btn-pos');
    });
    // закритие мобильного меню при клики вне его
    const Btn = $('.mob-menu-button'),
        $menu = $('.mob-menu-list');
    $(document).click(function (e) {
        if (!Btn.is(e.target) && !$menu.is(e.target) && $menu.has(e.target).length === 0) {
            console.log();
            if (menu.classList.contains('menu-animate')) {
                // menu.classList.remove('menu-animate');
                menu.classList.toggle('menu-animate');
                menuBtn.classList.toggle('btn-pos');
            }
        }
        ;
    });
    ////////
    /*const c = mobLink.length;
    // чтоб меню закрывалось при клике на любую ссылку
    for (let i = 0; i < c; i++) {
        mobLink[i].addEventListener('click', function () {
            menu.classList.toggle('menu-animate');
            menuBtn.classList.toggle('btn-pos');
            menuCol.classList.toggle('open');
        });
    }*/
}

/* кнопка наверх */
const scr = document.getElementById('scroller');
window.addEventListener('scroll', () => {
    let top = window.pageYOffset; // сколько проскролено
    if (top > 500) {
        scr.style.display = 'block';
    } else {
        scr.style.display = 'none';
    }
});
scr.addEventListener('click', () => {
    // $('body,html').animate({scrollTop: 0}, 300);
    window.scrollTo(0, 0);
});

/* фиксация верхнего меню */
function menu_fix() {
    const h_hght = 500; // высота шапки
    const h_mrg = 0; // отступ когда шапка уже не видна
    $(function () {
        let top = $(this).scrollTop(); // сколько проскролено
        const menu = $('#menu_outer'), // блок меню
            resp = $('nav.resp'),
            ul = $('nav.resp ul'),
            link = $('.resp a'),
            leftMenu = $('#l_menu');
        if ((top + h_mrg) > h_hght && screen_w >= 930) { // включается "скролл-меню"
            menu.css({
                'top': h_mrg,
                'position': 'fixed',
                'background': 'transparent',
                'z-index': '10'
            });
            resp.css({
                'border': 'none',
                'marginTop': '-20px',
            });
            ul.addClass('scrolled');
            link.css({
                'color': '#313A3D',
                'borderRight': '1px dotted #e61b05'
            });
           /* leftMenu.css({
                'position': 'fixed',
                'top': 0
            });*/
        } else {
            menu.css({
                'top': 0,
                'position': 'relative',
                'background': '',
                'z-index': ''
            });
            resp.css({
                'background-color': '',
                'border': '',
                'marginTop': ''
            });
            ul.removeClass('scrolled');
            link.css({
                'color': '',
                'borderRight': ''
            });
            /*leftMenu.css({
                'position': ''
            });*/
        }
    });
}

//
$(window).scroll(function () {
    menu_fix(); // фиксация верхнего меню
});

// доставание cookie
function readCookie(name) {
    const matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

/////////////
/* Далее в обертке window.onload */
window.onload = () => {
    // модалка с оповещением что выслано письмо
    const mailInfo = document.querySelector('#success-modal');
    if (mailInfo) {
        $('#success-modal').modal();
        /*setTimeout(function() {
            $('#success-modal').modal('hide');
        }, 4000);*/
    }
    // анимация в шапке
    const shtorka = document.querySelector('.shtorka');
    shtorka.classList.add('shtorka-animate');

    mobLeft(); // мобильное меню
    //
    (function ($) {
        new WOW().init();
    })(jQuery);

    // Окно чата/мессенджеров
    let msgBlock = document.getElementById('msg-block'),
        msgContent = document.getElementById('msg-content'),
        msgImg = document.querySelector('.msg-img'),
        msgClosed = document.querySelector('.msg-closed');

    const al = document.getElementById('container').clientWidth;
    msgBlock.style.right = (screen_w - al) / 2 + 'px'; //позиционируем в правый край родителя

    const showMsg = () => { // показ окна чата с анимацией
        $('#msg-block').velocity('transition.bounceIn');
        // msgBlock.style.display = 'block';
    };
    /* Всплывающая подсказка над чатом */
    const showTooltip = () => {
        if (msgBlock.hasAttribute('data-closed') && !readCookie('msg')) { // только при свернутом окошке и нету куки (не заходил больше часа или сколько там)
            let promise = document.querySelector('audio').play();
            if (promise !== undefined) {
                promise.then(_ => {
                    console.log('play!');
                }).catch(err => {
                    console.log(err.message);
                });
            }
            $('[data-toggle="tooltip"]').tooltip('show');
            document.cookie = "msg=1;max-age=3600;path=/"; // куку на час(в течении этого времени больше не будет всплывающих подсказок)
        }
    };
    //
    const rmTooltip = () => { // убиваем tooltip
        let tltp = document.querySelector('.tooltip');
        if (tltp) {
            tltp.remove();
        }
    };
    //
    const rmMsgAnim = () => { // нефиг всю дорогу мерцать
        const bar = document.querySelector('.msg-closed').classList;
        bar.remove('button-anim');
    };
    // несколько задержек
    setTimeout(showMsg, 3000); //  показываем блок с чатом
    setTimeout(showTooltip, 6000); // показываем всплывающую подсказку/приглашение
    setTimeout(rmTooltip, 14000); // скрываем подсказку
    setTimeout(rmMsgAnim, 30000); // выключаем анимацию
    msgBlock.addEventListener('mouseover', () => { // по наведению мыши тож прибиваем
        rmTooltip();
    });
    msgContent.addEventListener('click', () => { // разворачиваем окно чата
        if (msgBlock.hasAttribute('data-closed')) { // свернуто
            // msgBlock.style.height = '370px';
            msgBlock.classList.add('msg-opened');
            msgBlock.style.background = 'url(/img/wats-bg.gif)';
            msgBlock.style.boxShadow = '0 0 30px #999';
            msgImg.style.left = 'calc(50% - 30px)';
            msgClosed.style.display = 'none';
            msgBlock.removeAttribute('data-closed');
            showMsg();
        }
    });
    //
    const msgClose = document.querySelector('#msg-block button');
    msgClose.addEventListener('click', () => { // сворачиваем окно чата
        if (!msgBlock.hasAttribute('data-closed')) { // окно не свернуто
            msgImg.style.left = '240px';
            // msgBlock.style.height = '';
            msgBlock.classList.remove('msg-opened');
            msgBlock.style.background = '';
            msgBlock.style.boxShadow = '';
            msgClosed.style.display = '';
            msgBlock.setAttribute('data-closed', '');
        }
    });
    //
    $(document).on('pjax:beforeSend', () => {
        document.body.style.cursor = 'progress';
        $('#container_loading').show();
        let method = $.pjax.options.type; // (GET или POST)
        let target = $.pjax.options.container; // контейнер куда грузим AJAX данные
        if (method == 'POST' && $.pjax.options.url == '/') { // отправка формы с главной
            container_loading.style.top = window.pageYOffset + screen_h / 2 - 30 + 'px';
        }
        if (target == '#my-modal' && method == 'GET') { // вызов модального окна(обратный звонок)
            showOverlay();
        } else if (method != 'POST') { // данные в блок #inc (основной контент)
            const inc = document.querySelector('#inc');
            const mainW = document.querySelector('#main').clientWidth;
            const incW = inc.clientWidth;
            const l = document.querySelector('#inc').offsetLeft;
            const scrB = () => { // узнаем ширину скроллбара
                // создадим элемент с прокруткой
                let div = document.createElement('div');
                div.style.overflowY = 'scroll';
                div.style.width = '50px';
                div.style.height = '50px';
                document.body.append(div);
                let scrollWidth = div.offsetWidth - div.clientWidth;
                div.remove();
                scrollWidth = scrollWidth ? scrollWidth : 0;
                return scrollWidth;
            };
            container_loading.style.left = (screen_w - mainW) / 2 + l + incW / 2 - 30 - scrB() + 'px';
            const incOverl = document.querySelector('#inc-overlay');
            incOverl.style.width = inc.clientWidth + 'px';
            incOverl.style.height = inc.clientHeight + 'px';
            incOverl.style.left = inc.offsetLeft + 'px';
            incOverl.style.top = inc.offsetTop + 'px';
            scrollTo(0, 0);
            $('#inc-overlay').css('display', 'block');
        }
    });

    $(document).on('pjax:complete', () => {
        let target = $.pjax.options.container; // контейнер куда грузим AJAX данные
        if (target == '#inc') {
            linkColor(); // красим активную ссылку
        }
        document.body.style.cursor = 'default';
        hideOverlay();
        container_loading.style.left = '';
        container_loading.style.top = '';
        $('#inc-overlay').css('display', 'none');
        let method = $.pjax.options.type;
        if (method == 'POST' && $.pjax.options.url == '/') { // очищаем поля формы отправки письма
            document.forms[0].reset();
            $('#index-form label').removeClass('fill')
        }
        // Ratelimiter сработал (ПРЕВЫШЕНО КОЛ-ВО ПОПЫТОК ВХОДА)
        // Куки сохранял в action site/login
        $(document).on('pjax:error', (event, xhr, textStatus, errorThrown, options) => {
            $('#container_loading').hide();
            if (xhr.status == 429) {
                alert('Количество попыток исчерпано.Не более ' + readCookie('rateLimit') + ' попыток в минуту');
            }
        });
    });
    /* Фиксируем "шторки" в контактной форме при фокусе */
    /*document.getElementById('index-form').addEventListener('focusin', (e) => {
        let el = e.target;
        let lbl = e.target.previousElementSibling; //<label>
        if (el.tagName != 'BUTTON'){
            console.log(el);
            lbl.classList.add('fill');
        }
    });*/
};
/* конец обертка onload */
function showOverlay() {
    $('#container').prepend('<div id="overlay"></div>');
    $('#overlay').show();
}
function hideOverlay() {
    $('#overlay').remove();
    $('#container_loading').hide();
}
// окраска активной AJAX ссылки верхнего меню
function linkColor() {
    let links = document.querySelectorAll('.resp li a'); // все ссылки верхнего меню
    let currentLink = window.location.pathname; // нажатая ссылка
    for (var i = 0; i < links.length; i++) {
        let y = links[i].pathname;
        if (y == currentLink && currentLink != '/') {
            // console.log(links[i]);
            links[i].classList.add('header_shadow');
            links[i].classList.add('cursor-default');
            links[i].onclick = () => {
                return false;
            }
        } else {
            links[i].classList.remove('header_shadow');
            links[i].classList.remove('cursor-default');
            links[i].onclick = () => {
                return true;
            }
        }
    }
}

/* Параграф "этапы создания сайта" на главной странице окраска активной ссылки */
const etap = [ // массив с описаниями
    "Уяснение задач заказчика, определение целевой аудитории сайта, написание брифа(в народном фольклоре ТЗ).Прототипирование или составление эскиза где определяются расположения элементов страниц.",
    "Определение концепции дизайна.Цветовое и графическое решение будущего сайта, выбор шрифтов и др.",
    "Страницы сайта должны корректно отображаться во всех браузерах.Как правило хорошего тона нынче можно говорить об <a class=\"portf-call\" href=\"/sozdanie#response\"><b> адаптивной верстке</b></a> т.е. сайт должен быть хорошо читаем без потери функционала и на смартфонах и на планшетах и на настольных пк, и даже на тех устройствах, которые появятся в будущем.",
    "Программирование идет параллельно с версткой.Постановка сайта \"на движок\" выбранный заказчиком(или разработанный нами).Проектирование и наполнение контентом базы данных(если требуется).Можем предложить собственную CMS которая в отличии от \"универсальных\" будет заточена под Ваш конкретный сайт и очень проста в использовании.",
    "Наполнение содержимым.Если сайт будет продвигаться в поисковиках, пишутся грамотные SEO тексты под поисковые запросы по ключевым словам.",
    "Здесь идет полная проверка работоспособности сайта.Так же тестируется стойкость к XSS атакам и SQL инъекциям.",
    "Собственно выкладка на выбранный хостинг.Этот этап может быть сделан уже в процессе верстки.Например когда коммерческий сайт планируеться к SEO продвижению.Ведь SEO&mdash; процесс нескорый и тут время-деньги."
];
const etli = document.querySelector('#etap ul');
if (etli) {
    etli.onclick = (e) => {
        let li = e.target;
        if (!li) return;
        $('#etap ul li').removeClass('etap_active'); // убираем окраску если есть
        li.classList.add('etap_active'); // подсветить новый li
        let n = li.dataset.n;
        document.getElementById('etap_target').innerHTML = etap[n]; // впендюриваем описание куда надо

    };
}
/* Левое меню окраска активной ссылки */
let leftMenu = document.querySelector('#l_menu');
if (leftMenu) {
    leftMenu.onclick = (e) => {
        let a = e.target;
        if (a.nodeName != 'A') return;
        let li = a.parentElement;
        if (li.nodeName != 'LI') return;
        /*if(li.classList.contains('link-active')){ // ссылка уже активна ничего не делаем
            a.onclick = () => {
                return false;
            }
        }*/
        $('#l_menu li').removeClass('link-active'); // убираем окраску если есть
        li.classList.add('link-active'); // подсветить новый li
    };
}
/******/
