<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="client.css" />
    <title>Financial Status 📈</title>
    <style>
  
  button{
  width: 100%; /* Adjust the width as needed */
  padding: 10px; /* Adjust the padding as needed */
  background-color: #ff7f50; /* Change the background color */
  color: white; /* Change the text color */
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

    </style>
  </head>
  <body>
    <div class="container">
      <h1>Financial Status 📈</h1>

      <?php
        // Check if the logout button is clicked
        if (isset($_POST['logout'])) {
          // Destroy the session
          session_start();
          session_destroy();
          header("Location: index.php"); // Redirect to login page or any other page
          exit();
      }
        
        $url = "https://api.freecurrencyapi.com/v1/latest?apikey=fca_live_kCFX50tPyIvT3DBwXRoS5Oxh08lRBFc1PuAm1liS";

        $curl = curl_init($url);

        // Set curl options
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Execute the request
        $resp = curl_exec($curl);

        // Check for errors
        if (!$resp) {
            die('Error: ' . curl_error($curl));
        }

        // Decode JSON response
        $data = json_decode($resp, true);

        // Check if data is present
        if (isset($data['data']) && is_array($data['data'])) {
            echo '<table border="1">';
            echo '<tr><th>Currency</th><th>Exchange Rate</th></tr>';

            foreach ($data['data'] as $currency => $exchangeRate) {
                echo '<tr>';
                echo '<td>' . $currency . '</td>';
                echo '<td>' . $exchangeRate . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo 'No data available.';
        }

        // Close cURL session
        curl_close($curl);
      ?>

      <div id="currency-list"></div>
      <form method="post">
        <button type="submit" name="logout" id="logout-btn">Logout</button>
      </form>
      
    </div>
  </body>
</html>
