   // Scroll animation for content sections
   const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

document.querySelectorAll('.content-section').forEach(section => {
    observer.observe(section);
});

// Smooth scroll for navigation
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const section = document.querySelector(this.getAttribute('href'));
        section.scrollIntoView({ behavior: 'smooth' });
    });
});

// Mobile Menu JavaScript
document.addEventListener('DOMContentLoaded', () => {
const mobileMenuIcon = document.querySelector('.mobile-menu-icon');
const navUl = document.querySelector('nav ul');
const header = document.querySelector('header');

mobileMenuIcon.addEventListener('click', (e) => {
e.stopPropagation();
navUl.classList.toggle('active');
});

document.addEventListener('click', (e) => {
if (!header.contains(e.target)) {
    navUl.classList.remove('active');
}
});

// Close menu when clicking links
document.querySelectorAll('nav a').forEach(link => {
link.addEventListener('click', () => {
    navUl.classList.remove('active');
});
});
});