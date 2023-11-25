const BASE_URL = 'http://localhost/brasil-pescados/site_painel/webapp/';

// função anonima js
// utilizada para efeito de piscar na sidebar do anunciante
$(function() {

    function blinker() {

        $('.blink_me').fadeOut(1000);
        $('.blink_me').fadeIn(1000);

    }

    setInterval(blinker, 1000);

});