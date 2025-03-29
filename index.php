
<?php
include ('head.php')
?>
<style>
    .hero {
        background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
    url('./assents/securityimage.png') center/cover;
   
    /* https://images.unsplash.com/photo-1582738411706-bfc8e691d1c2?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80 */
    height: 100%;
    width: 100%;
      display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
}
    .hero-content {
        margin-top:150px;
    max-width: 800px;
    padding: 20px;
}

.hero h1 {
    font-size: 3.5em;
    margin-bottom: 20px;
    text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.5);
}

.hero p {
    font-size: 1.2em;
    margin-bottom: 30px;
    line-height: 1.6;
}

.cta-button {
    padding: 15px 40px;
    font-size: 1.1em;
    background: #e74c3c;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.cta-button:hover {
    background: #c0392b;
}

.content-section {
    padding: 100px 20px;
    background: white;
    /* opacity: 0; */
    transform: translateY(50px);
    transition: all 0.8s;
}

.content-section.visible {
    opacity: 1;
    transform: translateY(0);
}

.services-grid {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
}

.service-card {
    background: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    border-left: 4px solid #e74c3c;
}

.service-card i {
    font-size: 2.5em;
    color: #e74c3c;
    margin-bottom: 20px;
}

.service-card h3 {
    color: #2c3e50;
    margin-bottom: 15px;
}

@media (max-width: 768px) {
    .hero{
        /* height: 70vh; */
    }
    .hero h1 {
        font-size: 2.5em;
    }
}
.stats-grid {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
gap: 30px;
margin: 40px 0;
text-align: center;
}

.stat-item {
background: white;
padding: 25px;
border-radius: 5px;
box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.stat-item h3 {
color: #e74c3c;
font-size: 2.5em;
margin-bottom: 10px;
}

.clients-grid {
display: flex;
justify-content: center;
flex-wrap: wrap;
gap: 40px;
padding: 50px 0;
filter: grayscale(0);
opacity: 0.7;
transition: all 0.3s;
}

.clients-grid:hover {
opacity: 1;
filter: grayscale(100%);
}
.clients_logo{
    width: 60px;
    height: auto;
    border-radius: 50%;
}

.benefits-grid {
display: grid;
grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
gap: 30px;
margin-top: 50px;
}

.benefit-card {
text-align: center;
padding: 30px;
background: white;
border-radius: 5px;
}

.benefit-card i {
font-size: 2em;
color: #e74c3c;
margin-bottom: 15px;
}

@media (max-width: 768px) {
.clients-grid {
    gap: 20px;
}

.stats-grid {
    grid-template-columns: 1fr;
}
}
</style>
        <section class="hero">
        <div class="hero-content">
            <h1>Professional Security Solutions</h1>
            <p>24/7 physical security services protecting your assets, personnel, and premises with trained professionals and advanced technology</p>
            <button class="cta-button">Get Started</button>
        </div>
        </section>

    <section class="content-section" id="services">
        <div class="services-grid">
            <div class="service-card">
                <i class="fas fa-shield-alt"></i>
                <h3>Executive Protection</h3>
                <p>Highly trained personnel for personal and corporate security details</p>
            </div>
            <div class="service-card">
                <i class="fas fa-truck-moving"></i>
                <h3>Cash Logistics</h3>
                <p>Secure transportation and handling of valuable assets</p>
            </div>
            <div class="service-card">
                <i class="fas fa-building"></i>
                <h3>Facility Security</h3>
                <p>Comprehensive premises protection and access control</p>
            </div>
            <div class="service-card">
                <i class="fas fa-calendar-alt"></i>
                <h3>Event Security</h3>
                <p>Crowd management and VIP protection for special events</p>
            </div>
        </div>
    </section>

    <section class="content-section" id="why-us" style="background:rgb(255, 255, 255);">
    <div class="content-grid">
        <h2 style="text-align: center; grid-column: 1/-1; margin-bottom: 40px; color: #2c3e50;">
            Trusted Security Partner
        </h2>
        
        <!-- Key Stats -->
        <div class="stats-grid">
            <div class="stat-item">
                <h3>25+</h3>
                <p>Years Experience</p>
            </div>
            <div class="stat-item">
                <h3>10,000+</h3>
                <p>Security Professionals</p>
            </div>
            <div class="stat-item">
                <h3>24/7</h3>
                <p>Response Team</p>
            </div>
        </div>

        <!-- Client Logos -->
        <div class="clients-grid">
            <img src="./assents/musir logo.jpg" alt="Client logo" class="clients_logo">
            <img src="./assents/hcard.jpg" alt="Client logo" class="clients_logo">
            <img src="./assents/sgs.jpg" alt="Client logo" class="clients_logo">
            <img src="./assents/r.png" alt="Client logo" class="clients_logo">
        </div>

        <!-- Key Differentiators -->
        <div class="benefits-grid">
            <div class="benefit-card">
                <i class="fas fa-certificate"></i>
                <h4>Certified Personnel</h4>
                <p>All security staff undergo rigorous training and background checks</p>
            </div>
            <div class="benefit-card">
                <i class="fas fa-clock"></i>
                <h4>Rapid Deployment</h4>
                <p>Emergency response teams available within 60 minutes</p>
            </div>
            <div class="benefit-card">
                <i class="fas fa-shield-alt"></i>
                <h4>Full Compliance</h4>
                <p>Meeting all industry regulations and safety standards</p>
            </div>
        </div>
    </div>
</section>

<?php
include ('foot.php')
?>