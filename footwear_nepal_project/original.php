
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FootWear Nepal</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="style.css">
   
</head>
<body>

<header>

    <div id="menu-bar" class="fas fa-bars"></div>

    <a href="index.php"><img src="images/logo.png"  height="65" width="65" class="logo" alt=""></a>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#products">products</a>
        <a href="#featured">featured</a>
        <a href="#blog">Blog</a>
        <a href="#review">Review</a>
    </nav>

    <div class="icons">
        <a href="#" class="fa fa-heart"></a>
        <a href="add_to_cart1.php" class="fas fa-shopping-cart"></a>
        <a href="account.php" class="fas fa-user"></a>
    </div>
    <div class="sign">
        <a href="login.html">SIGN IN</a>
    </div>

</header>


<section class="home" id="home">

    <div class="slide-container active">
        <div class="slide">
            <div class="content">
                <span>nike red shoes</span>
                <h3>nike metcon shoes</h3>
                <p>mostly prefered by customers. can be used for trekking and hiking and for daily basis. *top-notch quality* </p>
                
            </div>
            <div class="image">
                <img src="images/home-shoe-1.png" class="shoe" alt="">
                <img src="images/home-text-1.png" class="text" alt="">
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="content">
                <span>nike blue shoes</span>
                <h3>nike metcon shoes</h3>
                <p>mostly prefered by customers. can be used for trekking and hiking and for daily basis. *top-notch quality* </p>
                
            </div>
            <div class="image">
                <img src="images/home-shoe-2.png" class="shoe" alt="">
                <img src="images/home-text-2.png" class="text" alt="">
            </div>
        </div>
    </div>

    <div class="slide-container">
        <div class="slide">
            <div class="content">
                <span>nike yellow shoes</span>
                <h3>nike metcon shoes</h3>
                <p>mostly prefered by customers. can be used for trekking and hiking and for daily basis. *top-notch quality* </p>
            
            </div>
            <div class="image">
                <img src="images/home-shoe-3.png" class="shoe" alt="">
                <img src="images/home-text-3.png" class="text" alt="">
            </div>
        </div>
    </div>

    <div id="prev" class="fas fa-chevron-left" onclick="prev()"></div>
    <div id="next" class="fas fa-chevron-right" onclick="next()"></div>

</section>


<section class="service">

    <div class="box-container">

        <div class="box">
            <i class="fas fa-shipping-fast"></i>
            <h3>Fast Delivery</h3>
            <p>Fast and Safe Delivery available all over Nepal</p>
        </div>

        <div class="box">
            <i class="fas fa-undo"></i>
            <h3>7 days replacements</h3>
            <p>If any issues with the product, it can be replaced or refund within interval of 7 Days.</p>
        </div>

        <div class="box">
            <i class="fas fa-headset"></i>
            <h3>24 x 7 support</h3>
            <p>Any Queries?... Don't worry! We are there for you anytime needed.</p>
        </div>

    </div>

</section>


