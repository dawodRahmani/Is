<!DOCTYPE html>
<html>
<head>
    <title>Caesar Cipher Encryption/Decryption</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Caesar Cipher Encryption/Decryption</h2>
        <form method="post" action="ceaser.php">
            <div class="form-group">
                <label for="text">Text to Encrypt/Decrypt:</label>
                <input type="text" class="form-control" id="text" name="text" required>
            </div>
            <div class="form-group">
                <label for="key">Encryption/Decryption Key:</label>
                <input type="number" class="form-control" id="key" name="s" required>
            </div>
            <button type="submit" class="btn btn-primary" name="encrypt">Encrypt</button>
            <button type="submit" class="btn btn-primary" name="decrypt">Decrypt</button>
        </form>
    </div>
</body>
</html>



<?php
// A PHP program to illustrate Caesar
// Cipher Technique
 
// This function receives text and shift
// and returns the encrypted text
if (isset($_POST['encrypt'])) {
    $text = $_POST["text"];
    $key = intval($_POST["s"]); // Convert the key to an integer

    $result = encrypt($text, $key);
    echo "<div class=\"container mt-5\">
    <h2>Result</h2>
    <p>$result  </p>
    </div>";
   

}
    // Get the text and key from the form
elseif (isset($_POST['decrypt'])){
    $text = $_POST["text"];
    $key = intval($_POST["s"]); // Convert the key to an integer
    $result = decrypt($text, $key);
    echo "<div class=\"container mt-5\">
    <h2>Result</h2>
    <p>$result  </p>
    </div>";
   }

    // Perform encryption or decryption based on the action
   
else {
        $result = "Invalid action.";
    }


function encrypt($text, $s)
{
    $result = "";
    
    //c = p+k mod 26 
    // d = p - k mod 26 
    // traverse text
    for ($i = 0; $i < strlen($text); $i++)
    {
        // apply transformation to each
        // character Encrypt Uppercase letters
        if (ctype_upper($text[$i]))
            $result = $result.chr((ord($text[$i]) +
                               $s - 65) % 26 + 65);
 
    // Encrypt Lowercase letters
    else
        $result = $result.chr((ord($text[$i]) +
                           $s - 97) % 26 + 97);
    }
 
    // Return the resulting string
    return $result;
}
 
// Driver Code
// $text = "Hello";
// $s = 3;
// echo ord('h');
// echo "Text : " . $text;
// echo "\nShift: " . $s;
// echo "\nCipher: " . encrypt($text, $s);
 
// This code is contributed by ita_c



function decrypt($text2, $s2)
{
    $result = "";
    
    //c = p+k mod 26 
    // d = p - k mod 26 
    // traverse text
    for ($i = 0; $i < strlen($text2); $i++)
    {
        // apply transformation to each
        // character Encrypt Uppercase letters
        if (ctype_upper($text2[$i]))
            $result = $result.chr((ord($text2[$i]) -
                               $s2 - 65) % 26 + 65);
 
    // Encrypt Lowercase letters
    else
        $result = $result.chr((ord($text2[$i]) -
                           $s2 - 97) % 26 + 97);
    }
 
    // Return the resulting string
    return $result;
}
 
// Driver Code
// $text2 = "khoor";
// $s2 = 3;
// echo "Text : " . $text2;
// echo "\nShift: " . $s2;
// echo "\nCipher: " . decrypt($text2, $s2);
 
// This code is contributed by ita_c
?>