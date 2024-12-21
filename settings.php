<?php include 'assets/php/check-access.php'; ?>
<?php include 'assets/php/client-info.php'; ?>
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
        #zip{
            width: 30%;
        }

        #state{
            width: 60%;
        }

        #add-address-button{
            width: 60%; /* Adjust the width as needed */
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
            
            input[type="text"], input[type="email"], input[type="tel"], select, .jotform-submit {
                width: 100%;
                padding: 10px;
                margin-top: 5px;
                box-sizing: border-box; /* Include padding and border in the element's width */
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
        <div class="content" style="width: 76%;">
            <header>
                <h1>Settings</h1>
            </header>
            <div class="main-content">
                <div class="jotform-section">
                    <h2>Edit Personal Information</h2>
                    <form id="personal-info-form" class="jotform-form">
                        <div class="jotform-form-row">
                            <label for="username" class="jotform-form-label">Userame:</label>
                            <input type="text" id="username" name="username" class="jotform-form-input" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
                        </div>

                        <div class="jotform-form-row">
                            <label for="name" class="jotform-form-label">Name:</label>
                            <input type="text" id="name" name="name" class="jotform-form-input" value="<?php echo htmlspecialchars($userData['name']); ?>" required>
                        </div>

                        <div class="jotform-form-row">
                            <label for="email" class="jotform-form-label">Email:</label>
                            <input type="email" id="email" name="email" class="jotform-form-input" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                        </div>

                        <div class="jotform-form-row">
                            <label for="phone" class="jotform-form-label">Phone:</label>
                            <input type="tel" id="phone" name="phone" class="jotform-form-input" value="<?php echo htmlspecialchars($userData['phone']); ?>" required>
                        </div>

                        <div class="jotform-form-row">
                            <label for="address" class="jotform-form-label">Address:</label>
                            <input type="text" id="address" name="address" class="jotform-form-input" required>
                            &emsp;

                            <label for="city" class="jotform-form-label">City:</label>
                            <input type="text" id="city" name="city" class="jotform-form-input" required>
                            &emsp;

                            <label for="state" class="jotform-form-label">State:</label>
                            <select id="state" name="state" class="jotform-form-input" required>
                                <option value="">Select State</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                            &emsp;

                            <label for="zip" class="jotform-form-label">Zip:</label>
                            <input type="text" id="zip" name="zip" class="jotform-form-input" required>
                            &emsp;

                            <button type="button" id="add-address-button" class="jotform-form-input">Add Address</button>
                        </div>

                        <div class="address-list">
                            <!-- Service list will be displayed here -->
                        </div>
                        
                        <br>

                        <!-- Add more fields for personal information as needed -->

                        <div class="jotform-submit-section">
                            <button type="submit" class="jotform-submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var addAddressButton = document.getElementById("add-address-button");
            var addressList = document.querySelector(".address-list");
            var addressCount = 0;

            addAddressButton.addEventListener("click", function() {
                var address = document.getElementById("address").value;
                var city = document.getElementById("city").value;
                var state = document.getElementById("state").value;
                var zip = document.getElementById("zip").value;

                if (address && city && state && zip) {
                    if (addressCount < 5) {
                        // Create new address element
                        var newAddress = document.createElement("div");
                        newAddress.classList.add("address");
                        newAddress.innerHTML = "<strong>Address:</strong> " + address + ", <strong>City:</strong> " + city + ", <strong>State:</strong> " + state + ", <strong>Zip:</strong> " + zip;
                        addressList.appendChild(newAddress);
                        addressCount++;

                        // Send data to server
                        fetch('assets/php/client-address.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: 'address=' + encodeURIComponent(address) + '&city=' + encodeURIComponent(city) + '&state=' + encodeURIComponent(state) + '&zip=' + encodeURIComponent(zip)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                console.log(data.message);
                            } else {
                                console.error('Failed to add address');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    } else {
                        alert("You can only add up to 5 addresses.");
                    }
                } else {
                    alert("Please fill in all fields.");
                }
            });

            // Fetch existing addresses on load
            fetch('assets/php/client-address.php')
            .then(response => response.json())
            .then(addresses => {
                addresses.forEach(address => {
                    var newAddress = document.createElement("div");
                    newAddress.classList.add("address");
                    newAddress.innerHTML = "<strong>Address:</strong> " + address.street_name + 
                        ", <strong>City:</strong> " + address.city + 
                        ", <strong>State:</strong> " + address.state + 
                        ", <strong>Zip:</strong> " + address.zip_code;
                    addressList.appendChild(newAddress);
                });
            })
            .catch(error => console.error('Error loading addresses:', error));
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
    </script>
	</body>
</html>