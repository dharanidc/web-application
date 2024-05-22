<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Seat Selection</title>
    <style>
     /* ... (Your existing styles) ... */

     .balcony .seat {
            background-color: #ffa07a; /* Light Salmon */
        }

        .club .seat {
            background-color: #87cefa; /* Light Sky Blue */
        }

        .executive .seat {
            background-color: #98fb98; /* Pale Green */
        }

        /* ... (Your existing styles) ... */
          body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #333;
            color: #fff;
            overflow-y: scroll;
            height:800px;
        }

        .container {
            border: 2px solid #333;
            padding: 20px;
            text-align: center;
            background-color: #444;
            border-radius: 10px;
        }

        .screen {
  background-color: #fff;
  height: 70px;
  width: 100%;
  margin: 15px 0;
  transform: rotateX(-45deg);
  box-shadow: 0 3px 10px rgba(255, 255, 255, 0.7);
}

        .theatre {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .row {
            display: flex;
            justify-content: center;
        }

        .seat {
            width: 30px;
            height: 30px;
            margin: 5px;
            background-color: #ddd;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            color: #333;
        }

        .seat.selected {
            background-color: #28a745;
            color: #fff;
        }

        #count {
            margin-top: 10px;
            font-size: 20px;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Movie Name</h2>
    <div class="screen">Screen</div>
    <div class="theatre" id="seats-container"></div>
    <p id="count">Selected Seats: 0</p>
    <button onclick="proceedToPayment()">Proceed to Payment</button>
</div>
<!-- ... (Your existing HTML) ... -->

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const seatsContainer = document.getElementById("seats-container");
        const countText = document.getElementById("count");
        let selectedSeats = 0;
        let selectedSeatNumbers = [];

        // Number of rows and seats per row
        const numRows = 10;
        const seatsPerRow = 25;

        // Number of balcony seats and seats per balcony row
        const balconySeats = 14;
        const seatsPerBalconyRow = 14;

        // Number of club seats and seats per club row
        const clubSeats = 84;
        const seatsPerClubRow = 21;

        // Number of executive seats and seats per executive row
        const executiveSeats = 75;
        const seatsPerExecutiveRow = 25;

        // Create seats
        for (let row = 1; row <= numRows; row++) {
            const rowElement = document.createElement("div");
            rowElement.className = "row";
            seatsContainer.appendChild(rowElement);

            let seatsPerCurrentRow;
            if (row <= 2) {
                seatsPerCurrentRow = balconySeats;
            } else if (row > 2 && row <= 7) {
                seatsPerCurrentRow = seatsPerClubRow;
            } else if (row > numRows - 2) {
                seatsPerCurrentRow = seatsPerExecutiveRow;
                rowElement.classList.add("executive"); // Add executive class to the row
            } else {
                seatsPerCurrentRow = seatsPerRow;
            }

            for (let seat = 1; seat <= seatsPerCurrentRow; seat++) {
                const seatElement = document.createElement("button");
                seatElement.className = "seat";
                seatElement.innerText = seat;

                // Categorize seats into balcony, club, and executive
                if (row <= 2) {
                    seatElement.classList.add("balcony");
                } else if (row > 2 && row <= 7) {
                    seatElement.classList.add("club");
                } else {
                    seatElement.classList.add("executive");
                }

                rowElement.appendChild(seatElement);

                // Add click event listener to each seat
                seatElement.addEventListener("click", function () {
                    if (!seatElement.classList.contains("selected")) {
                        selectedSeats++;
                        selectedSeatNumbers.push(seat);
                        seatElement.classList.add("selected");
                    } else {
                        selectedSeats--;
                        const index = selectedSeatNumbers.indexOf(seat);
                        selectedSeatNumbers.splice(index, 1);
                        seatElement.classList.remove("selected");
                    }

                    updateSelectedCount();
                });
            }
        }

        function updateSelectedCount() {
            countText.innerText = `Selected Seats: ${selectedSeats}`;
        }
    });

    function proceedToPayment() {
        // Check if any seat is selected
        if (selectedSeats === 0) {
            alert("Please select at least one seat.");
        } else {
            // Calculate the amount based on the number of selected seats
            const seatPrice = 10; // Replace with your actual seat price
            const totalAmount = selectedSeats * seatPrice;

            // Proceed to payment logic
            alert(`Proceeding to payment for ${selectedSeats} selected seats. Total amount: $${totalAmount}`);
        }
    }
</script>

<!-- ... (Your existing HTML) ... -->

</body>
</html>