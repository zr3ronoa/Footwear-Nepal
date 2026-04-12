<?php

session_start();
require "db.php";

function getNavigationItems($conn) {
  $sql = "SELECT `name` AS `title`, `link` FROM `menu_items`";
  $result = $conn->query($sql);
  return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}
function getSlides($conn) {
    $sql = "SELECT id,subtitle, title, description, image_url, link FROM slide_container";
    $result = $conn->query($sql);

    // Return fetched data as an associative array, or an empty array on failure
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}
function getServices($conn) {
    $sql = "SELECT `icon`, `title`, `description` FROM `services`";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}


function getLatestProducts($conn) {
    $sql = "SELECT `name`, `description`, `price`, `original_price`, `rating`, `image_url` FROM `products`";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function getFeaturedProducts($conn) {
    $sql = "SELECT `name`, `description`, `price`, `original_price`, `rating`, `small_images`, `big_image` FROM `featured_products`";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function getTeamMembers($conn) {
    $sql = "SELECT `name`, `role`, image_url FROM team_members";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}
function getCustomerReviews($conn) {
    $sql = "SELECT customer_name, review_text, rating, created_at FROM customer_reviews ORDER BY created_at DESC";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}
function getOutlets($conn) {
    $sql = "SELECT name, url FROM outlets";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

// Function to fetch contacts
function getContacts($conn) {
    $sql = "SELECT type, value FROM contacts";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

// Function to fetch links
function getLinks($conn) {
    $sql = "SELECT name, url FROM links";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

// Function to fetch social media links
function getSocialMedia($conn) {
    $sql = "SELECT platform, url FROM social_media";
    $result = $conn->query($sql);
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}



$menuItems = getNavigationItems($conn);
$slides = getSlides($conn);
$services = getServices($conn);
$latestProducts = getLatestProducts($conn);
$featuredProducts = getFeaturedProducts($conn);
$teamMembers = getTeamMembers($conn);
$customerReviews = getCustomerReviews($conn);
$outlets = getOutlets($conn);
$contacts = getContacts($conn);
$links = getLinks($conn);
$socialMedia = getSocialMedia($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootWear Nepal</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script> <!-- Include the JavaScript file -->
    
</head>
<body>

<header>
       <div id="menu-bar" class="fas fa-bars"></div>


        <a href="index.php">
              <img src="images/logo.png" alt="FootWear Nepal" class="logo" width="65" height="65">
        </a>


        <nav class="navbar">
              <?php foreach ($menuItems as $menuItem): ?>
                     <a href="<?= htmlspecialchars($menuItem['link']); ?>">
                     <?= htmlspecialchars($menuItem['title']); ?>
                     </a>
              <?php endforeach; ?>
        </nav>

        <div class="icons">
            <a href="#" class="fa fa-heart"></a>
            <a href="add_to_cart1.php" class="fas fa-shopping-cart"></a>
            <a href="account.php" class="fas fa-user"></a>
        </div>
</header>

<section id="home" class="home">
        <?php if (!empty($slides)): ?>
            <?php foreach ($slides as $index => $slide): ?>
                <div class="slide-container <?= $index === 0 ? 'active' : '' ?>">
                    <div class="slide">
                        <div class="content">
                            <span><?= htmlspecialchars($slide['subtitle']); ?></span>
                            <h3><?= htmlspecialchars($slide['title']); ?></h3>
                            <p><?= htmlspecialchars($slide['description']); ?></p>
                            <?php if (!empty($slide['link'])): ?>
                                <a href="<?= htmlspecialchars($slide['link']); ?>" class="btn">Learn More</a>
                            <?php endif; ?>
                        </div>
                        <div class="image">
                            <img src="<?= htmlspecialchars($slide['image_url']); ?>" alt="<?= htmlspecialchars($slide['title']); ?>" class="shoe">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <button id="prev" onclick="prev()">&#10094;</button>
            <button id="next" onclick="next()">&#10095;</button>
        <?php else: ?>
            <p>No slides available.</p>
        <?php endif; ?>
</section>

<section class="service">
    <div class="box-container">
        <?php if (!empty($services)): ?>
            <?php foreach ($services as $service): ?>
                <div class="box">
                    <i class="<?php echo htmlspecialchars($service['icon']); ?>"></i>
                    <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                    <p><?php echo htmlspecialchars($service['description']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No services available at the moment.</p>
        <?php endif; ?>
    </div>
</section>

<section class="products" id="products">
    <h1 class="heading"> latest <span>products</span> </h1>
    <div class="box-container">
        <?php foreach ($latestProducts as $product): ?>
            <div class="box">
                <div class="icons">
                    <a href="add_to_cart1.php" class="fas fa-heart"></a>
                    <a href="#" class="fas fa-share"></a>
                    <a href="#" class="fas fa-eye"></a>
                </div>
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="content">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                   <!-- <h3><?php //echo htmlspecialchars($product['description']); ?></h3>-->
                    <div class="price">
                        Rs.<?php echo number_format($product['price']); ?> 
                        <span>Rs.<?php echo number_format($product['original_price']); ?></span>
                    </div>
                    <div class="stars">
                        <?php
                        $fullStars = floor($product['rating']);
                        $halfStar = ($product['rating'] - $fullStars) >= 0.5;
                        for ($i = 0; $i < $fullStars; $i++) echo '<i class="fas fa-star"></i>';
                        if ($halfStar) echo '<i class="fas fa-star-half-alt"></i>';
                        for ($i = $fullStars + $halfStar; $i < 5; $i++) echo '<i class="far fa-star"></i>';
                        ?>
                    </div>
                    <form action="add_to_cart.php" method="POST">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>">
                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['image_url']); ?>">
                        <button type="submit" class="btn">Add to Cart</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="featured" id="featured">
    <h1 class="heading"> <span>featured</span> products </h1>
    <?php foreach ($featuredProducts as $index => $product): ?>
        <div class="row">
            <div class="image-container">
                <div class="small-image">
                    <?php
                    $smallImages = json_decode($product['small_images'], true);
                    foreach ($smallImages as $image): ?>
                        <img src="<?php echo htmlspecialchars($image); ?>" class="featured-image-<?php echo $index + 1; ?>" alt="">
                    <?php endforeach; ?>
                </div>
                <div class="big-image">
                    <img src="<?php echo htmlspecialchars($product['big_image']); ?>" class="big-image-<?php echo $index + 1; ?>" alt="">
                </div>
            </div>
            <div class="content">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <div class="stars">
                    <?php
                    $fullStars = floor($product['rating']);
                    $halfStar = ($product['rating'] - $fullStars) >= 0.5;
                    for ($i = 0; $i < $fullStars; $i++) echo '<i class="fas fa-star"></i>';
                    if ($halfStar) echo '<i class="fas fa-star-half-alt"></i>';
                    for ($i = $fullStars + $halfStar; $i < 5; $i++) echo '<i class="far fa-star"></i>';
                    ?>
                </div>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <div class="price">Rs.<?php echo number_format($product['price']); ?> <span>Rs.<?php echo number_format($product['original_price']); ?></span></div>
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                    <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>">
                    <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['big_image']); ?>">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<section class="review" id="blog">
    <h1 class="heading"> about <span>us</span> </h1>
    <div class="box-container">
        <?php foreach ($teamMembers as $member): ?>
            <div class="box">
                <img src="<?php echo htmlspecialchars($member['image_url']); ?>" alt="<?php echo htmlspecialchars($member['name']); ?>">
                <h3><?php echo htmlspecialchars($member['name']); ?></h3>
                <p><?php echo htmlspecialchars($member['role']); ?></p>
    
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="newsletter" id="review">

    <div class="content">
        <h1 class="heading"> customer <span> reviews</span> </h1>
        <p>If you want to give reviews about our products, please feel free.</p>
        <form action="reviews.php">
            <input type="submit" value="review box" class="btn">
        </form>
    </div>

</section>


<section class="footer">
    <div class="box-container">

        <!-- Outlets Section -->
        <div class="box">
            <h3>outlets</h3>
            <?php foreach ($outlets as $outlet): ?>
                <a href="<?= htmlspecialchars($outlet['url']) ?>" class="fa fa-map-marker">
                    <?= htmlspecialchars($outlet['name']) ?>
                </a>
            <?php endforeach; ?>

            <h3>contact us</h3>
            <?php foreach ($contacts as $contact): ?>
                <?php if ($contact['type'] == 'email'): ?>
                    <a href="mailto:<?= htmlspecialchars($contact['value']) ?>" class="far fa-envelope">
                        <?= htmlspecialchars($contact['value']) ?>
                    </a>
                <?php elseif ($contact['type'] == 'phone'): ?>
                    <a href="tel:<?= htmlspecialchars($contact['value']) ?>" class="fas fa-phone">
                        <?= htmlspecialchars($contact['value']) ?>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Links Section -->
        <div class="box">
            <h3>links</h3>
            <?php foreach ($links as $link): ?>
                <a href="<?= htmlspecialchars($link['url']) ?>">
                    <?= htmlspecialchars($link['name']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- More Section -->
        <div class="box">
            <h3>more</h3>
            <a href="login.html">Account</a>
            <a href="#">Favourites</a>
            <a href="add_to_cart1.php">Cart</a>
            <a href="rewiews.php">Reviews</a>
        </div>

        <!-- Social Media Section -->
        <div class="box">
            <h3>follow us</h3>
            <?php foreach ($socialMedia as $media): ?>
                <a href="<?= htmlspecialchars($media['url']) ?>" class="fab fa-<?= strtolower(htmlspecialchars($media['platform'])) ?>">
                    <?= htmlspecialchars($media['platform']) ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="credit">created by <span> FootWear Nepal </span> | all rights reserved</div>
    </div>
</section></body>
</html>
