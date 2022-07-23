<?php
$this->title = 'SPA';
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
<script>
  /*jQuery(function ($) {
    grecaptcha.ready(function() {
      grecaptcha.execute("6LftRl0aAAAAAHJDSCKdThCy1TaS9OwaGNPSgWyC", {action: "index"}).then(function(token) {
        jQuery("#" + "indexform-recaptcha").val(token);

        const jsCallback = "";
        if (jsCallback) {
          eval("(" + jsCallback + ")(token)");
        }
      });
    });

  });*/
</script>