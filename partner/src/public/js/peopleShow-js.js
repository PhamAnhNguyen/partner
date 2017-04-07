$(document).ready(function () {
    function slideNext() {
        $('.people-text').eq(1).css({"transform": "translate(1141px)"});
        $('.people-text').eq(0).addClass('active-slide');
        $('.people-text').eq(1).removeClass('active-slide');

        $('.flex-btn i').eq(0).addClass('active-flex-btn');
        $('.flex-btn i').eq(1).removeClass('active-flex-btn');
    }
    function slidePre() {
        $('.people-text').eq(0).css({"transform": "translate(-1141px)"});
        $('.people-text').eq(1).addClass('active-slide');
        $('.people-text').eq(0).removeClass('active-slide');

        $('.flex-btn i').eq(1).addClass('active-flex-btn');
        $('.flex-btn i').eq(0).removeClass('active-flex-btn');
    }
    $('.people-slide .flex-btn i').eq(0).click(function () {
        slideNext();
    });
    $('.people-slide .flex-btn i').eq(1).click(function () {
        slidePre();
    });
    $('.people-pic .fa-chevron-left').click(function () {
        slideNext();
    });
    $('.people-pic .fa-chevron-right').click(function () {
        slidePre();
    });
    var tranfX = 35;
    function logoslide(x) {

        $('.logo-slide').css({"left": x});
        if (x <= -661)
        {
            $('.logo-sliderow .fa-circle').eq(0).removeClass('fa-active');
            $('.logo-sliderow .fa-circle').eq(1).addClass('fa-active');
        } else {
            $('.logo-sliderow .fa-circle').eq(0).addClass('fa-active');
            $('.logo-sliderow .fa-circle').eq(1).removeClass('fa-active');
        }
    }
    $('.logo-sliderow .fa-chevron-right').click(function () {
        tranfX = tranfX - $('.logo-item').width();
        if (tranfX <= -1160)
            tranfX = 35;
        logoslide(tranfX);
    });
    $('.logo-sliderow .fa-chevron-left').click(function () {
        tranfX = tranfX + $('.logo-item').width();
        if (tranfX >= 35)
            tranfX = -1160;
        logoslide(tranfX);
    });
    $('.flex-btn-logo .fa-two').eq(0).click(function () {
        tranfX = 35;
        logoslide(tranfX);
    });
    $('.flex-btn-logo .fa-two').eq(1).click(function () {
        tranfX = -1160;
        logoslide(tranfX);
    });

    $('.flex-btn-logo i').click(function () {
        //tranfX = tranfX + 
    });
});