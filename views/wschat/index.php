<h1>Web socket chat</h1>
<div class="d-flex flex-row justify-content-lg-start">
    <div>
        <div style="position: relative;">
            <div id="msgs-content"></div>
            <div style="text-align: right">
                <button id="msgsClear" type="button" class="btn btn-danger">Очистить</button>
                <button id="saveChat" class="btn btn-success">Сохранить чат</button>
            </div>
        </div>
        <br>
        <div id="response">Cоединения с сервером...</div>
        <input id="chatform-name" type="text" placeholder="Ваше имя" maxlength="30">
        <button id="btnSetUsername" class="btn btn-success">Установить</button>
        <br>
        <br>
        <input id="msg" type="text" placeholder="Сообщение" maxlength="1000">
        <div style="position: relative">
            <button id="chatBtn" type="submit" class="fab fa-telegram-plane"></button>
        </div>
        Отправка Ctrl + Enter<br>
        <label for="soundCheck">звук</label>
        <input id="soundCheck" type="checkbox" checked>


        <label for="dateCheck">Показывать время без даты</label>
        <input id="dateCheck" type="checkbox" checked>
    </div>

    <div id="storage" style="display: none">
        <h2>Есть сохраненные чаты:</h2>
        <ul id="list"></ul>
        <button id="delAll" class="btn btn-danger">удалить все</button>
        <div id="schat" style="display: none"></div>
    </div>
