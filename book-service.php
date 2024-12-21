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
                <h1>Book Appointment</h1>
            </header>
            <div class="main-content">
                <div class="jotform-section">
                    <h2>Booking an Appointment</h2>
                    <form id="personal-info-form" class="jotform-form" method="POST" action="assets/php/bookService.php" enctype="multipart/form-data">
                        <div class="jotform-form-row">
                            <label for="address" class="jotform-form-label">Address:</label>
                            <select id="address" name="address" class="jotform-form-input">
                                <!-- Options will be populated here -->
                            </select>
                        </div>

                        <div class="jotform-form-row">
                            <label for="provider" class="jotform-form-label">Service Provider:</label>
                            <select id="provider" name="provider" class="jotform-form-input">
                                <!-- Options will be populated here -->
                            </select>
                        </div>

                        <div class="jotform-form-row">
                            <label for="service-type" class="jotform-form-label">Type of Service:</label>
                            <select id="service-type" name="service-type" class="jotform-form-input">
                                <!-- Options will be populated here -->
                            </select>
                        </div>

                        <div class="jotform-form-row">
                            <label for="frequency" class="jotform-form-label">Service frequency:</label>
                            <select id="frequency" name="frequency" class="jotform-form-input">
                                <option value="once">One Time</option>
                                <option value="weekly">Weekly</option>
                                <option value="biweekly">Biweekly</option>
                                <option value="monthly">Monthly</option>
                            </select>
                        </div>

                        <!-- Add this section in your HTML form where the frequency is selected -->
                        <div class="jotform-form-row" id="duration-row" style="display:none;">
                            <label for="duration" class="jotform-form-label">Duration:</label>
                            <select id="duration" name="duration" class="jotform-form-input">
                                <option value="3">3 months</option>
                                <option value="6">6 months</option>
                                <option value="12">1 year</option>
                            </select>
                        </div>

                        <!-- Lawn Care Specific Fields -->
                        <div id="lawn-care-fields" style="display: none;">
                            <!-- Lawn care specific inputs -->
                            <div id="cut-options">
                                <div class="jotform-form-row">
                                    <label for="lawn-current-state" class="jotform-form-label">Current state of the lawn:</label>
                                    <select id="lawn-current-state" name="lawn-current-state" class="jotform-form-input">
                                        <option value="regular">Regular maintenance</option>
                                        <option value="overgrown">Overgrown/Extra Care needed</option>
                                    </select>
                                </div>
                                <div class="jotform-form-row">
                                <label for="lawn-terrain" class="jotform-form-label">Terrain of the property:</label>
                                <select id="lawn-terrain" name="lawn-terrain" class="jotform-form-input">
                                    <option value="flat">Flat</option>
                                    <option value="sloped">Sloped</option>
                                    <option value="multi">Multi-terrain</option>
                                </select>
                            </div>
                            </div>
                            <div id="removal-options" style="display: none;">
                                <div class="jotform-form-row">
                                    <label for="surface-type" class="jotform-form-label">Type of Surface:</label>
                                    <select id="surface-type" name="surface-type" class="jotform-form-input">
                                        <option value="driveway">Driveway</option>
                                        <option value="sidewalk">Sidewalk</option>
                                        <option value="walkway">Walkway</option>
                                        <option value="deck">Deck</option>
                                        <option value="all">All Pavement</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Pool Care Specific Fields -->
                        <div id="pool-care-fields" style="display: none;">
                            <!-- Pool care specific inputs -->
                            <div class="jotform-form-row">
                                <label for="pool-current-state" class="jotform-form-label">When was the last time you had pool maintenance?:</label>
                                <select id="pool-current-state" name="pool-current-state" class="jotform-form-input">
                                    <option value="recent">Within the last month</option>
                                    <option value="months">1-3 months</option>
                                    <option value="season">Last season</option>
                                </select>
                            </div>
                            <div class="jotform-form-row">
                                <label for="surface-type" class="jotform-form-label">Type of Surface:</label>
                                <select id="surface-type" name="surface-type" class="jotform-form-input">
                                    <option value="tile">Tile</option>
                                    <option value="vinyl">Vinyl</option>
                                    <option value="plaster">Plaster</option>
                                    <option value="pebbles">Pebbles</option>
                                    <option value="quartz">Quartz</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Pressure Washing Specific Fields -->
                        <div id="pressure-washing-fields" style="display: none;">
                            <!-- Pressure washing specific inputs -->
                            <div class="surface-option">
                                <div class="jotform-form-row">
                                    <label for="surface-type" class="jotform-form-label">Type of Surface:</label>
                                    <select id="surface-type" name="surface-type" class="jotform-form-input">
                                        <option value="driveway">Driveway</option>
                                        <option value="sidewalk">Sidewalk</option>
                                        <option value="walkway">Walkway</option>
                                        <option value="deck">Deck</option>
                                        <option value="all">All Pavement</option>
                                    </select>
                                </div>
                            </div>

                            <div class="dumpster-option">
                            <div class="jotform-form-row">
                                <label for="dumpsterNum" class="jotform-form-label">Number of Dumpster(s):</label>
                                <input type="number" step="1" id="dumpsterNum" name="dumpsterNum" class="jotform-form-input">
                            </div>
                            </div>
                        </div>

                        <!-- Add more fields for personal information as needed -->
                        <div class="jotform-form-row">
                            <label for="accessibility" class="jotform-form-label">Accessibility (Pets, Obstacles, Parking Instructions):</label>
                            <textarea id="accessibility" name="accessibility" class="jotform-form-input"></textarea>
                        </div>
                        <div class="jotform-form-row">
                            <label for="preferred-contact" class="jotform-form-label">Preferred Contact Method:</label>
                            <select id="preferred-contact" name="preferred-contact" class="jotform-form-input">
                                <option value="email">Email</option>
                                <option value="phone">Phone</option>
                                <option value="text">Text</option>
                            </select>
                        </div>
                        <div class="jotform-form-row">
                            <label for="appointment-date" class="jotform-form-label">Appointment Date:</label>
                            <input type="date" id="appointment-date" name="appointment-date" class="jotform-form-input" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>" max="<?= date('Y-m-d', strtotime('+31 days')) ?>" required>
                        </div>
                        <div class="jotform-form-row">
                            <label for="appointment-time" class="jotform-form-label">Appointment Time:</label>
                            <select id="appointment-time" name="appointment-time" class="jotform-form-input">
                               <option value="7am - 8am">7am - 8am</option>
                               <option value="8am - 9am">8am - 9am</option>
                               <option value="9am - 10am">9am - 10am</option>
                               <option value="10am - 11am">10am - 11am</option>
                               <option value="11am - 12pm">11am - 12pm</option>
                               <option value="12pm - 1pm">12pm - 1pm</option>
                               <option value="1pm - 2pm">1pm - 2pm</option>
                               <option value="2pm - 3pm">2pm - 3pm</option>
                               <option value="3pm - 4pm">3pm - 4pm</option>
                               <option value="4pm - 5pm">4pm - 5pm</option>
                               <option value="5pm - 6pm">5pm - 6pm</option>
                               <option value="6pm - 7pm">6pm - 7pm</option>
                           </select>
                        </div>
                        <div class="jotform-form-row">
                            <label for="additional-info" class="jotform-form-label">Additional information or questions:</label>
                            <textarea id="additional-info" name="additional-info" class="jotform-form-textarea"></textarea>
                        </div>
                        <div class="jotform-form-row">
                            <label for="photos" class="jotform-form-label">Upload Photos:</label>
                            <input type="file" id="photos" name="photos[]" class="jotform-form-input" multiple>
                        </div>
                        <div class="jotform-form-row">
                            <label for="budget" class="jotform-form-label">Get Instant Quote <br> (if acreage entered):</label>
                            <select id="budget" name="budget" class="jotform-form-input" style="display: none;">
                                <option value="ok">Tier 1</option>
                                <option value="good">Tier 2</option>
                                <option value="best">Tier 3</option>
                            </select>

                            &nbsp;

                            <button type="button" id="quote-button" class="jotform-form-input">Get Quote</button>
                        </div>
                        <input type="hidden" id="projectedTotalCost" name="projectedTotalCost">
                        <input type="hidden" id="baseRate" value="">
                        <div id="quote-result" style="text-align: center;"></div> <!-- To display the quote result -->
                        <br>
                        <div class="g-recaptcha" data-sitekey="6LcXEJ4pAAAAANKctEJyDsXMcnBESRGPwjPabMHb"></div>
                        <br>

                        <div class="jotform-submit-section">
                            <button type="submit" class="jotform-submit">Book Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fetch addresses
        fetch('assets/php/list-address.php')
        .then(response => response.json())
        .then(addresses => {
            const addressSelect = document.getElementById('address');
            addresses.forEach(address => {
                const option = document.createElement('option');
                option.value = address.address_id;
                option.textContent = `${address.street_name}, ${address.city}, ${address.state}, ${address.zip_code}`;
                addressSelect.appendChild(option);
            });
            if (addressSelect.options.length > 0) {
                addressSelect.dispatchEvent(new Event('change')); // Trigger change to load providers
            }
        });

        // Fetch providers based on selected address
        document.getElementById('address').addEventListener('change', function() {
            const addressId = this.value;
            fetch(`assets/php/get-address-providers.php?address_id=${addressId}`)
            .then(response => response.json())
            .then(data => {
                const providerSelect = document.getElementById('provider');
                providerSelect.innerHTML = ''; // Clear existing options
                ['lawn_provider', 'pool_provider', 'pW_provider'].forEach(type => {
                    const providerName = data[type];
                    if (providerName && providerName !== 'None Selected') {
                        const option = document.createElement('option');
                        option.value = type;
                        option.textContent = providerName;
                        providerSelect.appendChild(option);
                    }
                });

                // Add default provider option
                const defaultProviderOption = document.createElement('option');
                defaultProviderOption.textContent = 'WorkYarder Selected Provider';
                defaultProviderOption.value = 'workyarder-selected';
                providerSelect.appendChild(defaultProviderOption);

                if (providerSelect.options.length === 0) {
                    const option = document.createElement('option');
                    option.textContent = 'No Providers Available';
                    providerSelect.appendChild(option);
                } else {
                    providerSelect.dispatchEvent(new Event('change')); // Trigger change to load service types
                }
            });
        });

        // Populate service type dropdown based on provider selection
        document.getElementById('provider').addEventListener('change', function() {
            const providerType = this.options[this.selectedIndex].value;
            const addressId = document.getElementById('address').value;
            const serviceTypeSelect = document.getElementById('service-type');
            const budgetSelect = document.getElementById('budget');
            serviceTypeSelect.innerHTML = ''; // Clear existing options

            // Hide all specific fields initially
            document.getElementById('lawn-care-fields').style.display = 'none';
            document.getElementById('pool-care-fields').style.display = 'none';
            document.getElementById('pressure-washing-fields').style.display = 'none';

            if (providerType === 'workyarder-selected') {
                // Display the budget dropdown
                budgetSelect.style.display = 'block';
                
                // Fetch services for the selected provider
                fetch(`assets/php/get-service-price.php?business_id=1`)
                .then(response => response.json())
                .then(data => {
                    // Define service categories with their respective services
                    const serviceCategories = {
                        'Lawn Care': ['Simple Cut', 'Leaf Removal'],
                        'Pool Care': ['Pool Maintenance', 'Diagnostic', 'Pool Openings', 'Pool Closings'],
                        'Pressure Washing': ['Pressure Washing'],
                        'Cleaning Services': ['Gutter Cleaning', 'Dumpster Cleaning'],
                        'Snow Services': ['Snow Removal']
                    };

                    // Iterate over each category to create optgroups
                    Object.keys(serviceCategories).forEach(category => {
                        const optgroup = document.createElement('optgroup');
                        optgroup.label = category;

                        // Filter services to include only those that belong to the current category
                        serviceCategories[category].forEach(serviceName => {
                            // Find the service in the fetched data
                            const serviceData = data.find(service => service.startsWith(serviceName));
                            if (serviceData) {
                                const [name, price] = serviceData.split('|');
                                const option = new Option(name, name.toLowerCase().replace(/\s+/g, '-'));
                                option.setAttribute('data-price', price);
                                optgroup.appendChild(option);
                            } else {
                                console.error('Service not found:', serviceName);
                            }
                        });

                        // Append the optgroup to the select element if it contains any options
                        if (optgroup.children.length > 0) {
                            serviceTypeSelect.appendChild(optgroup);
                        }
                    });

                    // Trigger the change event to set the initial display properties
                    if (serviceTypeSelect.options.length > 0) {
                        serviceTypeSelect.dispatchEvent(new Event('change'));
                    }
                });
            } else {
                // Hide the budget dropdown if another provider is selected
                budgetSelect.style.display = 'none';
                budgetSelect.value = 'ok';

                // Fetch services for the selected provider
                fetch(`assets/php/get-address-providers.php?address_id=${addressId}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Log the data to see what is being returned
                    let services = [];
                    if (providerType === 'lawn_provider') {
                        services = data.lawn_services.split(',');
                        document.getElementById('lawn-care-fields').style.display = 'block';
                    } else if (providerType === 'pool_provider') {
                        services = data.pool_services.split(',');
                        document.getElementById('pool-care-fields').style.display = 'block';
                    } else if (providerType === 'pW_provider') {
                        services = data.pw_services.split(',');
                        document.getElementById('pressure-washing-fields').style.display = 'block';
                    }

                    // Populate the service type dropdown
                    services.forEach(service => {
                        const [serviceName, servicePrice] = service.split('|');
                        if (serviceName && servicePrice) {
                            const option = new Option(serviceName, serviceName.toLowerCase().replace(/\s+/g, '-'));
                            option.setAttribute('data-price', servicePrice);
                            serviceTypeSelect.appendChild(option);
                        } else {
                            console.error('Invalid service data:', service);
                        }
                    });

                    // Trigger the change event to set the initial display properties
                    if (serviceTypeSelect.options.length > 0) {
                        serviceTypeSelect.dispatchEvent(new Event('change'));
                    }
                });
            }
        });

        // Trigger the provider change event initially if there is a provider selected
        if (document.getElementById('provider').options.length > 0) {
            document.getElementById('provider').dispatchEvent(new Event('change'));
        }
        
        // Trigger the service type change event initially if there is a service selected
        if (document.getElementById('service-type').options.length > 0) {
            document.getElementById('service-type').dispatchEvent(new Event('change'));
        }
    });

    document.getElementById('service-type').addEventListener('change', function() {
        const selectedService = this.value;
        const selectedOption = this.options[this.selectedIndex];
        const baseRate = selectedOption.getAttribute('data-price'); // Get the price attribute from the selected option
        document.getElementById('baseRate').value = baseRate; // Store baseRate in hidden input

        // Hide all sections initially
        document.getElementById('lawn-care-fields').style.display = 'none';
        document.getElementById('pool-care-fields').style.display = 'none';
        document.getElementById('pressure-washing-fields').style.display = 'none';
        document.getElementById('cut-options').style.display = 'none';
        document.getElementById('removal-options').style.display = 'none';
        document.querySelector('.surface-option').style.display = 'none';
        document.querySelector('.dumpster-option').style.display = 'none';

        // Determine which options to show based on the selected service category
        if (['simple-cut'].includes(selectedService)) {
            document.getElementById('lawn-care-fields').style.display = 'block';
            document.getElementById('cut-options').style.display = 'block';
        } else if (['leaf-removal', 'snow-removal'].includes(selectedService)) {
            document.getElementById('lawn-care-fields').style.display = 'block';
            document.getElementById('removal-options').style.display = 'block';
        } else if (['pool-maintenance', 'diagnostic', 'pool-openings', 'pool-closings'].includes(selectedService)) {
            document.getElementById('pool-care-fields').style.display = 'block';
        } else if (['pressure-washing'].includes(selectedService)) {
            document.getElementById('pressure-washing-fields').style.display = 'block';
            document.querySelector('.surface-option').style.display = 'block';
        } else if (['dumpster-cleaning'].includes(selectedService)) {
            document.getElementById('pressure-washing-fields').style.display = 'block';
            document.querySelector('.dumpster-option').style.display = 'block';
        }
    });

    // Function to calculate projectedTotalCost based on selected service and address data
    function calculateProjectedTotalCost() {
        const selectedService = document.getElementById('service-type').value;
        const addressId = document.getElementById('address').value;
        const tier = document.getElementById('budget').value;
        const terrain = document.getElementById('lawn-terrain').value;
        const currentState = document.getElementById('lawn-current-state').value;
        const baseRate = document.getElementById('baseRate').value; // Retrieve baseRate from hidden input
        const surfaceType = document.getElementById('surface-type').value; // Get the selected surface type
        const dumpsterNum = document.getElementById('dumpsterNum').value; // Get the number of dumpsters

        getAddressData(addressId).then(addressData => {
            let projectedTotalCost = 0;

            // Calculate projectedTotalCost based on selected service and address data
            switch (selectedService) {
                case 'simple-cut':
                    projectedTotalCost = calculateLawnCareCost(addressData.lawn_size, 'simple-cut', tier, terrain, currentState, addressData.property_type, baseRate);
                    break;
                case 'leaf-removal':
                    projectedTotalCost = calculateLawnCareCost(addressData[surfaceType], 'leaf-removal', tier, terrain, currentState, addressData.property_type, baseRate);
                    break;
                case 'snow-removal':
                    projectedTotalCost = calculateLawnCareCost(addressData[surfaceType], 'snow-removal', tier, terrain, currentState, addressData.property_type, baseRate);
                    break;
                case 'pool-maintenance':
                    projectedTotalCost = calculatePoolCareCost(addressData.pool_size, 'maintenance', tier, baseRate);
                    break;
                case 'diagnostic':
                    projectedTotalCost = calculatePoolCareCost(addressData.pool_size, 'diagnostic', tier, baseRate);
                    break;
                case 'pool-openings':
                    projectedTotalCost = calculatePoolCareCost(addressData.pool_size, 'pool-openings', tier, baseRate);
                    break;
                case 'pool-closings':
                    projectedTotalCost = calculatePoolCareCost(addressData.pool_size, 'pool-closings', tier, baseRate);
                    break;
                case 'pressure-washing':
                    projectedTotalCost = calculatePressureWashingCost(addressData[surfaceType], 'pressure-washing', tier, baseRate);
                    break;
                case 'gutter-cleaning':
                    projectedTotalCost = calculatePressureWashingCost(addressData[surfaceType], 'gutter', tier, baseRate);
                    break;
                case 'dumpster-cleaning':
                    projectedTotalCost = calculatePressureWashingCost(dumpsterNum, 'dumpster', tier, baseRate); // Use the number of dumpsters for calculation
                    break;
                default:
                    break;
            }

            // Calculate booking and processing fee (5% of total cost)
            const bookingProcessingFee = projectedTotalCost * 0.0575;

            // Calculate projected total cost (total cost + booking and processing fee)
            const totalProjectedCost = projectedTotalCost + bookingProcessingFee;

            document.getElementById('projectedTotalCost').value = totalProjectedCost;
            document.getElementById('quote-result').innerHTML = `
                <div style='text-align: center;'>
                    <p><strong>Quote:</strong> $${projectedTotalCost.toFixed(2)}</p>
                    <p><strong>Booking and Processing fee:</strong> $${bookingProcessingFee.toFixed(2)}</p>
                    <hr>
                    <p><strong>Projected Total Cost:</strong> $${totalProjectedCost.toFixed(2)}</p>
                </div>
            `;
        });
    }

    // Function to get address data from the database
    function getAddressData(addressId) {
        return fetch(`assets/php/fetch-address-data.php?addressId=${addressId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                return data;
            })
            .catch(error => console.error('Error fetching address data:', error));
    }

    // Function to calculate lawn care cost
    function calculateLawnCareCost(acreage, serviceType, tier, terrain, currentState, propertyType, baseRate) {
        let hourlyRate = 0;
        let timePerAcre = 1;
        let additionalChargePerAcre = 1;
        let terrainCharge = 0;
        let stateCharge = 0;
        let propertyCharge = 0;

        // Set hourly rate, time per acre, and additional charge based on tier and acreage
        if (serviceType === "simple-cut") {
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
            } else if (tier === "good") {
                if (acreage <= 0.125) {
                    hourlyRate = baseRate * 4.4;
                } else if (acreage <= 0.25) {
                    hourlyRate = baseRate * 3;
                } else if (acreage <= 0.5) {
                    hourlyRate = baseRate * 1.9;
                } else {
                    hourlyRate = baseRate * 1.25;
                }
            } else if (tier === "best") {
                if (acreage <= 0.125) {
                    hourlyRate = baseRate * 5.6;
                } else if (acreage <= 0.25) {
                    hourlyRate = baseRate * 3.8;
                } else if (acreage <= 0.5) {
                    hourlyRate = baseRate * 2.5;
                } else {
                    hourlyRate = baseRate * 2;
                }
            } else {
                return "Invalid tier";
            }
        } else if (serviceType === "leaf-removal" || serviceType === "snow-removal") {
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

        // Define multipliers and additional charges per gallon for each service type
        const serviceSettings = {
            "maintenance": {
                "multipliers": {
                    "ok": [0.35, 0.75, 1.2, 1.8],
                    "good": [0.5, 0.9, 1.5, 2],
                    "best": [0.75, 1.25, 1.75, 2.25]
                },
                "charges": {
                    "ok": [0.008, 0.003, 0.001, 0.001],
                    "good": [0.008, 0.003, 0.001, 0.001],
                    "best": [0.008, 0.003, 0.001, 0.001]
                }
            },
            "diagnostic": {
                "multipliers": {
                    "ok": [1.25, 1.25, 1.25, 1.25],
                    "good": [1.6, 1.6, 1.6, 1.6],
                    "best": [2, 2, 2, 2]
                },
                "charges": {
                    "ok": [0.001, 0.001, 0.001, 0.001],
                    "good": [0.001, 0.001, 0.001, 0.001],
                    "best": [0.001, 0.001, 0.001, 0.001]
                }
            },
            "pool-openings": {
                "multipliers": {
                    "ok": [1.2, 1.6, 2.05, 2.65],
                    "good": [1.9, 2.3, 2.8, 3.4],
                    "best": [2.7, 3.2, 3.7, 4.2]
                },
                "charges": {
                    "ok": [0.008, 0.003, 0.001, 0.001],
                    "good": [0.008, 0.003, 0.001, 0.001],
                    "best": [0.008, 0.003, 0.001, 0.001]
                }
            },
            "pool-closings": {
                "multipliers": {
                    "ok": [1.2, 1.6, 2.05, 2.65],
                    "good": [1.9, 2.3, 2.8, 3.4],
                    "best": [2.7, 3.2, 3.7, 4.2]
                },
                "charges": {
                    "ok": [0.008, 0.003, 0.001, 0.001],
                    "good": [0.008, 0.003, 0.001, 0.001],
                    "best": [0.008, 0.003, 0.001, 0.001]
                }
            }
        };

        // Apply multipliers and additional charges based on the pool size and service type
        const settings = serviceSettings[serviceType];
        const multipliers = settings.multipliers[tier];
        const charges = settings.charges[tier];

        if (poolSize <= 5000) {
            totalCost = baseRate * multipliers[0];
            additionalChargePerGallon = charges[0];
        } else if (poolSize <= 15000) {
            totalCost = baseRate * multipliers[1];
            additionalChargePerGallon = charges[1];
        } else if (poolSize <= 30000) {
            totalCost = baseRate * multipliers[2];
            additionalChargePerGallon = charges[2];
        } else {
            totalCost = baseRate * multipliers[3] + ((poolSize - 30000) * 0.006);
            additionalChargePerGallon = charges[3];
        }

        // Calculate the total cost including additional charges
        totalCost += (poolSize * additionalChargePerGallon);

        return totalCost;
    }

    // Function to calculate pressure washing cost
    function calculatePressureWashingCost(areaSize, serviceType, tier, baseRate) {
        let totalCost = 0;
        let ratePerSquareFoot = 0;
    
        if (serviceType === "gutter") {
            if (tier === "ok") {
                ratePerSquareFoot = baseRate * 1.25;
            } else if (tier === "good") {
                ratePerSquareFoot = baseRate * 2;
            } else if (tier === "best") {
                ratePerSquareFoot = baseRate * 2.25;
            } else {
                return "Invalid tier";
            }
        } else if (serviceType === "pressure-washing") {
            if (tier === "ok") {
                ratePerSquareFoot = baseRate * 0.15;
            } else if (tier === "good") {
                ratePerSquareFoot = baseRate * 0.25;
            } else if (tier === "best") {
                ratePerSquareFoot = baseRate * 0.3;
            } else {
                return "Invalid tier";
            }
        } else if (serviceType === "dumpster") {
            if (tier === "ok") {
                ratePerSquareFoot = baseRate * 30;
            } else if (tier === "good") {
                ratePerSquareFoot = baseRate * 50;
            } else if (tier === "best") {
                ratePerSquareFoot = baseRate * 75;
            } else {
                return "Invalid tier";
            }
        } else {
            return "Invalid service type";
        }
    
        totalCost = areaSize * ratePerSquareFoot;
    
        return totalCost;
    }

    // Add event listener to the quote button
    document.getElementById('quote-button').addEventListener('click', calculateProjectedTotalCost);

    // Form submission handling
    const form = document.getElementById('personal-info-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())  // Directly parse JSON
        .then(data => {
            if (data.success) {
                // Check if booking_id is undefined
                if (typeof data.booking_id !== 'undefined') {
                    localStorage.setItem('bookingId', data.booking_id);
                    window.location.href = 'appointment-details.php'; // Adjust the file extension if necessary
                } else {
                    console.error('Booking ID is undefined:', data);
                    alert('Failed to retrieve booking ID.');
                }
            } else {
                alert('Failed to create booking: ' + (data.error || data.message));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to process response: ' + error.message);
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

    document.getElementById('frequency').addEventListener('change', function() {
        var selectedFrequency = this.value;
        var durationRow = document.getElementById('duration-row');
        if (['weekly', 'biweekly', 'monthly'].includes(selectedFrequency)) {
            durationRow.style.display = 'flex';
        } else {
            durationRow.style.display = 'none';
        }
    });

    document.getElementById('provider').addEventListener('change', function() {
        const providerType = this.value; // 'lawn_provider', 'pool_provider', 'pW_provider', or 'workyarder-selected'
        const addressId = document.getElementById('address').value;

        if (providerType === 'workyarder-selected') {
            // Set business_id to 1 for 'workyarder-selected'
            const businessId = 1;

            // Make all dates available
            validDays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

            // Show all time options
            const timeSelect = document.getElementById('appointment-time');
            timeSelect.innerHTML = ''; // Clear existing options
            for (let hour = 0; hour < 24; hour++) {
                let nextHour = hour + 1;
                let optionText = `${hour % 12 || 12}${hour >= 12 ? 'pm' : 'am'} - ${nextHour % 12 || 12}${nextHour >= 12 ? 'pm' : 'am'}`;
                const option = new Option(optionText, optionText);
                timeSelect.appendChild(option);
            }

            // Fetch availability data for business_id 1
            fetchAvailabilityData(businessId);

            return;
        }

        // Fetch the business_id for the selected provider type and address
        fetch(`assets/php/get-provider-business-id.php?address_id=${addressId}&provider_type=${providerType}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const businessId = data.business_id;
            console.log('Business ID:', businessId);
            if (!businessId) {
                console.error('No business ID found for the selected provider and address.');
                return;
            }

            // Fetch availability data for the business_id
            fetchAvailabilityData(businessId); // Call the modified function with the fetched businessId
        })
        .catch(error => {
            console.error('Failed to fetch business ID:', error);
        });
    });

    let availabilityData = {}; // Declare at a higher scope

    // Function to fetch availability data
    function fetchAvailabilityData(businessId) {
        if (!businessId) {
            console.error('No business ID provided for fetching availability data.');
            return;
        }
        fetch(`assets/php/get-business-availability.php?business_id=${businessId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            availabilityData = data; // Store fetched data
            console.log('Availability data:', availabilityData);
            validDays = Object.keys(data); // Assuming data is an object with days as keys
            console.log('Fetched valid days:', validDays);
            setupDateChangeListener(); // Ensure the date change listener is setup after data is fetched
        })
        .catch(error => {
            console.error('Failed to fetch availability data:', error);
        });
    }

    function setupDateChangeListener() {
        const datePicker = document.getElementById('appointment-date');
        datePicker.removeEventListener('change', handleDateChange); // Remove existing listener to avoid duplicates
        datePicker.addEventListener('change', handleDateChange);
    }

    function handleDateChange() {
        // Parse the date as a local date rather than UTC
        const dateString = this.value; // e.g., "2023-03-15"
        const dateParts = dateString.split('-'); // Split YYYY-MM-DD
        const year = parseInt(dateParts[0], 10);
        const month = parseInt(dateParts[1], 10) - 1; // Month is 0-indexed in JavaScript Date
        const day = parseInt(dateParts[2], 10);

        // Create a new Date object using local time components
        const selectedDate = new Date(year, month, day);

        const dayOfWeek = selectedDate.toLocaleString('en-us', {weekday: 'long'}).toLowerCase();
        console.log(`Selected day: ${dayOfWeek}`); // Debug: Show selected day
        console.log(`Valid days: ${validDays}`); // Debug: Show valid days

        if (!validDays.includes(dayOfWeek)) {
            alert('Selected date is not available. Please choose another date.');
            this.value = ''; // Reset the date input
        } else {
            alert('Date is valid!'); // Debug: Confirm the date is valid
            updateAppointmentTimes(availabilityData[dayOfWeek]); // Pass the correct day's availability
        }
    }

    function updateAppointmentTimes(availability) {
        const timeSelect = document.getElementById('appointment-time');
        timeSelect.innerHTML = ''; // Clear existing options

        let startHour = parseInt(availability.start_time.split(':')[0], 10);
        let endHour = parseInt(availability.end_time.split(':')[0], 10);

        for (let hour = startHour; hour < endHour; hour++) {
            let nextHour = hour + 1;
            let optionText = `${hour % 12 || 12}${hour >= 12 ? 'pm' : 'am'} - ${nextHour % 12 || 12}${nextHour >= 12 ? 'pm' : 'am'}`;
            const option = new Option(optionText, optionText);
            timeSelect.appendChild(option);
        }
    }
    </script>
	</body>
</html>