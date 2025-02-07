document.addEventListener('DOMContentLoaded', () => {
    // Billing toggle functionality
    const billingToggle = document.getElementById('billingToggle');
    const monthlyPrices = document.querySelectorAll('.monthly-price');
    const annualPrices = document.querySelectorAll('.annual-price');

    billingToggle.addEventListener('change', () => {
        const isAnnual = billingToggle.checked;
        monthlyPrices.forEach(price => price.style.display = isAnnual ? 'none' : 'inline');
        annualPrices.forEach(price => price.style.display = isAnnual ? 'inline' : 'none');
    });

    // Price card CTA button functionality
    const ctaButtons = document.querySelectorAll('.price-cta');
    ctaButtons.forEach(button => {
        button.addEventListener('click', () => {
            const plan = button.getAttribute('data-plan');
            const planRoutes = {
                'free': 'signup.html?plan=free',
                'pro': 'signup.html?plan=pro&trial=true',
                'enterprise': 'contact.html?interest=enterprise'
            };
            window.location.href = planRoutes[plan];
        });
    });

    // FAQ Accordion functionality
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        const answer = item.querySelector('.faq-answer');
        const icon = question.querySelector('i');

        question.addEventListener('click', () => {
            answer.classList.toggle('show');
            icon.classList.toggle('rotated');
        });
    });

    // Initial state for prices (default to monthly)
    annualPrices.forEach(price => {
        price.style.display = 'none';
    });
});