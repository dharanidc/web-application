

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket Booking</title>
    <style>
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
            height: 800px;
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



<script>
    document.addEventListener("DOMContentLoaded", function () {
    const seatsContainer = document.getElementById("seats-container");
    const countText = document.getElementById("count");
    let selectedSeats = 0;
    let selectedSeatNumbers = [];

    const numRows = 8;
    const seatsPerRow = 12;

    for (let row = 1; row <= numRows; row++) {
        const rowElement = document.createElement("div");
        rowElement.className = "row";
        seatsContainer.appendChild(rowElement);

        for (let seat = 1; seat <= seatsPerRow; seat++) {
            const seatElement = document.createElement("button");
            seatElement.className = "seat";
            seatElement.innerText = seat;

            rowElement.appendChild(seatElement);

            seatElement.addEventListener("click", function () {
                if (!seatElement.classList.contains("selected")) {
                    selectedSeats++;
                    selectedSeatNumbers.push({ row, seat });
                    seatElement.classList.add("selected");
                } else {
                    selectedSeats--;
                    const index = selectedSeatNumbers.findIndex(item => item.row === row && item.seat === seat);
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
    if (selectedSeats === 0) {
        alert("Please select at least one seat.");
    } else {
        const seatPrice = 10;
        const totalAmount = selectedSeats * seatPrice;
        alert(`Proceeding to payment for ${selectedSeats} selected seats. Total amount: $${totalAmount}`);
        // You can send the selected seat information to the server using AJAX for further processing.
    }
}

</script>

</body>
</html>
