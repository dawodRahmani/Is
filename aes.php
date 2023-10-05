<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encryption and Decryption</title>
    <!-- Include Bootstrap CSS -->
    <?php include('includes/head.php') ?>
<body>

<div class="container mt-5">
    <h1>Encryption and Decryption</h1>
    <form id="encryptionForm" method="post" action="aes.php">
        <div class="mb-3">
            <label for="textInput" class="form-label">Text Input</label>
            <input type="text" class="form-control" id="text" name="text" placeholder="Enter text to encrypt/decrypt" required>
        </div>
        <div class="mb-3">
            <label for="keyInput" class="form-label">Encryption Key</label>
            <input type="text" class="form-control" id="keyInput" name="key" placeholder="Enter encryption/decryption key" required>
        </div>
        <button type="submit" class="btn btn-primary" id="encrypt" name="encrypt">Encrypt</button>
        <button type="submit" class="btn btn-danger" id="decrypt" name="decrypt">Decrypt</button>
       
    </form>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script>

<!-- Your custom JavaScript for encryption/decryption here -->


</body>
</html>

<?php

function callapi($apiUrl, $data){
// Encode the data as JSON
$jsonData = json_encode($data);

// Initialize cURL session
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    return 'cURL error: ' . curl_error($ch);
}

// Close cURL resource
curl_close($ch);

// Output the response from the API
return $response;
}
if(isset($_POST['encrypt'])){

// Define the API URL
$apiUrl = 'http://127.0.0.1:5000/aesEnc';

// Define the JSON data
$data = array(
    'plaintext' => $_POST['text'],
    'key' => $_POST['key']
);
$final = callapi($apiUrl,$data);
echo " <div class=\"mt-3\">
<strong>Result:</strong>
<p id=\"result\">".$final."</p>

</div>";
print_r($data) ;

}
if(isset($_POST['decrypt'])){

    // Define the API URL
    $apiUrl = 'http://127.0.0.1:5000/aesDec';
    
    // Define the JSON data
    $data = array(
        'cipher' => $_POST['text'],
        'key' => $_POST['key']
    );
    $final = callapi($apiUrl,$data);
    echo " <div class=\"mt-3\">
    <strong>Result:</strong>
    <p id=\"result\">".$final."</p>
    
    </div>";
    print_r($data) ;
    
    }
?>
