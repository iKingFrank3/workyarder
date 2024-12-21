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
        
        #orderStatus{
            width: 25%;
        }
        
        .photo-gallery {
            flex-direction: column; /* Stack children vertically */
            align-items: center; /* Center-align items */
        }
        
        .photo-gallery .image-container {
            display: flex;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            justify-content: center; /* Center images horizontally */
        }
            
        .photo-gallery img {
            max-width: 50px; /* Adjust based on your needs */
            margin-right: 5px;
            border-radius: 5px;
        }
        .clickable-image {
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
                <h1>Owner Dashboard</h1>
            </header>
            <div class="main-content">
                <div class="jotform-section">
                    <h2>Lawn Bookings</h2>
                    <!-- Add a table or list of leads with sample data -->
                    <table class="leads-table lawn-bookings">
                        <thead>
                            <tr>
                                <th>Business Name</th>
                                <th>Clients Name</th>
                                <th>City, State</th>
                                <th>Date</th>
                                <th>Service Type</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add more lead entries -->
                        </tbody>
                    </table>
                </div>

                <br>

                <div class="jotform-section">
                    <h2>Pool Bookings</h2>
                    <!-- Add a table or list of leads with sample data -->
                    <table class="leads-table pool-bookings">
                        <thead>
                            <tr>
                                <th>Business Name</th>
                                <th>Clients Name</th>
                                <th>City, State</th>
                                <th>Date</th>
                                <th>Service Type</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add more lead entries -->
                        </tbody>
                    </table>
                </div>

                <br>

                <div class="jotform-section">
                    <h2>Pressure Washing Bookings</h2>
                    <!-- Add a table or list of leads with sample data -->
                    <table class="leads-table pressure-washing-bookings">
                        <thead>
                            <tr>
                                <th>Business Name</th>
                                <th>Clients Name</th>
                                <th>City, State</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>View</th>
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
    
    <!-- Add modal HTML structure -->
    <div id="eventModal" class="modal">
       <div class="modal-content">
          <span class="close">&times;</span>
          <h2 id="eventTitle"></h2>
          <div id="eventDescription"></div>
       </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('assets/php/fetchBookingData.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(appointment => {
                let tableBody;
                const allowedStatuses = ['Pending', 'In-Progress', 'Accepted', 'Requested', 'Headed to Location', 'Arrived', 'Reviewing'];

                if (allowedStatuses.includes(appointment.order_status)) {
                    if (appointment.business_id === 1 || appointment.business_name === 'WorkYarder Selected Provider') {
                        if (['Simple Cut', 'Leaf Removal', 'Snow Removal'].includes(appointment.service_type)) {
                            tableBody = document.querySelector('.lawn-bookings tbody');
                        } else if (['Pool Maintenance', 'Diagnostic', 'Pool Openings', 'Pool Closings'].includes(appointment.service_type)) {
                            tableBody = document.querySelector('.pool-bookings tbody');
                        } else if (['Gutter Cleaning', 'Dumpster Cleaning', 'Pressure Washing'].includes(appointment.service_type)) {
                            tableBody = document.querySelector('.pressure-washing-bookings tbody');
                        }
                    } else {
                        if (appointment.business_type) {
                            if (appointment.business_type === 'lawn-care') {
                                tableBody = document.querySelector('.lawn-bookings tbody');
                            } else if (appointment.business_type === 'pool-care') {
                                tableBody = document.querySelector('.pool-bookings tbody');
                            } else if (appointment.business_type === 'pw-care') {
                                tableBody = document.querySelector('.pressure-washing-bookings tbody');
                            }
                        }
                    }

                    if (tableBody) {
                        const row = `
                            <tr>
                                <td>${appointment.business_name}</td>
                                <td>${appointment.client_name}</td>
                                <td>${appointment.city_state}</td>
                                <td>${appointment.date}</td>
                                <td>${appointment.service_type}</td>
                                <td><button onclick="viewDetails(${appointment.appointment_id})">View</button></td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    }
                }
            });
        })
        .catch(error => console.error('Error:', error));
    });

    function viewDetails(appointmentId) {
        fetch(`assets/php/fetchBookingDetails.php?appointmentId=${appointmentId}`)
        .then(response => response.json())
        .then(data => {
            const modal = document.getElementById('eventModal');
            const title = document.getElementById('eventTitle');
            const description = document.getElementById('eventDescription');

            title.textContent = `Order Code: ${data.orderCode}`; // Ensure this matches the JSON property

            // Generate the order status dropdown with the current status selected
            const orderStatusOptions = ['Reviewing', 'Pending', 'Completed', 'Canceled'].map(status => 
                `<option value="${status}" ${data.orderStatus === status ? 'selected' : ''}>${status}</option>`
            ).join('');

            // Calculate the booking fee and full bid
            const bookingFee = data.quotePrice * 0.0575;
            const fullBid = data.quotePrice - bookingFee;

            description.innerHTML = `
                <div class="modal-section" style="text-align: center;">
                        <h1>Order Status: 
                            <select id="orderStatus" name="orderStatus" class="jotform-form-input">
                                ${orderStatusOptions}
                            </select>
                            &emsp;
                            <button class="jotform-submit" onclick="submitOrderStatus(${data.appointment_id})" style="display: inline-block;">Submit</button>
                        </h1>
                        <h2>Booking Information:</h2>
                        <p>Date: ${data.date}</p>
                        <p>Time: ${data.time}</p>
                        <p>Address: ${data.address}</p>
                        <p>Accessibility: ${data.accessibility}</p>
                        <p>Notes: ${data.clientNotes}</p>
                        <!-- Uploaded Photos Section -->
                        <div class="photo-gallery uploaded-photos">
                            <h4 style="text-align: center;">Customer Photo Submission</h4>
                            <div class="image-container">
                                ${data.uploadedPhotos.length > 0 ? data.uploadedPhotos.map(photo => `<img src="${photo}" alt="Customer Photo" class="clickable-image">`).join('') : '<p>No photos available.</p>'}
                            </div>
                        </div>
                        <br>
                        <p>Contact Method: ${data.contactMethod}</p>
                        <p>Contact: ${data.contact}</p>
                        <p>Additional Info: ${data.additionalInfo}</p>
                        <br>
                        <p>Quote Tier: ${data.quoteTier}</p>
                        <p>Quote Price: ${data.quotePrice}</p>
                        <p id="bookingFee">Booking Fee: $${bookingFee.toFixed(2)}</p>
                        <p id="fullBid">Full Bid: $${fullBid.toFixed(2)}</p>
                        <div>
                            <label for="bidPercentage">Bid Percentage:</label>
                            <input type="number" id="bidPercentage" value="25" min="5" max="100" step="5">
                            <button onclick="setBid(${fullBid}, ${data.appointment_id})" class="jotform-submit">Set Bid</button>
                        </div>
                        <p>Bid: $<span id="bidValue">${Number(data.bid).toFixed(2)} Currently at ${Number(data.percentageOff).toFixed(0)}%</span></p>
                        <hr>
                        <h2>Provider Information:</h2>
                        <p>Provider: ${data.provider}</p>
                        <p>Service Type: ${data.serviceType}</p>
                        <br>
                        <p>Notes: ${data.providerNotes}</p>
                        <br>
                        <!-- Uploaded Photos Section -->
                        <br>
                </div>
            `;
            
            const uploadedPhotosContainer = document.querySelector('.photo-gallery.uploaded-photos .image-container');

            // Clear existing images before appending new ones
            uploadedPhotosContainer.innerHTML = '';
            data.uploadedPhotos.forEach(photoUrl => {
                const img = document.createElement('img');
                img.src = photoUrl;
                img.classList.add('clickable-image'); 
                uploadedPhotosContainer.appendChild(img);
            });
            
            modal.style.display = 'block';
            
            // Attach the click event listener to the parent container of the images
            document.body.addEventListener('click', function(event) {
                // Check if the clicked element is an image with the class 'clickable-image'
                console.log(event.target); // To check what element is being clicked
                if (event.target.classList.contains('clickable-image')) {
                    enlargeImage(event.target.src);
                }
            });
        })
        .catch(error => console.error('Error fetching details:', error));
    }
    
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
    
    function submitOrderStatus(appointmentId, newStatus) {
        const orderStatus = newStatus || document.getElementById('orderStatus').value;
        const bookingCode = document.getElementById('eventTitle').textContent.replace('Order Code: ', ''); // Extract orderCode from the title

        fetch('assets/php/update-assignment-status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ appointmentId: appointmentId, newStatus: orderStatus }), // Use appointmentId directly
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
    
    function setBid(quotePrice, appointmentId) {
        const bidPercentage = document.getElementById('bidPercentage').value;
        const adjustedBidPercentage = 100 - bidPercentage; // Subtract from 100%
        const bidValue = quotePrice * (adjustedBidPercentage / 100);
        const percentageOff = 100 - adjustedBidPercentage;

        // Update the text content to show both the bid value and the percentage off
        document.getElementById('bidValue').textContent = `${bidValue.toFixed(2)} Currently at ${percentageOff}%`;

        // AJAX request to update the bid in the database
        fetch('assets/php/updateBid.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `appointmentId=${appointmentId}&bidValue=${bidValue}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Bid updated successfully');
            } else {
                console.error('Failed to update bid');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Close modal functionality
    document.querySelector('.close').addEventListener('click', function () {
        document.getElementById('eventModal').style.display = 'none';
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