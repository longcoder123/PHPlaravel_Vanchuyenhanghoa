const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i => {
			i.parentElement.classList.remove('active');
		});
		li.classList.add('active');
	});
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
});

// SEARCH FORM
const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if (window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if (searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
});

// PAGE LOAD STATUS
function applyPageLoadSettings() {
	if (window.innerWidth < 768) {
		sidebar.classList.add('hide');
	} else if (window.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
}

window.addEventListener('resize', function () {
	applyPageLoadSettings();
});

// SWITCH MODE
const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if (this.checked) {
		document.body.classList.add('dark');
		localStorage.setItem('mode', 'dark'); // Lưu trạng thái
	} else {
		document.body.classList.remove('dark');
		localStorage.setItem('mode', 'light'); // Lưu trạng thái
	}
});

// LOAD MODE ON PAGE LOAD
window.onload = function () {
	const mode = localStorage.getItem('mode');
	if (mode === 'dark') {
		document.body.classList.add('dark');
		switchMode.checked = true; // Thiết lập checkbox nếu chế độ tối được lưu
	}
	applyPageLoadSettings(); // Đặt các thiết lập ban đầu
};
