<?php include 'assets/php/check-access.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Owner Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="assets/img/WYicon.png" rel="icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
	<style>
		/* Add the following styles for the logout button */
        .logout-button {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #4F8E35;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-button:hover {
            background-color: #3d6b2a;
        }

        .user-modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }
        
        .user-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            height: 50%;
            overflow: auto;
        }
        
        .close,
        .close-client-modal,
        .close-details-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        
        .close:hover,
        .close-client-modal:hover,
        .close-details-modal:hover,
        .close:focus,
        .close-client-modal:focus,
        .close-details-modal:focus{
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
        /* Leads table styles */
        .leads-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .leads-table th, .leads-table td {
            padding: 10px;
            text-align: left;
        }

        .leads-table th {
            color: black;
        }

        .leads-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .leads-table .clickable {
            cursor: pointer;
            color: #4F8E35;
            text-decoration: underline;
        }

        /* Photo gallery styles for equipment and insurance photos */
        .photo-gallery {
            flex-direction: column; /* Stack children vertically */
            align-items: center; /* Center-align items */
        }

        .photo-gallery .image-container {
            display: flex;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .photo-gallery img {
            max-width: 50px; /* Adjust based on your needs */
            margin-right: 5px;
            border-radius: 5px;
        }

        .clickable-image {
            width: 25%;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .clickable-image:hover {
            transform: scale(1.05);
        }
        
        .nav-collapse {
            display: none;
            padding-left: 20px;
        }
        .nav-collapse ul {
            list-style: none;
            padding: 0;
        }
        .nav-collapse li a {
            display: block;
            color: white;
            padding: 8px;
            text-decoration: none;
        }
        .nav-collapse li a:hover {
            background-color: #555;
        }
	</style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="assets/img/WorkYarder-wlogo.png" alt="Small Logo" width="80%">
            </div>
            <ul class="nav">
                <li><a href="owner.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <!-- Collapsible Users Menu -->
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" onclick="toggleUsers()"><i class="fas fa-user-tie"></i> Users</a>
                    <div class="nav-collapse" id="usersMenu">
                        <ul>
                            <li><a href="user-request.php">User Request</a></li>
                            <li><a href="clients.php">Clients</a></li>
                            <li><a href="lawn-providers.php">Lawn Providers</a></li>
                            <li><a href="pool-providers.php">Pool Providers</a></li>
                            <li><a href="pressure-washing-providers.php">Pressure Washing Providers</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Collapsible Bookings Menu -->
                <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" onclick="toggleBookings()"><i class="fas fa-calendar-alt"></i> Bookings</a>
                    <div class="nav-collapse" id="bookingsMenu">
                        <ul>
                            <li><a href="upcoming-bookings.php">Upcoming Bookings</a></li>
                            <li><a href="active-bookings.php">Active Bookings</a></li>
                            <li><a href="all-bookings.php">All Bookings</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="all-issues.php"><i class="fa fa-wrench"></i> Damages & Issues</a></li>
            </ul>
			<a href="assets/php/logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="content">
            <header>
                <h1>Owner Dashboard</h1>
            </header>
            <div class="main-content">
                <div class="jotform-section"> 
                    <h2>Active Providers</h2>
                    <!-- Add a table or list of leads with sample data -->
                    <table class="leads-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>City, State</th>
                                <th>Provider Type</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'assets/php/populate-pw.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- New User Details Modal -->
    <div id="user-details-modal" class="user-modal">
        <div class="user-content">
            <span class="close-details-modal">&times;</span>
            <h2>User Details Modal</h2>
            <p>Username: <span id="provider-username">N/A</span></p>
            <p>Name: <span id="provider-name">N/A</span></p>
            <p>Phone: <span id="provider-phone">N/A</span></p>
            <p>Email: <span id="provider-email">N/A</span></p>
            <p>Access: <span id="provider-access">N/A</span></p>
            <p>Locked: <span id="provider-approved">N/A</span></p>
            
            <h2>Address</h2>
            <p>
                <span id="provider-street-name"></span>, 
                <span id="provider-city"></span>, 
                <span id="provider-state"></span>, 
                <span id="provider-zip-code"></span>
            </p>

            <div id="business-section">
                <h2>Business Info</h2>
                <p>Name: <span id="provider-business-name">N/A</span></p>
                <p>Email: <span id="provider-business-email">N/A</span></p>
                <p>Phone: <span id="provider-business-phone">N/A</span></p>
                <p>Terms: <span id="provider-business-terms">N/A</span></p>
                <p>Protocol: <span id="provider-business-protocol">N/A</span></p>
                <div class="photo-gallery">
                    <p>Insurance: <span class="image-container" id="provider-business-insurance">N/A</span></p>
                    <p>Equipment: <span class="image-container" id="provider-business-equipment">N/A</span></p>
                </div>
                <form action="assets/php/unlock-account.php" method="POST">
                    <input type="hidden" name="email" id="modal-email-unlock" value="">
                    <button type="submit" id="unlock-account-btn" class="jotform-submit">Unlock Account</button>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    document.querySelectorAll(".view-btn").forEach(button => {
        button.addEventListener("click", function() {
            const userDetailsModal = document.getElementById("user-modal");
            userDetailsModal.style.display = "block";

            // Fetch user details and populate the modal
            const email = button.closest("tr").querySelector("td:first-child").textContent.trim();
            console.log(email); // Debugging to check if email is correctly received
            fetchUserData(email);
        });
    });
    
    document.querySelectorAll('.access-btn').forEach(button => {
        button.addEventListener('click', function() {
            const email = this.getAttribute('data-email');
            fetch('assets/php/grant-access.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${email}`
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                if (data === 'success') {
                    alert('User has been approved');
                    location.reload();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
    
    document.querySelectorAll(".view-user-btn").forEach(button => {
        button.addEventListener("click", function() {
            const userDetailModal = document.getElementById("user-details-modal");
            userDetailModal.style.display = "block";

            // Fetch client details and populate the modal
            const email = button.closest("tr").querySelector("td:nth-child(3)").textContent.trim(); // Assuming email is in the 3rd column
            fetchUserDetailData(email);
        });
    });

    function fetchUserDetailData(email) {
        fetch('assets/php/fetchUserData.php?email=' + email)
            .then(response => response.json())
            .then(data => {
                const userDetailModal = document.getElementById("user-details-modal");
                userDetailModal.style.display = "block";

                // Populate the modal with the retrieved data
                document.getElementById("provider-username").textContent = data.username || 'N/A';
                document.getElementById("provider-email").textContent = data.email || 'N/A';
                document.getElementById("provider-name").textContent = data.name || 'N/A';
                document.getElementById("provider-phone").textContent = data.phone || 'N/A';
                document.getElementById("provider-approved").textContent = data.approved || 'N/A';
                document.getElementById("provider-access").textContent = data.access || 'N/A';
                
                document.getElementById("provider-street-name").textContent = data.street_name || 'N/A';
                document.getElementById("provider-city").textContent = data.city || 'N/A';
                document.getElementById("provider-state").textContent = data.state || 'N/A';
                document.getElementById("provider-zip-code").textContent = data.zip_code || 'N/A';
                
                document.getElementById("provider-business-name").textContent = data.business_name || 'N/A';
                document.getElementById("provider-business-email").textContent = data.business_email || 'N/A';
                document.getElementById("provider-business-phone").textContent = data.business_phone || 'N/A';
                document.getElementById("provider-business-terms").textContent = data.terms || 'N/A';
                document.getElementById("provider-business-protocol").textContent = data.protocol || 'N/A';
                document.getElementById("modal-email-unlock").value = email; // Set email for the Unlock Account form
                // Handle equipment and insurance files
                    const equipmentContainer = document.getElementById("provider-business-equipment");
                    if (data.equipment_files) {
                        const equipmentFiles = data.equipment_files.split(',');
                        const equipmentImages = equipmentFiles.map(file => `<img src="/assets/php/${file}" alt="Equipment Photo" class="clickable-image" onclick="enlargeImage('/assets/php/${file}')">`).join('');
                        equipmentContainer.innerHTML = equipmentImages;
                    } else {
                        equipmentContainer.innerHTML = '<p>No equipment photos available.</p>';
                    }

                    const insuranceContainer = document.getElementById("provider-business-insurance");
                    if (data.insurance_files) {
                        const insuranceFiles = data.insurance_files.split(',');
                        const insuranceImages = insuranceFiles.map(file => `<img src="/assets/php/${file}" alt="Insurance Photo" class="clickable-image" onclick="enlargeImage('/assets/php/${file}')">`).join('');
                        insuranceContainer.innerHTML = insuranceImages;
                    } else {
                        insuranceContainer.innerHTML = '<p>No insurance photos available.</p>';
                    }
            })
            .catch(error => console.error('Error fetching user data:', error));
    }

    // Close client modal functionality
    document.querySelector(".close-details-modal").addEventListener("click", function () {
        document.getElementById("user-details-modal").style.display = "none";
    });

    // Function to enlarge images on click
    function enlargeImage(imageSrc) {
        const viewer = document.createElement('div');
        viewer.style.position = 'fixed';
        viewer.style.left = '0';
        viewer.style.top = '0';
        viewer.style.width = '100%';
        viewer.style.height = '100%';
        viewer.style.backgroundColor = 'rgba(0,0,0,0.8)';
        viewer.style.display = 'flex';
        viewer.style.justifyContent = 'center';
        viewer.style.alignItems = 'center';
        viewer.style.zIndex = '1000';
        viewer.innerHTML = `<img src="${imageSrc}" style="max-width:90%; max-height:90%;">`;
        viewer.onclick = () => document.body.removeChild(viewer);
        document.body.appendChild(viewer);
    }
    
    function toggleBookings() {
        var bookingsMenu = document.getElementById('bookingsMenu');
        if (bookingsMenu.style.display === 'block') {
            bookingsMenu.style.display = 'none';
        } else {
            bookingsMenu.style.display = 'block';
        }
    }

    function toggleUsers() {
        var usersMenu = document.getElementById('usersMenu');
        if (usersMenu.style.display === 'block') {
            usersMenu.style.display = 'none';
        } else {
            usersMenu.style.display = 'block';
        }
    }
    </script>
</body>
</html>
