window.onload = () => {
    //overlay  когда нет картинки накрываем кнопки
    let imgOver = document.querySelector('.img-block-over');
    if (!localStorage.getItem('src')) {
        imgOver.style.height = document.querySelector('.img-control').clientHeight + 'px';
    }
    //
    const dragableImg = document.getElementById('img2');
    const container = document.getElementById('img-container');
    const exportBtn = document.getElementById('export-btn');
    const clearBtn = document.getElementById('clear-btn');
    let resizeContainer = document.querySelector('.resize-container');
    const imgBlock = document.querySelector('.img-control');
    const mainBlock = document.querySelector('.main-block');
    const contenteditable = document.getElementById('contenteditable');

    /* Если есть ранее сохраненные трансформации то применяем */
    if (localStorage.getItem('bg')) {
        container.style.backgroundImage = 'url("' + localStorage.getItem('bg') + '")';
    } else {
        container.style.backgroundImage = 'url("/img/test/img1.png")';
    }

    if (localStorage.getItem('inText')) { // текст
        contenteditable.style.left = localStorage.getItem('textX') + 'px';
        contenteditable.style.top = localStorage.getItem('textY') + 'px';
        contenteditable.style.fontSize = localStorage.getItem('fontSize') + 'px';
        contenteditable.style.fontFamily = localStorage.getItem('font');
        contenteditable.style.color = localStorage.getItem('color');
        contenteditable.style.letterSpacing = localStorage.getItem('letSps') + 'px';
        contenteditable.innerText = localStorage.getItem('inText');
        /*Вставляем и в инпуты*/
        innerText.value = localStorage.getItem('inText');
        font.value = localStorage.getItem('font');
        fontSize.value = localStorage.getItem('fontSize');
        color.value = localStorage.getItem('color');
        letSps.value = localStorage.getItem('letSps');
    }

    if (localStorage.getItem('src')) { // картинка
        dragableImg.src = localStorage.getItem('src');
        resizeableImage($('.resize-image')); // инициализация плагина трансформации
        imgBlock.style.display = 'block';
        mainBlock.style.display = 'block';
    } else {
        // dragableImg.src = '/img/test/no-image.png';
    }

    if (localStorage.getItem('x')) {
        if (!resizeContainer) {
            resizeContainer = document.querySelector('.resize-container');
        }
        resizeContainer.style.left = localStorage.getItem('x') + 'px';
        resizeContainer.style.top = localStorage.getItem('y') + 'px';
    } else {// зашли впервые и позиционируем картинку в левый верхний угол

    }

    if (localStorage.getItem('transform')) { // поворот картинки
        dragableImg.style.transform = localStorage.getItem('transform');
    }

    /* Вешаем события на кнопи */
    clearBtn.addEventListener('click', () => {
        clear();
    });
    /* Нажали сохранить */
    exportBtn.addEventListener('click', () => {
        // проверка зафиксили ли текст
        let text = document.querySelector('.contenteditable').innerText;
        if (text) {
            // let next = confirm('Вы редатировали текст.Зафиксировать его перед скриншотом? (отмена - продолжить редактирование)');
            // if (!next) return;
            fixText(contenteditable, container);
        }
        // убираем те элементы которы не должны быть на скриншоте
        if (document.querySelector('.btn-block')) {
            document.querySelector('.btn-block').style.display = 'none';
        }
        if (document.querySelector('.resize-handle-ne')) {
            document.querySelector('.resize-handle-ne').style.display = 'none';
            document.querySelector('.resize-handle-se').style.display = 'none';
            document.querySelector('.resize-handle-nw').style.display = 'none';
            document.querySelector('.resize-handle-sw').style.display = 'none';
        }


        // сохраняем позицию внутренней картинки
        resizeContainer = document.querySelector('.resize-container');
        if (resizeContainer) {
            let box = resizeContainer.getBoundingClientRect();
            let x = box.left + pageXOffset - container.offsetLeft;
            let y = box.top + pageYOffset - container.offsetTop;
            if (x <= 1) x = 0;
            if (y <= 1) y = 0;
            localStorage.setItem('x', x);
            localStorage.setItem('y', y);
        }
        // передаем то что скриншотим и внутр. каринку
        exportImg(container, dragableImg);
    });

    //* Реализация поворота input type=range */
    $(function () {
        let slider = $('input.image-rotate'),
            image = $('#img2');
        slider.on('change mousemove', function () {
            image.css('transform', 'rotate(' + $(this).val() + 'deg)')
        });
    })
}

/* Сохраняем как png файл */
function exportImg(elem, innerImg) {
    html2canvas(elem, {}).then(function (canvas) {
        canvas.toBlob(function (blob) {
            // после того, как Blob создан, загружаем его
            let link = document.createElement('a');
            link.download = str_rand(12) + '.png';
            link.href = URL.createObjectURL(blob);
            link.click();
            // удаляем внутреннюю ссылку на Blob чтоб не висела впамяти
            URL.revokeObjectURL(link.href);
        }, 'image/png');
        // здесь сохраняем внутреннюю картинку если мы ее не масштабировали то обычный src иначе base64
        localStorage.setItem('src', innerImg.src);
        // console.log(innerImg.style.transform);
        if (innerImg.style.transform) { // если только вертели картинку
            localStorage.setItem('transform', innerImg.style.transform);
        }
        // перезагружаемся
        location.reload();
    });
}

/* Возвращаем в девственное состояние */
function clear() {
    localStorage.clear();
    // перезагружаемся
    location.reload();
}

