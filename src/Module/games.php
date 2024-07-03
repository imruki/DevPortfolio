
<!-- Games Section -->
<div class="games-div">
  <section class="pen">
    <div class="stage">
      <a class="element RacingFanatics" href="https://imruki.itch.io/racing-fanatics-stunts" rel="nofollow" target="_blank"></a>
      <a class="element Fruitopia" href="https://imruki.itch.io/fruit-quest" rel="nofollow" target="_blank"></a>
      <a class="element myBBTAN" href="/bbtan-js"></a>
    </div>
  </section>
</div>

<script>
        $('.element').each(function() {
        $(this).mouseover(function() {
            $(this).addClass('active');
          $('.stage').children('.element').not('.active').addClass('inactive');
        });
        $(this).mouseleave(function() {
            $(this).removeClass('active');
            $('.stage').children('.element').not('.active').removeClass('inactive');
        });
    });
</script>

<style>
 /* ---------------------------- Games Menu ---------------------------- */
.pen {
  max-width: 635px;
  width: 100%;
  margin: 50px auto 0;
  opacity: 0;
  position: relative;
  -webkit-transition: all 0.25s ease-in-out;
  -moz-transition: all 0.25s ease-in-out;
  -ms-transition: all 0.25s ease-in-out;
  -o-transition: all 0.25s ease-in-out;
  transition: all 0.25s ease-in-out;
  -webkit-animation: 1s appear 1 forwards;
  -moz-animation: 1s appear 1 forwards;
  -o-animation: 1s appear 1 forwards;
  animation: 1s appear 1 forwards;
}
.credit {
  display: block;
  max-width: 400px;
  text-align: center;
  margin: 150px auto 0;
  padding: 0;
  font-size: 0.8em;
  color: #f0f0f0;
  text-shadow: 0 1px 0 rgba(0, 0, 0, 0.9);
}
.credit p a,
.credit a {
  color: white;
  text-decoration: none;
  font-weight: 700;
}
.credit p a:hover,
.credit a:hover,
.credit p a:active,
.credit a:active {
  text-shadow: 0 0 5px rgba(255, 255, 255, 0.4);
  color: white;
}
.credit p a.button,
.credit a.button {
  padding: 6px 12px;
  margin-top: 10px;
  background: #000000;
  border-radius: 3px;
}
.credit p a.button:hover,
.credit a.button:hover {
  background: #2b2b2b;
}
.credit p:last-of-type {
  margin-bottom: 30px;
}
.stage {
  max-width: 635px;
  width: 100%;
  height: 400px;
  -webkit-transition: all 0.25s ease-in-out;
  -moz-transition: all 0.25s ease-in-out;
  -ms-transition: all 0.25s ease-in-out;
  -o-transition: all 0.25s ease-in-out;
  transition: all 0.25s ease-in-out;
}
.element {
  background: green;
  width: 202px;
  -webkit-transform-origin: 50% 50%;
  height: inherit;
  margin: 0 7px 0 0;
  display: inline-block;
  -webkit-transition: all 0.25s ease-in-out;
  -moz-transition: all 0.25s ease-in-out;
  -ms-transition: all 0.25s ease-in-out;
  -o-transition: all 0.25s ease-in-out;
  transition: all 0.25s ease-in-out;
  -webkit-transform: translate3d(0, 0, 0);
  -moz-transform: translate3d(0, 0, 0);
  -ms-transform: translate3d(0, 0, 0);
  -o-transform: translate3d(0, 0, 0);
  transform: translate3d(0, 0, 0);
}
.element.active {
  width: 282px;
  -webkit-transition: all 0.25s ease-in-out;
  -moz-transition: all 0.25s ease-in-out;
  -ms-transition: all 0.25s ease-in-out;
  -o-transition: all 0.25s ease-in-out;
  transition: all 0.25s ease-in-out;
}
.element.inactive {
  width: 162px;
  -webkit-transition: all 0.25s ease-in-out;
  -moz-transition: all 0.25s ease-in-out;
  -ms-transition: all 0.25s ease-in-out;
  -o-transition: all 0.25s ease-in-out;
  transition: all 0.25s ease-in-out;
  opacity: 0.4;
} 
.element.Fruitopia {
  background: url('./src/assets/img/Fruitopia.JPG') 45% 0 no-repeat;
  background-size: cover;
}
.element.RacingFanatics {
  background: url('./src/assets/img/Racing.jpg') 45% 0 no-repeat;
  background-size: cover;
}
.element.myBBTAN {
  background: url('./src/assets/img/BBTAN Bootleg.jpg') 45% 0 no-repeat;
  background-size: cover;
}
.element:last-of-type {
  margin: 0;
}
@media all and (min-width: 900px) {
  .pen {
    max-width: 890px;
  }
  .element {
    width: 286px;
  }
  .element.inactive {
    width: 246px;
  }
  .element.active {
    width: 366px;
  }
  .stage {
    max-width: 890px;
    height: 600px;
  }
}
@media all and (max-width: 660px) {
  .pen {
    max-width: 335px;
  }
  .element {
    width: 101px;
  }
  .element.inactive {
    width: 61px;
  }
  .element.active {
    width: 181px;
  }
  .stage {
    max-width: 335px;
  }
}
@-webkit-keyframes appear {
  15% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
@-moz-keyframes appear {
  15% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
@-o-keyframes appear {
  15% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}
@keyframes appear {
  15% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}</style>