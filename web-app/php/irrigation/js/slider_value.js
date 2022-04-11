var minute_slider = document.getElementById("minutes");
var minute_output = document.getElementById("minutes_value");
minute_output.innerHTML = minute_slider.value;
minute_slider.oninput = function() {
  minute_output.innerHTML = this.value;
}

var second_slider = document.getElementById("seconds");
var second_output = document.getElementById("seconds_value");
second_output.innerHTML = second_slider.value;
second_slider.oninput = function() {
  second_output.innerHTML = this.value;
}

