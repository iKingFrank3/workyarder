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
    
    .jotform-form-row-1 {
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
        overflow-x: hidden;
        }

    footer {
        margin-top: auto;
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
    
    .photo-gallery {
        display: none; /* Initially hidden, will be displayed based on order status */
        flex-direction: column; /* Stack children vertically */
        align-items: center; /* Center-align items */
    }
    
    .photo-gallery .image-container {
        display: flex;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
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
    
    #issueCommentBox,
    #reviewText {
        width: 90%;
        height: 100px;
        margin: 10px auto;
        display: block;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    
    @media (max-width: 768px) {
           .jotform-form-row-1 {
                margin-bottom: 15px;
                display: flex;
                align-items: center;
            }
            
            .jotform-submit.row {
                font-size: 15px;
                margin: 5px;
            }
            
            .modal-content {
                margin: 60% auto; /* 15% from the top and centered */
            }
    }

    .rating {
        display: flex;
        flex-direction: row-reverse; /* Reverse the order of the star labels */
        justify-content: center; /* Center the stars horizontally */
        width: 100%; /* Take full width of the container */
        margin-top: 20px; /* Space from the previous content */
    }

    .rating > input {
        display: none; /* Hide the radio buttons */
    }

    .rating > label {
        font-size: 30px; /* Large star size */
        color: #ccc; /* Default hollow star color */
        cursor: pointer;
        transition: color 0.2s ease; /* Smooth transition for color change */
    }

    /* Hover and checked styles for the stars */
    .rating > input:hover ~ label,
    .rating > input:checked ~ label,
    .rating > label:hover ~ label,
    .rating > input:hover ~ label:hover ~ label {
        color: #4F8E35; 
    }

    .rating > label.active {
        color: #4F8E35;
    }
    </style>
</head>
<body>
    <header>
        <h1>Order Status</h1>
    </header>

    <nav>
        <a href="dashboard.php">Home</a>
    </nav>

    <section id="order-status">
        <div class="jotform-section">
            <h1 id="status-header">Order Status: ${data.orderStatus}</h1>
            <h2>Booking Information:</h2>
            <p id="order-code">Order Code: ${data.orderCode}</p>
            <p id="order-date">Date: ${data.date}</p>
            <p id="order-time">Time: ${data.time}</p>
            <p id="order-address">Address: ${data.address}</p>
            <p id="order-accessibility">Accessibility: ${data.accessibility}</p>
            <br>
            <p id="contact-method">Contact Method: ${data.contactMethod}</p>
            <p id="contact-info">Contact: ${data.contact}</p>
            <p id="additional-info">Additional Info: ${data.additionalInfo}</p>
            <br>
            <div class="jotform-form-row-1" style="display: flex;">
                <button id="editOrder" class="jotform-submit row" onclick="editAppointmentDetails()">Edit Appointment Details</button>
                <button id="makePayment" class="jotform-submit row" onclick="makePayment()">Make Payment</button>
                <button id="cancelOrder" class="jotform-submit row" onclick="cancelAppointment()">Cancel Appointment</button>
            </div>
            <div class="jotform-form-row">
                <button id="reportIssue" class="jotform-submit" onclick="reportIssue()">Report an Issue</button>
            </div>
            <button id="leaveReview" class="jotform-submit" onclick="leaveReview()" style="display: none;">Leave Review</button>
            <hr>
            <h2>Provider Information:</h2>
            <p id="provider-name">Provider: ${data.provider}</p>
            <p id="service-type">Service Type: ${data.serviceType}</p>
            <br>
            <p id="provider-notes">Notes: ${data.providerNotes}</p>
            <br>
            <!-- Before Photos Section -->
                <div class="photo-gallery before">
                    <h2 style="text-align: center;">Before Service Photos</h2>
                    <div class="image-container">
                        <p>No photos available.</p>
                    </div>
                </div>
                <br>
                <!-- Final Photos Section -->
                <div class="photo-gallery final">
                    <h2 style="text-align: center;">Final Service Photos</h2>
                    <div class="image-container">
                        <p>No photos available.</p>
                    </div>
                </div>
        </div>
    </section>

    <div id="reportIssueModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Report an Issue</h2>
            <textarea id="issueCommentBox" placeholder="Describe the issue"></textarea>
            <button class="jotform-submit" style="margin-top: 20px;" onclick="submitIssueReport()">Submit</button>
        </div>
    </div>

    <div id="reviewModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeReviewModal()">&times;</span>
            <h2>Leave a Review</h2>
            <textarea id="reviewText" placeholder="Describe your experience"></textarea>
            <div class="rating">
                <!-- Radio buttons for star rating -->
                <input type="radio" id="star5" name="rating" value="5" class="star"><label for="star5">☆</label>
                <input type="radio" id="star4" name="rating" value="4" class="star"><label for="star4">☆</label>
                <input type="radio" id="star3" name="rating" value="3" class="star"><label for="star3">☆</label>
                <input type="radio" id="star2" name="rating" value="2" class="star"><label for="star2">☆</label>
                <input type="radio" id="star1" name="rating" value="1" class="star"><label for="star1">☆</label>
            </div>
            <br>
            <button class="jotform-submit" onclick="submitReview()">Submit Review</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 King Frank Digital Marketing</p>
    </footer>
    <script>
    let globalAppointmentId; // Declare a global variable for appointment ID
    let globalData;
    
    document.addEventListener('DOMContentLoaded', function() {
        const appointmentId = localStorage.getItem('appointmentId');

        if (!appointmentId) {
            alert('No appointment ID provided.');
            return;
        }

        fetch(`assets/php/loadAppointment.php`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `appointmentId=${encodeURIComponent(appointmentId)}`
        })
        .then(response => response.json())
        .then(data => {
            if (!data) {
                console.error('No data returned from the server');
                return; // Stop further execution if no data is returned
            }
            
            globalAppointmentId = data.appointment_id; // Set the global appointment ID
            globalData = data;

            // Update the HTML with the fetched data using IDs
            document.getElementById('status-header').textContent = `Order Status: ${data.orderStatus}`;
            document.getElementById('order-code').textContent = `Order Code: ${data.orderCode}`;
            document.getElementById('order-date').textContent = `Date: ${data.date}`;
            document.getElementById('order-time').textContent = `Time: ${data.time}`;
            document.getElementById('order-address').textContent = `Address: ${data.address}`;
            document.getElementById('order-accessibility').textContent = `Accessibility: ${data.accessibility}`;
            document.getElementById('contact-method').textContent = `Contact Method: ${data.contactMethod}`;
            document.getElementById('contact-info').textContent = `Contact: ${data.contact}`;
            document.getElementById('additional-info').textContent = `Additional Info: ${data.additionalInfo}`;
            document.getElementById('provider-name').textContent = `Provider: ${data.provider}`;
            document.getElementById('service-type').textContent = `Service Type: ${data.serviceType}`;
            document.getElementById('provider-notes').textContent = `Notes: ${data.providerNotes}`;

            const beforePhotosContainer = document.querySelector('.photo-gallery.before .image-container');
            const finalPhotosContainer = document.querySelector('.photo-gallery.final .image-container');

            // Clear existing images before appending new ones
            beforePhotosContainer.innerHTML = '';
            if (data.beforePhotos && data.beforePhotos.length > 0) {
                data.beforePhotos.forEach(photoUrl => {
                    const img = document.createElement('img');
                    img.src = photoUrl;
                    img.classList.add('clickable-image'); 
                    beforePhotosContainer.appendChild(img);
                });
            } else {
                beforePhotosContainer.innerHTML = '<p>No photos available.</p>';
            }

            finalPhotosContainer.innerHTML = '';
            if (data.finalPhotos && data.finalPhotos.length > 0) {
                data.finalPhotos.forEach(photoUrl => {
                    const img = document.createElement('img');
                    img.src = photoUrl;
                    img.classList.add('clickable-image'); 
                    finalPhotosContainer.appendChild(img);
                });
            } else {
                finalPhotosContainer.innerHTML = '<p>No photos available.</p>';
            }
    
            // Conditional display of photo galleries based on order status
            if (data.orderStatus === 'Completed' || data.orderStatus === 'Finished') {
                document.querySelector('.photo-gallery.before').style.display = 'flex';
                document.querySelector('.photo-gallery.final').style.display = 'flex';
                document.getElementById('leaveReview').style.display = 'block'; // Show the Leave Review button
            } else {
                document.querySelector('.photo-gallery.before').style.display = 'none';
                document.querySelector('.photo-gallery.final').style.display = 'none';
                document.getElementById('leaveReview').style.display = 'none'; // Hide the Leave Review button
            }
        
            const allowedStatusesForFormRow = ['Pending', 'Accepted', 'Requested', 'In-Progress', 'Canceled', 'Headed to Location', 'Arrived', 'Reviewing', 'Finished'];
        
            const buttonContainer = document.querySelector('.jotform-form-row');
            if (!allowedStatusesForFormRow.includes(data.orderStatus)) {
                buttonContainer.style.display = 'none';
            } else {
                buttonContainer.style.display = 'block';
            }
        
            const allowedStatusesForRow1 = ['Pending', 'In-Progress', 'Accepted', 'Requested'];
        
            const buttonContainerRow1 = document.querySelector('.jotform-form-row-1');
            if (!allowedStatusesForRow1.includes(data.orderStatus)) {
                buttonContainerRow1.style.display = 'none';
            } else {
                buttonContainerRow1.style.display = 'flex'; // Assuming default display is flex as per your existing setup
            }
        
            const makePaymentButton = document.getElementById('makePayment');
            if (data.isPaid === 'No' || data.isPaid === null) {
                makePaymentButton.style.display = 'block';
            } else {
                makePaymentButton.style.display = 'none';
            }
        
            if (data.orderStatus === 'Canceled') {
                document.getElementById('editOrder').style.display = 'none';
                document.getElementById('makePayment').style.display = 'none';
                document.getElementById('cancelOrder').style.display = 'none';
            }
        
            // Attach the click event listener to the parent container of the images
            document.body.addEventListener('click', function(event) {
                console.log("Clicked element:", event.target); // Detailed log of the clicked element
                if (event.target.classList.contains('clickable-image')) {
                    console.log("Image source:", event.target.src); // Log the source to verify it's correct
                    enlargeImage(event.target.src);
                }
            });
            
            // Hide the leaveReview button if a review already exists or if the order status is not 'Completed' or 'Finished'
            if (data.reviewExists || (data.orderStatus !== 'Completed' && data.orderStatus !== 'Finished')) {
                document.getElementById('leaveReview').style.display = 'none';
            } else {
                document.getElementById('leaveReview').style.display = 'block';
            }
        })
        .catch(error => console.error('Error:', error));
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

    function makePayment() {
        // Retrieve the stored booking data from the statusSection's data attribute
        const statusSection = document.getElementById('order-status');
        const price = parseFloat(globalData.quotePrice);
        const serviceType = globalData.serviceType;

        if (!globalData) {
            console.error('Booking data not found.');
            return; // Exit the function if data is not available
        }

        // Hide the statusSection
        statusSection.style.display = 'none';

        // Create the PayPal and Venmo button container
        var paymentSection = document.createElement('div');
        paymentSection.classList.add('jotform-section');
        paymentSection.innerHTML = `
            <h3>Pay with PayPal or Venmo</h3>
            <label for="tip-amount">Add a Tip:</label>
            <input type="number" id="tip-amount" value="0" min="0" step="0.01" style="margin-bottom: 10px;">
            <div id="paypal-container-U9QFG4KVSL3HL"></div>
        `;

        // Dynamically create and append the PayPal SDK script
        var paypalSdkScript = document.createElement('script');
        paypalSdkScript.src = "https://www.paypal.com/sdk/js?client-id=AVz1CbLHF1QNWdPEj29ZY3Zn17upusw2P2y0n-UK6FN6SHf-9AbVwRTJGHTbhzUZqzWCxPOGuOtWrhPz&components=buttons&enable-funding=venmo&currency=USD";
        document.body.appendChild(paypalSdkScript);

        // Ensure the PayPal SDK script is loaded before trying to use paypal object
        paypalSdkScript.onload = function() {
            paypal.Buttons({
                createOrder: function(data, actions) {
                    const tipAmount = parseFloat(document.getElementById('tip-amount').value) || 0;
                    const totalAmount = price + tipAmount;
                    return actions.order.create({
                        purchase_units: [{
                            description: `WorkYarder - ${serviceType}`,
                            amount: {
                                currency_code: "USD",
                                value: totalAmount.toFixed(2)
                            }
                        }],
                        application_context: {
                            shipping_preference: 'NO_SHIPPING'
                        }
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        console.log('Transaction completed by ' + details.payer.name.given_name);
                        const tipAmount = parseFloat(document.getElementById('tip-amount').value) || 0;
                        // Add AJAX call here to update the database
                        fetch('assets/php/updatePaymentStatus.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `appointmentId=${encodeURIComponent(globalAppointmentId)}&tipAmount=${tipAmount}` // Send appointmentId and tipAmount
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                window.location.href = 'appointment-details.php'; // Redirect only on successful DB update
                            } else {
                                console.error('Error updating payment status:', data.message);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    });
                }
            }).render('#paypal-container-U9QFG4KVSL3HL');
        };

        // Append the payment section to the statusSection's parent element
        statusSection.parentNode.insertBefore(paymentSection, statusSection.nextSibling);
    }

    function editAppointmentDetails() {
        const statusSection = document.getElementById('order-status');

        // Create Contact Method dropdown
        const contactMethodOptions = ['Phone', 'Email', 'Text'].map(method => 
            `<option value="${method}" ${globalData.contactMethod === method ? 'selected' : ''}>${method}</option>`
        ).join('');

        // Correctly parse the current time from data.time
        const [time, modifier] = globalData.time.split(' ');
        let [hours, minutes] = time.split(':');
        hours = parseInt(hours);
        minutes = parseInt(minutes);
        if (modifier === 'PM' && hours < 12) hours += 12;
        if (modifier === 'AM' && hours === 12) hours = 0;

        const appointmentDate = new Date(globalData.date);
        appointmentDate.setHours(hours, minutes);

        let timeOptions = '';
        for (let hour = appointmentDate.getHours(); hour <= 19; hour++) {
            const isPM = hour >= 12;
            const formattedHour = ((hour + 11) % 12 + 1); // Convert 24h to 12h format
            const formattedTime = `${formattedHour}:00 ${isPM ? 'PM' : 'AM'}`;
            timeOptions += `<option value="${formattedTime}">${formattedTime}</option>`;
        }

        // Update the HTML to include dropdowns
        statusSection.innerHTML = `
            <div class="jotform-section">
                <h1>Order Status: ${globalData.orderStatus}</h1>
                <h2>Booking Information:</h2>
                <p>Order Code: ${globalData.orderCode}</p>
                <p>Date: ${globalData.date}</p>
                <p>Time: <select id="time-dropdown">${timeOptions}</select></p>
                <p>Address: ${globalData.address}</p>
                <p>Accessibility: ${globalData.accessibility}</p>
                <p>Notes: ${globalData.clientNotes}</p>
                <br>
                <p>Contact Method: <select id="contact-method-dropdown" onchange="updateContactMethod()" data-email="${globalData.email}" data-phone="${globalData.phone}">${contactMethodOptions}</select></p>
                <p>Contact: <span id="contact-info">${globalData.contact}</span></p>
                <p>Additional Info: ${globalData.additionalInfo}</p>
                <br>
                <p>Quote Tier: ${globalData.quoteTier}</p>
                <p>Quote Price: ${globalData.quotePrice}</p>
                <div class="jotform-form-row">
                    <button class="jotform-submit" onclick="saveAppointmentDetails()">Save Appointment Details</button>
                </div>
                <hr>
                <h2>Provider Information:</h2>
                <p>Order Status: ${globalData.orderStatus}</p>
                <p>Provider: ${globalData.provider}</p>
                <p>Service Type: ${globalData.serviceType}</p>
                <br>
                <p>Notes: ${globalData.providerNotes}</p>
            </div>
        `;
    }

    function updateContactMethod() {
        const contactMethodDropdown = document.getElementById('contact-method-dropdown');
        const selectedMethod = contactMethodDropdown.value;
        const email = contactMethodDropdown.getAttribute('data-email');
        const phone = contactMethodDropdown.getAttribute('data-phone');
        const contactInfoSpan = document.getElementById('contact-info');

        if (selectedMethod === 'Phone' || selectedMethod === 'Text') {
            contactInfoSpan.textContent = phone;
        } else if (selectedMethod === 'Email') {
            contactInfoSpan.textContent = email;
        }
    }

    function saveAppointmentDetails() {
        const contactMethodDropdown = document.getElementById('contact-method-dropdown');
        const timeDropdown = document.getElementById('time-dropdown');
        const contactMethod = contactMethodDropdown.value;
        const time = timeDropdown.value;

        fetch('assets/php/save-appointment-details.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ appointmentId: globalAppointmentId, contactMethod: contactMethod, time: time }),
        })
        .then(response => response.json())
        .then(data => {
            alert('Appointment details saved successfully.');
            // Optionally, refresh or update the page content to reflect the saved changes
            window.location.href = 'appointment-details.php'; // Redirect user to appointment-details.php
        })
        .catch(error => console.error('Error:', error));
    }

    function cancelAppointment() {
        if (confirm('Are you sure you want to cancel the appointment?')) {
            const statusSection = document.getElementById('order-status');
            const data = JSON.parse(statusSection.getAttribute('data-booking'));
            statusSection.setAttribute('data-booking', JSON.stringify(data));

            // Make an AJAX request to update the assignment status
            fetch('assets/php/update-assignment-status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ appointmentId: globalAppointmentId, newStatus: 'Canceled' }),
            })
            .then(response => response.json())
            .then(data => {
                alert('Appointment canceled successfully.');
                // Optionally, refresh or update the page content to reflect the canceled appointment
                window.location.href = 'appointment-details.php'; // Redirect user to appointment-details.php
                if (data.orderStatus === 'Canceled') {
                    document.getElementById('editOrder').style.display = 'none';
                    document.getElementById('makePayment').style.display = 'none';
                    document.getElementById('cancelOrder').style.display = 'none';
                }
            })
            .catch(error => console.error('Error:', error));

            // Hide buttons when order is canceled
            document.getElementById('editOrder').style.display = 'none';
            document.getElementById('makePayment').style.display = 'none';
            document.getElementById('cancelOrder').style.display = 'none';
        }
    }

    function reportIssue() {
        document.getElementById("reportIssueModal").style.display = "block";
    }

    document.addEventListener('DOMContentLoaded', function() {
        var closeButton = document.querySelector('.close');
        closeButton.addEventListener('click', function() {
            document.getElementById("reportIssueModal").style.display = "none";
        });
    });

    function submitIssueReport() {
        const message = document.getElementById('issueCommentBox').value;

            // Now, use appointmentId to get appointment_id and submit the issue
            fetch('assets/php/submitIssue.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ appointmentId: globalAppointmentId, message: message }),
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

    function leaveReview() {
        document.getElementById("reviewModal").style.display = "block";
    }

    function closeReviewModal() {
        document.getElementById("reviewModal").style.display = "none";
    }

    function submitReview() {
        const reviewText = document.getElementById("reviewText").value;
        const rating = document.querySelector('input[name="rating"]:checked').value;
        const appointmentId = globalAppointmentId;

        fetch('assets/php/submitReview.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `appointmentId=${appointmentId}&review=${encodeURIComponent(reviewText)}&rating=${rating}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Review submitted successfully.');
                closeReviewModal();
                window.location.href = 'appointment-details.php'; // Redirect only on successful DB update
            } else {
                alert('Error submitting review.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to submit review.');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.rating input');
        const labels = document.querySelectorAll('.rating label');

        function updateStars(target) {
            let clickedStarValue = target.value;
            stars.forEach((star, index) => {
                if (star.value <= clickedStarValue) {
                    labels[index].classList.add('active');
                } else {
                    labels[index].classList.remove('active');
                }
            });
        }

        stars.forEach(star => {
            star.addEventListener('click', function() {
                if (this.checked && this.value === document.querySelector('.rating input:checked')?.value) {
                    if (labels[stars.length - this.value].classList.contains('active')) {
                        this.checked = false;
                        labels.forEach(label => label.classList.remove('active'));
                    } else {
                        updateStars(this);
                    }
                } else {
                    updateStars(this);
                }
            });

            star.addEventListener('dblclick', function() {
                this.checked = false;
                labels.forEach(label => label.classList.remove('active'));
            });
        });
    });
    </script>
</body>
</html>