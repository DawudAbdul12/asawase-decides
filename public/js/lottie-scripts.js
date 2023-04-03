let animation1 = lottie.loadAnimation({
    container: document.getElementById("lottie-1"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/1/data.json'
});

let animation2 = lottie.loadAnimation({
    container: document.getElementById("lottie-2"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/2/data.json'
});

let animation3 = lottie.loadAnimation({
    container: document.getElementById("lottie-3"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/express-lane/data.json'
});

let animation4 = lottie.loadAnimation({
    container: document.getElementById("lottie-4"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/4/data.json'
});

let animation5 = lottie.loadAnimation({
    container: document.getElementById("lottie-5"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/5/data.json'
});

let animation6 = lottie.loadAnimation({
    container: document.getElementById("lottie-6"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/6/data.json'
});

let animation7 = lottie.loadAnimation({
    container: document.getElementById("about-lottie"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/about/data.json'
});

let animation8 = lottie.loadAnimation({
    container: document.getElementById("lottie-8"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/send-receive/data.json'
});

let animation9 = lottie.loadAnimation({
    container: document.getElementById("lottie-9"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/request-money/data.json'
});

let animation10 = lottie.loadAnimation({
    container: document.getElementById("lottie-10"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/reward-deals/data.json'
});

let animation11 = lottie.loadAnimation({
    container: document.getElementById("lottie-11"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/kyshi-cards/data.json'
});

let animation12 = lottie.loadAnimation({
    container: document.getElementById("lottie-12"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/rewards/data.json'
});
let animation13 = lottie.loadAnimation({
    container: document.getElementById("lottie-13"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/flags/flags.json'
});
let animation14 = lottie.loadAnimation({
    container: document.getElementById("lottie-14"),
    renderer: "svg",
    loop: true,
    autoplay: false,
    path: '/js/kyshi-connect/lottie.json'
});

/* Play animation when in view */
const anims = {
    'lottie-1': animation1,
    'lottie-2': animation2,
    'lottie-3': animation3,
    'lottie-4': animation4,
    'lottie-5': animation5,
    'lottie-6': animation6,
    'about-lottie': animation7,
    'lottie-8': animation8,
    'lottie-9': animation9,
    'lottie-10': animation10,
    'lottie-11': animation11,
    'lottie-12': animation12,
    'lottie-13': animation13,
    'lottie-14': animation14,
}

const animEls = document.querySelectorAll(".has-lottie");

if (animEls) {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting === true) {
                const entryId = entry.target.id;
                anims[entryId].play()
            }
        })
    }, {
        threshold: [0.8]
    });

    animEls.forEach((animEl) => {
        observer.observe(animEl);
    })
}
