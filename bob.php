<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Form</title>
    <!-- Include Bootstrap CSS -->
    <?php include('includes/head.php') ?>
</head>
<body>

<div class="container mt-5">
    <h1>Input Form</h1>
    <form method="post" action="bob.php">
        <div class="mb-3">
            <label for="pInput" class="form-label">p</label>
            <input type="text" class="form-control" id="pInput" name="p" placeholder="Enter p">
        </div>
        <div class="mb-3">
            <label for="qInput" class="form-label">q</label>
            <input type="text" class="form-control" id="qInput" name="q" placeholder="Enter q">
        </div>
        <div class="mb-3">
            <label for="mInput" class="form-label">messaeg</label>
            <input type="text" class="form-control" id="mInput" name="C" placeholder="Enter m">
        </div>
        <div class="mb-3">
            <label for="mInput" class="form-label">public key</label>
            <input type="text" class="form-control" id="mInput" name="e" placeholder="e">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script>

</body>
</html>

<?php

if(isset($_POST['submit'])){
// Define the URL of your Flask API
$apiUrl = 'http://127.0.0.1:5000/digital';  // Replace with the actual API URL

// Define the data to send in JSON format
$data = [
    'C' => $_POST['C'],
    'e' => $_POST['e'],
    'p' => $_POST['p'],
    'q' => $_POST['q']
   
];

// Convert the data to JSON format
$jsonData = json_encode($data);

// Set up cURL
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
}

// Close cURL resource
curl_close($ch);

// Output the response from the Flask API
echo $response;
}

?>
