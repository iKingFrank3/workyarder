<?php include 'assets/php/check-access.php'; ?>
<?php include 'assets/php/partner-info.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="assets/img/WYicon.png" rel="icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
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

            input[type="text"], input[type="email"], input[type="tel"], select, .jotform-submit {
                width: 100%;
                padding: 10px;
                margin-top: 5px;
                box-sizing: border-box; /* Include padding and border in the element's width */
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

            .terms-container {
                display: flex;
                flex-direction: column; /* Stack vertically by default */
                align-items: center; /* Center align the boxes */
                gap: 30px; /* Space between boxes */
            }

            .terms-box {
                width: 80%; /* Full width on mobile */
                border: 1px solid #ddd;
                border-radius: 8px;
                overflow: hidden;
                transition: box-shadow 0.3s ease;
                cursor: pointer;
                box-sizing: border-box;
                text-align: center; /* Center text and images */
            }

            .terms-box img {
                width: 80px; /* Smaller images on mobile */
                height: auto; /* Maintain aspect ratio */
                margin: 10px 0; /* Space above and below the image */
            }

            .terms-box h3 {
                background-color: #555;
                color: #fff;
                padding: 10px;
                margin: 0;
                font-size: 16px; /* Larger text for readability on mobile */
            }
            
            .mobile-header {
                z-index: 1001; /* Ensure mobile-header is above mobile-sidebar */
                position: relative; /* Needed to make z-index effective */
            }

            .mobile-sidebar {
                z-index: 1000; /* Lower than mobile-header */
                position: fixed; /* Keep this to ensure sidebar is fixed */
            }
            
            .file-inputs {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around; /* Adjusts spacing between inputs */
            }
            
            .file-inputs input[type="file"] {
                flex: 0 0 48%; /* Each input takes nearly half of the container width */
                margin-bottom: 10px; /* Space below each input */
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

        #item-name{
            width: 25%;
        }

        #service-name{
            width: 18%;
        }

        #item-price,
        #item-type,
        #add-item-button,
        #service-price,
        #service-type,
        #add-service-button{
            width: 12%; /* Adjust the width as needed */
        }
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
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto; /* Adjust the margin-top value to move the modal up */
        padding: 20px;
        border: 1px solid #888;
        width: 50%; /* Could be more or less, depending on screen size */
        border-radius: 8px;
        overflow-y: auto; /* Enable vertical scrolling if needed */
        max-height: 70vh; /* Prevent modal from running off the page */
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

    .terms-container {
        display: flex;
        justify-content: center; /* Aligns items to the right */
        gap: 20px; /* Adds space between the boxes */
    }

    .terms-box {
        flex: 0 0 calc(33.33% - 40px);
        margin-right: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        cursor: pointer;
        box-sizing: border-box;
    }

    .terms-box img {
        width: 120px;
        height: 120px;
        margin-bottom: 1rem;
        text-align: center;
        display: block;
        margin: 0 auto;
    }

    .terms-box:last-child {
        margin-right: 0;
    }

    .terms-box:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .terms-box h3 {
        background-color: #555;
        color: #fff;
        padding: 15px;
        margin: 0;
        font-size: 15px;
        text-align: center;
    }

    .photo-gallery {
        display: none;
        flex-direction: column;
        align-items: center;
    }

    .photo-gallery .image-container {
        display: flex;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .photo-gallery img {
        max-width: 50px;
        margin-right: 5px;
        border-radius: 5px;
    }

    .clickable-image {
        max-width: 25%; /* Adjust the size as needed */
        padding: 10px; /* Add padding */
        cursor: pointer;
        transition: transform 0.2s;
    }

    .clickable-image:hover {
        transform: scale(1.05);
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
                <h1>Settings</h1>
            </header>
            <div class="main-content">
                <div class="jotform-section">
                    <h2>Edit Personal Information</h2>
                    <form id="personal-info-form" class="jotform-form" action="assets/php/update-partner.php" method="POST">
                        <div class="jotform-form-row">
                            <label for="username" class="jotform-form-label">Username:</label>
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

                        <!-- Add more fields for personal information as needed -->

                        <div class="jotform-submit-section">
                            <button type="submit" class="jotform-submit">Save Changes</button>
                        </div>
                    </form>
                </div>

                <div class="jotform-section">
                    <h2>Edit Business Information</h2>
                    <form id="business-info-form" class="jotform-form" action="assets/php/update-partner.php" method="POST" enctype="multipart/form-data">
                        
                        <div class="jotform-form-row">
                            <label for="name" class="jotform-form-label">Business Name:</label>
                            <input type="text" id="bus-name" name="bus-name" class="jotform-form-input" value="<?php echo htmlspecialchars($businessData['business_name']); ?>" required>
                        </div>

                        <div class="jotform-form-row">
                            <label for="name" class="jotform-form-label">Business Type:</label>
                            <input type="text" id="bus-type" name="bus-type" class="jotform-form-input" value="<?php echo htmlspecialchars($businessData['business_type']); ?>" readonly>
                        </div>

                        <div class="jotform-form-row">
                            <label class="jotform-form-label">Upload Photos of Equipment:</label>
                            <button type="button" class="jotform-submit" id="toggle-equipment-photos">Upload</button>
                            &emsp;
                            <p id="equipment-instructions" style="display: none;">Please upload clear photos of your equipment. Include a sheet of paper in each photo with your username and name of equipment clearly printed on it. This helps verify the ownership of the equipment.</p>
                            <button type="button" class="jotform-submit" id="view-equipment-photos">View</button>
                                <div class="image-container">
                                    <p id="equipment-message" style="display: none;" data-photos="<?php echo htmlspecialchars(json_encode($equipmentPhotos)); ?>"></p>
                                </div>
                            <div id="equipment-photos" style="display: none;">
                                <div class="file-inputs">
                                    <input type="file" id="equipment-photo1" name="equipment-photos[]" class="jotform-form-input">
                                    <input type="file" id="equipment-photo2" name="equipment-photos[]" class="jotform-form-input">
                                    <input type="file" id="equipment-photo3" name="equipment-photos[]" class="jotform-form-input">
                                </div>
                            </div>
                        </div>

                        <div class="jotform-form-row">
                            <label class="jotform-form-label">Upload Proof of Insurance (if available):</label>
                            <button type="button" class="jotform-submit" id="toggle-insurance-photos">Upload</button>
                            &emsp;
                            <p id="insurance-instructions" style="display: none;">Please upload all relevant insurance documents, ensuring that both the front and back of each document are visible in the photos.</p>
                            <button type="button" class="jotform-submit" id="view-insurance-photos">View</button>
                                <div class="image-container">
                                    <p id="insurance-message" style="display: none;" data-photos="<?php echo htmlspecialchars(json_encode($insurancePhotos)); ?>"></p>
                                </div>
                            <div id="insurance-photos" style="display: none;">
                                <div class="file-inputs">
                                    <input type="file" id="insurance-photo1" name="insurance-photos[]" class="jotform-form-input">
                                    <input type="file" id="insurance-photo2" name="insurance-photos[]" class="jotform-form-input">
                                </div>
                            </div>
                        </div>

                        <!-- Add more fields for business information as needed -->
                        <br>
                        <div class="jotform-submit-section">
                            <button type="submit" class="jotform-submit">Save Changes</button>
                        </div>
                    </form>
                </div>

                <div class="jotform-section">
                    <h2>Edit Payment Information</h2>
                    <form id="payment-info-form" class="jotform-form" action="assets/php/update-partner.php" method="POST">
                        <div class="jotform-form-row">
                            <label for="payment" class="jotform-form-label">Payment Method:</label>
                            <select id="payment" name="payment" class="jotform-form-input" onchange="changePaymentLabel()">
                                <option value="none">-- Select Payment Method --</option>
                                <option value="Cashapp" <?php echo $businessData['payment_method'] == 'Cashapp' ? 'selected' : ''; ?>>Cashapp</option>
                                <option value="Venmo" <?php echo $businessData['payment_method'] == 'Venmo' ? 'selected' : ''; ?>>Venmo</option>
                                <option value="Paypal" <?php echo $businessData['payment_method'] == 'Paypal' ? 'selected' : ''; ?>>Paypal</option>
                                <option value="Direct Deposit" <?php echo $businessData['payment_method'] == 'Direct Deposit' ? 'selected' : ''; ?>>Direct Deposit (2 weeks)</option>
                            </select>
                        </div>
                        
                        <div class="jotform-form-row" id="payment-input-row">
                            <!-- Input field for the selected payment method will be added here dynamically -->
                        </div>                        

                        <!-- Add more fields for personal information as needed -->

                        <div class="jotform-submit-section">
                            <button type="submit" class="jotform-submit">Save Changes</button>
                        </div>
                    </form>
                </div>

                <div class="jotform-section">
                    <h2>Terms and Conditions & Protocol Policy</h2>
                    <div class="terms-container">
                        <div class="terms-box" onclick="openTermsModal()">
                            <h3 class="package-name">Terms and Conditions</h3>
                            <p style="text-align: center;">Review our Terms and Conditions.</p>
                            <p><img src="assets/img/file-contract-solid.svg" alt="Terms and Conditions"></p>
                        </div>
                        <div class="terms-box" onclick="openProtocolModal()">
                            <h3 class="package-name">Protocol Policy</h3>
                            <p style="text-align: center;">Review our Protocol Policy.</p>
                            <p><img src="assets/img/protocol-policy.png" alt="Terms and Conditions"></p>
                        </div>
                    </div>
                    <!-- Modal for Terms and Conditions -->
                    <div id="termsModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2 style="text-align: center;">Terms and Conditions</h2>
                            <div class="modal-text">
                                <h1 style="text-align: center;">WorkYarder Provider Terms and Conditions</h1>

                                <h3>1. Independent Contractor Relationship:</h3>
                                <p>By using WorkYarder, you acknowledge and agree that you are an independent contractor, not an employee of WorkYarder. As an independent contractor, you are solely responsible for your own taxes, insurance, benefits, and compliance with local laws and regulations.</p>

                                <h3>2. Appointment Attendance:</h3>
                                <p>You are expected to attend appointments punctually and reliably. Failure to appear at scheduled appointments without valid reasons for more than three times may result in the removal and deactivation of your WorkYarder account.</p>

                                <h3>3. Prohibited Activities:</h3>
                                <p>a. <strong>Solicitation:</strong> Soliciting customers outside of the WorkYarder platform, attempting to lure customers away from the platform, or engaging in any form of promotion without authorization is strictly prohibited.</p>
                                <p>b. <strong>Customer Poaching:</strong> Attempting to steal or divert customers from other service providers on the platform is prohibited.</p>
                                <p>c. <strong>Unethical Conduct:</strong> Engaging in any form of unethical conduct, including but not limited to theft, dishonesty, or misrepresentation, is strictly prohibited.</p>

                                <h3>4. Equipment and Insurance:</h3>
                                <p>You are responsible for ensuring that you have the necessary equipment and updated insurance coverage to perform your services through WorkYarder. If you choose to use insurance provided through WorkYarder, you must adhere to the terms and conditions of that insurance.</p>

                                <h3>5. Reporting Damages:</h3>
                                <p>In the event of any damages occurring during the provision of services, you agree to promptly report such damages to WorkYarder. You further agree that you may be responsible for covering the costs of damages, as well as any associated wages, if applicable, out of your own pocket.</p>

                                <h3>6. Data Privacy:</h3>
                                <p>WorkYarder respects your privacy and will not misuse or sell your data. By using the platform, you consent to the collection and use of your data in accordance with our Privacy Policy.</p>

                                <h3>7. Termination:</h3>
                                <p>WorkYarder reserves the right to terminate or suspend your account at any time and for any reason, including but not limited to violation of these Terms or engaging in fraudulent activities.</p>

                                <h3>8. Equipment and Performance:</h3>
  <p>Your equipment and performance will determine the type of jobs that appear in the 'WorkYarder Gigs' section. Ensure that your equipment is well-maintained and your services are delivered at a high standard to maximize your opportunities on the platform.</p>

                                <h3>9. Amendments:</h3>
                                <p>WorkYarder reserves the right to amend these Terms at any time. Any changes to the Terms will be communicated to you, and your continued use of the platform after such changes constitutes your acceptance of the amended Terms.</p>

                                <h3>10. Governing Law:</h3>
                                <p>These Terms shall be governed by and construed in accordance with the laws of Georgia, without regard to its conflict of law provisions.</p>

                                <p>By using WorkYarder, you agree to abide by these Terms and any other policies or guidelines posted on the platform. If you have any questions or concerns regarding these Terms, please contact us at contact@workyarder.com.</p>
                            </div>
                            <button class="jotform-submit" id="termsCond" style="margin-top: 20px; display: block; margin: 0 auto;">Accept</button>
                        </div>
                    </div>

                    <!-- Modal for Protocol Policy -->
                    <div id="protocolModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2 style="text-align: center;">Protocol Policy</h2>
                            <div class="protocol-modal-text">
                                <!-- Content will be populated based on the business type -->
                            </div>
                            <button class="jotform-submit" id="protPol" style="margin-top: 20px; display: block; margin: 0 auto;">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openTermsModal() {
            document.getElementById('termsModal').style.display = 'block';
        }

        function openProtocolModal() {
            document.getElementById('protocolModal').style.display = 'block';
        }

        // Close modal when the user clicks on <span> (x)
        var closeButtons = document.getElementsByClassName("close");
        for (var i = 0; i < closeButtons.length; i++) {
            closeButtons[i].onclick = function() {
                var modals = document.getElementsByClassName("modal");
                for (var j = 0; j < modals.length; j++) {
                    modals[j].style.display = "none";
                }
            }
        }

        // document.addEventListener("DOMContentLoaded", function() {
        //     var addItemButton = document.getElementById("add-item-button");
        //     var itemList = document.querySelector(".item-list");
        //     var itemCount = 0;

        //     addItemButton.addEventListener("click", function() {
        //         if (itemCount < 3) {
        //             var itemName = document.getElementById("item-name").value;
        //             var itemPrice = document.getElementById("item-price").value;
        //             var itemType = document.getElementById("item-type").value;

        //             if (itemName && itemPrice && itemType) {
        //                 var newItem = document.createElement("div");
        //                 newItem.classList.add("item");
        //                 newItem.innerHTML = "<strong>Name:</strong> " + itemName + ", <strong>Price:</strong> " + itemPrice + ", <strong>Type:</strong> " + itemType;
        //                 itemList.appendChild(newItem);
        //                 itemCount++;
        //             } else {
        //                 alert("Please fill in all fields.");
        //             }
        //         } else {
        //             alert("You can only add up to 10 items.");
        //         }
        //     });
        // });

        // document.addEventListener("DOMContentLoaded", function() {
        //     var addServiceButton = document.getElementById("add-service-button");
        //     var serviceList = document.querySelector(".service-list");
        //     var serviceCount = 0;

        //     addServiceButton.addEventListener("click", function() {
        //         if (serviceCount < 15) {
        //             var serviceName = document.getElementById("service-name").value;
        //             var servicePrice = document.getElementById("service-price").value;
        //             var serviceType = document.getElementById("service-type").value;

        //             if (serviceName && servicePrice && serviceType) {
        //                 var newService = document.createElement("div");
        //                 newService.classList.add("service");
        //                 newService.innerHTML = "<strong>Name:</strong> " + serviceName + ", <strong>Price:</strong> " + servicePrice + ", <strong>Type:</strong> " + serviceType;
        //                 serviceList.appendChild(newService);
        //                 serviceCount++;
        //             } else {
        //                 alert("Please fill in all fields.");
        //             }
        //         } else {
        //             alert("You can only add up to 15 service items.");
        //         }
        //     });
        // });
        
        function changePaymentLabel() {
            var selectElement = document.getElementById("payment");
            var selectedOption = selectElement.options[selectElement.selectedIndex].value;

            var paymentInputRow = document.getElementById("payment-input-row");

            // Clear previous content
            paymentInputRow.innerHTML = "";

            // Check if the selected option is not the default option
            if (selectedOption !== "none") {
                // Create new label and input based on the selected payment method
                var label = document.createElement("label");
                label.setAttribute("for", "payment-input");
                label.setAttribute("class", "jotform-form-label");
                label.textContent = selectedOption + ":";

                var input = document.createElement("input");
                input.setAttribute("type", "text");
                input.setAttribute("id", "payment-input");
                input.setAttribute("name", "payment-input");
                input.setAttribute("class", "jotform-form-input");
                input.setAttribute("required", "");

                // Append the label and input to the payment input row
                paymentInputRow.appendChild(label);
                paymentInputRow.appendChild(input);
            }
        }

        // Fetch business type and populate Protocol Policies
        document.addEventListener('DOMContentLoaded', function() {
            fetch('assets/php/getBusinessType.php')
            .then(response => response.json())
            .then(data => {
                const protocolPolicies = document.querySelector('.protocol-modal-text');
                const businessTypeInput = document.querySelector('#bus-type');
                businessTypeInput.placeholder = data.placeholder; // Set the placeholder based on business type
                
                if (data.termsStatus === 'No' || data.termsStatus === null) {
                    document.getElementById('termsCond').style.display = 'block';
                } else {
                    document.getElementById('termsCond').style.display = 'none';
                }

                if (data.protocolStatus === 'No' || data.protocolStatus === null) {
                    document.getElementById('protPol').style.display = 'block';
                } else {
                    document.getElementById('protPol').style.display = 'none';
                }
                
                switch(data.businessType) {
                    case 'lawn-care':
                        protocolPolicies.innerHTML = `<h1 style="text-align: center;">WorkYarder Protocol Policies: Lawn Care</h1>

                            <h3>General Rules:</h3>
                                <ul>
                                    <li>Service providers must report damages prior to starting a job.</li>
                                    <li>Accepting orders and not completing them or not showing up may result in a fine of $20-$100 and/or termination of the service provider's account.</li>
                                </ul>

                            <h3>Arrival and Completion:</h3>
                                <ul>
                                    <li>Service providers agree to arrive at the job site as soon as possible, complete the job, and leave as soon as possible.</li>
                                    <li>Any damages reported by a customer must be properly submitted in writing, along with a photo, via damage report, email (if applicable), or mail. Failure to do so may result in the service provider being responsible for covering the full damages.</li>
                                    <li>Service providers must comply with all laws and regulations while on the job site.</li>
                                </ul>

                            <h3>Job Types and Expectations:</h3>
                                <ul>
                                    <li>The expectations for each job type depend on the tier selected by the customer.</li>
                                </ul>

                                <h2 style="text-align: center;">Lawn Care Breakdown:</h2>
                                
                                <h3>Simple Cut:</h3>
                                    <ul>
                                        <li>Mow lawn</li>
                                        <li>Lawn edging</li>
                                        <li>Clean up debris</li>
                                    </ul>

                                <h3>Snow:</h3>
                                    <ul>
                                        <li>Snow removal</li>
                                        <li>Salt application (if necessary)</li>
                                    </ul>

                                <h3>Leaf:</h3>
                                    <ul>
                                        <li>Leaf removal</li>
                                    </ul>

                                <h2 style="text-align: center;">Tiers and Requirements:</h2>
                                
                                <h3>Tier 1</h3>
                                <p>Simple Cut:</p>
                                    <ul>
                                        <li><strong>Minimum Equipment Requirement: </strong>Must have at least a riding lawn mower and timmers/edgers.</li>
                                        <li><strong>Expectations: </strong>Service providers in this tier are expected to mow the lawn, edge it up (as needed), and clean up lawn debris efficiently.</li>
                                    </ul>

                                <p>Snow Removal:</p>
                                    <ul>
                                        <li><strong>Minimum Equipment Requirement: </strong>Must have at least a snow blower.</li>
                                        <li><strong>Expectations: </strong>Service providers in this tier are expected to shovel snow and apply salt if necessary.</li>
                                    </ul>

                                <p>Leaf Removal:</p>
                                    <ul>
                                        <li><strong>Minimum Equipment Requirement: </strong>Must have at least a leaf blower</li>
                                        <li><strong>Expectations: </strong>Service providers in this tier are expected to rake leaves and dispose of them properly.</li>
                                    </ul>

                                <h3>Tier 2</h3>
                                <p>Simple Cut:</p>
                                    <ul>
                                        <li><strong>Minimum Equipment Requirement: </strong>Must have at least a zero turn lawn mower and timmers/edgers or maintaining 3/5 stars (minimum 7 reviews).</li>
                                        <li><strong>Expectations: </strong>Service providers in this tier are expected to mow the lawn, edge it up, and clean up lawn debris efficiently.</li>
                                    </ul>

                                <p>Snow Removal:</p>
                                    <ul>
                                        <li><strong>Minimum Equipment Requirement: </strong>Must have at least a snow plow attachment for vehicle or maintaining 3/5 stars (minimum 7 reviews).</li>
                                        <li><strong>Expectations: </strong>Service providers in this tier are expected to use a snow blower for snow removal and apply salt if necessary.</li>
                                    </ul>

                                <p>Leaf Removal:</p>
                                    <ul>
                                        <li><strong>Minimum Equipment Requirement: </strong>Must have at least a lawn mower with leaf sucking ability (or leaf vacuum) or maintaining 3/5 stars (minimum 7 reviews).</li>
                                        <li><strong>Expectations: </strong>Service providers in this tier are expected to use a leaf blower for leaf removal and dispose of leaves properly.</li>
                                    </ul>

                                <h3>Tier 3</h3>
                                <p>Simple Cut:</p>
                                    <ul>
                                        <li><strong>Minimum Equipment Requirement: </strong>Must be maintaining 4/5 stars (minimum 15 reviews).</li>
                                        <li><strong>Expectations: </strong>Service providers in this tier are expected to mow the lawn, edge it up, and clean up lawn debris efficiently. Additionally, they should perform extra cleanup and/or trimming of trees and bushes (as need by or requested).</li>
                                    </ul>

                                <p>Snow Removal:</p>
                                    <ul>
                                        <li><strong>Minimum Equipment Requirement: </strong>Must be maintaining 4/5 stars (minimum 15 reviews).</li>
                                        <li><strong>Expectations: </strong>Service providers in this tier are expected to use a snow plow attachment for efficient snow removal and apply salt if necessary.</li>
                                    </ul>

                                <p>Leaf Removal:</p>
                                    <ul>
                                        <li><strong>Must be maintaining 4/5 stars (minimum 15 reviews).</li>
                                        <li><strong>Expectations: </strong>Service providers in this tier are expected to use a lawn mower with leaf vacuum for efficient leaf removal and dispose of leaves properly.</li>
                                    </ul>`; // Your lawn care policies HTML content
                        break;
                    case 'pool-care':
                        protocolPolicies.innerHTML = `<h1 style="text-align: center;">WorkYarder Protocol Policies: Pool Care</h1>

                            <h3>General Guidelines:</h3>
                            <ul>
                                <li>Service providers must report any damages or issues promptly.</li>
                                <li>Failure to complete assigned tasks or appointments may result in penalties or account termination.</li>
                            </ul>

                            <h3>Arrival and Completion:</h3>
                            <ul>
                                <li>Service providers must arrive at the job site promptly and complete tasks efficiently.</li>
                                <li>Any damages reported by a customer must be properly documented and reported in writing.</li>
                                <li>Service providers must adhere to all relevant laws and regulations while on the job site.</li>
                            </ul>

                            <h3>Job Duties and Responsibilities:</h3>
                            <ul>
                                <li>The specific tasks for each job type may vary depending on customer requirements and service tier.</li>
                            </ul>

                            <h2 style="text-align: center;">Pool Care Breakdown:</h2>

                            <h3>Maintenance:</h3>
                            <ul>
                                <li>Skim pool surface to remove debris</li>
                                <li>Brush pool walls and vacuum pool floor</li>
                                <li>Test water levels and chemical balance</li>
                                <li>Adjust chemicals as needed</li>
                                <li>Clean or replace pool filters</li>
                                <li>Cover pool if applicable</li>
                            </ul>

                            <h3>Diagnostic:</h3>
                            <ul>
                                <li>Identify and assess pool issues</li>
                                <li>Provide detailed evaluation and repair recommendations</li>
                                <li>Offer referrals for specialized services if necessary</li>
                            </ul>

                            <h3>Opening:</h3>
                            <ul>
                                <li>Remove pool cover</li>
                                <li>Clean pool thoroughly</li>
                                <li>Start up pool equipment</li>
                                <li>Test and balance water chemistry</li>
                                <li>Apply necessary treatments</li>
                                <li>Ensure pool is ready for use</li>
                            </ul>

                            <h3>Closing:</h3>
                            <ul>
                                <li>Test and balance water chemistry</li>
                                <li>Clean pool thoroughly</li>
                                <li>Lower water levels if required</li>
                                <li>Prepare equipment for winterization</li>
                                <li>Apply closing treatments</li>
                                <li>Securely cover pool</li>
                            </ul>

                            <h2 style="text-align: center;">Tiers and Requirements:</h2>

                            <h3>Tier 1</h3>
                            <p>Maintenance:</p>
                            <ul>
                                <li><strong>Minimum Equipment Requirement:</strong> Skimmer, brush, manual vacuum</li>
                                <li><strong>Expectations:</strong> Efficiently clean pool, perform basic water tests, and apply necessary treatments. Provide basic diagnostic assessments and recommendations.</li>
                            </ul>

                            <h3>Tier 2</h3>
                            <p>Maintenance:</p>
                            <ul>
                                <li><strong>Minimum Equipment Requirement:</strong> Filter cleaner, test kit, automatic pool cleaner, advanced chemical treatments or maintaining 3/5 stars (minimum 7 reviews).</li>
                                <li><strong>Expectations:</strong> Thoroughly clean pool, conduct detailed water testing and balancing, and provide comprehensive diagnostic assessments and recommendations.</li>
                            </ul>

                            <h3>Tier 3</h3>
                            <p>Maintenance:</p>
                            <ul>
                                <li><strong>Minimum Equipment Requirement:</strong> Must be maintaining 4/5 stars (minimum 15 reviews).</li>
                                <li><strong>Expectations:</strong> Offer top-notch pool maintenance services, including meticulous cleaning, expert water testing and balancing, and in-depth diagnostic evaluations with tailored recommendations.</li>
                            </ul>`; // Your pool care policies HTML content
                        break;
                    case 'pw-care':
                        protocolPolicies.innerHTML = `<h1 style="text-align: center;">WorkYarder Protocol Policies: Pressure Washing</h1>

                            <h3>General Guidelines:</h3>
                            <ul>
                                <li>Service providers must report any damages or issues promptly.</li>
                                <li>Failure to complete assigned tasks or appointments may result in penalties or account termination.</li>
                            </ul>

                            <h3>Arrival and Completion:</h3>
                            <ul>
                                <li>Service providers must arrive at the job site promptly and complete tasks efficiently.</li>
                                <li>Any damages reported by a customer must be properly documented and reported in writing.</li>
                                <li>Service providers must adhere to all relevant laws and regulations while on the job site.</li>
                            </ul>

                            <h3>Job Duties and Responsibilities:</h3>
                            <ul>
                                <li>The specific tasks for each job type may vary depending on customer requirements and service tier.</li>
                            </ul>

                            <h2 style="text-align: center;">Pressure Washing Breakdown:</h2>

                            <h3>Pressure Wash Cleaning:</h3>
                            <ul>
                                <li>Clean surfaces using pressure washer equipment.</li>
                            </ul>

                            <h3>Gutter Cleaning:</h3>
                            <ul>
                                <li>Inspect gutters for damage or blockages.</li>
                                <li>Remove debris by scooping and flushing gutters.</li>
                                <li>Ensure downspouts are clear and properly aligned.</li>
                            </ul>

                            <h3>Dumpster Cleaning:</h3>
                            <ul>
                                <li>Remove debris and trash from dumpsters.</li>
                                <li>Apply cleaning solution and scrub surfaces thoroughly.</li>
                                <li>Rinse off cleaning solution and sanitize dumpster.</li>
                            </ul>

                            <h2 style="text-align: center;">Tiers and Requirements:</h2>

                            <h3>Tier 1</h3>
                            <p>Pressure Wash Cleaning:</p>
                            <ul>
                                <li><strong>Minimum Equipment Requirement:</strong> Basic pressure washer with standard nozzles.</li>
                                <li><strong>Expectations:</strong> Complete pressure washing tasks efficiently, focusing on basic cleaning needs with attention to detail and speed.</li>
                            </ul>

                            <h3>Tier 2</h3>
                            <p>Gutter Cleaning:</p>
                            <ul>
                                <li><strong>Minimum Equipment Requirement:</strong> Professional-grade pressure washer with high PSI and surface cleaner attachment or maintaining 3/5 stars (minimum 7 reviews).</li>
                                <li><strong>Expectations:</strong> Conduct thorough pressure washing services, addressing both visible and hidden dirt, while providing clear communication and basic maintenance advice.</li>
                            </ul>

                            <h3>Tier 3</h3>
                            <p>Dumpster Cleaning:</p>
                            <ul>
                                <li><strong>Minimum Equipment Requirement:</strong> Must be maintaining 4/5 stars (minimum 15 reviews).</li>
                                <li><strong>Expectations:</strong> Deliver top-quality pressure washing results with precision and efficiency, utilizing advanced equipment and techniques to ensure superior cleanliness and customer satisfaction.</li>
                            </ul>`; // Your pressure washing policies HTML content
                        break;
                    default:
                        protocolPolicies.innerHTML = `<p>Protocol Policies not found for your business type.</p>`;
                }
            })
            .catch(error => console.error('Error:', error));
        });

        document.getElementById('termsCond').addEventListener('click', function() {
            if (confirm('I have read and agree to the Terms and Conditions.')) {
                updateBusinessInfo('terms');
            }
        });

        document.getElementById('protPol').addEventListener('click', function() {
            if (confirm('I have acknowledged and agree to abide by the Protocol Policy for each service, requirement, and tier.')) {
                updateBusinessInfo('protocol');
            }
        });

        function updateBusinessInfo(field) {
            fetch('assets/php/updateBusinessInfo.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `field=${field}`
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                if (data.message.includes('successfully')) {
                    if (field === 'terms') {
                        document.getElementById('termsCond').style.display = 'none';
                    } else if (field === 'protocol') {
                        document.getElementById('protPol').style.display = 'none';
                    }
                }
            })
            .catch(error => console.error('Error:', error));
        }

        document.addEventListener('DOMContentLoaded', function() {
            const toggleEquipmentPhotos = document.getElementById('toggle-equipment-photos');
            const viewEquipmentPhotos = document.getElementById('view-equipment-photos');
            const equipmentPhotosDiv = document.getElementById('equipment-photos');
            const equipmentMessage = document.getElementById('equipment-message');

            toggleEquipmentPhotos.addEventListener('click', function() {
                if (toggleEquipmentPhotos.textContent === 'Hide') {
                    equipmentPhotosDiv.style.display = 'none';
                    toggleEquipmentPhotos.textContent = 'Upload';
                    viewEquipmentPhotos.style.display = 'block'; // Show the 'View' button
                    equipmentMessage.style.display = 'none';
                    document.getElementById('equipment-instructions').style.display = 'none'; // Show instructions
                } else {
                    equipmentPhotosDiv.style.display = 'block';
                    toggleEquipmentPhotos.textContent = 'Hide';
                    viewEquipmentPhotos.style.display = 'none';
                    equipmentMessage.style.display = 'none';
                    document.getElementById('equipment-instructions').style.display = 'block'; // Show instructions
                }
            });

            viewEquipmentPhotos.addEventListener('click', function() {
                const photos = JSON.parse(equipmentMessage.getAttribute('data-photos'));
                if (photos && photos.length > 0) {
                    if(viewEquipmentPhotos.textContent === 'View') {
                        equipmentMessage.innerHTML = photos.map(photo => `<img src="${photo}" alt="Equipment Photo" class="clickable-image">`).join('');
                        equipmentMessage.style.display = 'block';
                        viewEquipmentPhotos.textContent = 'Hide'; // Change text to 'Hide'
                        toggleEquipmentPhotos.style.display = 'none'; // Hide the 'Upload' button
                        // Add click event to each image
                        document.querySelectorAll('.clickable-image').forEach(img => {
                            img.addEventListener('click', () => enlargeImage(img.src));
                        });
                    } else {
                        equipmentMessage.style.display = 'none';
                        viewEquipmentPhotos.textContent = 'View'; // Change text to 'Hide'
                        toggleEquipmentPhotos.style.display = 'block'; // Hide the 'Upload' button
                    }
                } else {
                    if(viewEquipmentPhotos.textContent === 'View') {
                    equipmentMessage.innerHTML = 'No photos available';
                    equipmentMessage.style.display = 'block';
                    viewEquipmentPhotos.textContent = 'Hide';
                    toggleEquipmentPhotos.style.display = 'none';
                } else {
                    equipmentMessage.style.display = 'none';
                    viewEquipmentPhotos.textContent = 'View';
                    toggleEquipmentPhotos.style.display = 'block';
                }
                }
            });

            const toggleInsurancePhotos = document.getElementById('toggle-insurance-photos');
            const viewInsurancePhotos = document.getElementById('view-insurance-photos');
            const insurancePhotosDiv = document.getElementById('insurance-photos');
            const insuranceMessage = document.getElementById('insurance-message');

            toggleInsurancePhotos.addEventListener('click', function() {
                if (toggleInsurancePhotos.textContent === 'Hide') {
                    insurancePhotosDiv.style.display = 'none';
                    toggleInsurancePhotos.textContent = 'Upload';
                    viewInsurancePhotos.style.display = 'block';
                    insuranceMessage.style.display = 'none';
                    document.getElementById('insurance-instructions').style.display = 'none'; // Hide instructions
                } else {
                    insurancePhotosDiv.style.display = 'block';
                    toggleInsurancePhotos.textContent = 'Hide';
                    viewInsurancePhotos.style.display = 'none';
                    insuranceMessage.style.display = 'none';
                    document.getElementById('insurance-instructions').style.display = 'block'; // Show instructions
                }
            });

            viewInsurancePhotos.addEventListener('click', function() {
                const photos = JSON.parse(insuranceMessage.getAttribute('data-photos'));
                if (photos && photos.length > 0) {
                    if(toggleInsurancePhotos.textContent === 'View') {
                        insuranceMessage.innerHTML = photos.map(photo => `<img src="${photo}" alt="Insurance Photo" class="clickable-image">`).join('');
                        insuranceMessage.style.display = 'block';
                        viewInsurancePhotos.textContent = 'Hide'; // Change text to 'Hide'
                        toggleInsurancePhotos.style.display = 'none'; // Hide the 'Upload' button
                        // Add click event to each image
                        document.querySelectorAll('.clickable-image').forEach(img => {
                            img.addEventListener('click', () => enlargeImage(img.src));
                        });
                    } else {
                        insuranceMessage.style.display = 'none';
                        viewInsurancePhotos.textContent = 'View'; // Change text to 'Hide'
                        toggleInsurancePhotos.style.display = 'block'; // Hide the 'Upload' button
                    }
                } else {
                    if(viewInsurancePhotos.textContent === 'View') {
                        insuranceMessage.innerHTML = '&emsp; No photos available';
                        insuranceMessage.style.display = 'block';
                        viewInsurancePhotos.textContent = 'Hide';
                        toggleInsurancePhotos.style.display = 'none';
                    } else if(viewInsurancePhotos.textContent === 'Hide') {
                        insuranceMessage.style.display = 'none';
                        viewInsurancePhotos.textContent = 'View';
                        toggleInsurancePhotos.style.display = 'block';
                    }
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

        document.addEventListener('DOMContentLoaded', function() {
            fetch('assets/php/partnerVerification.php')
            .then(response => response.json())
            .then(data => {
                const nav = document.querySelector('.nav');
                if (data.approved === 'No') {
                    nav.innerHTML = `
                        <li><a href="partner.php"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li><a href="partner-settings.php"><i class="fas fa-cogs"></i> Settings</a></li>
                    `;
                }
            })
            .catch(error => console.error('Error:', error));
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