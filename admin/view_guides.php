<?php include 'header.php'; ?>
<?php include '../db_connection.php'; ?>

<style>
    .personnel-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Smaller cards */
        gap: 25px;
        padding: 20px;
        max-width: 1200px; /* Reduced container width */
        /* margin: 0 auto; */
    }

    .personnel-card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06); /* Softer shadow */
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }


    /* Modified Card Header */
    .card-header {
        padding: 20px;
    }

    .id-photo {
        width: 100px; /* Smaller photo */
        height: 100px;
        border-width: 3px;
    }

    .personnel-name {
        font-size: 1.4em; /* Smaller name */
    }
    /* */

    .personnel-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
    }

    .personnel-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.12);
    }

    .card-header {
        background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
        padding: 30px 20px;
        text-align: center;
        position: relative;
    }

    .id-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid rgba(255,255,255,0.2);
        object-fit: cover;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .personnel-card:hover .id-photo {
        transform: scale(1.05);
    }

    .personnel-name {
        color: white;
        margin: 0;
        font-size: 1.6em;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-body {
        padding: 25px;
        background: #f9fafb;
    }

    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 18px;
        padding: 15px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .detail-item i {
        width: 35px;
        font-size: 1.2em;
        color: #3498db;
    }

    .status-chip {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    .male { background: #e3f2fd; color: #1976d2; }
    .female { background: #fce4ec; color: #d81b60; }
    .other { background: #f3e5f5; color: #8e24aa; }

    .registration-date {
        text-align: center;
        padding: 15px;
        background: white;
        margin: 20px -25px -25px;
        border-top: 1px solid rgba(0,0,0,0.05);
    }

    /* Content Header Styles */
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 30px 40px 0;
        max-width: 1500px;
        margin: 0 auto;
    }

    .content-header h2 {
        font-size: 2em;
        color: #2c3e50;
        margin: 0;
    }

    .search-box {
        padding: 12px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 30px;
        width: 300px;
        transition: all 0.3s ease;
    }

    .search-box:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.2);
    }
    
    /* Mobile First Approach */
    @media (max-width: 600px) {
        .personnel-grid {
            grid-template-columns: 1fr;
            padding: 10px;
            gap: 15px;
            margin:0 auto;
        }
        
        .content-header {
            flex-direction: column;
            padding: 20px 15px 0;
        }
        
        .search-box {
            width: 100%;
            margin-top: 15px;
        }
    }

    /* Desktop Adjustments */
    @media (min-width: 1024px) {
        .personnel-grid {
            grid-template-columns: repeat(3, 1fr); /* Force 3 columns */
            margin-left:100px;
        }
    }
</style>

<!-- Header with Search Input -->
<div class="content-header">
    <h2>🔍 Active Guides</h2>
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search by name..." class="search-box">
    </div>
</div>

<!-- Personnel Grid -->
<div class="personnel-grid">
    <?php
    $query = "SELECT 
                id,
                CONCAT(first_name, ' ', last_name) AS fullname,
                phone,
                role,
                gender,
                address,
                registration_date,
                id_image
              FROM hiring_requests 
              WHERE role = 'personnel'
              AND status = 'Approved' 
              ORDER BY registration_date DESC";
    
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $genderClass = strtolower($row['gender']);
    ?>
    <!-- Add data-name attribute for search functionality -->
    <div class="personnel-card" data-name="<?= htmlspecialchars(strtolower($row['fullname'])) ?>">
        <div class="card-header">
            <?php if(!empty($row['id_image'])): ?>
            <img src="./<?= htmlspecialchars($row['id_image']) ?>" 
                 alt="<?= htmlspecialchars($row['fullname']) ?>" 
                 class="id-photo">
            <?php else: ?>
            <div class="id-photo placeholder">
                <i class="fas fa-user-circle"></i>
            </div>
            <?php endif; ?>
            <h3 class="personnel-name"><?= htmlspecialchars($row['fullname']) ?></h3>
        </div>
        
        <div class="card-body">
            <div class="detail-item">
                <i class="fas fa-mobile-alt"></i>
                <div><?= htmlspecialchars($row['phone']) ?></div>
            </div>

            <div class="detail-item">
                <i class="fas fa-id-badge"></i>
                <div>Security <?= htmlspecialchars(ucfirst($row['role'])) ?></div>
            </div>

            <div class="detail-item">
                <i class="fas fa-venus-mars"></i>
                <span class="status-chip <?= $genderClass ?>">
                    <?= htmlspecialchars(ucfirst($row['gender'])) ?>
                </span>
            </div>

            <div class="detail-item">
                <i class="fas fa-map-marked-alt"></i>
                <div><?= htmlspecialchars($row['address']) ?></div>
            </div>

            <div class="registration-date">
                <i class="fas fa-calendar-check"></i>
                Registered: <?= date('F j, Y', strtotime($row['registration_date'])) ?>
            </div>
        </div>
    </div>
    <?php 
        }
    } else { 
    ?>
    <div class="empty-state">
        <i class="fas fa-users-slash"></i>
        <h2>No Security Personnel Found</h2>
        <p>Start by adding new security personnel through the admin panel.</p>
    </div>
    <?php } ?>
</div>

<script>
// Search functionality
const searchInput = document.getElementById('searchInput');
const personnelCards = document.querySelectorAll('.personnel-card');

searchInput.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    
    personnelCards.forEach(card => {
        const name = card.getAttribute('data-name');
        card.style.display = name.includes(searchTerm) ? 'block' : 'none';
    });
});
</script>

<?php include 'footer.php'; ?>