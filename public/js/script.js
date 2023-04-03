window.addEventListener('DOMContentLoaded', function (e) {
	new WOW().init();
	
	const mainNav = document.querySelector(".main-nav");
	if (mainNav) {
		addNavBg(mainNav);
		window.addEventListener("scroll", function () {
			addNavBg(mainNav);
		});
	}

	const navToggle = document.querySelector(".nav-toggle");

	navToggle.addEventListener("click", function () {
		const navWrapper = document.querySelector(".nav-wrapper");
		navToggle.classList.toggle("active");
		navWrapper.classList.toggle("open");
		mainNav.classList.toggle("nav-open");
	})

	const navDropdowns = document.querySelectorAll(".nav-dp");
	navDropdowns.forEach(function (navDp) {
		navDp.addEventListener("click", function (e) {
			e.preventDefault();
			const dpItems = navDp.nextElementSibling;
			if (navDp.classList.contains("dp-open")) {
				navDp.classList.remove("dp-open");
				dpItems.style.maxHeight = "0px";
			} else {
				navDp.classList.add("dp-open");
				dpItems.style.maxHeight = dpItems.scrollHeight + "px";
			}
		})
	})

	const featCards = document.querySelectorAll(".feat-card");

	if (featCards) {
		const initialBg = "#F3F4F5";
		const initialText = "#6C757D";
		const initialLink = "#04CE9D";

		featCards.forEach(function (featCard) {
			const featTitle = featCard.querySelector("h5");
			const featPara = featCard.querySelector("p");
			const featLink = featCard.querySelector("a");
			const bgHover = featCard.getAttribute("data-hover-bg");
			const textHover = featCard.getAttribute("data-hover-text");

			featCard.addEventListener("mouseenter", function () {
				featCard.style.background = bgHover;
				featTitle.style.color = textHover;
				featPara.style.color = textHover;
				featLink.style.color = textHover;
			});

			featCard.addEventListener("mouseleave", function () {
				featCard.style.background = initialBg;
				featTitle.style.color = initialText;
				featPara.style.color = initialText;
				featLink.style.color = initialLink;
			})
		});
	}

	// Video popup

	const popupVideoBtns = document.querySelectorAll(".yt-embed .play-btn");

	if(popupVideoBtns) {
		const videoModal = document.getElementById("play-video-body");
		popupVideoBtns.forEach(function(popupVideoBtn) {
			popupVideoBtn.addEventListener("click", function(e) {
				e.preventDefault();
				console.log("Got here");
				const videoLink = popupVideoBtn.getAttribute("data-video");
				const embedUrl = `${videoLink}?controls=0&iv_load_policy=3&rel=0&showinfo=0&showsearch=0`;
				videoModal.innerHTML = `
					<iframe class="as-background" src="${embedUrl}" frameborder="0" allowfullscreen></iframe> 
				`
				$("#myModal").modal("show");
			});
		});

		$("#myModal").on("hidden.bs.modal", function () {
			videoModal.innerHTML = "";
		});
	}

	// End video popup

	$('.about-slides').slick({
		dots: false,
		arrows: false,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
		fade: true,
		autoplay: false,
	});

	$(".about-slider .ctrl-next").click(function () {
		$(".about-slides").slick("slickNext");
	})

	$(".about-slider .ctrl-prev").click(function () {
		$(".about-slides").slick("slickPrev");
	})

	$('.stories-slider').slick({
		dots: false,
		arrows: false,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
	});
});

function addNavBg(navElem) {
	let scrollAmnt = window.scrollY;

	if (scrollAmnt >= 100) {
		navElem.classList.add("nav-bg");
	} else {
		navElem.classList.remove("nav-bg");
	}
}


// cookie policy code
const cookieStorage = {
	getItem: (key) => {
		const cookies = document.cookie
			.split(';')
			.map(cookie => cookie.split('='))
			.reduce((acc, [key, value]) => ({ ...acc, [key.trim()]: value }), {});
		return cookies[key];
	},
	setItem: (key, value) => {
		document.cookie = `${key}=${value};`
	}
};


const storageType = cookieStorage;
const storageTypeSession = sessionStorage;
const consentPropetyName = 'kyshi_consent';

const shouldShowPopup = () => !storageType.getItem(consentPropetyName);
const saveToStorage = () => storageType.setItem(consentPropetyName, true)
const saveToSessionStorage =() => storageTypeSession.setItem(consentPropetyName, true)

window.onload = () => {
	const consentPopUp = document.getElementById('cookie-consent-popup')
	const acceptBtn = document.getElementById('acceptCookies')
	const rejectBtn = document.getElementById('rejectCookies')

	const acceptFunc = event => {
		saveToStorage(storageType)
		consentPopUp.classList.add('hidden-consent');
	};

	const  rejectFunc = event => {
		saveToSessionStorage(storageTypeSession)
		consentPopUp.classList.add('hidden-consent');
	};

	acceptBtn.addEventListener('click', acceptFunc);
	rejectBtn.addEventListener('click', rejectFunc)

	if (shouldShowPopup()) {
		setTimeout(() => {
			consentPopUp.classList.remove('hidden-consent');
		}, 2000);
	}
}