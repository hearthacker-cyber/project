
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <style>
    #map {
      height: 500px;
    }
  </style>
</head>
<body>

<div class="container">

  <div id="map"></div>
</div>

<script>
  var map = L.map('map').setView([20.5937, 78.9629], 5); // Default center of India
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
  }).addTo(map);

  <?php
  // Database connection
  $servername = "srv1124.hstgr.io";
  $username = "u632480160_52project";
  $password = "@Babahelp13";
  $db = "u632480160_52project";

  // Create connection
  $con = new mysqli($servername, $username, $password, $db);

  // Check connection
  if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
  }

  // Retrieve flood details from the database
  $sql = "SELECT * FROM flood_history";
  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    // Output markers for each flood location
    while ($row = $result->fetch_assoc()) {
      echo "L.marker([" . $row['latitude'] . ", " . $row['longitude'] . "]).addTo(map)
      .bindPopup('<b>Year:</b> " . $row['year'] . "<br><b>Location:</b> " . $row['location'] . "<br><b>Severity:</b> " . $row['severity'] . "<br><b>Impact:</b> " . $row['impact'] . "');\n";
    }
  } else {
    echo "No flood data available";
  }

  $con->close();
  ?>
</script>

