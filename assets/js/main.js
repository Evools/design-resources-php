document.addEventListener('DOMContentLoaded', function () {
  const searchButton = document.getElementById('searchButton');
  const searchModal = document.getElementById('searchModal');
  const modalInput = document.querySelector('.search-modal__input');
  const closeButton = document.querySelector('.search-modal__close');
  const overlay = document.querySelector('.search-modal__overlay');

  searchButton.addEventListener('click', openModal);

  document.addEventListener('keydown', function (e) {
    if (e.key === '/' && !searchModal.classList.contains('active')) {
      e.preventDefault();
      openModal();
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && searchModal.classList.contains('active')) {
      closeModal();
    }
  });

  closeButton.addEventListener('click', closeModal);

  overlay.addEventListener('click', closeModal);

  function openModal() {
    searchModal.classList.add('active');
    modalInput.focus();
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    searchModal.classList.remove('active');
    modalInput.value = '';
    document.body.style.overflow = '';
  }
});


//Modal Submit
document.addEventListener('DOMContentLoaded', function () {
  const submitBtn = document.querySelector('.btn[href="#"]');
  const submitModal = document.getElementById('submitModal');
  const closeButton = submitModal.querySelector('.submit-modal__close');
  const overlay = submitModal.querySelector('.submit-modal__overlay');
  const dropdown = submitModal.querySelector('.submit-modal__dropdown');
  const dropdownBtn = submitModal.querySelector('.submit-modal__dropdown-btn');
  const dropdownItems = submitModal.querySelectorAll('.submit-modal__dropdown-item');
  const dropdownBtnText = dropdownBtn.querySelector('span');

  submitBtn.addEventListener('click', function (e) {
    e.preventDefault();
    openModal();
  });

  closeButton.addEventListener('click', closeModal);
  overlay.addEventListener('click', closeModal);

  dropdownBtn.addEventListener('click', function () {
    dropdown.classList.toggle('active');
  });

  dropdownItems.forEach(item => {
    item.addEventListener('click', function (e) {
      e.preventDefault();
      dropdownBtnText.textContent = this.textContent;
      dropdown.classList.remove('active');
    });
  });

  document.addEventListener('click', function (e) {
    if (!dropdown.contains(e.target)) {
      dropdown.classList.remove('active');
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && submitModal.classList.contains('active')) {
      closeModal();
    }
  });

  function openModal() {
    submitModal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    submitModal.classList.remove('active');
    document.body.style.overflow = '';
    dropdown.classList.remove('active');
    dropdownBtnText.textContent = 'Resource type';
  }
});


//Active link navbar
document.addEventListener('DOMContentLoaded', function () {
  const navLinks = document.querySelectorAll('.nav__link');
  const currentPath = window.location.pathname;

  navLinks.forEach(link => {
    const href = link.getAttribute('href');

    if (href === '/') {
      if (currentPath === '/' || currentPath === '/index.php') {
        link.classList.add('active');
      }
    } else if (currentPath.includes(href)) {
      link.classList.add('active');
    }
  });
});