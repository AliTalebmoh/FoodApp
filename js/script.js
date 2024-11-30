// Initialize DOM elements
let sidebar = document.querySelector(".sidebar");
let profile = document.querySelector(".header .flex .profile");
let navbar = document.querySelector(".sidebar .navbar");
let menuBtn = document.querySelector("#menu-btn");
let userBtn = document.querySelector("#user-btn");

// Menu button click handler
if (menuBtn) {
  menuBtn.onclick = () => {
    sidebar.classList.toggle("active");
    profile.classList.remove("active");
  };
}

// User button click handler
if (userBtn) {
  userBtn.onclick = () => {
    profile.classList.toggle("active");
    sidebar.classList.remove("active");
  };
}

// Window scroll handler
window.onscroll = () => {
  sidebar.classList.remove("active");
  profile.classList.remove("active");
};

// Loader functions
function loader() {
  document.querySelector(".loader").style.display = "none";
}

function fadeOut() {
  setInterval(loader, 2000);
}

window.onload = fadeOut;

// Number input handler
document.querySelectorAll('input[type="number"]').forEach((numberInput) => {
  numberInput.oninput = () => {
    if (numberInput.value.length > numberInput.maxLength) {
      numberInput.value = numberInput.value.slice(0, numberInput.maxLength);
    }
  };
});
