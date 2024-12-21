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
                    <h2>Active Clients</h2>
                    <!-- Add a table or list of leads with sample data -->
                    <table class="leads-table">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'assets/php/populate-clients.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Client Details Modal -->
    <div id="client-modal" class="user-modal">
        <div class="user-content">
            <span class="close-client-modal">&times;</span>
            <h2>Client Details</h2>
            <p>Username: <span id="client-username">N/A H</span></p>
            <p>Name: <span id="client-name">N/A</span></p>
            <p>Phone: <span id="client-phone">N/A</span></p>
            <p>Email: <span id="client-email">N/A</span></p>
            <p>Role: <span id="client-role">N/A</span></p>
            <p>Access: <span id="client-access">N/A</span></p>
            
            <h2>Address</h2>
            <p>
                <span id="client-street-name"></span>, 
                <span id="client-city"></span>, 
                <span id="client-state"></span>, 
                <span id="client-zip-code"></span>
            </p>
            
            <div id="interests-section">
                <h2>Interests & Sizes</h2>
                <p>Interest: <span id="client-interests">N/A</span></p>
                <p>Lawn: <span id="client-lawn-size">N/A</span></p>
                <p>Pool: <span id="client-pool-size">N/A</span></p>
                <p>Lot: <span id="client-driveway">N/A</span></p>
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

    document.querySelectorAll(".view-client-btn").forEach(button => {
        button.addEventListener("click", function() {
            const clientModal = document.getElementById("client-modal");
            clientModal.style.display = "block";

            // Fetch client details and populate the modal
            const email = button.closest("tr").querySelector("td:nth-child(5)").textContent.trim(); // Assuming email is in the 5th column
            fetchClientData(email);
        });
    });

    function fetchClientData(email) {
        fetch('assets/php/fetchUserData.php?email=' + email)
            .then(response => response.json())
            .then(data => {
                const clientModal = document.getElementById("client-modal");
                clientModal.style.display = "block";

                // Populate the modal with the retrieved data
                document.getElementById("client-username").textContent = data.username || 'N/A';
                document.getElementById("client-email").textContent = data.email || 'N/A';
                document.getElementById("client-name").textContent = data.name || 'N/A';
                document.getElementById("client-phone").textContent = data.phone || 'N/A';
                document.getElementById("client-role").textContent = data.role || 'N/A';
                document.getElementById("client-access").textContent = data.access || 'N/A';
                
                document.getElementById("client-street-name").textContent = data.street_name || 'N/A';
                document.getElementById("client-city").textContent = data.city || 'N/A';
                document.getElementById("client-state").textContent = data.state || 'N/A';
                document.getElementById("client-zip-code").textContent = data.zip_code || 'N/A';
                
                document.getElementById("client-interests").textContent = data.interests || 'N/A';
                document.getElementById("client-lawn-size").textContent = data.lawn_size || 'N/A';
                document.getElementById("client-pool-size").textContent = data.pool_size || 'N/A';
                document.getElementById("client-driveway").textContent = data.driveway || 'N/A';
                
            })
            .catch(error => console.error('Error fetching client data:', error));
    }

    // Close client modal functionality
    document.querySelector(".close-client-modal").addEventListener("click", function () {
        document.getElementById("client-modal").style.display = "none";
    });
    
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