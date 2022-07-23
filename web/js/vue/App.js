const DraggableResizable = Vue3DraggableResizable.default
const DraggableContainer = Vue3DraggableResizable.DraggableContainer
//
let tmpW, tmpH, tmpSrc, tmpFileName;
//
const maxImgWidth = 360;
// const maxImgSize = 4; // объявил в views/layout/constructor.php !
const containerW = 400;
const containerH = 773;
// const fakeBlock = document.getElementById('fakeBlock');
//
const App = {
    components: {draggableResizable: DraggableResizable},
    data() {
        return {
            defaultText: 'Ваш текст',
            defaultColor: '#0000ff',
            defaultFontSize: 24,
            tmpLayer: {
                id: '',
                zIndex: 1000,
                type: '',
                fileName: '',
                src: '',
                content: this.defaultText,
                x: 0,
                y: 0,
                w: 0,
                h: 0,
                fontFamily: '',
                fontSize: this.defaultFontSize,
                interval: 0,
                color: this.defaultColor,
                rotate: '',
                isActive: true,
            },
            layers: [],
        }
    },
    methods: {
        dragEndHandle(e, index) {
            let realX, realY;
            if (e.x < 0) {
                realX = 0;
                e.x = 0;
            } else if (e.x > (containerW - this.tmpLayer.w)) {
                realX = containerW - this.tmpLayer.w;
                e.x = containerW - this.tmpLayer.w;
            } else {
                realX = e.x;
            }
            //
            if (e.y < 0) {
                realY = 0;
                e.y = 0;
            } else if (e.y > (containerH - this.tmpLayer.h)) {
                realY = containerH - this.tmpLayer.h;
                e.y = containerH - this.tmpLayer.h;
            } else {
                realY = e.y;
            }
            this.layers[index].x = realX;
            this.tmpLayer.x = realX;
            this.layers[index].y = realY;
            this.tmpLayer.y = realY;
            // document.getElementById(index).style.left = realX + 'px';
            // document.getElementById(index).style.top = realY + 'px';
        },
        handle(e, index, type) {
            if (type === 'drag-end') {
                this.dragEndHandle(e, index);
            }
        },
        imgResize(e, index) {
            // let block = document.getElementById(String(index));
            this.layers[index].w = e.w;
            this.layers[index].h = e.h;
        },
        setActive(index) {
            this.hideProgress();
            this.clearActive();
            /*let overlay = document.getElementById('overlay');
            if(overlay){
                overlay.style.display = 'block';
            }*/
            //
            this.tmpLayer.id = this.layers[index].id;
            this.tmpLayer.type = this.layers[index].type;
            this.tmpLayer.fileName = this.layers[index].fileName;
            this.tmpLayer.content = this.layers[index].content;
            //
            this.layers[index].zIndex = 1000;
            this.tmpLayer.zIndex = 1000;
            //
            this.tmpLayer.src = this.layers[index].src;
            this.tmpLayer.x = this.layers[index].x;
            this.tmpLayer.y = this.layers[index].y;
            this.tmpLayer.w = this.layers[index].w;
            this.tmpLayer.h = this.layers[index].h;
            this.tmpLayer.fontFamily = this.layers[index].fontFamily;
            this.tmpLayer.fontSize = this.layers[index].fontSize;
            this.tmpLayer.interval = this.layers[index].interval;
            this.tmpLayer.color = this.layers[index].color;
            this.tmpLayer.rotate = this.layers[index].rotate;
            //
            this.layers[index].isActive = true;
            // document.getElementById(String(index)).click();
        },
        hideBorder() { // убираем управляющие элементы перед скриншотом
            /*let container = document.getElementById('img-container');
            container.style.border = 'none';*/
            let activeTxt = document.querySelector('.activeTxt');
            if (activeTxt) {
                activeTxt.style.border = 'none';
            }
            this.clearActive();
            this.clearActive();
            this.hideProgress();
        },
        startLoader(){
            document.body.style.cursor = 'progress';
        },
        stopLoader(){
            document.body.style.cursor = ''
        },
        clearActive() {
            this.layers.forEach(item => {
                item.isActive = false;
                item.zIndex = item.id;
            })
            this.tmpLayer.type = '';
        },
        exportAll() {
            let container = document.getElementById('img-container');
            this.hideBorder();
            /*let overlay = document.getElementById('overlay');
            if(overlay){
                overlay.style.display = 'none';
            }*/
            this.save();
            this.export(container);
        },
        save() {
            try{
                localStorage.setItem('layers', JSON.stringify(this.layers));
            }catch (e) {
                console.log(e);
                alert('Превышена квота LocalStorage');
                return
                // location.reload();
            }

        },
        send(){ // отправка на сервер
            document.body.style.cursor = 'progress';
            let container = document.getElementById('img-container');
            let progressBlock = document.querySelector('.progress');
            let progressBar = document.querySelector('.progress-bar');
            let formData;
            let $alert = $('.alert');
            const url = '/constructor';
            // const url = 'https://alexart.houme21.ru/constructor';
            html2canvas(container, {}).then(function (canvas) {
                canvas.toBlob(function (blob) {
                    formData = new FormData();
                    formData.append('screen', blob, 'test.png');
                    // csrf токен объявлен в файле шаблона views/layout/constructor.php в самом верху
                    formData.append(csrf_param, csrf_token);
                    // отправка
                    /* Fetch без индикатора загрузки */
                    /*let response = fetch(url, {
                        method: 'POST',
                        body: formData,
                    }).then(function (response) {
                        response.text().then(function (data) {
                            if(response.ok){
                                $alert.show().addClass('alert-success').text('Изображение загружено');
                            }else{
                                let code = response.status;
                                console.log(response)
                                let errText;
                                switch (code) {
                                    case 411 : errText = 'Слишком большой файл';break;
                                    case 415 : errText = 'Не распознан файл изображения';break;
                                    default : '';
                                }
                                $alert.show().addClass('alert-danger').text('Ошибка ' + code + ' ' + errText);
                            }
                        });
                    });*/
                    //
                    /* AJAX с прогрессбаром */
                    let xhr = new XMLHttpRequest();
                    xhr.timeout = 20000;
                    xhr.onreadystatechange = () => {
                        if(xhr.readyState == 1) {
                            progressBlock.style.visibility = 'visible';
                            progressBar.classList.add('progress-bar-animated');
                            if (progressBar.classList.contains('bg-danger')){
                                progressBar.classList.remove('bg-danger');
                                progressBar.classList.add('bg-success');
                            }
                            progressBar.innerText = '';
                        }
                    };
                    xhr.upload.onprogress = (e) => {
                        let percentComplete = Math.ceil((e.loaded / e.total) * 100);
                        progressBar.style.width = percentComplete + '%';
                        progressBar.innerText = percentComplete + '%';
                    };
                    // Ждём завершения: неважно, успешного или нет
                    xhr.onloadend = () => {
                        if (xhr.status == 200) {
                            // console.log("Успех");
                            $alert.show().addClass('alert-success').text('Изображение загружено');
                        } else {
                            let code = xhr.status;
                            // console.log("Ошибка " + code);
                            switch (code) {
                                case 413 : errText = 'Слишком большой файл.';break;
                                case 415 : errText = 'Не распознан файл изображения.';break;
                                default : errText = '';
                            }
                            progressBar.classList.remove('bg-success');
                            progressBar.classList.add('bg-danger');
                            progressBar.innerText = 'Ошибка !';
                            $alert.show().addClass('alert-danger').text('Ошибка ' + code + '. ' + errText);
                        }
                        document.body.style.cursor = '';
                        progressBar.classList.remove('progress-bar-animated');
                        document.body.style.cursor = '';
                    };
                    xhr.open('POST', url);
                    xhr.send(formData);
                    //
                }, 'image/png');
            });
        },
        export(container) {
            // console.log('export');
            let fileName = this.strRand(12);
            html2canvas(container, {}).then(function (canvas) {
                canvas.toBlob(function (blob) {
                    // после того, как Blob создан, загружаем его
                    let link = document.createElement('a');
                    link.download = fileName + '.png';
                    link.href = URL.createObjectURL(blob);
                    link.click();
                    // удаляем внутреннюю ссылку на Blob чтоб не висела впамяти
                    URL.revokeObjectURL(link.href);
                }, 'image/png');
            });
        },
        strRand(len) { // случайная строка
            let result = '';
            let words = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
            let max_position = words.length - 1;
            for (i = 0; i < len; ++i) {
                position = Math.floor(Math.random() * max_position);
                result = result + words.substring(position, position + 1);
            }
            return result;
        },
        addText() {
            this.hideProgress();
            // получим id
            let id;
            if(!this.layers.length){ // еще ничего не добавлено
                id = 0;
            }else{
                let arr = [];
                this.layers.forEach((item) => {
                    arr.push(item.id);
                });
                id = Math.max(...arr) + 1;
            }
            //
            this.layers.push({
                id: id,
                zIndex: id,
                type: 'txt',
                fileName: '',
                content: this.defaultText,
                src: '',
                x: 0,
                y: 0,
                // w: Math.floor((this.defaultText -0.5) * this.tmpLayer.fontSize),
                // h: Math.floor(this.defaultText * 1.5),
                w: (this.defaultText.length) * this.defaultFontSize,
                h: this.defaultFontSize * 1.5,
                fontFamily: '',
                fontSize: 24,
                color: this.defaultColor,
                interval: '',
                rotate: '',
                isActive: true,
            });
            this.clearActive();
            this.setActive(id);
            this.save();
        },
        addImg() {
            this.hideProgress();
            document.getElementById('imgInput').click(); // клик по input[type=file]
        },
        readFile() { // по событию onchange на input[type=file]
            let input = document.getElementById('imgInput');
            let file = input.files[0];
            //
            if (this.getFileExt(file.name) != 'png' || file.type != 'image/png') {
                alert('Недопустимый тип файла! (только PNG)');
                return;
            }
            if (file.size > maxImgSize * 1024 * 1024) {
                alert('Превышен размер файла (не более ' + maxImgSize + ' мегабайт)');
                return;
            }
            //
            async function f() {
                let reader = new FileReader();
                await reader.readAsDataURL(file);
                reader.onload = await function () {
                    tmpSrc = reader.result;
                    tmpFileName = file.name;
                    input.value = null; // очищаем а то при добавлении одинаковых файлов трабл
                    document.getElementById('insert').click();
                }
                reader.onerror = function () {
                    console.log(reader.error);
                };
            }
            //
            f();
        },
        insertImg() {
            let id = this.layers.length ? String(this.layers.length) : '0';
            //
            async function f() {
                // финт ушами чтобы узнать реальный размер Base64 изображения
                let tmpImg = new Image();
                tmpImg.src = tmpSrc;
                tmpImg.onload = await function () {
                    tmpW = tmpImg.naturalWidth;
                    tmpH = tmpImg.naturalHeight;
                    //
                    if (tmpW > maxImgWidth) { // превышает допустимый размер - уменьшаем
                        let ratio = tmpW / tmpH;
                        let canvas = document.createElement('canvas');
                        canvas.width = maxImgWidth;
                        let height = Math.floor(maxImgWidth / ratio);
                        canvas.height = height;
                        var ctx = canvas.getContext("2d");
                        ctx.drawImage(this, 0, 0, maxImgWidth, height);
                        tmpW = maxImgWidth;
                        tmpH = height;
                        canvas.toBlob(function (blob) {
                            let reader = new FileReader();
                            reader.readAsDataURL(blob); // конвертирует Blob в base64 и вызывает onload
                            reader.onload = function () {
                                tmpSrc = reader.result; // url с данными
                            };
                        }, 'image/png');
                    }
                    document.getElementById('push').click(); // идем к методу pushImg()
                }
            }
            f();
        },
        pushImg() { // добавляем в массив
            // получим id
            let id;
            if(!this.layers.length){ // еще ничего не добавлено
                id = 0;
            }else{
                let arr = [];
                this.layers.forEach((item) => {
                    arr.push(item.id);
                });
                id = Math.max(...arr) + 1;
            }
            //
            this.layers.push({
                id: id,
                zIndex: id,
                type: 'img',
                fileName: tmpFileName,
                src: tmpSrc,
                x: 0,
                y: 0,
                w: tmpW,
                h: tmpH,
                rotate: '',
                isActive: true,
            });
            this.clearActive();
            this.setActive(id);
            this.save();
        },
        getFileExt(fname) {
            return fname.slice((fname.lastIndexOf(".") - 1 >>> 0) + 2);
        },
        getLayers() {
            let localLayers = localStorage.getItem('layers');
            if (localLayers) {
                this.layers = JSON.parse(localLayers);
            }
        },
        typing() {
            let w = (this.tmpLayer.content.length - 2) * this.tmpLayer.fontSize;
            let h = this.tmpLayer.fontSize * 1.5;
            this.tmpLayer.w = w;
            this.tmpLayer.h = h;
        },
        del(index) { // удаление слоя
            this.hideProgress();
            this.clearActive();
            if(this.layers[index]){
                this.layers.splice(index, 1);
                /*if(this.layers.length){ // пересортировка
                    let i = 0;
                    this.layers.forEach((item) => {
                        item.id = i;
                        item.zIndex = i;
                        i++;
                    })
                }*/
            }
        },
        hideProgress(){
            document.querySelector('.progress').style.visibility = 'hidden';
            $('.alert').hide();
        },
        clear() {
            this.layers = [];
            localStorage.clear();
            this.hideProgress();
        },
    },
    mounted() {
        this.getLayers();
        document.getElementById('main-overlay').style.display = 'none';
        document.getElementById('loader').style.display = 'none';
    },
    /*created(){
        console.log('created')
    },*/
    watch: {
        layers: {
            handler(updatedList) {
                this.save();
            },
            deep: true
        },
        tmpLayer: {
            handler(updatedList) {
                if(updatedList.type){
                    this.layers[updatedList.id].zIndex = updatedList.zIndex;
                    this.layers[updatedList.id].x = updatedList.x;
                    this.layers[updatedList.id].y = updatedList.y;
                    this.layers[updatedList.id].w = updatedList.w;
                    this.layers[updatedList.id].h = updatedList.h;
                    this.layers[updatedList.id].content = updatedList.content;
                    this.layers[updatedList.id].src = updatedList.src;
                    this.layers[updatedList.id].fontSize = updatedList.fontSize;
                    this.layers[updatedList.id].fontFamily = updatedList.fontFamily;
                    this.layers[updatedList.id].interval = updatedList.interval;
                    this.layers[updatedList.id].color = updatedList.color;
                    this.layers[updatedList.id].rotate = updatedList.rotate;
                    //
                    this.save();
                }

            },
            deep: true
        },
    },
    computed: {},
}

Vue.createApp(App).mount("#app");