/* Список функций */
// доставание cookie
function readCookie(name) {
    const matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
//
function updateList() {
    $.pjax.defaults.timeout = false;
    $.pjax.reload({
        method: 'get',
        container: '#msgs-content'
    });
}
///
function updateUserColor() {
    let clr = decodeURIComponent(readCookie('user_color'));
    clr = 'hsl(' + clr + ',100%,50%)';
    if(clr){
        let inp = document.getElementById('chatform-name');
        let msgBlock = document.querySelector('.msg-line');
        inp.style.color = clr;
        inp.setAttribute('style', '-webkit-text-fill-color:'  + clr + ' !important');
        chatBtn.style.color = clr;
        msgBlock.style.border = '1px solid ' + clr;
    }
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
/* Оборачивание ссылок в тег a */
$.fn.replaceUrl = function(){
    var regexp = /((ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?)/gi;
    this.each(function(){
        $(this).html(
            $(this).html().replace(regexp,'<a href="$1" target="_blank">$1</a>'));
    });
    return $(this);
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

let msgs = document.getElementById('msgs-content');
$(document).on('pjax:start', () => {
    // document.body.style.cursor = 'progress';
    let beforeMsgsCount = msgs.childNodes.length;
    sessionStorage.setItem('beforeMsgsCount', beforeMsgsCount);
});

$(document).on('pjax:complete', () => {
    // document.body.style.cursor = 'default';
    let method = $.pjax.options.type;
    if(method == 'POST'){
        document.getElementById('msg').value = ''; // приняты данные с формы
        updateUserColor();
        sound();
    }else if(method == 'GET'){ // обновление по setInterval()
        let beforeMsgsCount = sessionStorage.getItem('beforeMsgsCount');
        let afterMsgsCount = msgs.childNodes.length;
        if(afterMsgsCount != beforeMsgsCount){ // бибикаем только при изменнении
            sound();
        }
    }
    $('#msgs-content').scrollTop($('#msgs-content')[0].scrollHeight);
    $('.msg-body').replaceUrl();
    echoTime('.dt');
});

// updateUserColor();
$('#msgs-content').scrollTop($('#msgs-content')[0].scrollHeight);
$('.msg-body').replaceUrl();
echoTime('.dt');
setInterval(updateList, 5000);

// переключение формата даты/времени
dateCheck.addEventListener('click', ()=>{
    let flag = document.querySelector('.dateOnly').style.display;
    if(flag == 'none'){
        $('.dateOnly').css('display', 'inline');
    }else{
        $('.dateOnly').css('display', 'none');
    }
});
