var nav = $('nav');
var line = $('<div />').addClass('line');

line.appendTo(nav);

var active = nav.find('.active');
var pos = 0;
var wid = 0;

function Slide() {
  if(!nav.hasClass('animate')) {
    nav.addClass('animate');

    var _this = active;

    nav.find('ul li').removeClass('active');

    var position = _this.parent().position();
    var width = _this.parent().width();

    if(position.left >= pos) {
      line.animate({
        width: ((position.left - pos) + width)
      }, 300, function() {
        line.animate({
          width: width,
          left: position.left
        }, 150, function() {
          nav.removeClass('animate');
        });
        _this.parent().addClass('active');
      });
    } else {
      line.animate({
        left: position.left,
        width: ((pos - position.left) + wid)
      }, 300, function() {
        line.animate({
          width: width
        }, 150, function() {
          nav.removeClass('animate');
        });
        _this.parent().addClass('active');
      });
    }

    pos = position.left;
    wid = width;
  }
}

if(active.length) {
  console.log("initiated");
  pos = active.position().left;
  wid = active.width();
  line.css({
    left: pos,
    width: wid
  });
  Slide(); 
}

window.onresize = Slide;

nav.find('ul li button').click(function(e) {
  e.preventDefault();
  active = $(this);
  Slide();
});
