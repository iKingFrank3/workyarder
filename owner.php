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

        .modal {
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
        
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        
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
        
        .fc-today-button {
            text-transform: capitalize;
        }
        
        .box-content-calendar {
            overflow-y: auto;
            max-height: 120px; /* Adjust the height based on your design */
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
            color: #4F8E35;
        }

        .notification-box h3 {
            font-size: 18px;
        }

        .notification-box h5 {
            text-align: left;
        }

        .notification-box p {
            font-size: 14px;
            text-align: left;
        }

        .notification-box .box-content {
            margin-top: 15px;
        }

        .fc-event {
            border: 1px solid #4F8E35
        }

        .fc-event, .fc-event-dot {
            background-color: #4F8E35;
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
                <div class="notification-boxes">
                    <div class="notification-box">
                        <div class="box-header">
                            <i class="fas fa-user-tie"></i>
                            <h3>Users</h3>
                            <h5>Total Users: </h5>
                            <p>Clients: </p>
                            <p>Request: </p>
                        </div>
                        <div class="box-content" id="taskUpdateContent">
                            <!-- Display Task updates or No Task updates based on the values of totalcomments and completeTask -->
                        </div>
                    </div>
                    <div class="notification-box">
                        <div class="box-header">
                            <i class="fas fa-calendar-alt"></i>
                            <h3>Bookings</h3>
                            <h5>Active: </h5>
                            <p>Completed: </p>
                        </div>
                        <div class="box-content-calendar">
                            <p><span id="calendarEvent"></span></p>
                        </div>
                    </div>
                    <div class="notification-box">
                        <div class="box-header">
                            <i class="fas fa-check-circle"></i>
                            <h3>Revenue</h3>
                            <h5>Today's Gross: </h5>
                            <p>Today's Profit: </p>
                            
                        </div>
                        <div class="box-content" id="crmUpdateContent">
                            <!-- Display CRM updates or No CRM updates based on the value of pendingCRM -->
                        </div>
                    </div>
                </div>
                <hr>
                <br>
                <div class="data-insights">
					<div class="fullCalendar">
					</div>
				</div>
            </div>
        </div>
    </div>
    
    <!-- Add modal HTML structure -->
    <div id="eventModal" class="modal">
       <div class="modal-content">
          <span class="close">&times;</span>
          <h2 id="eventTitle"></h2>
          <p id="eventDescription"></p>
       </div>
    </div>
    <script>
    // Initialize FullCalendar
    $('.fullCalendar').fullCalendar({
             events: [
                    {
                        title: 'My Event',
                        start: '2024-03-16'
                    },
                    // Add more events as needed
                ],
            eventClick: function (event) {
            // Open modal with event details
            openEventModal(event);
            },
        });
        
        function openEventModal(event) {
            const modal = document.getElementById('eventModal');
            const titleElement = document.getElementById('eventTitle');
            const descriptionElement = document.getElementById('eventDescription');
        
            titleElement.textContent = event.title;
            descriptionElement.textContent = event.description;
        
            // Show the modal
            modal.style.display = 'block';
        }
        
        // Add this at the bottom of the script
        const closeModalButton = document.getElementsByClassName('close')[0];
        closeModalButton.onclick = function () {
            const modal = document.getElementById('eventModal');
            modal.style.display = 'none';
        };
        
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