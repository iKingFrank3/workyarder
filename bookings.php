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

        .notification-boxes,
        .notification-boxes-requests {
            display: flex;
            justify-content: flex-start; /* Adjust to align items from the start */
            flex-wrap: wrap; /* Allow boxes to wrap to next line */
            margin-bottom: 30px;
        }

        .notification-box {
            flex: 0 0 225px; /* Fixed width */
            margin: 0 10px 20px 0; /* Consistent margin for spacing */
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

        .description {
            text-align: left;
        }

        .week-calendar {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background-color: #f2f2f2;
        }

        .day {
            flex: 1;
            text-align: center;
            padding: 10px;
            background-color: #e6e6e6;
            margin: 2px;
            border-radius: 5px;
        }

        /* New styles for time inputs */
        .time-input {
            margin-top: 10px;
        }

        .time-input label {
            display: block;
            margin-bottom: 5px;
        }

        .time-input input[type="time"] {
            width: 80%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .notification-boxes .view-all {
            margin-top: 150px; /* Adjust this value as needed for spacing */
        }

        #save-submit {
            display: block;
            margin: 0 auto;
            text-align: center;
        }
        
        .day-navigation{
            margin-top: 15px;
        }

        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 40%; /* Could be more or less, depending on screen size */
            text-align: center;
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
        
        .box-header {
            text-align: center;
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

        /* Initially hide the logo */
        .mobile-logo {
            display: none;
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

        .mobile-instruction {
            display: none; /* Hide by default */
        }

        /* Show the logo only on screens smaller than 768px */
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

            .mobile-logo {
                display: block;
                width: 50%;
                margin-right: 70px;
            }
            
            .logout-button {
                position: static; /* Adjust position for mobile */
                width: 100%;
                margin-top: 20px;
                margin-left: 15px;
            }

            .week-calendar {
                overflow-x: auto; /* Allows horizontal scrolling */
                display: flex;
                flex-wrap: nowrap; /* Prevents wrapping of items */
            }

            .day {
                flex: 0 0 33.33%; /* Each day takes one-third of the space */
                display: inline-block; /* Ensures items line up horizontally */
                margin-bottom: 10px;
                box-sizing: border-box; /* Includes padding and border in the element's total width */
            }

            .notification-box {
                flex: 0 0 48%; /* Two boxes per row on small screens */
                margin-right: 2%;
            }

            .notification-boxes {
                justify-content: space-between;
            }

            .time-input label[for$='-start-time']::after {
                content: 'Start';
            }
            .time-input label[for$='-end-time']::after {
                content: 'End';
            }
            .time-input label {
                font-size: 0; /* Hide original text */
            }
            .time-input label::after {
                font-size: 16px; /* Reset font size for new text */
            }
            .mobile-instruction {
                display: block; /* Hide by default */
            }
            
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
            }
    
            footer {
                margin-top: auto;
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
                <li><a href="partner.php"><i class="fas fa-home"></i> Dashboard</a></li>
				<li><a href="bookings.php"><i class="fas fa-book"></i> Bookings</a></li>
				<li><a href="sub-list.php"><i class="fas fa-file-alt"></i> Subscriber List</a></li>
				<li><a href="work-history.php"><i class="fas fa-history"></i> Work History</a></li>
				<li><a href="partner-settings.php"><i class="fas fa-cogs"></i> Settings</a></li>
			</ul>
			<a href="assets/php/logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="mobile-sidebar">
            <ul class="nav">
                <li><a href="partner.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="bookings.php"><i class="fas fa-book"></i> Bookings</a></li>
                <li><a href="sub-list.php"><i class="fas fa-file-alt"></i> Subscriber List</a></li>
                <li><a href="work-history.php"><i class="fas fa-history"></i> Work History</a></li>
                <li><a href="partner-settings.php"><i class="fas fa-cogs"></i> Settings</a></li>
            </ul>
            <a href="assets/php/logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="content">
            <header>
                <h1>Bookings and Requests</h1>
            </header>
            <div class="main-content">
                <form method="POST" action="assets/php/availability.php">
                    <div class="jotform-section">
                        <h3>Set Availability</h3>
                        <p class="mobile-instruction" style="font-size: 13px;">Please scroll and update your availability for each day</p>
                        <div class="week-calendar">
                            <div class="day" id="sunday">
                                <h4>Sun</h4>
                                <div class="time-input">
                                    <label for="sunday-start-time"  class="desktop-label">Start Time:</label>
                                    <input type="time" id="sunday-start-time" name="sunday-start-time">
                                </div>
                                <div class="time-input">
                                    <label for="sunday-end-time" class="desktop-label">End Time:</label>
                                    <input type="time" id="sunday-end-time" name="sunday-end-time">
                                </div>
                                <br>
                                <button type="button" class="jotform-submit none-button">None</button>
                            </div>
                            <div class="day" id="monday">
                                <h4>Mon</h4>
                                <div class="time-input">
                                    <label for="monday-start-time" class="desktop-label">Start Time:</label>
                                    <input type="time" id="monday-start-time" name="monday-start-time">
                                </div>
                                <div class="time-input">
                                    <label for="monday-end-time" class="desktop-label">End Time:</label>
                                    <input type="time" id="monday-end-time" name="monday-end-time">
                                </div>
                                <br>
                                <button type="button" class="jotform-submit none-button">None</button>
                            </div>
                            <div class="day" id="tuesday">
                                <h4>Tue</h4>
                                <div class="time-input">
                                    <label for="tuesday-start-time" class="desktop-label">Start Time:</label>
                                    <input type="time" id="tuesday-start-time" name="tuesday-start-time">
                                </div>
                                <div class="time-input">
                                    <label for="tuesday-end-time" class="desktop-label">End Time:</label>
                                    <input type="time" id="tuesday-end-time" name="tuesday-end-time">
                                </div>
                                <br>
                                <button type="button" class="jotform-submit none-button">None</button>
                            </div>
                            <div class="day" id="wednesday">
                                <h4>Wed</h4>
                                <div class="time-input">
                                    <label for="wednesday-start-time" class="desktop-label">Start Time:</label>
                                    <input type="time" id="wednesday-start-time" name="wednesday-start-time">
                                </div>
                                <div class="time-input">
                                    <label for="wednesday-end-time" class="desktop-label">End Time:</label>
                                    <input type="time" id="wednesday-end-time" name="wednesday-end-time">
                                </div>
                                <br>
                                <button type="button" class="jotform-submit none-button">None</button>
                            </div>
                            <div class="day" id="thursday">
                                <h4>Thu</h4>
                                <div class="time-input">
                                    <label for="thursday-start-time" class="desktop-label">Start Time:</label>
                                    <input type="time" id="thursday-start-time" name="thursday-start-time">
                                </div>
                                <div class="time-input">
                                    <label for="thursday-end-time" class="desktop-label">End Time:</label>
                                    <input type="time" id="thursday-end-time" name="thursday-end-time">
                                </div>
                                <br>
                                <button type="button" class="jotform-submit none-button">None</button>
                            </div>
                            <div class="day" id="friday">
                                <h4>Fri</h4>
                                <div class="time-input">
                                    <label for="friday-start-time" class="desktop-label">Start Time:</label>
                                    <input type="time" id="friday-start-time" name="friday-start-time">
                                </div>
                                <div class="time-input">
                                    <label for="friday-end-time" class="desktop-label">End Time:</label>
                                    <input type="time" id="friday-end-time" name="friday-end-time">
                                </div>
                                <br>
                                <button type="button" class="jotform-submit none-button">None</button>
                            </div>
                            <div class="day" id="saturday">
                                <h4>Sat</h4>
                                <div class="time-input">
                                    <label for="saturday-start-time" class="desktop-label">Start Time:</label>
                                    <input type="time" id="saturday-start-time" name="saturday-start-time">
                                </div>
                                <div class="time-input">
                                    <label for="saturday-end-time" class="desktop-label">End Time:</label>
                                    <input type="time" id="saturday-end-time" name="saturday-end-time">
                                </div>
                                <br>
                                <button type="button" class="jotform-submit none-button">None</button>
                            </div>
                        </div>
                        <br>
                        <br>
                        <button id="save-submit" type="submit" class="jotform-submit">Save Availability</button>
                    </div>
                </form>

                <div class="jotform-section">
                    <h3>WorkYarder Gigs</h3>
                    <div class="notification-boxes">
                    </div>
                    <button id="prevButton" class="jotform-submit" style="float: left;">Previous</button>
                    <button id="nextButton" class="jotform-submit" style="float: right;">Next</button>
                    <br>
                    <br>
                </div>

                <div class="jotform-section">
                    <h3>Booking Requests</h3>
                    <div class="notification-boxes-requests">
                    </div>
                    <button id="prevButtonRequests" class="jotform-submit" style="float: left;">Previous</button>
                    <button id="nextButtonRequests" class="jotform-submit" style="float: right;">Next</button>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <!-- Add modal HTML structure for Appointment Details -->
    <div id="appointmentDetailsModal" class="modal">
       <div class="modal-content">
          <span class="close">&times;</span>
          <h2 id="appointmentTitle"></h2>
          <p id="appointmentDescription"></p>
          <!-- Add more elements here as needed to display all appointment details -->
       </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentPage = 1;
            const itemsPerPage = window.innerWidth <= 768 ? 1 : 3;
            let appointments = []; // Assuming this will hold the fetched appointments

            function updatePaginationButtons() {
                document.getElementById('prevButton').style.display = currentPage === 1 ? 'none' : 'block';
                document.getElementById('nextButton').style.display = (currentPage * itemsPerPage) >= appointments.length ? 'none' : 'block';
            }

            fetch('assets/php/availability.php')
            .then(response => response.json())
            .then(data => {
                // Populate the form with the fetched data
                Object.keys(data).forEach(day => {
                    document.getElementById(day + '-start-time').value = data[day].start_time;
                    document.getElementById(day + '-end-time').value = data[day].end_time;
                });
            });

            // Optional: Handle form submission via JavaScript for a better user experience
            const form = document.querySelector('form');
            form.onsubmit = function(event) {
                event.preventDefault();
                const formData = new FormData(form);
                fetch('assets/php/availability.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(result => {
                    alert('Availability saved successfully');
                    // Reload or further actions
                })
                .catch(error => console.error('Error:', error));
            };

            fetch('assets/php/list-appointments.php')
            .then(response => response.json())
            .then(data => {
                appointments = data; // Store fetched appointments
                const container = document.querySelector('.notification-boxes');
                container.innerHTML = ''; // Clear existing appointments
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, appointments.length);
                appointments.slice(startIndex, endIndex).forEach(appointment => {
                    const totalAmount = parseFloat(appointment.bid) + parseFloat(appointment.tip);
                    const box = document.createElement('div');
                    box.className = 'notification-box';
                    box.innerHTML = `
                        <div class="box-header">
                            <h3>${appointment.service_type}</h3>
                            <h5>Date: ${formatDate(appointment.date)} Time: ${appointment.time}</h5>
                            <p class="description">
                                ${appointment.property_type}<br>
                                Location: ${appointment.city}, ${appointment.state} ${appointment.zip_code}<br>
                                ${dynamicSizeDescription(appointment)}<br>
                                Bid: $${appointment.bid}<br>
                                Tip: $${appointment.tip}<br>
                                Total: $${totalAmount.toFixed(2)}<br>
                                <br> <a href="#">View More<a>
                            </p>
                            <button class="jotform-submit" data-appointment-id="${appointment.appointment_id}">Accept</button>
                        </div>
                    `;
                    container.appendChild(box);

                    // Adding event listener for View More to open modal with appointment details
                    const viewMore = box.querySelector('a'); // Using description as a trigger for now
                    viewMore.addEventListener('click', function() {
                        const modal = document.getElementById('appointmentDetailsModal');
                        const titleElement = document.getElementById('appointmentTitle');
                        const descriptionElement = document.getElementById('appointmentDescription');
                        
                        // Populate modal with appointment details
                        titleElement.textContent = `${appointment.service_type} on ${formatDate(appointment.date)} at ${appointment.time}`;
                        descriptionElement.innerHTML = `${appointment.property_type}<br>
                                                        Location: ${appointment.city}, ${appointment.state} ${appointment.zip_code}<br>
                                                        ${dynamicSizeDescription(appointment)}<br>
                                                        ${appointment.lawn_state}<br>
                                                        ${appointment.surface}<br>
                                                        ${appointment.terrain}<br>
                                                        ${appointment.speed}<br>
                                                        Bid: $${appointment.bid}<br>
                                                        Tip: $${appointment.tip}<br>
                                                        Total: $${totalAmount.toFixed(2)}<br>
                                                        <br>
                                                        Notes: ${appointment.notes}<br>
                                                        <br>
                                                        <button class='jotform-submit' data-appointment-id='${appointment.appointment_id}'>Accept</button>`; // Added Accept button
                        
                        // Show the modal
                        modal.style.display = 'block';
                    });
                });
                updatePaginationButtons();
            })
            .catch(error => console.error('Error:', error));

            document.getElementById('prevButton').addEventListener('click', function(event) {
                event.stopPropagation(); // Stop the event from bubbling up
                currentPage = Math.max(1, currentPage - 1);
                updatePaginationButtons();
                const container = document.querySelector('.notification-boxes');
                container.innerHTML = ''; // Clear existing appointments
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, appointments.length);
                appointments.slice(startIndex, endIndex).forEach(appointment => {
                    const totalAmount = parseFloat(appointment.bid) + parseFloat(appointment.tip);
                    const box = document.createElement('div');
                    box.className = 'notification-box';
                    box.innerHTML = `
                        <div class="box-header">
                            <h3>${appointment.service_type}</h3>
                            <h5>Date: ${formatDate(appointment.date)} Time: ${appointment.time}</h5>
                            <p class="description">
                                ${appointment.property_type}<br>
                                Location: ${appointment.city}, ${appointment.state} ${appointment.zip_code}<br>
                                ${dynamicSizeDescription(appointment)}<br>
                                Bid: $${appointment.bid}<br>
                                Tip: $${appointment.tip}<br>
                                Total: $${totalAmount.toFixed(2)}<br>
                                <br> <a href="#">View More<a>
                            </p>
                            <button class="jotform-submit" data-appointment-id="${appointment.appointment_id}">Accept</button>
                        </div>
                    `;
                    container.appendChild(box);

                    // Adding event listener for View More to open modal with appointment details
                    const viewMore = box.querySelector('a'); // Using description as a trigger for now
                    viewMore.addEventListener('click', function() {
                        const modal = document.getElementById('appointmentDetailsModal');
                        const titleElement = document.getElementById('appointmentTitle');
                        const descriptionElement = document.getElementById('appointmentDescription');
                        
                        // Populate modal with appointment details
                        titleElement.textContent = `${appointment.service_type} on ${formatDate(appointment.date)} at ${appointment.time}`;
                        descriptionElement.innerHTML = `${appointment.property_type}<br>
                                                        Location: ${appointment.city}, ${appointment.state} ${appointment.zip_code}<br>
                                                        ${dynamicSizeDescription(appointment)}<br>
                                                        ${appointment.lawn_state}<br>
                                                        ${appointment.surface}<br>
                                                        ${appointment.terrain}<br>
                                                        ${appointment.speed}<br>
                                                        Bid: $${appointment.bid}<br>
                                                        Tip: $${appointment.tip}<br>
                                                        Total: $${totalAmount.toFixed(2)}<br>
                                                        <br>
                                                        Notes: ${appointment.notes}<br>
                                                        <br>
                                                        <button class='jotform-submit' data-appointment-id='${appointment.appointment_id}'>Accept</button>`; // Added Accept button
                        
                        // Show the modal
                        modal.style.display = 'block';
                    });
                });
            });

            document.getElementById('nextButton').addEventListener('click', function(event) {
                event.stopPropagation(); // Stop the event from bubbling up
                currentPage++; // Increment currentPage
                updatePaginationButtons();
                const container = document.querySelector('.notification-boxes');
                container.innerHTML = ''; // Clear existing appointments
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = Math.min(startIndex + itemsPerPage, appointments.length);
                appointments.slice(startIndex, endIndex).forEach(appointment => {
                    const totalAmount = parseFloat(appointment.bid) + parseFloat(appointment.tip);
                    const box = document.createElement('div');
                    box.className = 'notification-box';
                    box.innerHTML = `
                        <div class="box-header">
                            <h3>${appointment.service_type}</h3>
                            <h5>Date: ${formatDate(appointment.date)} Time: ${appointment.time}</h5>
                            <p class="description">
                                ${appointment.property_type}<br>
                                Location: ${appointment.city}, ${appointment.state} ${appointment.zip_code}<br>
                                ${dynamicSizeDescription(appointment)}<br>
                                Bid: $${appointment.bid}<br>
                                Tip: $${appointment.tip}<br>
                                Total: $${totalAmount.toFixed(2)}<br>
                                <br> <a href="#">View More<a>
                            </p>
                            <button class="jotform-submit" data-appointment-id="${appointment.appointment_id}">Accept</button>
                        </div>
                    `;
                    container.appendChild(box);

                    // Adding event listener for View More to open modal with appointment details
                    const viewMore = box.querySelector('a'); // Using description as a trigger for now
                    viewMore.addEventListener('click', function() {
                        const modal = document.getElementById('appointmentDetailsModal');
                        const titleElement = document.getElementById('appointmentTitle');
                        const descriptionElement = document.getElementById('appointmentDescription');
                        
                        // Populate modal with appointment details
                        titleElement.textContent = `${appointment.service_type} on ${formatDate(appointment.date)} at ${appointment.time}`;
                        descriptionElement.innerHTML = `${appointment.property_type}<br>
                                                        Location: ${appointment.city}, ${appointment.state} ${appointment.zip_code}<br>
                                                        ${dynamicSizeDescription(appointment)}<br>
                                                        ${appointment.lawn_state}<br>
                                                        ${appointment.surface}<br>
                                                        ${appointment.terrain}<br>
                                                        ${appointment.speed}<br>
                                                        Bid: $${appointment.bid}<br>
                                                        Tip: $${appointment.tip}<br>
                                                        Total: $${totalAmount.toFixed(2)}<br>
                                                        <br>
                                                        Notes: ${appointment.notes}<br>
                                                        <br>
                                                        <button class='jotform-submit' data-appointment-id='${appointment.appointment_id}'>Accept</button>`; // Added Accept button
                        
                        // Show the modal
                        modal.style.display = 'block';
                    });
                });
            });

            // Close modal functionality
            const closeModal = document.getElementsByClassName('close')[0]; // Adjust if you have more close buttons
            closeModal.onclick = function() {
                const modal = document.getElementById('appointmentDetailsModal');
                modal.style.display = 'none';
            };

            // Delegate event for dynamically added Accept buttons
            document.body.addEventListener('click', function(event) {
                if (event.target.classList.contains('jotform-submit')) {
                    const appointmentId = event.target.getAttribute('data-appointment-id');
                    if (appointmentId) {
                        acceptAppointment(appointmentId);
                    }
                }
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

        document.addEventListener('DOMContentLoaded', function() {
            let currentDayIndex = 0;
            const daysToShow = window.innerWidth <= 768 ? 3 : 7;
            const days = document.querySelectorAll('.day');

            function updateDayVisibility() {
                days.forEach((day, index) => {
                    day.style.display = (index >= currentDayIndex && index < currentDayIndex + daysToShow) ? 'block' : 'none';
                });
            }

            document.getElementById('prevDay').addEventListener('click', function() {
                currentDayIndex = Math.max(0, currentDayIndex - 1);
                updateDayVisibility();
            });

            document.getElementById('nextDay').addEventListener('click', function() {
                currentDayIndex = Math.min(days.length - daysToShow, currentDayIndex + 1);
                updateDayVisibility();
            });

            updateDayVisibility();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const noneButtons = document.querySelectorAll('.none-button');

            noneButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation(); // Stop the event from bubbling up
                    
                    const dayContainer = this.closest('.day');
                    const startTimeInput = dayContainer.querySelector('[id$="-start-time"]');
                    const endTimeInput = dayContainer.querySelector('[id$="-end-time"]');

                    if (this.textContent === "None") {
                        // Disable inputs and set time to '00:00:00'
                        startTimeInput.value = '00:00';
                        endTimeInput.value = '00:00';
                        startTimeInput.disabled = true;
                        endTimeInput.disabled = true;
                        this.textContent = "Add";
                    } else {
                        // Enable inputs and set time to '07:00' to '19:00'
                        startTimeInput.value = '07:00';
                        endTimeInput.value = '19:00';
                        startTimeInput.disabled = false;
                        endTimeInput.disabled = false;
                        this.textContent = "None";
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            let currentPageRequests = 1;
            const itemsPerPageRequests = window.innerWidth <= 768 ? 1 : 3;
            let bookingRequests = [];

            function updatePaginationButtonsRequests() {
                document.getElementById('prevButtonRequests').style.display = currentPageRequests === 1 ? 'none' : 'block';
                document.getElementById('nextButtonRequests').style.display = (currentPageRequests * itemsPerPageRequests) >= bookingRequests.length ? 'none' : 'block';
            }

            fetch('assets/php/list-booking-requests.php')
            .then(response => response.json())
            .then(data => {
                bookingRequests = data;
                updateBookingRequestsDisplay();
            })
            .catch(error => console.error('Error:', error));

            function updateBookingRequestsDisplay() {
                const containerRequests = document.querySelector('.notification-boxes-requests');
                containerRequests.innerHTML = '';
                const startIndex = (currentPageRequests - 1) * itemsPerPageRequests;
                const endIndex = Math.min(startIndex + itemsPerPageRequests, bookingRequests.length);
                bookingRequests.slice(startIndex, endIndex).forEach(request => {
                    const totalAmount = parseFloat(request.bid) + parseFloat(request.tip);
                    const box = document.createElement('div');
                    box.className = 'notification-box';
                    box.innerHTML = `
                        <div class="box-header">
                            <h3>${request.service_type}</h3>
                            <h5>Date: ${formatDate(request.date)} Time: ${request.time}</h5>
                            <p class="description">
                                ${request.property_type}<br>
                                Location: ${request.city}, ${request.state} ${request.zip_code}<br>
                                ${dynamicSizeDescription(request)}<br>
                                Bid: $${request.bid}<br>
                                Tip: $${request.tip}<br>
                                Total: $${totalAmount.toFixed(2)}<br>
                                <br> <a href="#">View More<a>
                            </p>
                            <button class="jotform-submit" data-appointment-id="${request.appointment_id}">Accept</button>
                        </div>
                    `;
                    containerRequests.appendChild(box);

                    // Adding event listener for View More to open modal with appointment details
                    const viewMore = box.querySelector('a'); // Using description as a trigger for now
                    viewMore.addEventListener('click', function() {
                        const modal = document.getElementById('appointmentDetailsModal');
                        const titleElement = document.getElementById('appointmentTitle');
                        const descriptionElement = document.getElementById('appointmentDescription');
                        
                        // Populate modal with appointment details
                        titleElement.textContent = `${request.service_type} on ${formatDate(request.date)} at ${request.time}`; // Example, adjust based on actual data structure
                        descriptionElement.innerHTML = `${request.property_type}<br>
                                                        Location: ${request.city}, ${request.state} ${request.zip_code}<br>
                                                        ${dynamicSizeDescription(request)}<br>
                                                        ${request.lawn_state}<br>
                                                        ${request.surface}<br>
                                                        ${request.terrain}<br>
                                                        ${request.speed}<br>
                                                        Bid: $${request.bid}<br>
                                                        Tip: $${request.tip}<br>
                                                        Total: $${totalAmount.toFixed(2)}<br>
                                                        <br>
                                                        Notes: ${request.notes}<br>
                                                        <br>
                                                        <button class='jotform-submit' data-appointment-id='${request.appointment_id}'>Accept</button>`; // Added Accept button
                        
                        // Show the modal
                        modal.style.display = 'block';
                    });
                });
                updatePaginationButtonsRequests();
            }

            document.getElementById('prevButtonRequests').addEventListener('click', function() {
                event.stopPropagation(); // Stop the event from propagating to child elements
                currentPageRequests = Math.max(1, currentPageRequests - 1);
                updateBookingRequestsDisplay();
            });

            document.getElementById('nextButtonRequests').addEventListener('click', function() {
                event.stopPropagation(); // Stop the event from propagating to child elements
                currentPageRequests++;
                updateBookingRequestsDisplay();
            });
        });

        function formatDate(dateStr) {
            const date = new Date(dateStr);
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }
        
        function dynamicSizeDescription(appointment) {
            if (['Pool Maintenance', 'Pool Opening', 'Pool Closing', 'Pool Diagnostic'].includes(appointment.service_type)) {
                return `${appointment.size} gallons`;
            } else if (['Simple Cut', 'Leaf Removal', 'Snow Removal'].includes(appointment.service_type)) {
                return `${appointment.size} acres`;
            } else if (['Pressure Washing'].includes(appointment.service_type)) {
                return `${appointment.size} sq ft`;
            } else if (['Gutter Cleaning'].includes(appointment.service_type)) {
                return `${appointment.size} lin ft`;
            } else if (['Dumpster Cleaning'].includes(appointment.service_type)) {
                return `${appointment.size} dumpster`;
            } else {
                return ` `;
            }
        }
        
        function dynamicSizeDescription(request) {
            if (['Pool Maintenance', 'Pool Opening', 'Pool Closing', 'Pool Diagnostic'].includes(request.service_type)) {
                return `${request.size} gallons`;
            } else if (['Simple Cut', 'Leaf Removal', 'Snow Removal'].includes(request.service_type)) {
                return `${request.size} acres`;
            } else if (['Pressure Washing'].includes(request.service_type)) {
                return `${request.size} sq ft`;
            } else if (['Gutter Cleaning'].includes(request.service_type)) {
                return `${request.size} lin ft`;
            } else if (['Dumpster Cleaning'].includes(request.service_type)) {
                return `${request.size} dumpster`;
            } else {
                return ` `;
            }
        }

        function acceptAppointment(appointmentId) {
            fetch('assets/php/accept_task.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `appointmentId=${appointmentId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Appointment accepted successfully');
                    // Optionally, refresh the page or update the UI accordingly
                } else {
                    alert('Error accepting appointment');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>