</div>
<script>
    function readCookie(name) {
        const matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
    ///
function sound(){
    try {
        let flag = document.getElementById('soundCheck').checked;
        if(flag) {
            const snd = new Audio("data:audio/mpeg;base64,//uQxAAAEvGLIVT0AAuBtax3P2QCIAAIAGWUC+HkqfLeTs0zTQg7wL4BGCfQQ3A1BYDjCA4BoHgpWlFh2Lu+QLnkCgpRYu+4uL2QDQPDIT0FBQyRQUpwbh+fo7i4uLvoKA3BufBAoYlehAoKClOKChiIlbigokli4u8O4u73oh7v/6PcIKChlC6J//1vcEChhYNAaGU7u717u78PoZRYdnkALgvHkClOe/ARmPZVAwGIyHA4FQkCQJBAMAHAEzABwATHDWRgjAHQYFwJEe8X1jOkkG4y04RCJQANqNrMDJKMgDIMDRFDAxXiDAy/CIAwrhVUWkuBgVCABqvXuBybuyBzvSGtzQraTgYJkCgaaxbgYrAVAaNjqAZCANLHNWvS4GC0E4GQARAAgNQMHYCwspBusxOtr/DbAs2Q4tCcxlxZZ5qpw//nS+WTcwPjkEQ/qf/m9y4aLD4xY0FCM/1vr/+DY2I0QIoLjKBoVwKACAwIAAAUBGWCCBZIDYgy509qN0uj/1/Pc3uTBLf/LAI423K5bICDMzK72SSB0piCDVSm//uSxAoDzHSZNbzGADAAADSAAAAEJz44gRLSUSRJEVS0SgAhJcOjJdZkxJsZJBqIqloyMjISTExMTExPVtWTkSRJMXWjISls2t81WrfqtqMBoOCJ4Kgqs6Ij3/8t/g1///ywcLVMQU1FMy45OC40VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVUxBTUUzLjk4LjRVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVf/7ksQ5A8AAAaQAAAAgAAA0gAAABFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVMQU1FMy45OC40VVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVX/+5LEOQPAAAGkAAAAIAAANIAAAARVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV");
            snd.play();
        }
    }
    catch( e ) {
        console.log( "can't play sounds. " + e.message );
    }
}
/* Отправка по CTrl + Enter */
let text = document.querySelector('#msg');
text.onkeydown = function( e ) {
    if ( e.keyCode === 13 && e.ctrlKey ){
        chatBtn.click();
    }
};
/* Вывод только времени без даты */
function echoTime(selector){
    let flag = document.getElementById('dateCheck').checked;
    let dt = document.querySelectorAll(selector);
    if(flag){
        dt.forEach(function (item) {
            let dateOnly = item.innerText.slice(0, 11);
            let timeOnly = item.innerText.slice(11);
            item.innerHTML = '<span class="fa fa-check" style="font-size: 90%;color: green"></span><span class="dateOnly" style="display: none">' + dateOnly + '</span>' + timeOnly;
        });
    }
}
//
/* конец Список функций */
    window.onload = () => {
        /* Оборачивание ссылок в тег a */
        $.fn.replaceUrl = function(){
            var regexp = /((ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)/gi;
            this.each(function(){
                $(this).html(
                    $(this).html().replace(regexp,'<a href="$1" target="_blank">$1</a>'));
            });
            return $(this);
        };
        //
        $(function () {
            let chat = new WebSocket('ws://localhost:8080/wschat');
            let user_color = readCookie('user_color'),
                user_name = readCookie('user_name');
            if (user_name != 'undefined'){
                $('#chatform-name').val(user_name);
            }
            if(user_color != 'undefined'){
                updateColor();
            }

            chat.onmessage = function (e) {
                $('#response').text('');
                // console.log(e);
                let response = JSON.parse(e.data);
                if (response.type && response.type == 'chat') {
                    let dt = new Date();
                    // дата вида 06.03.2021
                    let currentDate = dt.toLocaleDateString();
                    // время без секунд вида 07:48
                    let currentTime = dt.toLocaleTimeString().slice(0,-3);
                    
                    $('#msgs-content').prepend('<p class="msg-line" style="border: .5px solid transparent"><span class="full-name"><b style="border-bottom: 2px solid hsl(' + response.user_color + ',100%,50%)">' + response.from + '</b></span><span class="msg-body">' + response.message + '</span><span class="dt"><span class="fa fa-check" style="font-size: 90%;color: green"></span><span class="dateOnly" style="display: none">' + currentDate + ' </span>' + currentTime + '</span></p>');
                    $('#msgs-content').scrollTop = $('#msgs-content').height;
                    $('.msg-body').replaceUrl();
                    document.cookie = 'user_color=' + response.user_color;
                    // console.log(dt.toLocaleDateString());
                    // console.log(dt.toLocaleTimeString());
                    // console.log(dt.toLocaleTimeString().slice(0,-3));
                    sound();
                } else if (response.message) {
                    $('#response').text(response.message);

                    if(response.type == 'set'){
                        /*document.cookie = 'user_color=' + response.user_color + '; path=/;  max-age=86400';
                        document.cookie = 'user_name=' + response.user_name + '; path=/;  max-age=86400';*/
                        document.cookie = 'user_color=' + response.user_color;
                        document.cookie = 'user_name=' + response.user_name;
                        updateColor();
                        // console.log('here');
                    }

                }
            };
            chat.onopen = function (e) {
                $('#response').text('Установите имя');
                // console.log(e);
            };
            let oldMsg = null;
            $('#chatBtn').click(function () {
                let msg = $('#msg').val();
                if (msg && (msg != oldMsg)) {
                    let user_color = readCookie('user_color');
                    chat.send(JSON.stringify({'action': 'chat', 'message': msg, 'user_color': user_color}));
                    // console.log(user_color);
                    oldMsg = msg;
                    $('#msg').val('');
                } else if (!msg) {
                    $('#response').text('Введите сообщение');
                    // alert('Введите сообщение')
                }else if(msg == oldMsg){
                    $('#response').text('Попытка повторной отправки. Измените текст сообщения');
                }
            })

            $('#btnSetUsername').click(function () {
                let username = document.getElementById('chatform-name').value;
                // console.log(username);
                if (username) {
                    chat.send(JSON.stringify({'action': 'setName', 'name': username}));
                    updateColor();
                } else {
                    alert('Установите имя')
                }
            })
        })
    }

    function updateColor() {
        let clr = decodeURIComponent(readCookie('user_color'));
        clr = 'hsl(' + clr + ',100%,50%)';
        // clr = 'hsl(10%,100%,50%)';
        if(clr){
            let inp = document.getElementById('chatform-name');
            // let msgBlock = document.querySelector('.msg-line');
            inp.style.color = clr;
            inp.setAttribute('style', '-webkit-text-fill-color:'  + clr + ' !important');
            chatBtn.style.color = clr;
            // msgBlock.style.border = '1px solid ' + clr;
        }
    }

    /* Очистить чат */
    msgsClear.addEventListener('click', ()=>{
        $('#msgs-content').text('');
    });
    // все сохраненные
    let allChats = localStorage.getItem('wschats');
    /* Сохранить чат */
    saveChat.addEventListener('click', ()=>{
        let wschats;
        if(allChats){
          wschats = JSON.parse(allChats)
        }else{
            wschats = [];
        }
        const data = document.querySelector('#msgs-content').innerHTML;
        if(data.length > 0) {
            const dt = new Date();
            const name = prompt('имя для сохранения') + '_' + dt.getFullYear() + '-' + (parseInt(dt.getMonth()) + 1).toString() + '-' + dt.getDate();
            const chat = {};
            chat.name = name;
            chat.data = data;
            wschats.push(chat)
            localStorage.setItem('wschats', JSON.stringify(wschats));
        }
    });
    /* Сохраненные чаты */
    if(allChats){
        allChats = JSON.parse(allChats);
        storage.style.display = 'block';
        const list = document.getElementById('list');
        // выводим список сохраненных чатов
        allChats.forEach((item) => {
            let li = document.createElement('li');
            let a = document.createElement('a');
            a.innerText = item.name;
            a.setAttribute('data-chat', item.name);
            li.append(a);
            list.append(li);
        })
        // отображаем нужный чат
        list.onclick = (e) => {
            let key = e.target.getAttribute('data-chat');
            schat.style.display = 'block';
            let chatData;
            allChats.forEach((item) => {
                if(item.name === key){
                    chatData = item.data;
                }
            })
            schat.innerHTML = chatData + '<button type="button" class="close"></button>';
            const close = document.querySelector('#schat > button');
            close.onclick = () => {
                schat.style.display = 'none';
            };
        };

        /* Удалить все сохраненные чаты */
        delAll.onclick = () => {
            localStorage.removeItem('wschats');
            list.innerHTML = '';
            storage.style.display = 'none';
        };
    }
    //
    // переключение формата даты/времени
dateCheck.addEventListener('click', ()=>{
    let flag = document.querySelector('.dateOnly').style.display;
    if(flag == 'none'){
        $('.dateOnly').css('display', 'inline');
    }else{
        $('.dateOnly').css('display', 'none');
    }
});
</script>
