<?php include 'assets/php/check-access.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Partner Dashboard</title>
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
            z-index: 1050; /* Higher z-index to be on top */
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
            margin: 15% auto; /* Center horizontally */
            padding: 20px; /* Reduce padding */
            border: 1px solid #888;
            width: 50%; /* Reduce width */
            text-align: center; /* Center text and content */
        }
        
        .modal-content h2, .modal-content p {
            margin: 0 auto; /* Center horizontally */
            padding: 10px; /* Add padding for better spacing */
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
            justify-content: space-between;
            align-items: center;
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

        #start-job-button {
            position: absolute;
            top: 50%;
            right: 50px; /* Adjust the distance from the right edge */
            transform: translateY(-50%);
            background-color: #4F8E35;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .task-item .photo-container {
            float: right;
            width: 300px; /* Adjust width as needed */
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .task-item img {
            max-width: 100px; /* Adjust based on your needs */
            margin-right: 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .task-item img:hover {
            transform: scale(1.05);
        }

        /* Responsive styles */
        body {
            font-size: 16px; /* Adjust base font size */
        }

        @media (max-width: 768px) {
            body {
                font-size: 14px; /* Smaller font size for mobile devices */
            }

            .notification-box, .data-insights, .task-item {
                flex-direction: column; /* Stack elements vertically on smaller screens */
                padding: 10px;
            }

            .modal-content {
                width: 90%; /* Increase width for smaller screens */
            }

            .logout-button {
                position: static; /* Adjust position for mobile */
                width: 100%;
                margin-top: 20px;
                margin-left: 15px;
            }

            .jotform-submit, .close {
                padding: 15px 30px; /* Larger touch targets */
                font-size: 18px; /* Larger font size for readability */
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

        img {
            max-width: 100%; /* Ensure images are responsive */
            height: auto; /* Maintain aspect ratio */
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
            
            .fc .fc-button-group>* {
                margin: 0 0 10px -1px;
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
        
        #issueCommentBox {
            width: 90%;
            height: 100px;
            margin: 10px auto;
            display: block;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
                <!-- Loaded from JavaScript -->
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
                <h1>Welcome, </h1>
            </header>
            <div class="main-content">
                <div class="jotform-section">
					<h3>Today's Bookings</h3>
                    <div class="task-list">
                        <ul id="task-blog">
                            <!-- Appointments will be appended here -->
                        </ul>
                    </div>
                    <a href="#"><h5>View all upcoming appointments</h5></a>
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
          <p id="eventNotes"></p>
       </div>
    </div>
    
    <div id="reportIssueModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
            <h2>Report an Issue</h2>
            <form id="issueForm">
                <label><input type="radio" name="issueType" value="InclementWeather"> Inclement weather</label><br>
                <label><input type="radio" name="issueType" value="Emergency"> Emergency</label><br>
                <label><input type="radio" name="issueType" value="EquipmentMalfunction"> Equipment malfunction</label><br>
                <label><input type="radio" name="issueType" value="Other"> Other</label><br>
    
                <div id="detailBox" style="display:none;">
                    <textarea id="issueCommentBox" placeholder="Describe your situation in detail"></textarea>
                </div>
                
                <div id="rescheduleSection" style="display:none;">
                    <h4>Will this require an appointment reschedule?</h4>
                    <label><input type="radio" name="reschedule" value="yes"> Yes</label><br>
                    <label><input type="radio" name="reschedule" value="no"> No</label><br>
                </div>
                
                <br>
                <div id="rescheduleDateTime" style="display:none;">
                    <input type="datetime-local" id="rescheduleTime">
                </div>
                
                <br>
                <button type="button" class="jotform-submit" onclick="submitIssueReport()">Submit</button>
            </form>
        </div>
    </div>
    <div class="mobile-sidebar">
        <ul class="nav">
            <!-- Loaded from JavaScript -->
        </ul>
        <a href="assets/php/logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    <script>
        $(document).ready(function() {
            var isMobile = window.matchMedia("only screen and (max-width: 768px)").matches;

            $('.fullCalendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultView: isMobile ? 'basicWeek' : 'month',
                events: 'assets/php/partner-calendar.php',
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
            descriptionElement.innerHTML = event.description; // Changed to innerHTML to correctly render HTML tags

            // Show the modal
            modal.style.display = 'block';
        }

        // Add this at the bottom of the script
        const closeModalButton = document.getElementsByClassName('close')[0];
        closeModalButton.onclick = function () {
            const modal = document.getElementById('eventModal');
            modal.style.display = 'none';
        };

        // Fetch appointments for the logged-in user and display in the task-list
        $.ajax({
            url: 'assets/php/partner-appointments.php',
            method: 'GET',
            dataType: 'json', // Explicitly expecting JSON response
            success: function(response) {
                console.log(response); // Debugging line to inspect the response
                if (response && response.appointments && Array.isArray(response.appointments)) {
                    response.appointments.forEach(appointment => {
                        console.log(appointment);  // Debugging line to inspect appointment data
                        console.log(appointment.photos);  // Add this line to log the photo array
                        const totalAmount = parseFloat(appointment.bid) + parseFloat(appointment.tip);
                        const taskItem = `
                            <li class="task-item">
                                <div>
                                    <h3>${appointment.time} - ${appointment.serviceType}</h3>
                                    <p>Client: ${appointment.client}</p>
                                    <p>Address: ${appointment.street}, ${appointment.city}, ${appointment.ST} ${appointment.zip}</p>
                                    <p>Size: ${appointment.size || 'None'}</p>
                                    <p>State: ${appointment.state || 'None'}</p>
                                    <p>Surface: ${appointment.surface || 'None'}</p>
                                    <p>Terrain: ${appointment.terrain || 'None'}</p>
                                    <p>Additional Info: ${appointment.additionalInfo || 'None'}</p>
                                    <p>Payout: $${appointment.bid} + $${appointment.tip} Tip = $${totalAmount.toFixed(2)} Total</p>
                                    <p><a href="#" onclick="document.getElementById('reportIssueModal').style.display='block'">Report Issue</a></p>
                                    <br>
                                    <button class="jotform-submit" onclick="startJob('${appointment.appointmentId}')">Start Job</button>
                                </div>
                                <br>
                                <div class="photo-container">
                                    ${appointment.photos && appointment.photos[0] ? appointment.photos.map(photo => `<img src="/assets/php/${photo}" alt="Uploaded Photo">`).join('') : '<p>No photos available.</p>'}
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

        function startJob(appointmentId) {
            sessionStorage.setItem('appointmentId', appointmentId);
            window.location.href = 'start-appointment.php';
             submitOrderStatus('Headed to Location', appointmentId)
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetch('assets/php/partnerVerification.php')
            .then(response => response.json())
            .then(data => {
                const nav = document.querySelector('.nav');
                const mobileNav = document.querySelector('.mobile-sidebar .nav'); // Select the mobile nav

                // Initialize navContent with an empty string or default content
                let navContent = `
                    <li><a href="partner.php"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="bookings.php"><i class="fas fa-book"></i> Bookings</a></li>
                    <li><a href="sub-list.php"><i class="fas fa-file-alt"></i> Subscriber List</a></li>
                    <li><a href="work-history.php"><i class="fas fa-history"></i> Work History</a></li>
                    <li><a href="partner-settings.php"><i class="fas fa-cogs"></i> Settings</a></li>
                `;

                if (data.approved === 'No') {
                    navContent = `
                        <li><a href="partner.php"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li><a href="partner-settings.php"><i class="fas fa-cogs"></i> Settings</a></li>
                    `;
                }
                
                nav.innerHTML = navContent;
                mobileNav.innerHTML = navContent; // Update mobile nav

                // Properly chain the second fetch call
                return fetch('assets/php/checkOrderStatus.php');
            })
            .then(response => response.json())
            .then(data => {
                if (data.hasActiveStatus) {
                    const nav = document.querySelector('.nav');
                    const mobileNav = document.querySelector('.mobile-sidebar .nav'); // Select the mobile nav

                    let navContent = `
                        <li><a href="partner.php"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li><a href="start-appointment.php"><i class="fas fa-play"></i> Start Appointment</a></li>
                    `;

                    nav.innerHTML = navContent;
                    mobileNav.innerHTML = navContent; // Update mobile nav
                }
            })
            .catch(error => console.error('Error:', error));

            document.querySelector('#task-blog').addEventListener('click', function(event) {
                if (event.target.tagName === 'IMG' && event.target.parentElement.classList.contains('photo-container')) {
                    enlargeImage(event.target.src);
                }
            });

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
        
        function submitOrderStatus(newStatus, appointmentId) {
            const orderStatus = newStatus || document.getElementById('orderStatus').value;
    
            fetch('assets/php/update-assignment-status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ appointmentId: appointmentId, newStatus: orderStatus }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === "Assignment status updated successfully") {
                    alert('Order status updated successfully.');
                } else {
                    alert('Error updating order status.');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            var reportIssueLink = document.querySelector('a[href="#"]');
            var closeButton = document.querySelectorAll('.close');
            var modal = document.getElementById("reportIssueModal");
            var issueTypeRadios = document.getElementsByName('issueType');
            var rescheduleRadios = document.getElementsByName('reschedule');

            reportIssueLink.addEventListener('click', function() {
                modal.style.display = "block";
            });

            closeButton.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    this.parentElement.parentElement.style.display = 'none';
                });
            });

            issueTypeRadios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    var detailBox = document.getElementById('detailBox');
                    var rescheduleSection = document.getElementById('rescheduleSection');
                    if (this.value === "Emergency" || this.value === "EquipmentMalfunction" || this.value === "Other") {
                        detailBox.style.display = 'block';
                        document.getElementById('issueCommentBox').placeholder = "Describe your situation in detail";
                    } else {
                        detailBox.style.display = 'none';
                    }
                    rescheduleSection.style.display = 'block';
                });
            });

            rescheduleRadios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    var rescheduleDateTime = document.getElementById('rescheduleDateTime');
                    if (this.value === "yes") {
                        rescheduleDateTime.style.display = 'block';
                    } else {
                        rescheduleDateTime.style.display = 'none';
                    }
                });
            });

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });

        function submitIssueReport(appointmentId) {
            const issueType = document.querySelector('input[name="issueType"]:checked').value;
            const message = document.getElementById('issueCommentBox').value;
            const reschedule = document.querySelector('input[name="reschedule"]:checked').value;
            const rescheduleTime = reschedule === "yes" ? document.getElementById('rescheduleTime').value : "This will not require a reschedule";

            const fullMessage = `${issueType} - ${message}. ${reschedule === "yes" ? "This provider will like to reschedule the appointment for - " + rescheduleTime : "This will not require a reschedule"}`;

                // Now, use appointmentId to submit the issue
                fetch('assets/php/submitIssue.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ appointmentId: appointmentId, message: fullMessage }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Issue reported successfully.');
                        document.getElementById("reportIssueModal").style.display = "none";
                    } else {
                        alert('Error reporting the issue.');
                    }
                });
        }
    </script>
</body>
</html>