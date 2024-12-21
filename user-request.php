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
                    <h2>Account Request</h2>
                    <!-- Add a table or list of leads with sample data -->
                    <table class="leads-table">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Account Type</th>
                                <th>Location</th>
                                <th>Service</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'assets/php/populate-request.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
     <!-- Add modal HTML structure for lead details -->
    <div class="user-modal" id="user-modal">
        <div class="user-content">
            <span class="close">&times;</span>
            <!-- Content for lead details will be populated here -->
            <h2>User Details</h2>
            <p>Username: <span id="username">N/A</span></p>
            <p>Password: <span id="password">N/A</span></p>
            <p>Name: <span id="name">N/A</span></p>
            <p>Phone: <span id="phone">N/A</span></p>
            <p>Email: <span id="email">N/A</span></p>
            <p>Role: <span id="role">N/A</span></p>
            <p>Referral: <span id="referral">N/A</span></p>
            <p>Access: <span id="access">N/A</span></p>
            <p>Approved: <span id="approved">N/A</span></p>
            <br>
            <div style="overflow: hidden; white-space: nowrap;">
                <form action="assets/php/approve-request.php" method="POST" style="display: inline-block; margin-right: 10px;">
                    <input type="hidden" name="email" id="modal-email" value="">
                    <input type="hidden" name="providerType" id="modal-provider-type" value="">
                    <button type="submit" class="jotform-submit">Approve Account</button>
                </form>
                <form action="assets/php/grant-access.php" method="POST" style="display: inline-block;">
                    <input type="hidden" name="email" id="modal-email-access" value="">
                    <button type="submit" class="jotform-submit">Grant Access</button>
                </form>
            </div>
            
            <h2>Address</h2>
            <p>
                <span id="street-name"></span>, 
                <span id="city"></span>, 
                <span id="state"></span>, 
                <span id="zip-code"></span>
            </p>
            
            <div id="interests-sizes">
                <h2>Interests & Sizes</h2>
                <p>Interest: <span id="interests">N/A</span></p>
                <p>Lawn: <span id="lawn-size">N/A</span></p>
                <p>Pool: <span id="pool-size">N/A</span></p>
                <p>Lot: <span id="driveway">N/A</span></p>
            </div>

            <div id="business-info" style="display:none;">
                <h2>Business Info</h2>
                <p>Name: <span id="business-name">N/A</span></p>
                <p>Email: <span id="business-email">N/A</span></p>
                <p>Phone: <span id="business-phone">N/A</span></p>
                <p>Terms: <span id="business-terms">N/A</span></p>
                <p>Protocol: <span id="business-protocol">N/A</span></p>
                <br>
                <p>Equipment: <span id="business-equipment">N/A</span></p>
                <div class="photo-gallery">
                    <div class="image-container" id="business-equipment-photos">
                        <!-- Equipment photos will be dynamically inserted here -->
                    </div>
                </div>
                <br>
                <p>Insurance: <span id="business-insurance">N/A</span></p>
                <div class="photo-gallery">
                    <div class="image-container" id="business-insurance-photos">
                        <!-- Insurance photos will be dynamically inserted here -->
                    </div>
                </div>
            </div>
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

    function fetchUserData(email) {
        console.log(email); // Debugging to check if email is correctly received
        // Make an AJAX request to fetch user data
        fetch('assets/php/fetchUserData.php?email=' + email)
            .then(response => response.json())
            .then(data => {
                const userDetailsModal = document.getElementById("user-modal");
                userDetailsModal.style.display = "block";

                // Populate the modal with the retrieved data
                document.getElementById("username").textContent = data.username || 'N/A';
                document.getElementById("password").textContent = (data.password && data.password !== 'N/A' && !data.password.startsWith('WY-')) ? 'User has set the password' : 'N/A';
                document.getElementById("email").textContent = email || 'N/A';
                document.getElementById("name").textContent = data.name || 'N/A';
                document.getElementById("phone").textContent = data.phone || 'N/A';
                document.getElementById("role").textContent = data.role || 'N/A';
                document.getElementById("access").textContent = data.access || 'N/A';
                document.getElementById("approved").textContent = data.approved || 'N/A';
                document.getElementById("referral").textContent = data.referral || 'N/A';

                // Determine if the user is a client or a provider
                if (data.role && data.role !== 'client') {
                    // Business Info Section
                    document.getElementById("business-info").style.display = "block";
                    document.getElementById("interests-sizes").style.display = "none";

                    document.getElementById("business-name").textContent = data.business_name || 'N/A';
                    document.getElementById("business-email").textContent = data.business_email || 'N/A';
                    document.getElementById("business-phone").textContent = data.business_phone || 'N/A';
                    document.getElementById("business-terms").textContent = data.terms || 'N/A';
                    document.getElementById("business-protocol").textContent = data.protocol || 'N/A';
                    document.getElementById("business-equipment").textContent = data.account_equipment || 'N/A';
                    // Handle equipment and insurance files
                    const equipmentContainer = document.getElementById("business-equipment-photos");
                    if (data.equipment_files) {
                        const equipmentFiles = data.equipment_files.split(',');
                        const equipmentImages = equipmentFiles.map(file => `<img src="/assets/php/${file}" alt="Equipment Photo" class="clickable-image" onclick="enlargeImage('/assets/php/${file}')">`).join('');
                        equipmentContainer.innerHTML = equipmentImages;
                    } else {
                        equipmentContainer.innerHTML = '<p>No equipment photos available.</p>';
                    }
                    
                    document.getElementById("business-insurance").textContent = data.account_insurance || 'N/A';
                    const insuranceContainer = document.getElementById("business-insurance-photos");
                    if (data.insurance_files) {
                        const insuranceFiles = data.insurance_files.split(',');
                        const insuranceImages = insuranceFiles.map(file => `<img src="/assets/php/${file}" alt="Insurance Photo" class="clickable-image" onclick="enlargeImage('/assets/php/${file}')">`).join('');
                        insuranceContainer.innerHTML = insuranceImages;
                    } else {
                        insuranceContainer.innerHTML = '<p>No insurance photos available.</p>';
                    }
                } else {
                    // Interests & Sizes Section
                    document.getElementById("business-info").style.display = "none";
                    document.getElementById("interests-sizes").style.display = "block";

                    document.getElementById("interests").textContent = data.interests || 'N/A';
                    document.getElementById("lawn-size").textContent = data.lawn_size || 'N/A';
                    document.getElementById("pool-size").textContent = data.pool_size || 'N/A';
                    document.getElementById("driveway").textContent = data.driveway || 'N/A';
                }

                document.getElementById("street-name").textContent = data.street_name || 'N/A';
                document.getElementById("city").textContent = data.city || 'N/A';
                document.getElementById("state").textContent = data.state || 'N/A';
                document.getElementById("zip-code").textContent = data.zip_code || 'N/A';
                document.getElementById("modal-email").value = email;
                document.getElementById("modal-provider-type").value = data.provider_type || 'client'; // Assuming 'client' as default
                document.getElementById("modal-email-access").value = email; // Set email for the Grant Access form
            })
            .catch(error => console.error('Error fetching user data:', error));
    }

    // Function to close the user modal
    function closeUserModal() {
        const userDetailsModal = document.getElementById("user-modal");
        userDetailsModal.style.display = "none";
    }

    // Add event listener to the close button in the user modal
    document.querySelector(".close").addEventListener("click", function () {
        closeUserModal();
    });

    // Add event listener to close the user modal when clicking outside the modal
    window.addEventListener("click", function (event) {
        const userDetailsModal = document.getElementById("user-modal");
        if (event.target === userDetailsModal) {
            closeUserModal();
        }
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