
<?php
$conn = new mysqli("localhost", "root", "", "art_pricing_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$artwork_name = $_POST['artwork_name'];
$hours_spent = $_POST['hours_spent'];
$material_cost = $_POST['material_cost'];
$complexity = $_POST['complexity'];
$experience_level = $_POST['experience_level'];

// Image upload
$image_name = $_FILES['art_image']['name'];
$tmp_name = $_FILES['art_image']['tmp_name'];
$upload_path = "uploads/" . $image_name;
move_uploaded_file($tmp_name, $upload_path);

// Pricing logic
if ($experience_level == "Beginner") {
    $hourly_rate = 100;
} elseif ($experience_level == "Intermediate") {
    $hourly_rate = 250;
} else {
    $hourly_rate = 500;
}

if ($complexity == "Low") {
    $multiplier = 1.0;
} elseif ($complexity == "Medium") {
    $multiplier = 1.3;
} else {
    $multiplier = 1.6;
}

$base_price = ($hours_spent * $hourly_rate) + $material_cost;
$suggested_price = $base_price * $multiplier;

$date_created = date("Y-m-d");

$sql = "INSERT INTO price_records 
(artwork_name, hours_spent, material_cost, complexity, experience_level, base_price, suggested_price, date_created, image_path)
VALUES 
('$artwork_name', '$hours_spent', '$material_cost', '$complexity', '$experience_level', '$base_price', '$suggested_price', '$date_created', '$upload_path')";

$conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Price Result</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body{
            margin:0;
            background:black;
            color:white;
            font-family: Arial, sans-serif;
            cursor: url('cursor.png') 0 0, auto;
            padding-top:80px;
            text-align:center;
        }

        /* Stars */
        .stars{
            position:fixed;
            width:100%;
            height:100%;
            z-index:-1;
            pointer-events:none;
        }

        .stars span{
            position:absolute;
            border-radius:50%;
            background:white;
            opacity:0.8;
            animation: twinkle 3s infinite ease-in-out;
        }

        .small{ width:2px; height:2px; }
        .medium{ width:4px; height:4px; }
        .big{ width:6px; height:6px; }

        @keyframes twinkle{
            0%,100%{opacity:0.3;}
            50%{opacity:1;}
        }

        /* Navbar */
        .navbar{
            position:fixed;
            top:0;
            width:100%;
            background:black;
            padding:12px 0;
            z-index:1000;
        }

        .navbar a{
            color:white;
            text-decoration:none;
            margin:0 20px;
            font-size:18px;
        }

        img{
            width:350px;
            height:350px;
            object-fit:cover;
            border-radius:10px;
            margin-bottom:20px;
        }

        .result{
            width:500px;
            margin:auto;
        }

        .warning{
            margin-top:15px;
            font-weight:bold;
        }
    </style>
</head>

<body>

<div class="stars">
    <span class="small" style="top:5%; left:10%;"></span>
    <span class="medium" style="top:12%; left:80%;"></span>
    <span class="small" style="top:30%; left:5%;"></span>
    <span class="big" style="top:70%; left:90%;"></span>
    <span class="medium" style="top:85%; left:15%;"></span>
    <span class="small" style="top:40%; left:95%;"></span>
    <span class="big" style="top:60%; left:2%;"></span>
    <span class="medium" style="top:90%; left:60%;"></span>
    <span class="small" style="top:15%; left:50%;"></span>
</div>

<div class="navbar">
    <a href="index.html">Home</a>
    <a href="form.html">Add Artwork</a>
    <a href="history.php">Gallery</a>
</div>

<div class="result">
    <h2>Price Calculation Result</h2>

    <img src="<?php echo $upload_path; ?>">

    <p><strong>Artwork:</strong> <?php echo $artwork_name; ?></p>
    <p><strong>Base Price:</strong> ₹<?php echo $base_price; ?></p>
    <p><strong>Suggested Price:</strong> ₹<?php echo $suggested_price; ?></p>

    <p class="warning">
        You should NOT price this artwork below ₹<?php echo $suggested_price; ?>
    </p>

    <a href="form.html">Calculate Another Artwork</a>
</div>

</body>
</html>




