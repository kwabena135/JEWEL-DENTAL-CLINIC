<?php
$servername = "localhost";
$username = "root"; // change if different
$password = "";     // change if different
$dbname = "your_database_name"; // change to your database name

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data safely
    $fullName = htmlspecialchars($_POST['fullName']);
    $age = intval($_POST['age']);
    $email = htmlspecialchars($_POST['email']);
    $date = htmlspecialchars($_POST['date']);
    $address = htmlspecialchars($_POST['address']);
    $phone = htmlspecialchars($_POST['phone']);

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO appointments (fullName, age, email, date, address, phone) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissss", $fullName, $age, $email, $date, $address, $phone);

    if ($stmt->execute()) {
        echo "<h2>Appointment Booked Successfully!</h2>";
        echo "<table border='1' cellpadding='8'>";
        echo "<tr><th>Full Name</th><td>$fullName</td></tr>";
        echo "<tr><th>Age</th><td>$age</td></tr>";
        echo "<tr><th>Email</th><td>$email</td></tr>";
        echo "<tr><th>Date</th><td>$date</td></tr>";
        echo "<tr><th>Address</th><td>$address</td></tr>";
        echo "<tr><th>Phone</th><td>$phone</td></tr>";
        echo "</table>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h2>No appointment data received.</h2>";
}
?>