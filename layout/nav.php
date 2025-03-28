<header class="header container">
    <div class="navbar">
        <a href="/" class="logo">
            <img src="/assets/img/logo.svg" alt="logo">
        </a>
        <nav class="nav">
            <a class="nav__link" href="/">Resources</a>
            <a class="nav__link" href="/jobs">Jobs</a>
            <a class="nav__link" href="/inspiration">Inspiration</a>
        </nav>
    </div>
    <div class="action-block">
        <button class="search" id="searchButton">
            <span class="search__text">Search resources</span>
            <span class="search__icon">/</span>
        </button>
        <a class="nav__link" href="/sponsor">Sponsor</a>
        <a class="btn" href="#">Submit →</a>
    </div>
</header>

<div class="search-modal" id="searchModal">
    <div class="search-modal__overlay"></div>
    <div class="search-modal__content">
        <div class="search-modal__header">
            <div class="search-modal__input-wrapper">
                <svg class="search-modal__icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <input type="text" class="search-modal__input" placeholder="Search for a resource or category" autofocus>
            </div>
            <button class="search-modal__close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="search-modal__results">
            <h3 class="search-modal__title">Resources</h3>
            <div class="search-modal__items">
                <a href="#" class="search-modal__item">
                    <img src="/assets/img/resourse/figma.png" alt="Figma" class="search-modal__item-icon">
                    <div class="search-modal__item-info">
                        <h4>Figma</h4>
                        <p>Design and collaborate all in the browse...</p>
                    </div>
                    <span class="search-modal__item-tag">Design Tools</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="submit-modal" id="submitModal">
    <div class="submit-modal__overlay"></div>
    <div class="submit-modal__content">
        <div class="submit-modal__header">
            <h2>Submit a resource</h2>
            <p>Submit a resource for other designers. If we like it too, we'll feature it.</p>
            <button class="submit-modal__close">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="submit-modal__form">
            <div class="submit-modal__field">
                <div class="submit-modal__input-wrapper">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                        <path d="M10 13C11.6569 13 13 11.6569 13 10C13 8.34315 11.6569 7 10 7C8.34315 7 7 8.34315 7 10C7 11.6569 8.34315 13 10 13Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M21 17L17.5 13.5M13.5 17.5L17 14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input type="text" placeholder="Resource link" class="submit-modal__input">
                </div>
            </div>

            <div class="submit-modal__field">
                <div class="submit-modal__dropdown">
                    <button class="submit-modal__dropdown-btn">
                        <span>Resource type</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <div class="submit-modal__dropdown-content">
                        <div class="submit-modal__dropdown-item">Accessibility</div>
                        <div class="submit-modal__dropdown-item">Books</div>
                        <div class="submit-modal__dropdown-item">Color</div>
                        <div class="submit-modal__dropdown-item">Design News</div>
                        <div class="submit-modal__dropdown-item">Design Systems</div>
                        <div class="submit-modal__dropdown-item">Design Tools</div>
                        <div class="submit-modal__dropdown-item">Icons</div>
                        <div class="submit-modal__dropdown-item">Illustrations</div>
                        <div class="submit-modal__dropdown-item">Inspiration</div>
                        <div class="submit-modal__dropdown-item">Jobs</div>
                        <div class="submit-modal__dropdown-item">Learn Design</div>
                    </div>
                </div>
            </div>

            <button class="btn btn--primary submit-modal__submit">Submit resource</button>
        </div>
    </div>
</div>