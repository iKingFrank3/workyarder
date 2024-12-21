<?php include 'assets/php/check-access.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            width: 55%;
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
            flex: 1 1 100%; /* Take full width on small screens */
            background-color: #fff;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px; /* Add bottom margin for spacing between boxes */
        }

        @media (min-width: 768px) {
            .notification-box {
                flex: 1 1 30%; /* Adjust size to take about one-third of the space on larger screens */
            }
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

        .fc-today-button {
            text-transform: capitalize;
        }
        
        .box-content-calendar {
            overflow-y: auto;
            max-height: 120px; /* Adjust the height based on your design */
        }

        .fc-event {
            border: 1px solid #4F8E35
        }

        .fc-event, .fc-event-dot {
            background-color: #4F8E35;
        }
        
        /* Style for the Task List (Task Blog) */
        .task-list {
            margin-top: 20px;
        }

        .task-list h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        #task-blog {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .task-item {
            background-color: #fff;
            padding: 20px;
            margin: 15px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: relative;
            display: flex;
            flex-direction: column; /* Stack items vertically */
            align-items: flex-start; /* Align items to the start of the flex container */
        }

        .task-item h3 {
            font-size: 20px;
            margin: 0;
            color: #333;
        }

        .task-item p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        .task-item h4 {
            font-size: 18px;
            margin-top: 15px;
            color: #333;
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
                width: 90%; /* Make content use full width */
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
            
            .notification-boxes {
                flex-wrap: wrap; /* Allow boxes to wrap onto the next line */
            }
        }

        /* Initially hide the logo */
        .mobile-logo {
            display: none;
        }
        
        .modal{
            z-index: 1; /* Sit on top */
        }

        /* Show the logo only on screens smaller than 768px */
        @media (max-width: 768px) {
            .mobile-logo {
                display: block;
                width: 50%;
                margin-right: 70px;
            }

            .modal-content {
                width: 70%; /* More suitable for smaller screens */
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
            
            .button-container button {
                margin-bottom: 15px;
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
        
        .button-container button {
            display: inline-block; /* Display buttons inline */
            margin-right: 10px; /* Space between buttons */
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
                <h1>Dashboard </h1>
            </header>
            <div class="main-content">
                <div class="data-insights">
					<h3>Welcome, </h3>
                    <h4>Here are your upcoming scheduled service</h4>
                    <div class="task-list">
                        <ul id="task-blog">
                            <!-- Appointments will be appended here -->
                        </ul>
                    </div>
				</div>
                <div class="jotform-form-row">
                    <label for="address" class="jotform-form-label">Address:</label>
                    <select id="address" name="address" class="jotform-form-input">
                        <!-- Address (if multiple ) -->
                    </select>
                </div>
                <div class="notification-boxes">
                    <div class="notification-box">
                        <div class="box-header">
                            <img src="assets/img/grass.png" alt="Lawn Care" width="20%">
                            <h3>Lawn Care Provider</h3>
                        </div>
                        <div class="box-content" id="lawnUpdateContent">
                            <p>None Selected</p>
                        </div>
                    </div>
                    <div class="notification-box">
                        <div class="box-header">
                            <img src="assets/img/swimming-pool.png" alt="Pool Care" width="20%">
                            <h3>Pool Care Provider</h3>
                        </div>
                        <div class="box-content" id="poolUpdateContent">
                            <p>None Selected</p>
                        </div>
                    </div>
                    <div class="notification-box">
                        <div class="box-header">
                            <img src="assets/img/pressure-washer.png" alt="Pressure Washing" width="20%">
                            <h3>Pressure Washing Provider</h3>
                        </div>
                        <div class="box-content" id="pwUpdateContent">
                            <p>None Selected</p>
                        </div>
                    </div>
                </div>
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
        // Initialize FullCalendar with dynamic events
        $(document).ready(function() {
            var isMobile = window.matchMedia("only screen and (max-width: 768px)").matches;

            $('.fullCalendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultView: isMobile ? 'basicWeek' : 'month',
                events: 'assets/php/client-calendar.php',
                eventClick: function (event) {
                    openEventModal(event);
                }
            });
        });
        
        function openEventModal(event) {
            const modal = document.getElementById('eventModal');
            const titleElement = document.getElementById('eventTitle');
            const descriptionElement = document.getElementById('eventDescription');
        
            titleElement.textContent = event.title;
            descriptionElement.innerHTML = event.description; // Use innerHTML to render HTML content
        
            // Show the modal
            modal.style.display = 'block';
        }
        
        // Add this at the bottom of the script
        const closeModalButton = document.getElementsByClassName('close')[0];
        closeModalButton.onclick = function () {
            const modal = document.getElementById('eventModal');
            modal.style.display = 'none';
        };

        document.addEventListener("DOMContentLoaded", function() {
            // Fetch and populate addresses
            fetch('assets/php/list-address.php')
            .then(response => response.json())
            .then(data => {
                const addressSelect = document.getElementById('address');
                data.forEach(address => {
                    const option = document.createElement('option');
                    option.value = address.address_id;
                    option.textContent = `${address.street_name}, ${address.city}, ${address.state}, ${address.zip_code}`;
                    addressSelect.appendChild(option);
                });
                
                // Trigger the change event if there are addresses
                if (addressSelect.options.length > 0) {
                    addressSelect.dispatchEvent(new Event('change'));
                }
            });

            // Handle address selection change
            document.getElementById('address').addEventListener('change', function() {
                const addressId = this.value;
                fetch(`assets/php/get-address-providers.php?address_id=${addressId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('lawnUpdateContent').querySelector('p').textContent = data.lawn_provider || 'None Selected';
                    document.getElementById('poolUpdateContent').querySelector('p').textContent = data.pool_provider || 'None Selected';
                    document.getElementById('pwUpdateContent').querySelector('p').textContent = data.pW_provider || 'None Selected';
                })
                .catch(error => console.error('Error fetching provider data:', error));
            });
        });

        // Fetch appointments for the logged-in user and display in the task-list
        $.ajax({
            url: 'assets/php/client-appointments.php',
            method: 'GET',
            dataType: 'json', // Explicitly expecting JSON response
            success: function(response) {
                console.log(response); // Debugging line to inspect the response
                if (response && response.appointments && Array.isArray(response.appointments)) {
                    response.appointments.forEach(appointment => {
                        const taskItem = `
                            <li class="task-item">
                                <h3>${appointment.time} - ${appointment.serviceType}</h3>
                                <p>Provider: ${appointment.providerName}</p>
                                <p>Address: ${appointment.address}</p>
                                <br>
                                <p>${appointment.additionalInfo}</p>
                                <div class='button-container'>
                                    <button class="jotform-submit" onclick="appointmentDetails(${appointment.appointmentId})">Appointment Details</button>
                                    <button class="jotform-submit" onclick="cancelAppointment(${appointment.appointmentId})">Cancel Appointment</button>
                                </div>
                            </li>
                        `;
                        $('#task-blog').append(taskItem);
                    });
                    // Initially show only the first 3 task items
                    $('.task-item').slice(3).hide();
                    // Check if there are no appointments
                    if (response.appointments.length === 0) {
                        $('#task-blog').append('<li>No upcoming appointments</li>');
                        $('h5').hide(); // Hide the <h5> button
                    } else if (response.appointments.length <= 3) {
                        $('h5').hide();
                    } else {
                        $('h5').on('click', function() {
                            $('.task-item').slice(3).toggle();
                            $(this).text($(this).text() === 'View all upcoming appointments' ? 'Minimize appointment list' : 'View all upcoming appointments');
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.log('Error fetching appointments:', error);
            }
        });
        
        function cancelAppointment(appointmentId) {
            const newStatus = 'Canceled';

            fetch('assets/php/update-assignment-status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ appointmentId: appointmentId, newStatus: newStatus }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === "Assignment status updated successfully") {
                    alert('Appointment cancelled successfully.');
                    // Optionally, refresh the page or update the UI to reflect the cancellation
                } else {
                    alert('Error cancelling appointment.');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        function appointmentDetails(appointmentId) {
            // Store appointmentId in local storage
            localStorage.setItem('appointmentId', appointmentId);
            // Redirect to the appointment-details.php
            window.location.href = 'appointment-details.php';
        }
        
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
    </script>
	</body>
</html>