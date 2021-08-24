import owlCarousel from 'owl.carousel';
(function() {
  const home = document.getElementById('home-slider');

  if (home) {
    $('#home-slider').owlCarousel({
      nav: false,
      dots: true,
      items: 1,
    });
    console.log(home);
  }
})();
