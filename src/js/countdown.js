(function () {
  const second = 1000,
    minute = second * 60,
    hour = minute * 60,
    day = hour * 24;


  let date = document.currentScript.getAttribute('date'),
    countDown = new Date(date).getTime(),
    x = setInterval(function () {

      let now = new Date().getTime(),
        distance = countDown - now;
        if (distance < 0){
          document.getElementById("our-countdown").style.display = 'none';
        }else{
          document.getElementById("days").innerText = Math.floor(distance / (day)),
          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);
  
        }
      

      //seconds
    }, 0)
}());