'use strict';

/* ===== Enable Bootstrap Popover (on element) ====== */
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
if (popoverTriggerList.length > 0) {
	const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
}

/* ==== Enable Bootstrap Alert ====== */
const alertList = document.querySelectorAll('.alert');
if (alertList.length > 0) {
	const alerts = [...alertList].map(element => new bootstrap.Alert(element));
}

/* ===== Responsive Sidepanel ====== */
const sidePanelToggler = document.getElementById('sidepanel-toggler');
const sidePanel = document.getElementById('app-sidepanel');
const sidePanelDrop = document.getElementById('sidepanel-drop');
const sidePanelClose = document.getElementById('sidepanel-close');

// Asegurarte de que `sidePanel` exista antes de llamar a la función
window.addEventListener('load', function () {
	if (sidePanel) {
		responsiveSidePanel();
	}
});

window.addEventListener('resize', function () {
	if (sidePanel) {
		responsiveSidePanel();
	}
});

function responsiveSidePanel() {
	let w = window.innerWidth;
	if (sidePanel) {
		if (w >= 1200) {
			// Si es mayor o igual a 1200px
			sidePanel.classList.remove('sidepanel-hidden');
			sidePanel.classList.add('sidepanel-visible');
		} else {
			// Si es menor a 1200px
			sidePanel.classList.remove('sidepanel-visible');
			sidePanel.classList.add('sidepanel-hidden');
		}
	}
}

// Verificar si `sidePanelToggler` y `sidePanel` existen antes de agregar el eventListener
if (sidePanelToggler && sidePanel) {
	sidePanelToggler.addEventListener('click', () => {
		if (sidePanel.classList.contains('sidepanel-visible')) {
			sidePanel.classList.remove('sidepanel-visible');
			sidePanel.classList.add('sidepanel-hidden');
		} else {
			sidePanel.classList.remove('sidepanel-hidden');
			sidePanel.classList.add('sidepanel-visible');
		}
	});
}

// Verificar si `sidePanelClose` y `sidePanelToggler` existen antes de agregar el eventListener
if (sidePanelClose && sidePanelToggler) {
	sidePanelClose.addEventListener('click', (e) => {
		e.preventDefault();
		sidePanelToggler.click();
	});
}

// Verificar si `sidePanelDrop` y `sidePanelToggler` existen antes de agregar el eventListener
if (sidePanelDrop && sidePanelToggler) {
	sidePanelDrop.addEventListener('click', (e) => {
		sidePanelToggler.click();
	});
}

/* ====== Mobile search ======= */
const searchMobileTrigger = document.querySelector('.search-mobile-trigger');
const searchBox = document.querySelector('.app-search-box');

// Verificar si `searchMobileTrigger` existe antes de agregar el eventListener
if (searchMobileTrigger && searchBox) {
	searchMobileTrigger.addEventListener('click', () => {
		searchBox.classList.toggle('is-visible');

		let searchMobileTriggerIcon = document.querySelector('.search-mobile-trigger-icon');
		if (searchMobileTriggerIcon) {
			if (searchMobileTriggerIcon.classList.contains('fa-magnifying-glass')) {
				searchMobileTriggerIcon.classList.remove('fa-magnifying-glass');
				searchMobileTriggerIcon.classList.add('fa-xmark');
			} else {
				searchMobileTriggerIcon.classList.remove('fa-xmark');
				searchMobileTriggerIcon.classList.add('fa-magnifying-glass');
			}
		}
	});
}
