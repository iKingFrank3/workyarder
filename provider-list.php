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
        /* Leads table styles */
        .leads-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            display: none; /* Initially hide the table */
        }

        .leads-table th, .leads-table td {
            border: 1px solid #e1e1e1;
            padding: 10px;
            text-align: left;
        }

        .leads-table th {
            background-color: #4F8E35;
            color: #fff;
        }

        .leads-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .lead-filters {
            align-items: center;
            text-align: center; /* Center the button */
            display: block;
            margin: 0 auto;

        }

        .leads-table .clickable {
            cursor: pointer;
            color: #4F8E35;
            text-decoration: underline;
        }

        #lead-search, #lead-filter-status {
            padding: 10px;
            border:1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        
        #lead-search {
            width: 250px;
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

        .notification-box.selected {
            background-color: #4F8E35;
            color: #fff;
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
            width: 65%;
            height: 50%;
            overflow: auto;
        }
        
        .close,
        .close-provider-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        
        .close:hover,
        .close-provider-modal:hover,
        .close:focus,
        .close-provider-modal:focus{
            color: black;
            text-decoration: none;
            cursor: pointer;
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

        .search-row{
            width: 75%;
            display: flex;
            align-items: center;
            margin: 0 auto; /* Center the row horizontally */
        }

        @media (max-width: 768px) {
            .lead-filters, .notification-boxes, .leads-table {
                width: 90%; /* Adjust width to fit within the modal content */
                margin: 0 auto; /* Center align these elements */
            }

            .lead-filters {
                flex-direction: column; /* Stack the elements vertically */
                align-items: center; /* Center align items */
            }

            .search-row {
                flex-direction: column; /* Stack the search input and select dropdown vertically */
                align-items: center; /* Center align items */
            }

            .notification-boxes {
                flex-direction: column; /* Stack notification boxes vertically */
            }

            .notification-box {
                width: 85%; /* Each box takes full width */
                margin-bottom: 10px; /* Add some space between the boxes */
            }

            .leads-table {
                display: block; /* Ensure the table is displayed */
                overflow-x: auto; /* Enable horizontal scrolling if table is wider than screen */
            }
        }

        @media (max-width: 768px) {
            .jotform-section {
                overflow-x: auto; /* Enable horizontal scrolling */
            }
            .leads-table {
                width: 100%; /* Ensure the table is not wider than the section */
                min-width: 600px; /* Minimum width to maintain table structure */
            }
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
                <h1>Provider List</h1>
            </header>
            <div class="main-content">
                <div class="crm-leads">
					<div class="lead-filters">
					    <div class="search-row">
					        <label><strong>Search</strong>&nbsp;</label>
					        <input type="text" id="lead-search" placeholder="Search service or provider name..." style="margin-right: 10px;">
					        <p style="margin: 0 10px 0 0;">near</p>
					        <select id="address" name="address" class="jotform-form-input">
					            <!-- Address (if multiple ) -->
					        </select>
					    </div>
					</div>
                    <br>
                    <div class="notification-boxes">
                        <div class="notification-box">
                            <div class="box-header">
                                <h3>Lawn Care Providers</h3>
                            </div>
                        </div>
                        <div class="notification-box">
                            <div class="box-header">
                                <h3>Pool Care Providers</h3>
                            </div>
                        </div>
                        <div class="notification-box">
                            <div class="box-header">
                                <h3>Pressure Washing Providers</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Add a table or list of leads with sample data -->
                    <div class="jotform-section">
                        <table class="leads-table">
                            <thead>
                                <tr>
                                    <th>Business Name</th>
                                    <th>City, State</th>
                                    <th>Zip Code</th>
                                    <th>Availabity</th>
                                    <th>Price Range</th>
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
    </div>
    
    <!-- Provider Details Modal -->
    <div id="provider-details-modal" class="user-modal">
        <div class="user-content">
            <span class="close-provider-modal">&times;</span>
            <div style="text-align: center;">
                <!-- Button to select the provider -->
                <button id="selectProvider" class="jotform-submit">Select as my provider</button>
                <br>
                <h2>Provider Details</h2>
                <p>Name: <span id="provider-name">N/A</span></p>
                <p>Location: <span id="provider-city">N/A</span>, <span id="provider-state">N/A</span>, <span id="provider-zip">N/A</span></p>
                <h2 style="font-weight: bold; text-align: center;">Availability</h2>
                <div id="provider-availability"></div>
                <!-- Container for services -->
                <div id="services-container">
                    <h2 style="font-weight: bold; text-align: center;">Services Offered</h2>
                </div>
                <!-- Container for services -->
                <div id="reviews-container">
                    <h2 style="font-weight: bold; text-align: center;">Customer Reviews</h2>
                </div>
            </div>
            <!-- Add more details as needed -->
        </div>
    </div>
    
    <script>
        document.querySelectorAll('.notification-box').forEach(box => {
            box.addEventListener('click', function() {
                const addressSelect = document.getElementById('address');
                const selectedState = addressSelect.selectedOptions[0].getAttribute('data-state');

                if (this.classList.contains('selected')) {
                    this.classList.remove('selected');
                    // Fetch all providers when no box is selected, ensuring the state is passed
                    fetchAllProviders(selectedState);
                } else {
                    document.querySelectorAll('.notification-box').forEach(box => {
                        box.classList.remove('selected');
                    });

                    this.classList.add('selected');

                    const providerTypeMap = {
                        'Lawn Care Providers': 'lawn-care',
                        'Pool Care Providers': 'pool-care',
                        'Pressure Washing Providers': 'pw-care'
                    };

                    const providerText = this.querySelector('h3').textContent.trim();
                    const providerType = providerTypeMap[providerText];

                    // Ensure state is passed when fetching specific provider types
                    fetchProviders(providerType, selectedState);
                }
            });
        });

        function fetchProviders(providerType, state) {
            fetch('assets/php/list-providers.php', {
                method: 'POST',
                body: JSON.stringify({ selectedProvider: providerType, state: state }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.text())
            .then(data => {
                document.querySelector('.leads-table tbody').innerHTML = data;
                document.querySelector('.leads-table').style.display = 'table';
            });
        }

        function fetchAllProviders(state) {
            fetch('assets/php/list-providers.php', {
                method: 'POST',
                body: JSON.stringify({ state: state }),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.text())
            .then(data => {
                document.querySelector('.leads-table tbody').innerHTML = data;
                document.querySelector('.leads-table').style.display = 'table';
            });
        }

        // Initially load all providers
        fetchAllProviders();

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('lead-search');

            searchInput.addEventListener('input', function() {
                const searchText = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('.leads-table tbody tr');

                tableRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    const name = cells[0].textContent.toLowerCase();
                    const cityState = cells[1].textContent.toLowerCase();
                    const zip = cells[2].textContent.toLowerCase();

                    if (name.includes(searchText) || cityState.includes(searchText) || zip.includes(searchText)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Fetch and populate addresses
            fetch('assets/php/list-address.php')
            .then(response => response.json())
            .then(data => {
                const addressSelect = document.getElementById('address');
                data.forEach(address => {
                    const option = document.createElement('option');
                    option.value = address.address_id;
                    option.textContent = `${address.street_name}, ${address.city}, ${address.state}, ${address.zip_code}`;
                    option.setAttribute('data-state', address.state);
                    addressSelect.appendChild(option);
                });
                
                // Trigger the change event if there are addresses
                if (addressSelect.options.length > 0) {
                    addressSelect.dispatchEvent(new Event('change'));
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

            const addressSelect = document.getElementById('address');
            addressSelect.addEventListener('change', function() {
                const selectedState = this.selectedOptions[0].getAttribute('data-state');
                fetchAllProviders(selectedState); // Pass the selected state to the fetch function
            });
        });
        
        function showProviderDetails(businessId) {
            console.log("showProviderDetails called with ID:", businessId);
            // Fetch provider details using AJAX
            fetch('assets/php/fetchProviderDetails.php?business_id=' + businessId)
                .then(response => response.json())
                .then(data => {
                    console.log("Data received:", data);
                    // Populate the modal with the retrieved data
                    document.getElementById('provider-name').textContent = data.name || 'N/A';
                    document.getElementById('provider-city').textContent = data.city || 'N/A';
                    document.getElementById('provider-state').textContent = data.state || 'N/A';
                    document.getElementById('provider-zip').textContent = data.zip_code || 'N/A';

                    const availabilityContainer = document.getElementById('provider-availability');
                    availabilityContainer.innerHTML = ''; // Clear previous entries
                    const days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
                    days.forEach(day => {
                        const time = data.availability && data.availability[day] ? data.availability[day] : 'N/A';
                        const dayElement = document.createElement('div');
                        dayElement.textContent = `${day.charAt(0).toUpperCase() + day.slice(1)}: ${time}`;
                        availabilityContainer.appendChild(dayElement);
                    });

                    // Display services
                    const servicesContainer = document.getElementById('services-container');
                    servicesContainer.innerHTML = '<h2>Services Offered</h2>'; // Reset the innerHTML to include the header
                    data.services.forEach(service => {
                        const serviceElement = document.createElement('div');
                        serviceElement.innerHTML = `<strong>${service.name}: $${service.price}</strong><br>${service.description || 'No description available'}`;
                        servicesContainer.appendChild(serviceElement);
                        servicesContainer.appendChild(document.createElement('br')); // Add a line break after each service
                    });

                    // Display reviews
                    const reviewsContainer = document.getElementById('reviews-container');
                    reviewsContainer.innerHTML = '<h2>Customer Reviews</h2>';
                    data.reviews.forEach(review => {
                        const reviewElement = document.createElement('div');
                        reviewElement.innerHTML = `<strong>Rating: ${review.rating}/5</strong><br>${review.review}<br><small>Posted on: ${new Date(review.created_at).toLocaleDateString()}</small>`;
                        reviewsContainer.appendChild(reviewElement);
                        reviewsContainer.appendChild(document.createElement('br'));
                    });

                    // Display the modal
                    document.getElementById('provider-details-modal').style.display = 'block';
                    document.getElementById('provider-details-modal').setAttribute('data-business-id', businessId);
                })
                .catch(error => console.error('Error fetching provider details:', error));
        }

        // Close the modal when the close button is clicked
        document.querySelector('.close-provider-modal').addEventListener('click', function() {
            document.getElementById('provider-details-modal').style.display = 'none';
        });

        // Close the modal when clicking outside of it
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('provider-details-modal');
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
        
        document.getElementById('selectProvider').addEventListener('click', function() {
            // Retrieve the businessId from the modal's data attribute
            const businessId = document.getElementById('provider-details-modal').getAttribute('data-business-id');

            fetch('assets/php/updateProviderSelection.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ businessId: businessId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Provider updated successfully!');
                } else {
                    alert('Failed to update provider: ' + data.error);
                }
            })
            .catch(error => console.error('Error updating provider:', error));
        });
    </script>
</body>
</html>