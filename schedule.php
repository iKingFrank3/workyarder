<?php include 'assets/php/booking-access.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkYarder</title>
    <link rel="stylesheet" href="assets/css/style.css">
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

        .fc-today-button {
            text-transform: capitalize;
        }
        
        .box-content-calendar {
            overflow-y: auto;
            max-height: 120px; /* Adjust the height based on your design */
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Increased z-index to sit on top of everything */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }
        
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
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
            width: 96%;
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

        .fc{
            width: 80%;
            text-align: center;
            display: block;
            margin: 0 auto;
        }

        .fc-event, .fc-event-dot {
            background-color: #4F8E35;
        }
        
        @media (max-width: 768px) {
            .modal-content {
                margin: 45% auto;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Confirm Appointment</h1>
    </header>

    <nav>
        <a href="index.html">Home</a>
        <a href="order-status.html">Order Status</a>
    </nav>

    <div class="content">
            <h2 style="text-align: center;">Please select a day below that will best fit your schedule </h2>
        <div class="main-content">
            <div class="data-insights">
                <div class="fullCalendar">
            </div>
            </div>
        </div>
    </div>

    <!-- Add modal HTML structure -->
    <div id="eventModal" class="modal">
        <form action="assets/php/appointment.php" name="appointment-form" method="post" onsubmit="return onSubmitAppointment(event)">
        <div class="modal-content">
           <span class="close">&times;</span>
           <h2 id="eventTitle"></h2>
           <input type="hidden" id="appointment-date" name="appointment-date">
           <input type="hidden" name="booking_code" value="<?php echo $bookingCode; ?>">
           <p id="eventDescription"></p>
           <p>Service: <?php echo $serviceType; ?></p>
           <p>Booking Code: <?php echo $bookingCode; ?></p>
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
           <br/>
           <br/>
           <textarea id="appointment-notes" name="appointment-notes" class="jotform-form-textarea" placeholder="Additional Notes"></textarea>
           <br/>
           <div class="jotform-submit-section">
            <button type="submit" class="jotform-submit" data-callback="onSubmitPool">Submit</button>
        </div>
        </div>
        </form> <!-- Add this form closing tag -->
    </div>

    <footer>
        <p>&copy; 2023 King Frank Digital Marketing</p>
    </footer>

    <script>
         // Initialize FullCalendar
         $('.fullCalendar').fullCalendar({
              events: function(start, end, timezone, callback) {
                var events = [];
                var date = moment().add(1, 'days'); // start from tomorrow
                for (var i = 0; i < 30; i++) { // repeat for the next 30 days
                    events.push({
                        title: 'Book date',
                        start: date.format('YYYY-MM-DD'),
                    });
                    date.add(1, 'days'); // add a day
                }
                callback(events);
              },
             eventClick: function (event, jsEvent, view) {
             // Open modal with event details
             openEventModal(event);
             },
         });
         
         function openEventModal(event) {
             const modal = document.getElementById('eventModal');
             const titleElement = document.getElementById('eventTitle');
             const descriptionElement = document.getElementById('eventDescription');
             const dateElement = document.getElementById('appointment-date');
             
             titleElement.textContent = moment(event.start).format('dddd, MMMM Do');
             dateElement.value = moment(event.start).format('YYYY-MM-DD');
             descriptionElement.textContent = "Please confirm your booking details.";
         
             // Show the modal
             modal.style.display = 'block';
         }
         
         // Add this at the bottom of the script
         const closeModalButton = document.getElementsByClassName('close')[0];
         closeModalButton.onclick = function () {
             const modal = document.getElementById('eventModal');
             modal.style.display = 'none';
         };

         function onSubmitAppointment(event) {
             event.preventDefault(); // Prevent default form submission
             const formData = new FormData(document.forms['appointment-form']);
             formData.append('eventTitle', document.getElementById('eventTitle').textContent); // Add eventTitle to form data
             // Correctly select the form
             fetch('assets/php/appointment.php', {
                 method: 'POST',
                 body: formData,
             })
             .then(response => response.text()) // Get the response as text
             .then(text => {
                 // Split the response on a pattern that matches your specific output
                 const parts = text.split('}{').map((part, index, array) => {
                     if (index > 0 && index < array.length - 1) {
                         return `}{${part}}{`;
                     }
                     return part;
                 });

                 if (parts.length > 1) {
                     parts[0] += '}';
                     parts[1] = '{' + parts[1];
                 }

                 const data1 = JSON.parse(parts[0]);
                 const data2 = JSON.parse(parts[1]);
                 console.log('Success:', data1, data2);
                 // Handle success response
                 const modal = document.getElementById('eventModal');
                 modal.style.display = 'none'; // Close the modal on success
                 window.location.href = 'appointment-success.html';
             })
             .catch((error) => {
                 console.error('Error:', error);
                 // Handle errors here
             });

             return false; // Return false to prevent the default form submission
         }
     </script>
</body>
</html>