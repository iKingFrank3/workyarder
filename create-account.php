<?php include 'assets/php/check-access.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
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

        /* Add styles for checkbox group */
        .checkbox-group {
            display: flex;
            flex-direction: column;
        }

        .checkbox-row {
            display: flex;
            margin-bottom: 10px;
        }

        .checkbox-label {
            margin-right: 10px;
        }
        
        .radio-group {
            display: flex;
            flex-direction: column;
        }

        .radio-row {
            display: flex;
            margin-bottom: 10px;
        }

        .radio-label {
            margin-right: 10px;
        }
        
        .numeric-row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .numeric-label {
            margin-right: 10px;
        }

        .numeric-input {
            width: 50px; /* Adjust the width as needed */
            text-align: center;
        }

        .numeric-button {
            font-size: 1.5em;
            cursor: pointer;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        footer {
            margin-top: auto;
        }

        .idk-row-lawn,
        .idk-row-pool,
        .idk-row-pw {
        display: flex;
        justify-content: center; /* Center the content horizontally */
        align-items: center;
        overflow: hidden;
        }

        .idk-row-lawn input[type="checkbox"],
        .idk-row-pool input[type="checkbox"],
        .idk-row-pw input[type="checkbox"] {
            margin-right: -50px; /* Adjust the spacing between the checkbox and label as needed */
            flex: 1;
        }

        #no-property-size-label{
            display: block;
            overflow: hidden;
        }

        #lawn-size,
        #pool-size,
        #pressure-washing-size {
            width: 30%;
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
                <li><a href="create-account.php"><i class="fas fa-user-plus"></i> Create Account</a></li>
            </ul>
			<a href="assets/php/logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="mobile-sidebar">
            <ul class="nav">
                <li><a href="create-account.php"><i class="fas fa-user-plus"></i> Create Account</a></li>
            </ul>
            <a href="assets/php/logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="content">
            <header>
                <h1>Create New Account</h1>
            </header>
            <div class="main-content">
                <div class="jotform-section">
                    <h2>Personal Info</h2>
                    <form id="personal-info-form" action="assets/php/create-user.php" method="post" class="jotform-form" onsubmit="return validatePassword()">
                        <div class="jotform-form-row">
                            <label for="name" class="jotform-form-label">Name:</label>
                            <input type="text" id="name" name="name" class="jotform-form-input" required>
                        </div>
                        
                        <div class="jotform-form-row">
                            <label for="username" class="jotform-form-label">Username:</label>
                            <input type="text" id="username" name="username" class="jotform-form-input" required>
                        </div>

                        <div class="jotform-form-row">
                            <label for="email" class="jotform-form-label">Email:</label>
                            <input type="text" id="email" name="email" class="jotform-form-input" value="<?php echo $_SESSION['username']; ?>" readonly="readonly">
                        </div>

                        <div class="jotform-form-row">
                            <label for="phone" class="jotform-form-label">Phone:</label>
                            <input type="tel" id="phone" name="phone" class="jotform-form-input" required>
                        </div>

                        <div class="jotform-form-row">
                            <label for="password" class="jotform-form-label">Password:</label>
                            <input type="password" id="password" name="password" class="jotform-form-input" required>
                        </div>
                            
                        <div class="jotform-form-row">
                            <label for="confirm-password" class="jotform-form-label">Confirm Password:</label>
                            <input type="password" id="confirm-password" name="confirm-password" class="jotform-form-input" required>
                        </div>
                        
                        <!-- Add this div for displaying the alert -->
                            <div id="password-mismatch" style="color: red; display: none;">
                                Passwords do not match
                            </div>
                        <br>

                        <h2>Address</h2>
                        <div class="jotform-form-row">
                            <label for="street-address" class="jotform-form-label">Street Address:</label>
                            <input type="text" id="street-address" name="street-address" class="jotform-form-input" required>
                        </div>

                        <div class="jotform-form-row">
                            <label for="city" class="jotform-form-label">City:</label>
                            <input type="text" id="city" name="city" class="jotform-form-input" required>
                        </div>

                        <div class="jotform-form-row">
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
                        </div>

                        <div class="jotform-form-row">
                            <label for="zip-code" class="jotform-form-label">Zip Code:</label>
                            <input type="text" id="zip-code" name="zip-code" class="jotform-form-input" required>
                        </div>
                        <br>

                        <div class="checkbox-group client-section" style="display:none;">
                            <label>What services are you interested in?</label>
                            <br>
                            <br>
                            <div class="checkbox-row">
                                <div class="jotform-form-row">
                                    <input type="checkbox" id="lawn-care" name="lawn-care">
                                    <label for="lawn-care">Lawn Care</label>
                                </div>
                                &emsp;
                                &emsp;
                                &emsp;
                                <input type="number" step="0.1" value="0.0" id="lawn-size" name="lawn-size" class="jotform-form-input" style="display: none;" placeholder="Enter lawn size in acres">
                            </div>
                            <div class="idk-row-lawn" style="display: none;">
                                <div class="jotform-form-row">
                                    <input type="checkbox" value="idk" id="no-property-size-lawn" name="no-property-size" class="jotform-form-input">
                                    <label for="no-property-size-lawn" id="no-property-size-label" class="jotform-form-label">Not sure</label>
                                    </div>
                            </div>
                            <div class="checkbox-row">
                                <div class="jotform-form-row">
                                    <input type="checkbox" id="pool-care" name="pool-care">
                                    <label for="pool-care">Pool Care</label>
                                </div>
                                &emsp;
                                &emsp;
                                &emsp;
                                <input type="text" id="pool-size" name="pool-size" class="jotform-form-input" style="display: none;" placeholder="Enter pool size in gallons">
                            </div>
                            <div class="idk-row-pool" style="display: none;">
                                <div class="jotform-form-row">
                                <input type="checkbox" value="idk" id="no-property-size-pool" name="no-property-size" class="jotform-form-input">
                                <label for="no-property-size-pool" id="no-property-size-label" class="jotform-form-label">Not sure</label>
                                </div>
                            </div>
                            <div class="checkbox-row">
                                <div class="jotform-form-row">
                                    <input type="checkbox" id="pressure-washing" name="pressure-washing">
                                    <label for="pressure-washing">Pressure Washing Care</label>
                                </div>
                                &emsp;
                                &emsp;
                                &emsp;
                                <input type="number" step="1" id="pressure-washing-size" name="pressure-washing-size" class="jotform-form-input" style="display: none;" placeholder="Enter lot size in sq feet">
                            </div>
                            <div class="idk-row-pw" style="display: none;">
                                <div class="jotform-form-row">
                                <input type="checkbox" value="idk" id="no-property-size-pressure-washing" name="no-property-size" class="jotform-form-input">
                                <label for="no-property-size-pressure-washing" id="no-property-size-label" class="jotform-form-label">Not sure</label>
                                </div>
                            </div>
                            
                            <!-- New checkbox for agreeing to terms and conditions with modal trigger -->
                            <div class="form-row" style="text-align: center; margin-top: 20px;">
                                <input type="checkbox" id="terms" name="terms" required>
                                <label for="terms">I agree to the <a href="#" class="terms-link" onclick="openTermsModal()">Terms and Conditions</a> and <a href="#" class="privacy-link" onclick="openPrivacyModal()">Privacy Policy</a>.</label>
                            </div>
                            <br>
                        </div>

                        <div class="checkbox-group provider-section" style="display:none;">
                        <h2>Business Info</h2>
                        <div class="jotform-form-row">
                            <label for="business-name" class="jotform-form-label">Business Name:</label>
                            <input type="text" id="business-name" name="business-name" class="jotform-form-input">
                        </div>

                        <div class="jotform-form-row">
                            <label for="business-phone" class="jotform-form-label">Business Phone:</label>
                            <input type="tel" id="business-phone" name="business-phone" class="jotform-form-input">
                        </div>

                        <div class="jotform-form-row">
                            <label for="business-email" class="jotform-form-label">Business Email:</label>
                            <input type="email" id="business-email" name="business-email" class="jotform-form-input">
                        </div>

                        <div class="jotform-form-row">
                            <label class="jotform-form-label">Do have insurance?</label>
                            <div class="radio-group">
                                <div class="radio-row">
                                    <input type="radio" id="insurance-yes" name="insurance" value="Yes">
                                    <label class="radio-label" for="insurance-yes">Yes</label>
                                    
                                    <input type="radio" id="insurance-no" name="insurance" value="No">
                                    <label class="radio-label" for="insurance-no">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="jotform-form-row">
                            <label class="jotform-form-label">Do have your own equipment?</label>
                            <div class="radio-group">
                                <div class="radio-row">
                                    <input type="radio" id="equipment-yes" name="equipment" value="Yes">
                                    <label class="radio-label" for="equipment-yes">Yes</label>
                                    
                                    <input type="radio" id="equipment-no" name="equipment" value="No">
                                    <label class="radio-label" for="equipment-no">No</label>
                                </div>
                                <input type="text" id="equipment-details" name="equipment-details" class="jotform-form-input" style="display: none;width: 95%" placeholder="Name(s) of equipment">
                            </div>
                        </div>
                    </div>
                        <!-- Other form fields... -->

                        <div class="jotform-submit-section">
                            <button type="submit" class="jotform-submit">Finish Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal for Terms and Conditions -->
    <div id="termsModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeTermsModal()">&times;</span>
            <h2>Terms and Conditions</h2>
            <div class="modal-text">
                <h3>1. Introduction</h3>
                <p>Welcome to Workyarder.com. By accessing or using our website, you agree to comply with and be bound by these Terms and Conditions. If you do not agree with any part of these terms, you must not use our website.</p>

                <h3>2. Services Provided</h3>
                <p>Workyarder.com allows users to search for lawn care, pool care, and pressure washing providers, book appointments, or create general requests to be matched with a provider. We aim to provide accurate quotes based on saved measurements of your lawn, pool, gutter,  driveway, walkway, and sidewalk areas.</p>

                <h3>3. User Accounts</h3>
                <p>Eligibility: You must be at least 18 years old to create an account and use our services.<br>
                Account Security: You are responsible for maintaining the confidentiality of your account information and password. You agree to notify us immediately of any unauthorized use of your account.</p>

                <h3>4. Service Providers</h3>
                <p>Independent Contractors: Service providers listed on our website are independent contractors and not employees of Workyarder.com. We are not responsible for the actions or omissions of these providers.<br>
                Accuracy of Information: We strive to ensure the accuracy of information provided by service providers. However, we do not guarantee the completeness or accuracy of such information.</p>

                <h3>5. Booking and Payments</h3>
                <p>Booking: By booking a service through our website, you agree to the terms and conditions of the service provider.<br>
                Payments: All payments for services are to be made directly to the service provider as per their terms. We do not handle payments or disputes related to payments.</p>

                <h3>6. Data Collection and Privacy</h3>
                <p>Personal Information: We collect personal information necessary to provide our services. Our <a href="link to privacy policy">Privacy Policy</a> explains how we collect, use, and protect your personal data.<br>
                Saved Measurements: We may save measurements of your lawn, pool, gutter, driveway, walkway, and sidewalk areas to improve our service accuracy. By using our services, you consent to this data collection.</p>

                <h3>7. User Conduct</h3>
                <p>Prohibited Activities: You agree not to use our website for any unlawful or prohibited activities. This includes but is not limited to, fraud, harassment, and the distribution of harmful content.<br>
                Content Submission: Any content you submit to our website must be accurate and not violate any third-party rights.</p>

                <h3>8. Limitation of Liability</h3>
                <p>No Warranty: Our services are provided "as is" without any warranties, express or implied. We do not guarantee the availability, accuracy, or reliability of our services.<br>
                Liability: To the maximum extent permitted by law, Workyarder.com is not liable for any indirect, incidental, or consequential damages arising out of your use of our website.</p>

                <h3>9. Indemnification</h3>
                <p>You agree to indemnify and hold Workyarder.com and its affiliates, officers, agents, and employees harmless from any claims, damages, or expenses arising out of your use of our website or violation of these Terms and Conditions.</p>

                <h3>10. Dispute Resolution</h3>
                <p>Any disputes arising from the services provided by the independent contractors listed on Workyarder.com should be directed to the respective service provider. Workyarder.com acts solely as a facilitator connecting users with service providers and is not a party to any service agreement. Consequently, any legal ramifications resulting from disputes should be addressed with the service provider.</p>

                <h3>11. Changes to Terms</h3>
                <p>We reserve the right to modify these Terms and Conditions at any time. Any changes will be effective immediately upon posting on our website. Your continued use of our services constitutes acceptance of the revised terms.</p>

                <h3>12. Governing Law</h3>
                <p>These Terms and Conditions are governed by and construed in accordance with the laws of [Your Jurisdiction]. Any disputes arising out of or related to these terms will be subject to the exclusive jurisdiction of the courts in [Your Jurisdiction].</p>

                <h3>13. Contact Information</h3>
                <p>If you have any questions or concerns about these Terms and Conditions, please contact us at contact@workyarder.com.</p>
            </div>
            <button class="jotform-submit" onclick="acceptTerms()">Accept</button>
        </div>
    </div>

    <!-- Modal for Privacy Policy -->
    <div id="privacyModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closePrivacyModal()">&times;</span>
            <h2>Privacy Policy</h2>
            <div class="modal-text">
                <h3>1. Introduction</h3>
                <p>Workyarder.com ("we," "our," "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website. If you do not agree with the terms of this Privacy Policy, please do not access the site.</p>

                <h3>2. Information We Collect</h3>
                <p>We may collect information about you in a variety of ways. The information we may collect on the site includes:</p>
                <ul>
                    <li>Personal Data: Personally identifiable information, such as your name, shipping address, email address, and telephone number, and demographic information, such as your age, gender, hometown, and interests, that you voluntarily give to us when you register with the site or our mobile application, or when you choose to participate in various activities related to the site, such as online chat and message boards.</li>
                    <li>Derivative Data: Information our servers automatically collect when you access the site, such as your IP address, your browser type, your operating system, your access times, and the pages you have viewed directly before and after accessing the site.</li>
                    <li>Financial Data: Financial information, such as data related to your payment method (e.g., valid credit card number, card brand, expiration date) that we may collect when you purchase, order, return, exchange, or request information about our services from the site.</li>
                    <li>Data from Social Networks: User information from social networking sites, such as Facebook, Google+, Instagram, including your name, your social network username, location, gender, birth date, email address, profile picture, and public data for contacts, if you connect your account to such social networks.</li>
                    <li>Mobile Device Data: Device information, such as your mobile device ID, model, and manufacturer, and information about the location of your device, if you access the site from a mobile device.</li>
                    <li>Third-Party Data: Information from third parties, such as personal information or network friends, if you connect your account to the third party and grant the site permission to access this information.</li>
                    <li>Data from Contests, Giveaways, and Surveys: Personal and other information you may provide when entering contests or giveaways and/or responding to surveys.</li>
                </ul>

                <h3>3. Use of Your Information</h3>
                <p>Having accurate information about you permits us to provide you with a smooth, efficient, and customized experience. Specifically, we may use information collected about you via the site to:</p>
                <ul>
                    <li>Create and manage your account.</li>
                    <li>Process your transactions and send you related information.</li>
                    <li>Email you regarding your account or order.</li>
                    <li>Fulfill and manage purchases, orders, payments, and other transactions related to the site.</li>
                    <li>Generate a personal profile about you to make future visits to the site more personalized.</li>
                    <li>Increase the efficiency and operation of the site.</li>
                    <li>Monitor and analyze usage and trends to improve your experience with the site.</li>
                    <li>Notify you of updates to the site.</li>
                    <li>Offer new products, services, mobile applications, and/or recommendations to you.</li>
                    <li>Perform other business activities as needed.</li>
                    <li>Prevent fraudulent transactions, monitor against theft, and protect against criminal activity.</li>
                    <li>Process payments and refunds.</li>
                    <li>Request feedback and contact you about your use of the site.</li>
                    <li>Resolve disputes and troubleshoot problems.</li>
                    <li>Respond to product and customer service requests.</li>
                    <li>Solicit support for the site.</li>
                </ul>

                <h3>4. Disclosure of Your Information</h3>
                <p>We may share information we have collected about you in certain situations. Your information may be disclosed as follows:</p>
                <ul>
                    <li>By Law or to Protect Rights: If we believe the release of information about you is necessary to respond to legal process, to investigate or remedy potential violations of our policies, or to protect the rights, property, and safety of others, we may share your information as permitted or required by any applicable law, rule, or regulation.</li>
                    <li>Third-Party Service Providers: We may share your information with third parties that perform services for us or on our behalf, including payment processing, data analysis, email delivery, hosting services, customer service, and marketing assistance.</li>
                    <li>Marketing Communications: With your consent, or with an opportunity for you to withdraw consent, we may share your information with third parties for marketing purposes, as permitted by law.</li>
                    <li>Interactions with Other Users: If you interact with other users of the site, those users may see your name, profile photo, and descriptions of your activity, including sending invitations to other users, chatting with other users, liking posts, and following blogs.</li>
                    <li>Online Postings: When you post comments, contributions, or other content to the site, your posts may be viewed by all users and may be publicly distributed outside the site in perpetuity.</li>
                    <li>Third-Party Advertisers: We may use third-party advertising companies to serve ads when you visit the site. These companies may use information about your visits to the site and other websites that are contained in web cookies in order to provide advertisements about goods and services of interest to you.</li>
                    <li>Affiliates: We may share your information with our affiliates, in which case we will require those affiliates to honor this Privacy Policy. Affiliates include our parent company and any subsidiaries, joint venture partners, or other companies that we control or that are under common control with us.</li>
                    <li>Business Partners: We may share your information with our business partners to offer you certain products, services, or promotions.</li>
                    <li>Offer Wall: The site may display a third-party hosted "offer wall." Such an offer wall allows third-party advertisers to offer virtual currency, gifts, or other items to users in return for acceptance and completion of an advertisement offer. Such an offer wall may appear in our mobile application and be displayed to you based on certain data, such as your geographic area or demographic information. When you click on an offer wall, you will leave our mobile application. A unique identifier, such as your user ID, will be shared with the offer wall provider in order to prevent fraud and properly credit your account.</li>
                    <li>Social Media Contacts: If you connect to the site through a social network, your contacts on the social network will see your name, profile photo, and descriptions of your activity.</li>
                </ul>

                <h3>5. Security of Your Information</h3>
                <p>We use administrative, technical, and physical security measures to help protect your personal information. While we have taken reasonable steps to secure the personal information you provide to us, please be aware that despite our efforts, no security measures are perfect or impenetrable, and no method of data transmission can be guaranteed against any interception or other type of misuse.</p>

                <h3>6. Policy for Children</h3>
                <p>We do not knowingly solicit information from or market to children under the age of 13. If we learn that we have collected personal information from a child under age 13 without verification of parental consent, we will delete that information as quickly as possible. If you become aware of any data we have collected from children under age 13, please contact us at contact@workyarder.com.</p>

                <h3>7. Controls for Do-Not-Track Features</h3>
                <p>Most web browsers and some mobile operating systems include a Do-Not-Track ("DNT") feature or setting you can activate to signal your privacy preference not to have data about your online browsing activities monitored and collected. No uniform technology standard for recognizing and implementing DNT signals has been finalized. As such, we do not currently respond to DNT browser signals or any other mechanism that automatically communicates your choice not to be tracked online. If a standard for online tracking is adopted that we must follow in the future, we will inform you about that practice in a revised version of this Privacy Policy.</p>

                <h3>8. Options Regarding Your Information</h3>
                <p>Account Information: You may at any time review or change the information in your account or terminate your account by contacting us using the contact information provided below.</p>
                <p>Emails and Communications: If you no longer wish to receive correspondence, emails, or other communications from us, you may opt out by contacting us at contact@workyarder.com or by using the unsubscribe option in our email communications.</p>

                <h3>9. Contact Us</h3>
                <p>If you have questions or comments about this Privacy Policy, please contact us at:</p>
                <p>Workyarder.com<br>Email: contact@workyarder.com</p>
            </div>
            <button class="jotform-submit" onclick="acceptPrivacy()">Accept</button>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('assets/php/fetchRole.php', {
                method: 'POST',
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displaySectionsBasedOnRole(data.role);
                    console.log('The role is ', data.role);
                } else {
                    console.error(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        function displaySectionsBasedOnRole(role) {
            const clientSection = document.querySelector('.client-section');
            const providerSection = document.querySelector('.provider-section');

            if (role === 'client') {
                clientSection.style.display = 'block';
                providerSection.style.display = 'none';
            } else if (role === 'pW_provider' || role === 'pool_provider' || role === 'lawn_provider') {
                providerSection.style.display = 'block';
                clientSection.style.display = 'none';
            }
        }

        function incrementValue(id) {
            var inputElement = document.getElementById(id);
            var value = parseInt(inputElement.value, 10);
            inputElement.value = value < inputElement.max ? value + 1 : value;
        }

        function decrementValue(id) {
            var inputElement = document.getElementById(id);
            var value = parseInt(inputElement.value, 10);
            inputElement.value = value > inputElement.min ? value - 1 : value;
        }
        
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;
            var specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
            
            if (password.length < 10 || !specialCharRegex.test(password)) {
                alert("Password must be at least 10 characters long and include a special character.");
                return false;
            }
            
            return true;
        }
        
        document.addEventListener('DOMContentLoaded', function () {
            var passwordInput = document.getElementById('password');
            var confirmPasswordInput = document.getElementById('confirm-password');
            var alertMessage = document.getElementById('password-mismatch');
            
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
    
            function checkPasswordMatch() {
                var password = passwordInput.value;
                var confirmPassword = confirmPasswordInput.value;
    
                if (password !== confirmPassword) {
                    alertMessage.style.display = 'block';
                } else {
                    alertMessage.style.display = 'none';
                }
            }
    
            passwordInput.addEventListener('input', checkPasswordMatch);
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);

            // Add event listeners for service checkboxes to toggle visibility of size inputs
            document.getElementById('lawn-care').addEventListener('change', function() {
                document.getElementById('lawn-size').style.display = this.checked ? 'block' : 'none';
                document.querySelector('.idk-row-lawn').style.display = this.checked ? 'flex' : 'none'; // Hide or show idk-row based on checkbox
            });

            document.getElementById('pool-care').addEventListener('change', function() {
                document.getElementById('pool-size').style.display = this.checked ? 'block' : 'none';
                document.querySelector('#no-property-size-pool').parentElement.style.display = this.checked ? 'flex' : 'none'; // Show or hide "Not sure" button for pool-size
                document.querySelector('.idk-row-pool').style.display = this.checked ? 'flex' : 'none'; // Hide or show idk-row based on checkbox
            });

            document.getElementById('pressure-washing').addEventListener('change', function() {
                document.getElementById('pressure-washing-size').style.display = this.checked ? 'block' : 'none';
                document.querySelector('#no-property-size-pressure-washing').parentElement.style.display = this.checked ? 'flex' : 'none'; // Show or hide "Not sure" button for pressure-washing-size
                document.querySelector('.idk-row-pw').style.display = this.checked ? 'flex' : 'none'; // Hide or show idk-row based on checkbox
            });

            const equipmentYes = document.getElementById('equipment-yes');
            const equipmentNo = document.getElementById('equipment-no');
            const equipmentDetails = document.getElementById('equipment-details');

            equipmentYes.addEventListener('change', function() {
                if (this.checked) {
                    equipmentDetails.style.display = 'block';
                }
            });

            equipmentNo.addEventListener('change', function() {
                if (this.checked) {
                    equipmentDetails.style.display = 'none';
                }
            });

            // Add event listener to toggle required attribute based on visibility
            var providerSection = document.querySelector('.checkbox-group.provider-section');
            var clientSection = document.querySelector('.checkbox-group.client-section');
            var providerInputs = providerSection.querySelectorAll('input, select');
            var clientInputs = clientSection.querySelectorAll('input, select');

            // Function to toggle required attribute
            function toggleRequired(section, isRequired) {
                var inputs = section.querySelectorAll('input, select');
                inputs.forEach(function(input) {
                    if (isRequired) {
                        input.setAttribute('required', '');
                    } else {
                        input.removeAttribute('required');
                    }
                });
            }

            // Initial check and setup
            toggleRequired(providerSection, providerSection.style.display !== 'none');
            toggleRequired(clientSection, clientSection.style.display !== 'none');

            // You can call toggleRequired whenever the display status of these sections changes
            // Example: Assuming you have event listeners that toggle the display property of these sections
            
            // Add event listeners for the "Not sure" checkboxes
                document.getElementById('no-property-size-lawn').addEventListener('change', function() {
                    toggleInputDisabledAndValue('lawn-size', this.checked);
                });
    
                document.getElementById('no-property-size-pool').addEventListener('change', function() {
                    toggleInputDisabledAndValue('pool-size', this.checked);
                });
    
                document.getElementById('no-property-size-pressure-washing').addEventListener('change', function() {
                    toggleInputDisabledAndValue('pressure-washing-size', this.checked);
                });
    
                // Function to disable input and set its value to 0
                function toggleInputDisabledAndValue(inputId, isDisabled) {
                    var inputElement = document.getElementById(inputId);
                    inputElement.disabled = isDisabled;
                    inputElement.value = isDisabled ? 0 : inputElement.value;
                    inputElement.style.backgroundColor = isDisabled ? '#e0e0e0' : ''; // Set background to gray when disabled
                }
                
            // Add event listener for the "Terms and Conditions" link
            const termsLink = document.querySelector('.terms-link');
            const termsModal = document.getElementById('termsModal');
            const closeBtn = document.querySelector('.close'); // Assuming you have a close button with class 'close'

            termsLink.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior
                termsModal.style.display = 'block'; // Display the terms modal
            });

            closeBtn.addEventListener('click', function() {
                termsModal.style.display = 'none'; // Hide the terms modal on close button click
            });

            // Optional: Close the modal when clicking outside of it
            window.addEventListener('click', function(event) {
                if (event.target == termsModal) {
                    termsModal.style.display = 'none';
                }
            });

            // Add event listener for the "Privacy Policy" link
            const privacyLink = document.querySelector('.privacy-link');
            const privacyModal = document.getElementById('privacyModal');
            const closePrivacyBtn = document.querySelector('.close'); // Assuming you have a close button with class 'close'

            privacyLink.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior
                privacyModal.style.display = 'block'; // Display the privacy modal
            });

            closePrivacyBtn.addEventListener('click', function() {
                privacyModal.style.display = 'none'; // Hide the privacy modal on close button click
            });

            // Optional: Close the modal when clicking outside of it
            window.addEventListener('click', function(event) {
                if (event.target == privacyModal) {
                    privacyModal.style.display = 'none';
                }
            });
            
            const form = document.getElementById('create-account-form'); // Ensure you have the correct form ID
            const termsCheckbox = document.getElementById('terms');
            const clientSection = document.querySelector('.checkbox-group.client-section');

            function updateCheckboxRequirement() {
                // Check if the client section is displayed
                const isDisplayed = clientSection.style.display !== 'none';
                // Set the required attribute based on the display status
                termsCheckbox.required = isDisplayed;
            }

            // Call this function initially and whenever the form is about to be submitted
            updateCheckboxRequirement();
            form.addEventListener('submit', updateCheckboxRequirement);

            // Optionally, if there are other actions that show/hide the client section, call updateCheckboxRequirement after those actions
        });
        
        function openTermsModal() {
            document.getElementById('termsModal').style.display = 'block';
        }

        function closeTermsModal() {
            document.getElementById('termsModal').style.display = 'none';
        }

        function acceptTerms() {
            // Implement what happens when terms are accepted
            closeTermsModal();
        }

        function openPrivacyModal() {
            document.getElementById('privacyModal').style.display = 'block';
        }

        function closePrivacyModal() {
            document.getElementById('privacyModal').style.display = 'none';
        }

        function acceptPrivacy() {
            // Optionally check a checkbox or perform other actions when the Privacy Policy is accepted
            closePrivacyModal();
        }
    </script>
</body>
</html>