<?php 
include 'connection.php'; 

// Get the ID from the URL
$id = $_GET['id'];

// Prepare the DELETE SQL statement
$sql = "DELETE FROM penjualan WHERE id = ?";
if ($stmt = $conn->prepare($sql)) {
    // Bind parameters
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the view page after successful deletion
        header("Location: view.php");
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>
