window.addEventListener('DOMContentLoaded', function(e) {
	/* Navbar background on scroll */
	const mainNav = document.querySelector(".main-nav");
	if(mainNav) {
		addNavBg(mainNav);
		window.addEventListener("scroll", function() {
			addNavBg(mainNav);
		});
	}

	/* Testimonial Sliders */
	$('.testimonial-slider').slick({
		dots: true,
		infinite: false,
		speed: 300,
		nav: false,
		slidesToShow: 2,
		slidesToScroll: 2,
		responsive: [
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 1,
			  slidesToScroll: 1
			}
		  }
		]
	});

	/* How it works active state switch */
	let workSteps = document.querySelectorAll(".how-step");
	let presStep = 0;
	let maxStep = workSteps.length - 1;
	if(workSteps) {
		setInterval(function() {
			workSteps[presStep].classList.remove("bg-step");
			presStep++;
			if(presStep > maxStep) {
				presStep = 0;
			}
			workSteps[presStep].classList.add("bg-step");
		}, 3000)
	}

	/* Video Modal */
	$("#video-modal").on("hidden.bs.modal", function () {
		$("#video-modal-body").html("");
	});

	$('#play-btn').on('click', function (e) {
		e.preventDefault();
		let videoUrl = $(this).attr('data-video');
		let embedVideoUrl = `${videoUrl}?controls=0&iv_load_policy=3&rel=0&showinfo=0&showsearch=0`;
		console.log(embedVideoUrl);
		$("#video-modal-body").html(`
			<iframe src="${embedVideoUrl}" frameborder="0" allowfullscreen></iframe>
		`);
		$("#video-modal").modal("show");
	});
});

function addNavBg(navElem) {
	let scrollAmnt = window.scrollY;

	if(scrollAmnt >= 100) {
		navElem.classList.add("btn-bg");
	} else {
		navElem.classList.remove("btn-bg");
	}
}