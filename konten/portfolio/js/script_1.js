  var txt = '--.: Assalamuallaikum Warahmatullahi Wabarakatuh This is My first Website By Awal Prasetyo :.--';
  var spd = 300;
  var fresh = null;
  function jalan (){
    document.title = txt;
    txt = txt.substring(1, txt.length) + txt.charAt(0);
    fresh = setTimeout('jalan()', spd);
    txt.innerHTML = txt;
  }jalan();
        
$(document).ready(function(){
	$('[data-toggle="popover"]').popover();
});

$(window).scroll(function(){
  let wScroll = $(this).scrollTop();
  
  $('.jumbotron h2').css({
    'transform' : 'translate(0px,'+wScroll/10+'%)'
  });

  $('.gambar').css({
    'transform' : 'translate(0px,'+wScroll/28+'%)'
  });

  $('.jumbotron h1').css({
    'transform' : 'translate(0px,'+wScroll/12+'%)'
  });
  $('.jumbotron p.lead').css({
    'transform' : 'translate(0px,'+wScroll/24+'%)'
  });

  $('.jumbotron hr').css({
    'transform' : 'translate(0px,'+wScroll/10+'%)'
  });

  $('.jumbotron p.jelas').css({
    'transform' : 'translate(0px,'+wScroll/16+'%)'
  });

  $('.jumbotron p a').css({
    'transform' : 'translate(0px,'+wScroll/7+'%)'
  });

  $('.jumbotron div.collapse p').css({
    'transform' : 'translate(0px,'+wScroll/55+'%)'
  });

  $('.jumbotron div.collapse').css({
    'transform' : 'translate(0px,'+wScroll/55+'%)'
  });
});

$(document).ready(function(){
  $('.up a i').hide();
  $(window).scroll(function(){
    if ($(this).scrollTop()>50) {
      $('.up a i').fadeIn();
    } else {
      $('.up a i').fadeOut();
    }
  });
});

$(document).ready(function(){
  $('.up a').click(function(){
    $('html, body').animate({
      scrollTop: 0
    }, 1000);
    return false;
  });
  
});

$(document).ready(function(){
  $('.scroll').on('click',function(e){

    var tujuan = $(this).attr('href');

    var elemenTujuan = $(tujuan);

    e.preventDefault();

    $('html, body').animate({
      scrollTop: elemenTujuan.offset().top
    }, 1000, 'swing');
  });
});