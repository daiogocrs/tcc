$("#mais").click(function () {
	var $this = $(this);
	$this.toggleClass('mais');
	if ($this.hasClass('mais')) {
		$this.text('mais');
	} else {
		$this.text('menos');
	}
});

$(window).scroll(function () {
	$(".slideanim").each(function () {
		var pos = $(this).offset().top;

		var winTop = $(window).scrollTop();
		if (pos < winTop + 600) {
			$(this).addClass("slide");
		}
	});
});

$(document).ready(function () {
	$(".navbar a, #service a").on('click', function (event) {

		if (this.hash !== "") {
			event.preventDefault();
			var hash = this.hash;

			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 900, function () {

				window.location.hash = hash;
			});
		}
	});

	$(window).scroll(function () {
		if ($(this).scrollTop() >= 300) {
			$('.to-top').fadeIn(200);
		} else {
			$('.to-top').fadeOut(200);
		}
	});
	$('.to-top').click(function () {
		$('.body,html').animate({
			scrollTop: 0
		}, 500);
	});

})