/* Генерация псевдослучайной строки */
function str_rand(len) {
    let result = '';
    let words = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    let max_position = words.length - 1;
    for (i = 0; i < len; ++i) {
        position = Math.floor(Math.random() * max_position);
        result = result + words.substring(position, position + 1);
    }
    return result;
}

// получить расширение файла
function getFileExt(fname) {
    return fname.slice((fname.lastIndexOf(".") - 1 >>> 0) + 2);
}

/* Form Fetch() */
document.addEventListener('DOMContentLoaded', () => {
    //
    const form = document.querySelector('#bg-form');
    const fileInput = document.getElementById('file-input');
    /* Здесь отпрака на сервер */
    /*form.onsubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        console.log(formData.get('background_img'));
        let response = await fetch('/test', {
            method: 'POST',
            body: formData,
        });
        let result = await response.text();
        if(response.ok){

        }
    }*/
    /* Здесь никуда не отправляем */
    fileInput.onchange = () => {
        let file = fileInput.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function () {
            let bgImg = reader.result;
            document.getElementById('img-container').style.backgroundImage = 'url("' + bgImg + '")';
            localStorage.setItem('bg', bgImg);
        };
    }
});

// получаем файл картинки, вставляем в нужный блок, инициализируем плагин
function readFile(input, img) {
    // console.log(input);
    // return;
    let file = input.files[0];
    if (getFileExt(file.name) != 'png') {
        alert('Ата-та, только PNG');
        return;
    }
    let container = document.querySelector(img);
    let reader = new FileReader();
    reader.readAsDataURL(file)
    reader.onload = function () {
        container.src = reader.result;
        // resizeableImage($('.resize-image')); // init плагина
        resizeableImage(container); // init плагина
    };
    reader.onerror = function () {
        console.log(reader.error);
    };
}

function imgAdd(elem) { // имитируем клик на input type=file
    document.querySelector('.img-block-over').style.display = 'none'; // снимаем оверлей
    elem.click();
}

function allAdd() { // верхняя кнопка "с плюсиком"
    let buttons = document.querySelectorAll('.rBt');
    let i = 0;
    while (buttons[i]) {
        if (i == 0) {
            buttons[i].classList.toggle('visible-left');
        } else {
            buttons[i].classList.toggle('visible-right');
        }
        i++;
    }
}

function textAdd(area) { // пока не задействована
    document.getElementById('contenteditable').style.display = 'block';
}

/* Drag & Drop блока с текстом */
contenteditable.onmousedown = function (event) {
    let shiftX = event.clientX - contenteditable.getBoundingClientRect().left;
    let shiftY = event.clientY - contenteditable.getBoundingClientRect().top;
    document.body.append(contenteditable);

    moveAt(event.pageX, event.pageY);

    // переносит блок на координаты (pageX, pageY),
    // дополнительно учитывая изначальный сдвиг относительно указателя мыши
    function moveAt(pageX, pageY) {
        contenteditable.style.left = pageX - shiftX + 'px';
        contenteditable.style.top = pageY - shiftY + 'px';
    }
    function onMouseMove(event) {
        moveAt(event.pageX, event.pageY);
    }
    // передвигаем блок при событии mousemove
    document.addEventListener('mousemove', onMouseMove);
    // отпустить блок, удалить ненужные обработчики
    contenteditable.onmouseup = function (e) {
        document.removeEventListener('mousemove', onMouseMove);
        contenteditable.onmouseup = null;
    };

};

contenteditable.ondragstart = function () {
    return false;
}

/* Убиваем текстовый контейнер.И на его место копию.После драгдропа не берется скриншот !!!!!!!!!!!!!!! */
// запускается перед снятием скриншота
function fixText(textContainer, mainContainer) {
    // получаем координаты
    let x = textContainer.offsetLeft - mainContainer.offsetLeft;
    let y = textContainer.offsetTop - mainContainer.offsetTop;
    // данные с контролов в правой части страницы
    let inText = textContainer.innerText;
    let font = document.getElementById('font').value;
    let fontSize = document.getElementById('fontSize').value;
    let color = document.getElementById('color').value;
    let letSps = document.getElementById('letSps').value;
    // удаляем
    textContainer.parentNode.removeChild(textContainer);
    // делаем клона
    let div = document.createElement('div');
    div.className = "contenteditable";
    div.setAttribute('id', 'res');
    div.innerText = inText;
    mainContainer.appendChild(div);
    res.style.left = x + 'px';
    res.style.top = y + 'px';
    res.style.fontFamily = font;
    res.style.fontSize = fontSize + 'px';
    res.style.color = color;
    res.style.letterSpacing = letSps + 'px';
    // сохраняем
    localStorage.setItem('textX', x);
    localStorage.setItem('textY', y);
    localStorage.setItem('inText', inText);
    localStorage.setItem('font', font);
    localStorage.setItem('fontSize', fontSize);
    localStorage.setItem('color', color);
    localStorage.setItem('letSps', letSps);
}

// Привязываем события на контролах
innerText.addEventListener('input', () => {
    contenteditable.innerText = innerText.value;
});

fontSize.addEventListener('input', () => {
    contenteditable.style.fontSize = fontSize.value + 'px';
});

font.addEventListener('change', () => {
    contenteditable.style.fontFamily = font.value;
});

color.addEventListener('change', () => {
    contenteditable.style.color = color.value;
});

letSps.addEventListener('input', () => {
    console.log('here');
    contenteditable.style.letterSpacing = letSps.value + 'px';
});