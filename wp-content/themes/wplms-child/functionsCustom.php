<script>
    window.addEventListener("scroll", function() {
  var element = document.querySelector(".foy-sticky-section");
  var rect = element.getBoundingClientRect();
  var windowHeight = window.innerHeight;
  
  if (rect.top < 0) {
    element.style.position = "fixed";
    element.style.bottom = "0";
  } else {
    element.style.position = "absolute";
    element.style.top = /* put the initial position value here */;
  }
});
</script>