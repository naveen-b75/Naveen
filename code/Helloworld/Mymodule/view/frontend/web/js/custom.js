require(['jquery','jquery/ui'],function ($) {
   $(document).ready(function () {
       $('.red').click(function () {
           $('body').css({'background':'#d43f3a'},{'color':'#fdfbff'});
       });
       $('.blue').click(function () {
           $('body').css({'background':'#2e6da4'},{'color':'#f3ffed'});
       })
   })
});



