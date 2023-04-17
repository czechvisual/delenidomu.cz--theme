/* eslint-disable max-len, no-param-reassign, no-unused-vars */
/**
 * Scripts
 * @Author: Patrik Vaďura
 * @package acdfevelop
 */

// Mobile menu
function openMenu() {
  const element = document.getElementById("header");
  element.classList.add("menu-opened");
}

function closeMenu() {
  const element = document.getElementById("header");
  element.classList.remove("menu-opened");
}

// Sticky nav
function stickyNav() {
  const header = document.querySelector('.site-header');

  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 0) {
    header.classList.add('is-fixed');
  } else {
    header.classList.remove('is-fixed');
  }
}

window.addEventListener('scroll', stickyNav);
window.addEventListener('DOMContentLoaded', stickyNav);

// Back to top
function backTop() {
  const button = document.getElementById("go-top");

  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    button.classList.add('is-visible');
  } else {
    button.classList.remove('is-visible');
  }
}

function goTop() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

window.addEventListener('scroll', backTop);
window.addEventListener('DOMContentLoaded', backTop);
