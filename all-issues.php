<!DOCTYPE html>
<html lang="en">
<head>
    <title>Issues and Damages Dashboard</title>
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

        /* Modal background */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        /* Modal content */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 50%; /* Could be more or less, depending on screen size */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); /* Optional: Adds shadow to the modal */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
                <img src="https://workyarder.com/assets/img/WorkYarder-wlogo.png" alt="Small Logo" width="80%">
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
                <h1>Issues and Damages Dashboard</h1>
            </header>
            <div class="main-content">
                <!-- Issues Table -->
                <div class="jotform-section">
                    <h2>All Issues</h2>
                    <table class="leads-table">
                        <thead>
                            <tr>
                                <th>Booking Code</th>
                                <th>Username</th>
                                <th>Created At</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'assets/php/populate-issues.php'; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Damages Table -->
                <div class="jotform-section">
                    <h2>Damages</h2>
                    <table class="leads-table">
                        <thead>
                            <tr>
                                <th>Booking Code</th>
                                <th>Business Name</th>
                                <th>Uploaded At</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php include 'assets/php/populate-damages.php'; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals -->
    <div id="issueModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <!-- Content for issue details -->
            <h2>Issue Details</h2>
            <div class="issue-details">
                <p><strong>Username:</strong> <span id="issue-username"></span></p>
                <p><strong>Name:</strong> <span id="issue-name"></span></p>
                <p><strong>Appointment Time and Date:</strong> <span id="issue-appointment"></span></p>
                <p><strong>Assigned To:</strong> <span id="issue-assigned-to"></span></p>
                <p><strong>Message:</strong> <span id="issue-message"></span></p>
            </div>
        </div>
    </div>
    <div id="damageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <!-- Content for damage details -->
            <h2>Damage Details</h2>
            <div class="damage-details">
                <p><strong>Business Name:</strong> <span id="damage-business-name"></span></p>
                <p><strong>Service Type:</strong> <span id="damage-service-type"></span></p>
                <p><strong>Name:</strong> <span id="damage-name"></span></p>
                <p><strong>Address:</strong> <span id="damage-address"></span></p>
                <p><strong>Photos:</strong> <div id="damage-photos"></div></p>
                <p><strong>Notes:</strong> <span id="damage-notes"></span></p>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll(".view-btn").forEach(button => {
            button.addEventListener("click", function() {
                const issueModal = document.getElementById("issueModal");
                issueModal.style.display = "block";

                // Fetch issue details and populate the modal
                const issueId = button.getAttribute("data-issue-id"); // Assuming each button has a data-issue-id attribute
                fetchIssueData(issueId);
            });
        });

        function fetchIssueData(issueId) {
            fetch('assets/php/fetchIssueData.php?issueId=' + issueId)
                .then(response => response.json())
                .then(data => {
                    // Populate the modal with the retrieved data
                    document.getElementById("issue-username").textContent = data.username || 'N/A';
                    document.getElementById("issue-name").textContent = data.name || 'N/A';
                    document.getElementById("issue-appointment").textContent = data.appointment_id || 'N/A';
                    document.getElementById("issue-assigned-to").textContent = data.assigned_to || 'N/A';
                    document.getElementById("issue-message").textContent = data.message || 'N/A';
                })
                .catch(error => console.error('Error fetching issue data:', error));
        }

        // Function to close the issue modal
        function closeIssueModal() {
            const issueModal = document.getElementById("issueModal");
            issueModal.style.display = "none";
        }

        // Add event listener to the close button in the issue modal
        document.querySelectorAll(".close").forEach(button => {
            button.addEventListener("click", function() {
                // Determine which modal should be closed based on some logic or additional data attributes
                if (this.closest("#issueModal")) {
                    closeIssueModal();
                } else if (this.closest("#damageModal")) {
                    closeDamageModal();
                }
            });
        });

        // Add event listener to close the issue modal when clicking outside the modal
        window.addEventListener("click", function (event) {
            const issueModal = document.getElementById("issueModal");
            if (event.target === issueModal) {
                closeIssueModal();
            }
        });

        document.querySelectorAll(".view-damage-btn").forEach(button => {
            button.addEventListener("click", function() {
                const damageModal = document.getElementById("damageModal");
                damageModal.style.display = "block";

                // Fetch damage details and populate the modal
                const damageId = button.getAttribute("data-damage-id"); // Assuming each button has a data-damage-id attribute
                fetchDamageData(damageId);
            });
        });

        function fetchDamageData(damageId) {
            console.log('DamageId: ', damageId);
            fetch('assets/php/fetchDamageData.php?damageId=' + damageId)
                .then(response => response.json())
                .then(data => {
                    // Populate the modal with the retrieved data
                    const damageBusinessNameElement = document.getElementById("damage-business-name");
                    const damageServiceTypeElement = document.getElementById("damage-service-type");
                    const damageNameElement = document.getElementById("damage-name");
                    const damageAddressElement = document.getElementById("damage-address");
                    const damageNotesElement = document.getElementById("damage-notes");

                    damageBusinessNameElement.textContent = data.business_name || 'N/A';
                    damageServiceTypeElement.textContent = data.description || 'N/A';
                    damageNameElement.textContent = data.booking_id || 'N/A';
                    damageAddressElement.textContent = data.uploaded_at || 'N/A';
                    damageNotesElement.textContent = data.description || 'N/A';

                    // Assuming data.photos is an array of image URLs
                    const photosContainer = document.getElementById("damage-photos");
                    photosContainer.innerHTML = ''; // Clear previous images
                    if (data.photos && data.photos.length > 0) {
                        data.photos.forEach(photo => {
                            const img = document.createElement('img');
                            img.src = photo;
                            img.classList.add('clickable-image');
                            img.onclick = () => enlargeImage(photo);
                            photosContainer.appendChild(img);
                        });
                    } else {
                        photosContainer.innerHTML = '<p>No photos available.</p>';
                    }
                })
                .catch(error => console.error('Error fetching damage data:', error));
        }

        // Function to close the damage modal
        function closeDamageModal() {
            const damageModal = document.getElementById("damageModal");
            damageModal.style.display = "none";
        }

        // Add event listener to the close button in the damage modal
        document.querySelectorAll(".close").forEach(button => {
            button.addEventListener("click", function() {
                // Determine which modal should be closed based on some logic or additional data attributes
                if (this.closest("#issueModal")) {
                    closeIssueModal();
                } else if (this.closest("#damageModal")) {
                    closeDamageModal();
                }
            });
        });

        // Add event listener to close the damage modal when clicking outside the modal
        window.addEventListener("click", function (event) {
            const damageModal = document.getElementById("damageModal");
            if (event.target === damageModal) {
                closeDamageModal();
            }
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