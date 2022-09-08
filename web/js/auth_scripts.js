const screen_w = document.body.clientWidth;
const screen_h = document.body.clientHeight;
// Переключение видимости символов пароля и иконки
const icons = $('span.clicked');
const field = $('input.pass-input');
icons.click(function (e) {

    if (e.target.classList.contains('fa-eye-slash')) {
        icons.removeClass('fa-eye-slash');
        icons.addClass('fa-eye');
        field.attr('type', 'text');
    } else {
        icons.removeClass('fa-eye');
        icons.addClass('fa-eye-slash');
        field.attr('type', 'password');
    }
});