<?php
include("header.php");

// Fix caching issue
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$sql = "SELECT * FROM emergency ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

function extractCoordinates($mapLink) {
    preg_match('/@([-.\d]+),([-.\d]+)/', $mapLink, $matches);
    return $matches ? ['lat' => $matches[1], 'lng' => $matches[2]] : null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <style>
        .map-container {
            width: 100%;
            height: 250px;
            border-radius: 8px;
            margin-top: 10px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Emergency Records</h2>

        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) { 
                $coords = extractCoordinates($row['mapLink']);
            ?>
                <div class="col-md-4">
                    <div class="card shadow-lg mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['address']) ?></h5>
                            <p class="card-text"><strong>Phone:</strong> <?= htmlspecialchars($row['phone']) ?></p>

                            <?php if ($coords): ?>
                                <div id="map-<?= $row['id'] ?>" class="map-container"></div>
                            <?php else: ?>
                                <p class="text-danger">Invalid Google Map Link</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script>
        window.onload = function () {
            <?php
            mysqli_data_seek($result, 0);
            while ($row = mysqli_fetch_assoc($result)) { 
                $coords = extractCoordinates($row['mapLink']);
                if ($coords) { 
            ?>
                var map = L.map("map-<?= $row['id'] ?>").setView([<?= $coords['lat'] ?>, <?= $coords['lng'] ?>], 15);
                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution: "&copy; OpenStreetMap contributors"
                }).addTo(map);
                L.marker([<?= $coords['lat'] ?>, <?= $coords['lng'] ?>]).addTo(map)
                    .bindPopup("<?= htmlspecialchars($row['address']) ?>").openPopup();
            <?php } } ?>
        };
    </script>
</body>
</html>

<?php mysqli_close($conn); ?>