<section class="products" id="products">

    <h1 class="heading"> latest <span>products</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-share"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <img src="images/product-1.png" alt="Nike Shoes">
            <div class="content">
                <h3>nike shoes-1</h3>
                <div class="price">Rs.5799 <span>Rs.7999</span></div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                 Form to send product data 
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_name" value="nike shoes-1">
                    <input type="hidden" name="product_price" value="5799">
                    <input type="hidden" name="product_image" value="images/product-1.png">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
        </div>
        
        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-share"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <img src="images/product-2.png" alt="">
            <div class="content">
                <h3>nike shoes-2</h3>
                <div class="price">Rs.6799 <span>Rs.9799</span></div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_name" value="nike shoes-2">
                    <input type="hidden" name="product_price" value="6799">
                    <input type="hidden" name="product_image" value="images/product-2.png">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
        </div>

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-share"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <img src="images/product-3.png" alt="">
            <div class="content">
                <h3>nike shoes-3</h3>
                <div class="price">Rs.3999 <span>Rs.5999</span></div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_name" value="nike shoes-3">
                    <input type="hidden" name="product_price" value="3999">
                    <input type="hidden" name="product_image" value="images/product-3.png">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
        </div>

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-share"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <img src="images/product-4.png" alt="">
            <div class="content">
                <h3>nike shoes-4</h3>
                <div class="price">Rs.6999 <span>Rs.9999</span></div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_name" value="nike shoes-4">
                    <input type="hidden" name="product_price" value="6999">
                    <input type="hidden" name="product_image" value="images/product-4.png">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
        </div>

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-share"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <img src="images/product-5.png" alt="">
            <div class="content">
                <h3>nike shoes-5</h3>
                <div class="price">Rs.8999 <span>Rs.11999</span></div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_name" value="nike shoes-5">
                    <input type="hidden" name="product_price" value="8999">
                    <input type="hidden" name="product_image" value="images/product-5.png">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
        </div>

        <div class="box">
            <div class="icons">
                <a href="#" class="fas fa-heart"></a>
                <a href="#" class="fas fa-share"></a>
                <a href="#" class="fas fa-eye"></a>
            </div>
            <img src="images/product-6.png" alt="">
            <div class="content">
                <h3>nike shoes-6</h3>
                <div class="price">Rs.7999 <span>Rs.10799</span></div>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_name" value="nike shoes-6">
                    <input type="hidden" name="product_price" value="7999">
                    <input type="hidden" name="product_image" value="images/product-6.png">
                    <button type="submit" class="btn">Add to Cart</button>
                </form>
            </div>
        </div>

    </div>

</section>


<section class="featured" id="featured">

    <h1 class="heading"> <span>featured</span> products </h1>

    <div class="row">
        <div class="image-container">
            <div class="small-image">
                <img src="images/f-img-1.1.png" class="featured-image-1" alt="">
                <img src="images/f-img-1.2.png" class="featured-image-1" alt="">
                <img src="images/f-img-1.3.png" class="featured-image-1" alt="">
                <img src="images/f-img-1.4.png" class="featured-image-1" alt="">
            </div>
            <div class="big-image">
                <img src="images/f-img-1.1.png" class="big-image-1" alt="">
            </div>
        </div>
        <div class="content">
            <h3>new nike airmax shoes-1</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="far fa-star"></i>
            </div>
            <p>very comfortable and easy to wear. specialized for even old people to wear.</p>
            <div class="price">Rs.4999 <span>Rs.7999</span></div>
            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="product_name" value="new nike airmax shoes-1">
                <input type="hidden" name="product_price" value="4999">
                <input type="hidden" name="product_image" value="images/f-img-1.2.png">
                <button type="submit" class="btn">Add to Cart</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="image-container">
            <div class="small-image">
                <img src="images/f-img-2.1.png" class="featured-image-2" alt="">
                <img src="images/f-img-2.2.png" class="featured-image-2" alt="">
                <img src="images/f-img-2.3.png" class="featured-image-2" alt="">
                <img src="images/f-img-2.4.png" class="featured-image-2" alt="">
            </div>
            <div class="big-image">
                <img src="images/f-img-2.1.png" class="big-image-2" alt="">
            </div>
        </div>
        <div class="content">
            <h3>new nike airmax shoes-2</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <p>very comfortable and easy to wear. specialized for even old people to wear.</p>
            <div class="price">Rs.4999 <span>Rs.7999</span></div>
            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="product_name" value="new nike airmax shoes-2">
                <input type="hidden" name="product_price" value="4999">
                <input type="hidden" name="product_image" value="images/f-img-2.2.png" >
                <button type="submit" class="btn">Add to Cart</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="image-container">
            <div class="small-image">
                <img src="images/f-img-3.1.png" class="featured-image-3" alt="">
                <img src="images/f-img-3.2.png" class="featured-image-3" alt="">
                <img src="images/f-img-3.3.png" class="featured-image-3" alt="">
                <img src="images/f-img-3.4.png" class="featured-image-3" alt="">
            </div>
            <div class="big-image">
                <img src="images/f-img-3.1.png" class="big-image-3" alt="">
            </div>
        </div>
        <div class="content">
            <h3>new nike airmax shoes-3</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p>very comfortable and easy to wear. specialized for even old people to wear.</p>
            <div class="price">Rs.5500 <span>Rs.8999</span></div>
            <form action="add_to_cart.php" method="POST">
                <input type="hidden" name="product_name" value="new nike airmax shoes-3">
                <input type="hidden" name="product_price" value="5500">
                <input type="hidden" name="product_image" value="images/f-img-3.2.png">
                <button type="submit" class="btn">Add to Cart</button>
            </form>
        </div>
    </div>

