jQuery(document).ready(function($) {
    var SwiperSliderOne = new Swiper('.photography-swiper--slider', {
        loop: true,
        parallax: true,
        autoplay: {
            delay: 5000,
        },
        effect: 'fade',
        autoHeight: true,
        speed: 2500,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
            clickable: true,
        },
    });

    ///News Marquee
	const marquee = document.querySelectorAll(".marquee_text2");
	if (marquee) {
		$(".marquee_text2").marquee({
			direction: "left",
			duration: 70000,
			gap: 50,
			delayBeforeStart: 0,
			duplicated: true,
			startVisible: true,
		});
	}

    $(".navbar-toggler").click(function(){
        $(".navbar-nav").toggle();
      });

  });



  const navbarMenu = document.getElementById("menu");
  const burgerMenu = document.getElementById("burger");
  
  // Open Close Navbar Menu on Click Burger
  if (burgerMenu && navbarMenu) {
     burgerMenu.addEventListener("click", () => {
        burgerMenu.classList.toggle("is-active");
        navbarMenu.classList.toggle("is-active");
     });
  }
  
  // Close Navbar Menu on Click Menu Links
  document.querySelectorAll(".menu-link").forEach((link) => {
     link.addEventListener("click", () => {
        burgerMenu.classList.remove("is-active");
        navbarMenu.classList.remove("is-active");
     });
  });