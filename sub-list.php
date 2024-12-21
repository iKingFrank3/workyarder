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
        
        .service-form-input {
            min-width: 60px; /* Adjust based on your preference */
        }
        
        .service-form-input {
            width: 20%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .service-form-input[type="color"] {
            height: 40px;
            padding: 0;
        }
        
        /* Adjust input size and make them smaller */
        .service-form-input {
            padding: 8px;
        }

        .jotform-form-label {
            width: 100px; /* Fixed label width */
            font-size: 16px;
            margin-right: 0px;
        }

        .checkbox-container {
            display: flex;
            justify-content: center; /* Center the content horizontally */
            align-items: center;
            overflow: hidden;
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
            
            #size {
                width: 40%;
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

        @media (max-width: 768px) {
            .service-item-container {
                flex-direction: column;
                align-items: flex-start; /* Align items to the start of the flex container */
            }

            .service-form-input, .jotform-form-label {
                width: 100%; /* Make inputs and labels take full width */
                margin-bottom: 10px; /* Add some space between stacked elements */
            }

            .checkbox-container {
                justify-content: flex-start; /* Align checkbox to the start */
            }
        }
        
        #size {
            width: 40%;
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
                <h1>Subscription List</h1>
            </header>
            <div class="main-content">
                <div class="jotform-section">
                    <h2>Active Services</h2>
                    <br>
                    <form id="service-form">
                        <div id="service-items-container"></div>
                        <div class="jotform-submit-section">
                            <br>
                            <button type="submit" id="save" class="jotform-submit">Save Changes</button>
                        </div>
                    </form>
                    <br><br>
                    <div class="jotform-form-row">
                        <label for="price" class="jotform-form-label" style="width: 150px;">Calculate Prices:</label>
                        <input type="text" id="size" name="size" class="service-form-input" required>
                        &emsp;
                        <button type="button" id="calculate-button" class="jotform-submit">Calculate</button>
                    </div>
                    <!-- Placeholder for the dynamically generated table -->
                    <div id="price-calculation-results"></div>
                </div>
                <div class="jotform-section">
                    <h2>Active Subscribers</h2>
                    <!-- Add a table or list of leads with sample data -->
                    <table class="leads-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>City, State</th>
                                <th># of Bookings</th>
                                <th>Appt History</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add more lead entries -->
                        </tbody>
                    </table>
                    <br>
                    <h1 style="text-align: center;">Coming Soon! </h1>
                </div>
                <div class="jotform-section">
                    <h2>Create Promotion</h2>
                    <br>
                    <h1 style="text-align: center;">Coming Soon! </h1>
                </div>
            </div>
        </div>
    </div>
    <script>
        let currentBusinessType = '';
        let currentBusinessId = '';
        
        document.addEventListener('DOMContentLoaded', function() {
            function fetchBusinessTypeAndLoadServices() {
                fetch('assets/php/set-price.php?action=fetch_business_type')
                .then(response => response.json())
                .then(data => {
                    currentBusinessType = data.businessType;
                    currentBusinessId = data.businessId;
                    loadServiceNames(currentBusinessType);
                    // Update the placeholder text based on the fetched business type
                    document.getElementById('size').placeholder = getPlaceholderText(currentBusinessType);
                })
                .catch(error => console.error('Failed to fetch business type:', error));
            }

            function loadServiceNames(currentBusinessType) {
                const services = {
                    'lawn-care': ['Simple Cut', 'Leaf Removal', 'Snow Removal'],
                    'pool-care': ['Pool Maintenance', 'Diagnostic', 'Pool Openings', 'Pool Closings'],
                    'pw-care': ['Pressure Washing', 'Gutter Cleaning', 'Dumpster Cleaning']
                };

                const serviceList = services[currentBusinessType] || [];
                const serviceItemsContainer = document.getElementById('service-items-container');
                serviceItemsContainer.innerHTML = ''; // Clear previous entries

                serviceList.forEach(service => {
                    fetch(`assets/php/set-price.php?action=fetch_price&service_name=${encodeURIComponent(service)}&business_id=${currentBusinessId}`)
                    .then(response => response.json())
                    .then(data => {
                        const price = data.price || '0'; // Default to '0' if no price is found
                        const isActive = price !== '0';
                        const serviceItem = document.createElement('div');
                        serviceItem.innerHTML = `
                            <div class="service-item-container" style="display: flex; flex-direction: column; align-items: flex-start;">
                                <div style="display: flex; align-items: center; width: 100%;">
                                    <label for="service-name-${service}" class="jotform-form-label">Name:</label>
                                    <input type="text" id="service-name-${service}" name="service-name[]" value="${service}" class="service-form-input" required readonly>
                                    &emsp;
                                    <label for="service-price-${service}" class="jotform-form-label">Price:</label>
                                    <input type="text" id="service-price-${service}" name="service-price[]" value="${price}" class="service-form-input" required ${!isActive ? 'disabled' : ''}>
                                    &emsp;
                                    <div class="checkbox-container" style="display: flex; align-items: center;">
                                        <label for="active-${service}" class="jotform-form-label">Active</label>
                                        <input type="checkbox" id="active-${service}" name="active-${service}" class="service-form-input" ${isActive ? 'checked' : ''}>
                                    </div>
                                </div>
                                <br>
                                <div style="display: flex; align-items: center; width: 65%; margin-bottom: 20px;">
                                    <label for="service-description-${service}" class="jotform-form-label">Description:</label>
                                    <textarea id="service-description-${service}" name="service-description[]" class="service-form-input" style="flex-grow: 1;" ${!isActive ? 'disabled' : ''}></textarea>
                                </div>
                            </div>
                        `;
                        serviceItemsContainer.appendChild(serviceItem);

                        // Add event listener to the checkbox
                        document.getElementById(`active-${service}`).addEventListener('change', function() {
                            const priceInput = document.getElementById(`service-price-${service}`);
                            const descriptionTextarea = document.getElementById(`service-description-${service}`); // Get the description textarea

                            if (this.checked) {
                                priceInput.disabled = false;
                                priceInput.value = ''; // Clear the input
                                descriptionTextarea.disabled = false; // Enable the textarea
                                descriptionTextarea.value = ''; // Optionally clear the textarea
                            } else {
                                priceInput.disabled = true;
                                priceInput.value = '0'; // Set value to 0
                                descriptionTextarea.disabled = true; // Disable the textarea
                                descriptionTextarea.value = ''; // Clear the textarea
                            }
                        });
                    })
                    .catch(error => console.error('Error fetching price for service:', error));
                });
            }

            fetchBusinessTypeAndLoadServices();

            const form = document.getElementById('service-form');
            if (form) {
                form.onsubmit = function(event) {
                    event.preventDefault();
                    const formData = new FormData(form);
                    fetch('assets/php/set-price.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert('Service prices updated successfully!');
                        console.log(data);
                    })
                    .catch(error => console.error('Error updating service prices:', error));
                };
            } else {
                console.error('Form not found');
            }

            document.getElementById('calculate-button').addEventListener('click', function() {
                const size = parseFloat(document.getElementById('size').value);
                const serviceItemsContainer = document.getElementById('service-items-container');
                const priceCalculationResults = document.getElementById('price-calculation-results');
                priceCalculationResults.innerHTML = ''; // Clear previous results

                const table = document.createElement('table');
                table.className = 'price-table';
                table.innerHTML = `
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Price</th>
                            <th>Projected Payout</th>
                        </tr>
                    </thead>
                    <tbody>
                `;

                const services = {
                    'lawn-care': ['Simple Cut', 'Leaf Removal', 'Snow Removal'],
                    'pool-care': ['Pool Maintenance', 'Diagnostic', 'Pool Openings', 'Pool Closings'],
                    'pw-care': ['Pressure Washing', 'Gutter Cleaning', 'Dumpster Cleaning']
                };
                const serviceList = services[currentBusinessType] || [];

                serviceList.forEach(service => {
                    fetch(`assets/php/set-price.php?action=fetch_price&service_name=${service}&business_id=${currentBusinessId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.price) {
                            console.error('Price data is missing:', data);
                            throw new Error('Price data is missing');
                        }
                        const baseRate = parseFloat(data.price);
                        let totalCost = 0;

                        switch (currentBusinessType) {
                            case 'lawn-care':
                                totalCost = calculateLawnCareCost(size, service, 'ok', 'flat', 'normal', 'residential', baseRate);
                                break;
                            case 'pool-care':
                                totalCost = calculatePoolCareCost(size, service, 'ok', baseRate);
                                break;
                            case 'pw-care':
                                totalCost = calculatePressureWashingCost(size, service, 'ok', baseRate);
                                break;
                        }

                        const projectedPayout = totalCost * 0.85; // Calculate 85% of total cost

                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td style="padding-right: 20px;">${service}</td>
                            <td style="padding-right: 20px;">$${baseRate.toFixed(2)}</td>
                            <td>$${projectedPayout.toFixed(2)}</td>
                        `;
                        table.querySelector('tbody').appendChild(row);
                    })
                    .catch(error => {
                        console.error('Error fetching price:', error);
                        alert('Failed to fetch price data. Please check the server response.');
                    });
                });

                priceCalculationResults.appendChild(table);
            });
        });
        
        // Function to calculate lawn care cost
        function calculateLawnCareCost(acreage, serviceType, tier, terrain, currentState, propertyType, baseRate) {
            let hourlyRate = 0;
            let timePerAcre = 1;
            let additionalChargePerAcre = 1;
            let terrainCharge = 0;
            let stateCharge = 0;
            let propertyCharge = 0;

            // Set hourly rate, time per acre, and additional charge based on tier and acreage
            if (serviceType === "Simple Cut") {
                if (tier === "ok") {
                    if (acreage <= 0.125) {
                        hourlyRate = baseRate * 3.2;
                    } else if (acreage <= 0.25) {
                        hourlyRate = baseRate * 2.4;
                    } else if (acreage <= 0.5) {
                        hourlyRate = baseRate * 1.5;
                    } else {
                        hourlyRate = baseRate * 1;
                    }
                } else {
                    return "Invalid tier";
                }
            } else if (serviceType === "Leaf Removal" || serviceType === "Snow Removal") {
                if (tier === "ok") {
                    hourlyRate = baseRate * 9; // Adjust multiplier as per your service
                } else if (tier === "good") {
                    hourlyRate = baseRate * 12;
                } else if (tier === "best") {
                    hourlyRate = baseRate * 14.5;
                } else {
                    return "Invalid tier";
                }
            }

            // Additional charges for terrain, state, and property
            if (terrain === "sloped" || terrain === "multi") {
                terrainCharge = Math.ceil(acreage * 100) / 100 * 35;
            }
            if (currentState === "overgrown") {
                stateCharge = Math.ceil(acreage * 100) / 100 * 100;
            }
            if (propertyType === "commercial") {
                propertyCharge = Math.ceil(acreage * 100) / 100 * 10;
            }

            // Calculate total time and cost
            let total_time = acreage * timePerAcre;
            let additionalCharge = (acreage / 0.1) * additionalChargePerAcre;
            let totalCost = (total_time * hourlyRate) + additionalCharge + terrainCharge + stateCharge + propertyCharge;

            return totalCost;
        }

        // Function to calculate pool care cost
        function calculatePoolCareCost(poolSize, serviceType, tier, baseRate) {
            let totalCost = 0;
            let additionalChargePerGallon = 0;

            if (serviceType === "Pool Maintenance") {
                if (tier === "ok") {
                    if (poolSize <= 5000) {
                        totalCost = baseRate * 0.35;
                        additionalChargePerGallon = 0.008;
                    } else if (poolSize <= 15000) {
                        totalCost = baseRate * 0.75;
                        additionalChargePerGallon = 0.003;
                    } else if (poolSize <= 30000) {
                        totalCost = baseRate * 1.2;
                        additionalChargePerGallon = 0.001;
                    } else {
                        totalCost = baseRate * 1.8 + ((poolSize - 30000) * 0.006);
                        additionalChargePerGallon = 0.001;
                    }
                } else {
                    return "Invalid tier";
                }
            } else if (serviceType === "Diagnostic") {
                if (tier === "ok") {
                    totalCost = baseRate * 1.25;
                } else {
                    return "Invalid tier";
                }
            } else if (serviceType === "Pool Closings" || serviceType === "Pool Openings") {
                if (tier === "ok") {
                    if (poolSize <= 5000) {
                        totalCost = baseRate * 0.85;
                        additionalChargePerGallon = 0.008;
                    } else if (poolSize <= 15000) {
                        totalCost = baseRate * 1.25;
                        additionalChargePerGallon = 0.003;
                    } else if (poolSize <= 30000) {
                        totalCost = baseRate * 1.7;
                        additionalChargePerGallon = 0.001;
                    } else {
                        totalCost = baseRate * 2.3 + ((poolSize - 30000) * 0.006);
                        additionalChargePerGallon = 0.001;
                    }
                } else {
                    return "Invalid tier";
                }
            } else {
                // Add logic for other service types if necessary
            }

            totalCost = totalCost + (poolSize * additionalChargePerGallon);

                return totalCost;
            }

        // Function to calculate pressure washing cost
        function calculatePressureWashingCost(areaSize, serviceType, tier, baseRate) {
            let totalCost = 0;
            let ratePerSquareFoot = 0;
        
            if (serviceType === "Gutter Cleaning") {
                if (tier === "ok") {
                    ratePerSquareFoot = baseRate * 1.25;
                } else {
                    return "Invalid tier";
                }
            } else if (serviceType === "Pressure Washing") {
                if (tier === "ok") {
                    ratePerSquareFoot = baseRate * 0.15;
                } else {
                    return "Invalid tier";
                }
            } else if (serviceType === "Dumpster Cleaning") {
                if (tier === "ok") {
                    ratePerSquareFoot = baseRate * 30;
                } else {
                    return "Invalid tier";
                }
            } else {
                return "Invalid service type";
            }
        
            totalCost = areaSize * ratePerSquareFoot;
        
            return totalCost;
        }
        
        // Function to return appropriate placeholder text based on the business type
        function getPlaceholderText(businessType) {
            switch (businessType) {
                case 'lawn-care':
                    return 'Enter price per acres';
                case 'pool-care':
                    return 'Enter price per gallons';
                case 'pw-care':
                    return 'Enter price per sq ft or number of dumpsters';
                default:
                    return 'Please enter the size'; // Default placeholder
            }
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