<?php include 'assets/php/check-access.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="img/fav-icon.png" rel="icon">
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

        .data-insights {
            background-color: #fff;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .data-insights h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .notification-boxes {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .notification-box {
            flex: 1;
            background-color: #fff;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        .notification-box i {
            font-size: 36px;
            color: #3498db;
        }

        .notification-box h3 {
            font-size: 18px;
        }

        .notification-box .box-content {
            margin-top: 15px;
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
        
        .mobile-header {
            display: none; /* Hide by default */
            background-color: #333; /* Same background as sidebar header */
            text-align: center;
            padding: 0;
            display: flex; /* Use flexbox to layout children */
            align-items: center; /* Center items vertically */
            justify-content: space-between; /* Space between items */
        }

        .hamburger {
            display: none; /* Hide by default */
            font-size: 25px; /* Set size of hamburger icon */
            cursor: pointer; /* Change cursor to pointer */
            color: #fff; /* Set color to white for visibility */
            border: 2px solid #fff; /* White border around the hamburger icon */
            padding: 5px; /* Padding around the icon */
            border-radius: 5px; /* Optional: rounded corners */
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none; /* Hide the sidebar on mobile devices */
            }

            .content {
                width: 100%; /* Make content use full width */
                margin: 0; /* Remove any margin */
            }

            .mobile-header {
                display: flex; /* Show only in mobile view */
                justify-content: center; /* Center horizontally */
                align-items: center; /* Center vertically */
                width: 100%; /* Ensure it spans the full width */
                padding: 10px 0;
            }
            .hamburger {
                display: block; /* Show hamburger menu in mobile view */
            }

            .logout-button {
                position: static; /* Adjust position for mobile */
                width: 100%;
                margin-top: 20px;
                margin-left: 15px;
            }
            
            .jotform-section {
                overflow-x: auto; /* Enable horizontal scrolling */
            }
            .leads-table {
                width: 100%; /* Ensure the table is not wider than the section */
                min-width: 600px; /* Minimum width to maintain table structure */
            }
        }

        /* Initially hide the logo */
        .mobile-logo {
            display: none;
        }

        /* Show the logo only on screens smaller than 768px */
        @media (max-width: 768px) {
            .mobile-logo {
                display: block;
                width: 50%;
                margin-right: 70px;
            }

            .modal-content {
                width: 90%; /* More suitable for smaller screens */
                margin: 5% auto;
            }

            .jotform-form-row {
                display: flex;
                flex-direction: column;
                align-items: start;
                margin-bottom: 15px;
            }

            .jotform-form-label {
                margin-bottom: 5px;
            }
            
            .mobile-header {
                z-index: 1001; /* Ensure mobile-header is above mobile-sidebar */
                position: relative; /* Needed to make z-index effective */
            }

            .mobile-sidebar {
                z-index: 1000; /* Lower than mobile-header */
                position: fixed; /* Keep this to ensure sidebar is fixed */
            }
            
        }

        .mobile-sidebar {
            position: fixed;
            left: -100%; /* Start off-screen */
            top: 63px; /* Adjusted to start below the mobile-header */
            width: 250px; /* Same as the main sidebar */
            height: calc(100% - 50px); /* Adjust height to account for mobile-header */
            background-color: #232323;
            color: #fff;
            transition: left 0.3s;
            z-index: 999; /* Ensure it's on top but below the header */
            overflow-y: auto;
        }

        .mobile-sidebar.active {
            left: 0; /* Slide in */
        }
        
        .mobile-header.sticky-header {
            position: fixed; /* Make the header fixed at the top */
            top: 0; /* Align to the top */
            width: 100%; /* Full width */
            z-index: 1002; /* Higher than the sidebar to ensure it's on top */
        }

        body.with-sticky-header {
            padding-top: 60px; /* Adjust based on the height of your mobile-header */
        }
	</style>
</head>
<body>
    <div class="mobile-header">
        <div class="hamburger" style="margin-right: 30px;width: 8%;">&#9776;</div>
        <img src="assets/img/WorkYarder-wlogo.png" alt="WorkYarder Logo" class="mobile-logo">
    </div>
    <div class="dashboard">
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="assets/img/WorkYarder-wlogo.png" alt="Small Logo" width="80%">
            </div>
            <ul class="nav">
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
				<li><a href="book-service.php"><i class="fas fa-book"></i> Book Service</a></li>
				<li><a href="provider-list.php"><i class="fas fa-file-alt"></i> Provider List</a></li>
				<li><a href="history.php"><i class="fas fa-history"></i> Service History</a></li>
				<li><a href="settings.php"><i class="fas fa-cogs"></i> Settings</a></li>
			</ul>
			<a href="assets/php/logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="mobile-sidebar">
            <ul class="nav">
                <!-- Loaded from JavaScript -->
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
				<li><a href="book-service.php"><i class="fas fa-book"></i> Book Service</a></li>
				<li><a href="provider-list.php"><i class="fas fa-file-alt"></i> Provider List</a></li>
				<li><a href="history.php"><i class="fas fa-history"></i> Service History</a></li>
				<li><a href="settings.php"><i class="fas fa-cogs"></i> Settings</a></li>
            </ul>
            <a href="assets/php/logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="content">
            <header>
                <h1>Service History</h1>
            </header>
            <div class="main-content">
                <div class="jotform-section">
                    <h2>Order History</h2>
                    <!-- Add a table or list of leads with sample data -->
                    <table class="leads-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>City, State</th>
                                <th>Service Completed</th>
                                <th>Duration</th>
                                <th>Total</th>
                                <th>More Info</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add more lead entries -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('assets/php/fetchHistory.php')
            .then(response => response.text())
            .then(data => {
                document.querySelector('.leads-table tbody').innerHTML = data;
            });
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const mobileSidebar = document.querySelector('.mobile-sidebar');
            const mobileHeader = document.querySelector('.mobile-header');
            const body = document.body;

            hamburger.addEventListener('click', function() {
                mobileSidebar.classList.toggle('active');
                if (mobileSidebar.classList.contains('active')) {
                    mobileHeader.classList.add('sticky-header');
                    body.classList.add('with-sticky-header');
                } else {
                    mobileHeader.classList.remove('sticky-header');
                    body.classList.remove('with-sticky-header');
                }
            });
        });
        
        function appointmentDetails(bookingId) {
            localStorage.setItem('bookingId', bookingId);
            window.location.href = 'appointment-details.php';
        }
    </script>
	</body>
</html>