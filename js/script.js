const slider = document.querySelectorAll(".slider");
M.Slider.init(slider, {
	interval: 4000
});

var teks = new Typed('#teks', {
	strings: ['Assalamuallaikum Warahmatullahi Wabarakatuh'],
	typeSpeed: 40,
	backSpeed: 90,
	backDelay: 1000,
	fadeOut: false,
	loop: true
});

const tooltip = document.querySelectorAll('.tooltipped');
M.Tooltip.init(tooltip);