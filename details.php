<?php
$conn = new mysqli("localhost","root","","art_pricing_db");

$img = $_GET['img'];

$stmt = $conn->prepare("SELECT * FROM price_records WHERE image_path = ?");
$stmt->bind_param("s", $img);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
<title>Artwork Details</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">

<style>
body{
    margin:0;
    background:black;
    color:white;
    font-family: 'Playfair Display', serif;
    cursor: url('cursor.png') 0 0, auto;
    padding-top:120px;
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

/* Back link */
.back-link{
    position:fixed;
    top:80px;
    left:20px;
    text-decoration:none;
    font-size:20px;
    color:white;
    font-weight:bold;
}

img{
    width:450px;
    height:450px;
    object-fit:cover;
    border-radius:10px;
    margin-bottom:20px;
}

.details{
    width:420px;
    margin: 30px auto 0 auto;  /* pushes it to center */
    text-align:left;
    line-height:1.9;
    font-size:18px;
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

<a href="history.php" class="back-link">❮ Back to Gallery</a>

<img src="<?php echo $data['image_path']; ?>">

<div class="details">
    <h2 style="text-align:center; margin-bottom:25px;">
    <?php echo $data['artwork_name']; ?>
</h2>
    <p><strong>Hours Spent:</strong> <?php echo $data['hours_spent']; ?></p>
    <p><strong>Material Cost:</strong> ₹<?php echo $data['material_cost']; ?></p>
    <p><strong>Complexity:</strong> <?php echo $data['complexity']; ?></p>
    <p><strong>Experience Level:</strong> <?php echo $data['experience_level']; ?></p>
    <p><strong>Suggested Price:</strong> ₹<?php echo $data['suggested_price']; ?></p>
</div>

</body>
</html>
