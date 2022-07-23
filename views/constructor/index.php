<?php
$this->title = 'Онлайн дизайн чехлов';
?>
<noscript><strong>Для отображения страницы включите  Javascript !</strong></noscript>
<style>@keyframes dash {
           to {
               stroke-dashoffset: 136;
           }
       }
    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }</style>
<div id="app">
    <svg width="100px" height="100px" style="position: absolute;left:calc(50% - 50px);top:calc(50% - 50px)" viewBox="-3 -4 39 39"><polygon style="stroke-dasharray: 17;animation: dash 2.5s cubic-bezier(0.35, 0.04, 0.63, 0.95) infinite;" fill="#ffffff" stroke="#ff0000" stroke-width="1" points="16,0 32,32 0,32"></polygon></svg>
</div>
<script>window.onload = () => {
        Coloris({
            el: '.coloris',
            alpha: false,
            swatches: [
                '#ffffff', //
                '#000000', //
                '#000080', //navy
                '#0000FF', //blue
                '#00FA9A', //MediumSpringGreen
                '#00FF00', //lime
                '#191970', //MidnightBlue
                '#4169E1', //RoyalBlue
                '#FF00FF', //Fuchsia
                '#FF0000', //red
                '#FFFF00', //Yellow
                '#FFFFE0', //LightYellow
            ]
        });
    }</script>