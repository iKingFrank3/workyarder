<?php include 'assets/php/check-access.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkYarder</title>
    <link href="assets/img/WYicon.png" rel="icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    .jotform-section {
        max-width: 700px; /* Set a maximum width */
        margin: 0 auto; /* Center the section */
        border: 1px solid #ccc;
        padding: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .jotform-section.show {
        display: block; /* Show the section when a package is selected */
    }

    .jotform-section h1 {
        font-size: 25px;
        margin-bottom: 15px;
        text-align: center; /* Center the heading */
    }
    
    .jotform-section h2 {
        font-size: 20px;
        margin-bottom: 15px;
        text-align: center; /* Center the heading */
    }

    .jotform-section p {
        font-size: 15px;
        margin-bottom: 15px;
        text-align: center; /* Center the heading */
    }

    /* Form field styling */
    .jotform-form-row {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .jotform-form-label {
        width: 200px; /* Fixed label width */
        font-size: 16px;
        margin-right: 10px;
    }

    .jotform-form-input,
    .jotform-form-input-file,
    .jotform-form-textarea 
    {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .jotform-form-input[type="color"] {
        height: 40px;
        padding: 0;
    }

    /* Adjust input size and make them smaller */
    .jotform-form-input,
    .jotform-form-input-file,
    .jotform-form-textarea {
        padding: 8px;
    }

    /* Submit button styling */
    .jotform-submit-section {
        text-align: center;
    }

    .jotform-submit {
        background-color: #4F8E35; /* Grey color for the button */
        color: #fff;
        border: none;
        padding: 10px 20px; /* Reverted to previous size */
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        text-align: center; /* Center the button */
        display: block;
        margin: 0 auto;
    }

    .jotform-submit:hover {
        background-color: #444; /* Darker grey on hover */
    }

    body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    }

    footer {
        margin-top: auto;
    }

    #orderStatus{
        width: 25%;
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
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        border-radius: 8px;
        text-align: center;
    }

    .close,
    .close-report {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus,
    .close-report:hover,
    .close-report:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .image-upload-boxes input[type="file"] {
        border: 2px dashed #ccc;
        display: block;
        padding: 10px;
        width: 90%;
        margin: 10px auto;
        cursor: pointer;
    }

    .image-upload-boxes {
        text-align: center;
    }

    #beforeCommentBox,
    #endCommentBox,
    #damageCommentBox {
       width: 90%;
        height: 100px;
        margin: 10px auto;
        display: block;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Match damage-report-section to subscription-packages */
    .damage-report-section {
        display: flex;
        justify-content: space-around;
        align-items: stretch;
        flex-wrap: nowrap;
        overflow-x: auto;
        margin-top: 20px;
    }

    /* Match damage-report to subscription-package */
    .damage-report {
        flex: 0 0 calc(40% - 15px);
        margin-right: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        cursor: pointer;
        box-sizing: border-box;
    }

    .damage-report img {
        width: 120px;
        height: 120px;
        margin-bottom: 1rem;
        text-align: center;
        display: block;
        margin: 0 auto;
    }

    .damage-report:last-child {
        margin-right: 0;
    }

    .damage-report:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .damage-report h3 {
        background-color: #4F8E35;
        color: #fff;
        padding: 15px;
        margin: 0;
        font-size: 15px;
        text-align: center;
    }

    #timerSection{
        width: 25%;
        background-color: #444;
        pointer-events: none;
        cursor: default;
    }

    #taskList li {
        list-style: none; /* Remove default bullet points */
    }
    
    .hamburger {
        display: none; /* Hamburger menu is hidden by default */
    }

    nav {
        display: flex; /* Use flexbox for layout */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
    }

    @media (max-width: 768px) {
        body {
            min-height: 100vh; /* Ensure body is at least the height of the viewport */
            position: relative; /* Needed for absolute positioning of the footer */
            margin: 0;
            padding-bottom: 50px; /* Give space for the footer */
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 90%;
            text-align: center;
        }
        
        .damage-report {
            flex: 0 0 calc(70% - 15px);
        }

        .hamburger {
            display: block; /* Show hamburger menu */
            cursor: pointer;
            font-size: 30px;
        }

        .nav-links {
            display: none;
            flex-direction: column;
            width: 100%;
            position: absolute;
            top: 50px;
            left: 0;
            background-color: #333;
        }

        .nav-links a {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            display: block;
            text-align: center;
        }
        
        .modal-content {
            margin: 60% auto; /* 15% from the top and centered */
        }
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
    </style>
</head>
<body>
    <header>
        <h1>Order Status</h1>
    </header>

    <nav>
        <div class="hamburger">&#9776;</div>
        <div class="nav-links">
            <a href="partner.php">Home</a>
            <a href="start-appointment.php">Current Appointment</a>
        </div>
    </nav>

    <section id="order-status">
        <div class="jotform-section">
            <h2>Check Order Status</h2>
                <p>Please complete the appointment and update status below. Failure to properly complete speciifics for your appointment may result in deduction of pay.</p>
                
                <div class="jotform-section">
                    <h1>Order Status:</h1>

                    <h2>Provider Information:</h2>
                    <div class ="orderStatusDropdown">
                    <p>Order Status: 
                        <select id="orderStatus" name="orderStatus" class="jotform-form-input">
                            <option value="Otw">Headed to location</option>
                            <option value="Arrived">Arrived</option>
                        </select>
                        &emsp;
                        <button class="jotform-submit" onclick="submitOrderStatus()" style="display: inline-block;">Submit</button></p>
                    </div>
                    <p>Date & Time: </p>
                    <p>Service Type: </p>
                    <p>Address: </p>
                    <p>Accessibility: ${data.accessibility}</p>
                    <p>Additional Info: ${data.additionalInfo}</p>
                    <p>Projected Payout: ${data.bid}</p>
                    <br>
                    
                    <div class="termCond-section">
                        <input type="checkbox" id="terms" name="terms">
                        <label for="terms">I've reviewed protocol policies and I have the proper equipment to complete this task.</label>
                    </div>

                    <div class="damage-report-section">
                        <div class="damage-report" onclick="openDamageReportModal()">
                            <h3 class="package-name">Report Damage</h3>
                            <p><img src="assets/img/damage.png" alt="Damage Report"></p>
                            <p>Please report all damages prior to starting the appointment. <br> <br> You will <strong>NOT</strong> be able to go back after starting the job. </p>
                        </div>
                    </div>

                    <!-- Modal for Damage Report -->
                    <div id="damageReportModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Report Damage</h2>
                            <div class="image-upload-boxes">
                                <input type="file" id="imageUpload1" accept="image/*" multiple>
                                <input type="file" id="imageUpload2" accept="image/*" multiple>
                                <input type="file" id="imageUpload3" accept="image/*" multiple>
                            </div>
                            <textarea id="damageCommentBox" placeholder="Add comments based on the photos uploaded"></textarea>
                            <button class="jotform-submit" style="margin-top: 20px;" id="submitDamageReportButton">Submit</button>
                        </div>
                    </div>

                    <!-- Modal for Report Issue Report -->
                    <div id="reportIssueModal" class="modal">
                        <div class="modal-content">
                            <span class="close-report">&times;</span>
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
                                    <button type="button" class="jotform-submit" id="submitReportIssueButton">Submit</button>
                                </form>
                            </div>
                        </div>

                    <br>
                    
                    <div id="timerSection" class="jotform-submit" style="display: none;" disabled>Started Task: <br><span id="timer">(start_time)</span></div>

                    <ul id="taskList" style="display: none;">
                        <li><input type="checkbox" id="task1" name="task1" disabled>
                        <label for="task1"><a href="#" class="upload-link">Upload Before Images</a></label>
                        </li>

                        <!-- Dynamic task list will be appended here -->
                    </ul>
                    
                    <button class="jotform-submit" id="start-button" onclick="startAppointment()">Start Task</button>
                    <br>
                    <button class="jotform-submit" id="report-isssue" onclick="reportIssue()">Report Issue</button>
                    <br>
                    <button class="jotform-submit" id="finish-button" onclick="endAppointment()" style="display: none;">Finish Job</button>

                    <!-- Modal for Damage Report -->
                    <div id="endTaskModal" class="modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>End Appointment</h2>
                            <p>Submit final photos, wrap up, and wait to get paid for your amazing work!</p>
                            <div class="image-upload-boxes">
                                <input type="file" id="imageUpload1" accept="image/*" multiple>
                                <input type="file" id="imageUpload2" accept="image/*" multiple>
                                <input type="file" id="imageUpload3" accept="image/*" multiple>
                            </div>
                            <textarea id="endCommentBox" placeholder="Add comments based on the photos uploaded"></textarea>
                            <button class="jotform-submit" style="margin-top: 20px;" id="submitEndAppointmentButton">Submit</button>
                        </div>
                    </div>
                    
                    <hr>

                    <h2>Client Information:</h2>
                    <p>Name: </p>
                    <p>Notes: </p>

                    <br>

                </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 King Frank Digital Marketing</p>
    </footer>
    <script>
        var globalAppointmentId = null;  // Declare global variable
        var globalBookingId = null;  // Declare global variable
        var currentOrderStatus = null; // Store the current order status globally

        function fetchAndUpdateOrderStatus() {
            return new Promise((resolve, reject) => {
                let fetchUrl = 'assets/php/getAppointmentDetails.php';

                fetch(fetchUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error:', data.error);
                        alert(data.error);
                        reject(data.error);
                        return;
                    }

                    // Use the appointmentId from the response
                    globalAppointmentId = data.appointment_id;
                    globalBookingId = data.booking_id;
                    
                    // Store IDs in localStorage
                    localStorage.setItem('globalAppointmentId', globalAppointmentId);
                    localStorage.setItem('globalBookingId', globalBookingId);

                    // Check if the order status has changed
                    if (currentOrderStatus === null) {
                        currentOrderStatus = data.order_status; // Initialize currentOrderStatus
                    } else if (currentOrderStatus !== data.order_status) {
                        currentOrderStatus = data.order_status; // Update currentOrderStatus
                        location.reload(); // Refresh the page
                        return; // Exit the function to stop further execution after reload
                    }

                    // Populate the page with the fetched data
                    document.querySelector('.jotform-section h1').textContent = `Order Status: ${data.order_status}`;
                    document.querySelectorAll('.jotform-section p')[2].textContent = `Date & Time: ${data.date} ${data.time}`;
                    document.querySelectorAll('.jotform-section p')[3].textContent = `Service Type: ${data.serviceType}`;
                    document.querySelectorAll('.jotform-section p')[4].textContent = `Address: ${data.street_name}, ${data.city}, ${data.ST} ${data.zip_code}`;
                    document.querySelectorAll('.jotform-section p')[5].textContent = `Accessibility: ${data.accessibility}`;
                    document.querySelectorAll('.jotform-section p')[6].textContent = `Additional Info: ${data.additionalInfo}`;
                    document.querySelectorAll('.jotform-section p')[7].textContent = `Projected Payout: $${data.bid}`;
                    document.querySelectorAll('.jotform-section p')[11].textContent = `Name: ${data.name}`;
                    document.querySelectorAll('.jotform-section p')[12].textContent = `Notes: ${data.clientNotes}`;

                    // Update task list based on service type fetched
                    updateTaskList(data.serviceType);

                    // Check if the order status is 'In-Progress' and apply startAppointment properties
                    if (data.order_status === 'In-Progress') {
                        applyStartAppointmentProperties();
                    }

                    // Resolve the promise after all operations are done
                    resolve(globalAppointmentId);
                    resolve(globalBookingId);
                })
                .catch(error => {
                    console.error('Error:', error);
                    reject(error);
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchAndUpdateOrderStatus().then(appointmentId => {
                fetchStartTime(); // Call this here to ensure it runs after the booking ID is set
                // Call other functions that depend on globalAppointmentId here
                document.getElementById('submitDamageReportButton').addEventListener('click', submitDamageReport);
                document.getElementById('submitEndAppointmentButton').addEventListener('click', submitEndAppointment);
                document.getElementById('submitBeforeImagesButton').addEventListener('click', submitBeforeImages);
                document.getElementById('submitReportIssueButton').addEventListener('click', submitIssueReport);
            }).catch(error => {
                console.error("Failed to set booking ID:", error);
            });
            checkBeforeImagesExistence(); // Added function call to check for before images on page load

            const uploadLink = document.querySelector('.upload-link');
            const modal = document.getElementById('uploadModal');
            const closeBtn = document.getElementById('closeUploadModal');
            var closeButton = document.querySelector('.close-report');
            
            closeButton.addEventListener('click', function() {
                document.getElementById("reportIssueModal").style.display = "none";
            });

            uploadLink.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default link behavior
                modal.style.display = 'block';
            });

            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            const hamburger = document.querySelector('.hamburger');
            const navLinks = document.querySelector('.nav-links');

            // Function to toggle nav display
            function toggleNav() {
                if (window.innerWidth > 768) {
                    navLinks.style.display = 'flex'; // Ensure nav links are visible when not in mobile view
                } else {
                    navLinks.style.display = 'none'; // Ensure nav links are hidden when in mobile view
                }
            }

            // Event listener for hamburger menu click
            hamburger.addEventListener('click', function() {
                navLinks.style.display = navLinks.style.display === 'block' ? 'none' : 'block';
            });

            // Event listener for window resize
            window.addEventListener('resize', toggleNav);

            // Initial check
            toggleNav();
            
            // Modal for reporting issues
            var reportIssueModal = document.getElementById("reportIssueModal");
            var issueTypeRadios = document.getElementsByName('issueType');
            var rescheduleRadios = document.getElementsByName('reschedule');

            document.getElementById('submitReportIssueButton').addEventListener('click', function() {
                reportIssueModal.style.display = "block";
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
                if (event.target == reportIssueModal) {
                    reportIssueModal.style.display = "none";
                }
            };
        });

        function checkBeforeImagesExistence() {
            fetch(`assets/php/checkImages.php`)
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    enableUploadCheckbox();
                }
            })
            .catch(error => {
                console.error('Error checking existing images:', error);
            });
        }

        function applyStartAppointmentProperties() {
            document.querySelector('.damage-report-section').style.display = 'none';
            document.querySelector('.termCond-section').style.display = 'none';
            document.querySelector('.orderStatusDropdown').style.display = 'none';
            document.getElementById('start-button').style.display = 'none';
            document.getElementById('finish-button').style.display = 'block';
            document.getElementById('timerSection').style.display = 'block';
            document.getElementById('taskList').style.display = 'block';
        }
    
        function openDamageReportModal() {
            var modal = document.getElementById("damageReportModal");
            var span = document.getElementsByClassName("close")[0];
    
            modal.style.display = "block";
    
            span.onclick = function() {
                modal.style.display = "none";
            }
    
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    
        function endAppointment() {
            const taskCheckboxes = document.querySelectorAll('#taskList input[type="checkbox"]');
            let allTasksCompleted = true;
    
            taskCheckboxes.forEach(checkbox => {
                if (!checkbox.checked) {
                    allTasksCompleted = false;
                }
            });
    
            if (allTasksCompleted) {
                document.getElementById("endTaskModal").style.display = "block";
            } else {
                alert('Please complete all tasks before finishing the job.');
            }

            let formData = new FormData();
            formData.append('appointmentId', globalAppointmentId);
            formData.append('endTime', new Date().toISOString());

            fetch('assets/php/handleTimer.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log('End time saved:', data);
            })
            .catch((error) => {
                console.error('Error saving end time:', error);
            });
        }
    
        function startAppointment() {
            if (!document.getElementById('terms').checked) {
                alert('Please check the box to verify you reviewed the protocol and have the proper equipment prior to starting this job.');
                return;
            }
    
            // Hide the Report Damage section and start button
            document.querySelector('.damage-report-section').style.display = 'none';
            document.querySelector('.termCond-section').style.display = 'none';
            document.querySelector('.orderStatusDropdown').style.display = 'none';
            document.getElementById('start-button').style.display = 'none';
            document.getElementById('finish-button').style.display = 'block';
    
            
            // Show the timer and task list
            document.getElementById('timerSection').style.display = 'block';
            document.getElementById('taskList').style.display = 'block';
            
            let formData = new FormData();
            formData.append('appointmentId', globalAppointmentId);
            formData.append('startTime', new Date().toISOString());

            fetch('assets/php/handleTimer.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log('Start time saved:', data);
            })
            .catch((error) => {
                console.error('Error saving start time:', error);
            });

            // Update UI to show start time
            document.getElementById('timerSection').textContent = `Started at ${new Date().toLocaleTimeString()}`;
            
            //Set order_status to 'In-Progess'
            submitOrderStatus('In-Progress');
        }
    
        // Define tasks for each service type
        const serviceTasks = {
            "Simple Cut": [
                "Mow the lawn",
                "Lawn edging",
                "Clean up debris"
            ],
            "Leaf Removal": [
                "Leaf removal"
            ],
            "Snow Removal": [
                "Snow removal",
                "Salt application"
            ],
            "Pool Maintenance": [
                "Chlorine and shock treatment",
                "Clean pool debris (skimming, brushing, vacuum)",
                "Check and test Water levels, PH, & Chemical balance",
                "Chlorine and shock treatment",
                "Check filters (clean or replace)",
                "Replace cover"
            ],
            "Pool Opening": [
                "Remove cover",
                "Chlorine and shock treatment",
                "Clean pool debris (skimming, brushing, vacuum)",
                "Start up equipment",
                "check and test water levels, ph, & chemical balance",
            ],
            "Pool Closing": [
                "Algecide and shock for closing",
                "Clean pool debris (skimming, brushing, vacuum)",
                "Testing and balance water chemistry",
                "Lower water levels",
                "Prepare equipment for closing",
                "Algecide and shock for closing",
                "Cover pool"
            ],
            "Gutter Cleaning": [
                "Inspect Gutter",
                "Debris scooping",
                "Flush Gutter",
                "Inspect Downspout",
                "Check Alignment"
            ],
            "Dumpster Cleaning": [
                "Remove Debris",
                "Apply Cleaning solution",
                "Cleaning process (Scrubbing & Rinsing)",
                "Sanitize and Deodorize"
            ],
            "default": ["Completed Task"]
        };
    
        // Function to update task list based on selected service type
        function updateTaskList(serviceType) {
            const taskList = document.getElementById('taskList');
            // Clear existing tasks, except for the first 'Upload Before Images' checkbox
            while (taskList.children.length > 1) {
                taskList.removeChild(taskList.lastChild);
            }
            // Add new tasks based on service type
            const tasks = serviceTasks[serviceType] || serviceTasks["default"];
            tasks.forEach((task, index) => {
                const li = document.createElement('li');
                const input = document.createElement('input');
                input.type = 'checkbox';
                input.id = `task${index + 2}`;
                input.name = `task${index + 2}`;
                const label = document.createElement('label');
                label.htmlFor = `task${index + 2}`;
                label.textContent = task;
                li.appendChild(input);
                li.appendChild(label);
                taskList.appendChild(li);
            });
        }
    
        // Modal for Upload Before Images
        const uploadModalHTML = `
        <div id="uploadModal" class="modal">
            <div class="modal-content">
                <span id="closeUploadModal" class="close">&times;</span>
                <h2>Upload Before Images</h2>
                <div class="image-upload-boxes">
                    <input type="file" id="imageUploadBefore1" accept="image/*" multiple>
                    <input type="file" id="imageUploadBefore2" accept="image/*" multiple>
                    <input type="file" id="imageUploadBefore3" accept="image/*" multiple>
                    <input type="file" id="imageUploadBefore4" accept="image/*" multiple>
                </div>
                <textarea id="beforeCommentBox" placeholder="Add comments based on the photos uploaded"></textarea>
                <button class="jotform-submit" style="margin-top: 20px;" id="submitBeforeImagesButton">Submit</button>
            </div>
        </div>
        `;
        document.body.insertAdjacentHTML('beforeend', uploadModalHTML);

        function fetchStartTime() {
            let formData = new FormData();
            formData.append('appointmentId', globalAppointmentId);

            fetch('assets/php/uploadTimer.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log("Received data:", data); // Check what data is received
                if (data.start_time) {
                    document.getElementById('timer').textContent = new Date(data.start_time).toLocaleString('en-US', {
                        timeZone: 'America/New_York', // Set timezone to Eastern Time
                        weekday: 'long', // "Monday"
                        hour: 'numeric', // "12"
                        minute: 'numeric', // "00"
                        hour12: true, // AM/PM
                        month: 'long', // "June"
                        day: 'numeric', // "09"
                        year: 'numeric' // "2023"
                    });
                } else {
                    console.log("Start time not received or undefined.");
                }
            })
            .catch((error) => {
                console.error('Error fetching start time:', error);
            });
        }
        
        function submitOrderStatus(newStatus) {
            const orderStatus = newStatus || document.getElementById('orderStatus').value;
    
            fetch('assets/php/update-assignment-status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ appointmentId: globalAppointmentId, newStatus: orderStatus }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === "Assignment status updated successfully") {
                    alert('Order status updated successfully.');
                    location.reload(); // Refresh the page after successful update
                } else {
                    alert('Error updating order status.');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    
        function submitDamageReport() {
            const formData = new FormData();
            formData.append('bookingId', globalBookingId);
            formData.append('uploadType', 'damages');
            formData.append('notes', document.getElementById('damageCommentBox').value);
            const files = document.querySelectorAll('#damageReportModal input[type="file"]');
            Array.from(files).forEach((file, index) => {
                formData.append(`files[${index}]`, file.files[0]);
            });
            fetch('assets/php/handleUploads.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert('Damage report submitted successfully.');
                document.getElementById("damageReportModal").style.display = "none";
                document.querySelector('.damage-report-section').style.display = 'none';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting the damage report.');
            });
        }
    
        function submitEndAppointment() {
            const formData = new FormData();
            formData.append('appointmentId', globalAppointmentId);
            formData.append('bookingId', globalBookingId);
            formData.append('uploadType', 'final_photos');
            formData.append('notes', document.getElementById('endCommentBox').value);
            const files = document.querySelectorAll('#endTaskModal input[type="file"]');
            Array.from(files).forEach((file, index) => {
                formData.append(`files[${index}]`, file.files[0]);
            });
            fetch('assets/php/handleUploads.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert('Final photos submitted successfully.');
                // Update order status to 'Completed'
                return fetch('assets/php/update-assignment-status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ appointmentId: globalAppointmentId, newStatus: 'Finished' }),
                });
            })
            .then(response => response.json())
            .then(data => {
                console.log('Order status updated to Completed');
                window.location.href = 'partner.php'; // Redirect to partner.php
                // When the appointment process is completed
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the order status.');
            });
        }
    
        function submitBeforeImages() {
            const formData = new FormData();
            formData.append('bookingId', globalBookingId);
            formData.append('uploadType', 'before_photos');
            formData.append('notes', document.getElementById('beforeCommentBox').value);
            const files = document.querySelectorAll('#uploadModal input[type="file"]');
            Array.from(files).forEach((file, index) => {
                formData.append(`files[${index}]`, file.files[0]);
            });

            fetch('assets/php/handleUploads.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                alert('Before images submitted successfully.');
                document.getElementById("uploadModal").style.display = "none";
                enableUploadCheckbox(); // Enable the checkbox after successful upload
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting the before images.');
            });
        }

        function reportIssue() {
            document.getElementById("reportIssueModal").style.display = "block";
        }

        function submitIssueReport() {
            const issueType = document.querySelector('input[name="issueType"]:checked').value;
                const message = document.getElementById('issueCommentBox').value;
                const reschedule = document.querySelector('input[name="reschedule"]:checked').value;
                const rescheduleTime = reschedule === "yes" ? document.getElementById('rescheduleTime').value : "This will not require a reschedule";
    
                const fullMessage = `${issueType} - ${message}. ${reschedule === "yes" ? "This provider will like to reschedule the appointment for - " + rescheduleTime : "This will not require a reschedule"}`;
    
                fetch('assets/php/submitIssue.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ appointmentId: globalAppointmentId, message: fullMessage, reschedule: reschedule }),
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
    
        function enableUploadCheckbox() {
            document.getElementById('task1').disabled = false;
            document.getElementById('task1').checked = true; // Automatically check the box after enabling
        }
    </script>
</body>
</html>