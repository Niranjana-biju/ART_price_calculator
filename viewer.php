<?php
$conn = new mysqli("localhost","root","","art_pricing_db");

$result = $conn->query("SELECT * FROM price_records ORDER BY id ASC");
$records = [];
while($row = $result->fetch_assoc()){
    $records[] = $row;
}

$total = count($records);
$index = isset($_GET['i']) ? $_GET['i'] : 0;

if($index < 0) $index = 0;
if($index >= $total) $index = $total - 1;

$data = $records[$index];
?>

<!DOCTYPE html>
<html>
<head>
<title>Artwork Viewer</title>

<style>
body{
    font-family: Arial, sans-serif;
    background:#f4f4f4;
    text-align:center;
    padding:40px;
}

.viewer{
    background:white;
    padding:25px;
    width:700px;
    margin:auto;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

.image-box{
    position:relative;
}

.image-box img{
    width:500px;
    height:500px;
    object-fit:cover;
    border-radius:10px;
}

.arrow{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    font-size:40px;
    text-decoration:none;
    background:rgba(255,255,255,0.7);
    padding:10px 15px;
    border-radius:50%;
}

.left{ left:-70px; }
.right{ right:-70px; }

.details{
    margin-top:20px;
}
.navbar{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    background:black;
    padding:12px 0;
    text-align:center;
    z-index:1000;
}

.navbar a{
    color:white;
    text-decoration:none;
    margin:0 20px;
    font-size:18px;
    font-family: Arial, sans-serif;
}

.navbar a:hover{
    text-decoration:underline;
}

</style>
</head>

<body>

<h2>Artwork Viewer</h2>

<div class="viewer">

    <div class="image-box">

        <?php if($index > 0){ ?>
            <a class="arrow left" href="viewer.php?i=<?php echo $index-1; ?>">❮</a>
        <?php } ?>

        <img src="<?php echo $data['image_path']; ?>">

        <?php if($index < $total-1){ ?>
            <a class="arrow right" href="viewer.php?i=<?php echo $index+1; ?>">❯</a>
        <?php } ?>

    </div>

    <div class="details">
        <h3><?php echo $data['artwork_name']; ?></h3>
        <p>Hours: <?php echo $data['hours_spent']; ?></p>
        <p>Experience: <?php echo $data['experience_level']; ?></p>
        <p>Price: ₹<?php echo $data['suggested_price']; ?></p>
    </div>

</div>

<br>
<a href="history.php">Switch to Gallery View</a>
<div class="navbar">
    <a href="index.html">Home</a>
    <a href="form.html">Add Artwork</a>
    <a href="history.php">Gallery</a>
</div>
</body>


</html>

