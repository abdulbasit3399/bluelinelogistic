document.addEventListener('DOMContentLoaded', function () {
  disableLoading();
});

const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
const links = document.querySelectorAll('.nav-links');

hamburger.addEventListener('click', () => {
  //Animate Links
  navLinks.classList.toggle('open');
  links.forEach(link => {
    link.classList.toggle('fade');
  });

  //Hamburger Animation
  hamburger.classList.toggle('toggle');
});

let loading = true;

let successModal = document.getElementById('successModal');
let successFormModal = document.getElementById('successFormModal');
let getStartedModal = document.getElementById('getStartedModal');

let currentObject;

function openGetStartedModal() {
  getStartedModal.style.display = 'block';
  getStartedModal.classList.add('white-bg');
  currentObject = getStartedModal;

  navLinks.classList.remove('open');

  links.forEach(link => {
    link.classList.remove('fade');
  });

  //Hamburger Animation
  hamburger.classList.remove('toggle');
}

function closeGetStartedModal() {
  getStartedModal.style.display = 'none';
}

function openSuccessModal() {
  successModal.style.display = 'block';
  //successModal.classList.add("white-bg");
  //currentObject = successModal;
}

function closeSuccessModal() {
  successModal.style.display = 'none';
}

function openSuccessFormModal() {
  successFormModal.style.display = 'block';
  //successFormModal.classList.add("white-bg");
  //currentObject = successFormModal;
}

function closeSuccessFormModal() {
  successFormModal.style.display = 'none';
}

function disableLoading() {
  let loadingElm = document.getElementById('loading');
  if (loadingElm) {
    loadingElm.style.display = 'none';
  }
}

window.onclick = e => {
  if (e.target == successModal || e.target == successFormModal || e.target == getStartedModal) {
    if (currentObject) {
      currentObject.style.display = 'none';
    }
  }
};
