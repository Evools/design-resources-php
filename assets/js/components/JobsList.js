class JobsList {
  constructor() {
    this.page = 1;
    this.perPage = 10;
    this.jobs = [];
    this.loading = false;
    this.container = document.querySelector('.jobs__listings');
    this.setupEventListeners();
    this.init();
  }

  async init() {
    await this.loadJobs();
    this.render();
  }

  setupEventListeners() {
    // Подписка на email
    const subscribeForm = document.querySelector('.jobs__content-subscribe');
    const emailInput = subscribeForm.querySelector('input[type="email"]');
    const subscribeButton = subscribeForm.querySelector('button');

    subscribeButton.addEventListener('click', () => this.handleSubscribe(emailInput.value));

    // Бесконечная прокрутка
    window.addEventListener('scroll', () => {
      if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500 && !this.loading) {
        this.loadMore();
      }
    });
  }

  async loadJobs() {
    this.loading = true;
    try {
      const response = await fetch(`/api/jobs?page=${this.page}&per_page=${this.perPage}`);
      const data = await response.json();
      this.jobs = [...this.jobs, ...data.jobs];
      this.page++;
    } catch (error) {
      console.error('Error loading jobs:', error);
    } finally {
      this.loading = false;
    }
  }

  async loadMore() {
    await this.loadJobs();
    this.render();
  }

  async handleSubscribe(email) {
    if (!this.validateEmail(email)) {
      alert('Пожалуйста, введите корректный email');
      return;
    }

    try {
      const response = await fetch('/api/subscribe', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email })
      });

      const data = await response.json();
      if (data.success) {
        alert('Вы успешно подписались на рассылку!');
      } else {
        alert('Произошла ошибка при подписке');
      }
    } catch (error) {
      console.error('Error subscribing:', error);
      alert('Произошла ошибка при подписке');
    }
  }

  validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  formatDate(dateString) {
    const date = new Date(dateString);
    return new Intl.RelativeTimeFormat('ru').format(
      Math.ceil((date - new Date()) / (1000 * 60 * 60 * 24)),
      'day'
    );
  }

  render() {
    const jobsHtml = this.jobs.map(job => `
            <a href="/jobs/${job.id}" class="jobs__link">
                <div class="jobs__item">
                    <div class="jobs__item-company">
                        <div class="jobs__item-company-block">
                            <img src="${job.image}" alt="${job.company}">
                            <span class="company-name">${job.company}</span>
                        </div>
                        <div class="jobs__item-info">
                            <h3>${job.specialization}</h3>
                            <div class="jobs__item-details">
                                <span class="location">${job.country}</span>
                            </div>
                        </div>
                    </div>
                    <div class="jobs__item-date">${this.formatDate(job.created_at)}</div>
                </div>
            </a>
        `).join('');

    this.container.innerHTML = `
            <div class="jobs__header">
                <div class="jobs__header-left">
                    <span>Company</span>
                    <span>Position</span>
                </div>
                <span>Posted Date</span>
            </div>
            ${jobsHtml}
            ${this.loading ? '<div class="jobs__loading">Loading...</div>' : ''}
        `;
  }
}

// Инициализация компонента
document.addEventListener('DOMContentLoaded', () => {
  new JobsList();
});