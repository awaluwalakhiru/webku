var txt = '--.: Assalamuallaikum Warahmatullahi Wabarakatuh This is My Second Website By Awal Prasetyo :.--';
var spd = 300;
var fresh = null;
function jalan (){
  document.title = txt;
  txt = txt.substring(1, txt.length) + txt.charAt(0);
  fresh = setTimeout('jalan()', spd);
  txt.innerHTML = txt;
}jalan();

const sidenav = document.querySelectorAll('.sidenav');
M.Sidenav.init(sidenav);

const slider = document.querySelectorAll('.slider');
M.Slider.init(slider, {
    interval: 4000
});

const materialbox = document.querySelectorAll('.materialboxed');
M.Materialbox.init(materialbox);

const parallax = document.querySelectorAll('.parallax');
M.Parallax.init(parallax);

const fab = document.querySelectorAll('.fixed-action-btn');
M.FloatingActionButton.init(fab);

const car = document.querySelectorAll('.carousel');
M.Carousel.init(car);

const modal = document.querySelectorAll('.modal');
M.Modal.init(modal);

const tooltip = document.querySelectorAll('.tooltipped');
M.Tooltip.init(tooltip);

const scroll = document.querySelectorAll('.scrollspy');
M.ScrollSpy.init(scroll, {
    scrollOffset: 70
});