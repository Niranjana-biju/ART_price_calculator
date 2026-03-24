<?php
$conn = new mysqli("localhost","root","","art_pricing_db");

$search = "";
if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM price_records 
            WHERE artwork_name LIKE '%$search%' 
            ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM price_records ORDER BY id DESC";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>Artwork Gallery</title>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">

<style>
body{
    margin:0;
    background:black;
    color:white;
    font-family: Arial, sans-serif;
    cursor: url('cursor.png') 0 0, auto;
    padding-top:80px;
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
    text-align:center;
    z-index:1000;
}

.navbar a{
    color:white;
    text-decoration:none;
    margin:0 20px;
    font-size:18px;
}

/* Search */
.search-box{
    text-align:center;
    margin-bottom:30px;
}

.search-box input{
    width:280px;
    padding:10px 15px;
    border-radius:25px;
    border:none;
}

.search-box button{
    padding:10px 18px;
    border:none;
    border-radius:25px;
    background:white;
    color:black;
    margin-left:8px;
}

/* Gallery */
.gallery{
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(280px,1fr));
    gap:25px;
    padding:20px;
}

.card{
    background:white;
    border-radius:10px;
    padding:15px;
    text-align:center;
    color:black;
}

.card img{
    width:100%;
    height:280px;
    object-fit:cover;
    border-radius:8px;
}

.delete{
    color:red;
    text-decoration:none;
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

<h2 style="text-align:center;">Artwork Gallery</h2>

<div class="search-box">
    <form method="GET">
        <input type="text" name="search" placeholder="Search artwork name..." value="<?php echo $search; ?>">
        <button type="submit">Search</button>
    </form>
</div>

<div class="gallery">

<?php if($result->num_rows == 0){ ?>
    <p style="grid-column:1/-1; text-align:center;">Oops! Artwork not found.</p>
<?php } ?>

<?php while($row = $result->fetch_assoc()) { ?>
<div class="card">
    <a href="details.php?img=<?php echo urlencode($row['image_path']); ?>">

        <img src="<?php echo $row['image_path']; ?>">
    </a>
    <p><strong><?php echo $row['artwork_name']; ?></strong></p>
    <p>Price: ₹<?php echo $row['suggested_price']; ?></p>

    <a class="delete"
       href="delete.php?id=<?php echo $row['id']; ?>"
       onclick="return confirm('Are you sure you want to delete this artwork?');">
       Delete
    </a>
</div>
<?php } ?>

</div>

</body>
</html>


