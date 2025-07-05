const navBar = document.querySelector('.navbar');
const navLinks = document.querySelectorAll(".nav-item a");

window.addEventListener('scroll', () => {
	if (window.scrollY >= 56) {
		navBar.classList.add('navbar-scrolled');
		navLinks.forEach(function (link) {
			link.style.color = "#01283C";
		});
	} else if (window.scrollY < 56) {
		navBar.classList.remove('navbar-scrolled');
		navLinks.forEach(function (link) {
			link.style.color = "#FFF";
		});
	}
});

let lastScrollTop = 0;

window.addEventListener('scroll', () => {
	let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

	if (currentScroll > lastScrollTop) {
		navBar.style.top = "-100px";
	} else {
		navBar.style.top = "0";
	}
	lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
});
