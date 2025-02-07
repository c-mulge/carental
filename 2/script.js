// // Navigation Toggle
// const navToggle = document.getElementById('navToggle');
// const navMenu = document.getElementById('navMenu');

// navToggle.addEventListener('click', () => {
//   navMenu.classList.toggle('active');
//   navToggle.classList.toggle('active');
// });

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      window.scrollTo({
        top: target.offsetTop - 80,
        behavior: 'smooth'
      });
    }
  });
});

// Intersection Observer for Animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate-in');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Observe elements
document.querySelectorAll('.feature-card, .testimonial-card, .price-card').forEach(el => {
  observer.observe(el);
});

// Add scroll-based header transparency
window.addEventListener('scroll', () => {
  const header = document.querySelector('.header');
  if (window.scrollY > 50) {
    header.classList.add('scrolled');
  } else {
    header.classList.remove('scrolled');
  }
});

// // Testimonial Slider (Simple Version)
// const testimonials = [
//   {
//     content: "BudgetFlow helped me save for my dream house in just 18 months. The AI insights were game-changing!",
//     author: "Sarah M.",
//     role: "Product Designer"
//   },
//   {
//     content: "The best budgeting app I've ever used. Simple yet powerful!",
//     author: "John D.",
//     role: "Entrepreneur"
//   },
//   {
//     content: "Finally got my finances under control. Thank you BudgetFlow!",
//     author: "Michael R.",
//     role: "Software Engineer"
//   }
// ];

// let currentTestimonial = 0;
// const testimonialSlider = document.getElementById('testimonialSlider');

// function updateTestimonial() {
//   const testimonial = testimonials[currentTestimonial];
//   testimonialSlider.innerHTML = `
//     <div class="testimonial-card">
//       <div class="testimonial-content">
//         <p>${testimonial.content}</p>
//         <div class="testimonial-author">
//           <img src="/api/placeholder/50/50" alt="${testimonial.author}" class="author-image">
//           <div class="author-info">
//             <h4>${testimonial.author}</h4>
//             <span>${testimonial.role}</span>
//           </div>
//         </div>
//       </div>
//     </div>
//   `;
  
//   currentTestimonial = (currentTestimonial + 1) % testimonials.length;
// }




// updateTestimonial();
// setInterval(updateTestimonial, 5000);

// Hamburger Menu functionality
document.addEventListener('DOMContentLoaded', () => {
  const navToggle = document.getElementById('navToggle');
  const navMenu = document.getElementById('navMenu');
  
  navToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    
    // Animate hamburger icon
    const spans = navToggle.querySelectorAll('span');
    spans.forEach(span => span.classList.toggle('active'));
  });

  // Close menu when clicking outside
  document.addEventListener('click', (e) => {
    if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
      navMenu.classList.remove('active');
      const spans = navToggle.querySelectorAll('span');
      spans.forEach(span => span.classList.remove('active'));
    }
  });
});

// Testimonial Slider functionality
class TestimonialSlider {
  constructor() {
    this.slider = document.getElementById('testimonialSlider');
    this.currentSlide = 0;
    this.slides = [
      {
        content: "BudgetFlow helped me save for my dream house in just 18 months. The AI insights were game-changing!",
        author: "Sarah M.",
        role: "Product Designer",
        image: "/api/placeholder/50/50"
      },
      {
        content: "The real-time tracking feature has completely changed how I manage my expenses. Highly recommended!",
        author: "James K.",
        role: "Entrepreneur",
        image: "/api/placeholder/50/50"
      },
      {
        content: "Finally, a budgeting app that makes financial planning simple and actually enjoyable to use.",
        author: "Maria R.",
        role: "Software Engineer",
        image: "/api/placeholder/50/50"
      }
    ];
    
    this.init();
  }

  createSlide(slideData) {
    return `
      <div class="testimonial-card">
        <div class="testimonial-content">
          <p>${slideData.content}</p>
          <div class="testimonial-author">
            <img src="${slideData.image}" alt="${slideData.author}" class="author-image">
            <div class="author-info">
              <h4>${slideData.author}</h4>
              <span>${slideData.role}</span>
            </div>
          </div>
        </div>
      </div>
    `;
  }

  init() {
    // Create navigation dots
    const dotsContainer = document.createElement('div');
    dotsContainer.className = 'slider-dots';
    this.slides.forEach((_, index) => {
      const dot = document.createElement('button');
      dot.className = `slider-dot ${index === 0 ? 'active' : ''}`;
      dot.addEventListener('click', () => this.goToSlide(index));
      dotsContainer.appendChild(dot);
    });
    this.slider.parentNode.appendChild(dotsContainer);

    // Set initial slide
    this.updateSlider();

    // Auto-advance slides
    setInterval(() => this.nextSlide(), 5000);
  }

  updateSlider() {
    this.slider.innerHTML = this.createSlide(this.slides[this.currentSlide]);
    
    // Update dots
    const dots = document.querySelectorAll('.slider-dot');
    dots.forEach((dot, index) => {
      dot.classList.toggle('active', index === this.currentSlide);
    });
  }

  nextSlide() {
    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
    this.updateSlider();
  }

  goToSlide(index) {
    this.currentSlide = index;
    this.updateSlider();
  }
}

// Initialize testimonial slider
document.addEventListener('DOMContentLoaded', () => {
  new TestimonialSlider();
});