</section>

<section class="review" id="blog">

    <h1 class="heading"> about <span>us</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/gagan.jpg" alt="">
            <h3>Gagan Banepali</h3>
            <p>html css java handling</p>
           
        </div>

        <div class="box">
            <img src="images/john.jpg" alt="">
            <h3>John Prajapati</h3>
            <p> php database (my sql) handling</p>
           
        </div>

        <div class="box">
            <img src="images/nirajan.jpg" alt="">
            <h3>Nirajan Tamang</h3>
            <p>html css handling</p>
            
        </div>
        <div class="box">
            <img src="images/deelisha1.jpg" alt="">
            <h3>Dilisha Manandhar</h3>
            <p>html css java handling</p>
           
        </div>
    </div>

</section>

<section class="newsletter" id="review">

    <div class="content">
        <h1 class="heading"> customer <span> reviews</span> </h1>
        <p>If you want to give reviews about our products, please feel free.</p>
        <form action="rewiews.php">
            <input type="submit" value="review box" class="btn">
        </form>
    </div>

</section>


<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>outlets</h3>
            <a  href="https://www.google.com/maps/place/Kumaripati,+Lalitpur/@27.6701831,85.3193548,17.5z/data=!4m6!3m5!1s0x39eb19ce1dace9ed:0xfb9c8b305818fb7d!8m2!3d27.6699427!4d85.3204068!16s%2Fg%2F1tdvb_9j?entry=ttu&g_ep=EgoyMDI0MTAyMy4wIKXMDSoASAFQAw%3D%3D"class="fa fa-map-marker"> kumaripati, Lalitpur</a>
            <a href="https://www.google.com/maps/place/NEW+ROAD+MALL/@27.703737,85.3044752,17z/data=!3m1!4b1!4m6!3m5!1s0x39eb19bd46eeee95:0xa1582055cd79191b!8m2!3d27.7037323!4d85.3090886!16s%2Fg%2F11f62fz_nk?entry=ttu&g_ep=EgoyMDI0MTAyMy4wIKXMDSoASAFQAw%3D%3D" class="fa fa-map-marker"> New road, kathmandu</a>
            

            <h3> contact us</h3>
            <a href="https://mail.google.com/mail/u/0/#inbox?compose=SxfkdpNgllBhspbMHLSNxjZNQDtRzmTdQmxMSXPlpgfnXtJGpvwXVPnpLBgDjBVrWkVCWwpSpKqVHMJHMLBGDtRHXMwQzvqBJTgFxWZMhgszXMlJzcg" class="far fa-envelope">footwearnepal2024gmail.com</a>
            <a href="#" class="fas fa-phone"> +977 9849689455, 9865544480</a>
        </div>
S
        <div class="box">
            <h3>links</h3>
            <a href="#home">home</a>
            <a href="#products">products</a>
            <a href="#featured">featured</a>
            <a href="#blog">About Us</a>
        </div>

        <div class="box">
            <h3>More</h3>
            <a href="login.html">Account</a>
            <a href="#">Favourites</a>
            <a href="add_to_cart1.php">cart</a>
            <a href="rewiews.php">Reviews</a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="https://www.facebook.com/profile.php?id=61568682245968&mibextid=ZbWKwL"class="fab fa-facebook-square">  facebook</a>
            <a href="https://x.com/Footwear_Nepal?t=l4TJckjzUz3wqBpfKBqo9A&s=09" class="fab fa-twitter">  twitter</a>
            <a href="https://www.instagram.com/footwearnepal2024/profilecard/?igsh=ZHB3OXRia2Zsbmd6"  class="fab fa-instagram">  instagram</a>
            <a href="https://www.linkedin.com/in/footwear-nepal-196480339/?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="fab fa-linkedin">  linkedin</a>
        </div>

        <div class="credit">created by <span> FootWear Nepal </span> | all rights reserved</div>

    </div>

</section>


<script src="script.js"></script>
    
</body>
</html>