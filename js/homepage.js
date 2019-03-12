$(function () {
    //set interval
    //configuration
    var width = 720;
    var animation = 1000;//animation duration(in ms)
    var pause = 3000;//time between the slides(in ms)
    var currentslide = 1;
    //cache DOM
    var $slider = $('#slider');
    var $slidecontainer = $slider.find('.slides');
    var $slides = $slidecontainer.find('.slide');
    var interval;
    //resume on mouseleave
    function startslider() {
        interval = setInterval(function () {
            $slidecontainer.animate({ 'margin-left': '-=' + width }, animation, function () {  //animate margin-left
                currentslide++;
                if (currentslide == $slides.length) {
                    currentslide = 1;
                    $slidecontainer.animate({ 'margin-left': '0' }, animation);     //if it's the last slide, go to position 1 (0px) with animation
                }
            });
        }, pause);
    }
    //listen for mouseenter and pause
    function stopslider() {
        clearInterval(interval);
    }
    $slider.on('mouseenter', stopslider).on('mouseleave', startslider);
    startslider();
});