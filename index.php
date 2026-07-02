<!DOCTYPE html>
<?php
include 'config/db.php';
?>
<html lang="en">
<head>
    <link rel="stylesheet"
href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="hero.css">
<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Document</title>
</head>
<body>






    <div class="tagline">
        <a href="">Maa Ke Haath - Meet the mothers behind your pickle.</a>

    </div>


   <!------------------- //navbar--------------------- -->
    
<?php
session_start();
?>


<div class="nav">

    <!-- Logo -->
    <div class="logo">
        <a href="index.php">
            <img src="assets/img/logo.png" alt="logo">
        </a>
    </div>

    <!-- Menu -->
    <div class="offer">
        <a href="#home">Home</a>
        <a href="#card">Shop</a>
        <a href="#process">Our Process</a>
    </div>

    <!-- Right Side -->
    <div class="shop">

        <!-- Cart -->
        <a href="cart/cart.php">
            <img src="assets/img/shop.svg" alt="cart">
        </a>

        <?php if(isset($_SESSION['user_id'])){ ?>

            <!-- Profile -->
            <a href="profile.php" class="profile-link">
                <img src="assets/img/men.svg" alt="profile">
            </a>

            <!-- Username -->
            <span class="user-name">
                <?php echo $_SESSION['user_name']; ?>
            </span>

            <!-- Logout -->
            <a href="auth/logout.php" class="register-btn">
                Logout
            </a>

        <?php } else { ?>

            <!-- User Icon -->
            <a href="auth/login.php">
                <img src="assets/img/men.svg" alt="user">
            </a>

            <!-- Login -->
            <a href="auth/login.php" class="login-btn">
                Login
            </a>

            <!-- Register -->
            <a href="auth/register.php" class="register-btn">
                Register
            </a>

<!-- <a href="#" onclick="confirmLogout(event)">Logout</a> -->
         

        <?php } ?>

        <!-- Mobile Menu -->
        <div class="bar">
            <img id="menuBtn" src="assets/img/bar.svg" alt="menu">
        </div>

    </div>

</div>


  <!---------------------- //banner ------------------------------------>

<section class="hero">

    <!-- Background Decorations -->

    <div class="bg-gradient"></div>

    <!-- Floating Assets -->

    <img src="assets/img/leaf1.png" class="leaf leaf1" alt="">
    <img src="assets/img/leaf2.png" class="leaf leaf2" alt="">

    <img src="assets/img/garlic1.png" class="garlic" alt="">
    <img src="assets/img/chilli.png" class="chilli" alt="">

    <img src="assets/img/mustard.png" class="mustard mustard1" alt="">
    <img src="assets/img/mustard.png" class="mustard mustard2" alt="">
    <img src="assets/img/mustard.png" class="mustard mustard3" alt="">

    <img src="assets/img/sparkle.png" class="spark sparkle1" alt="">
    <img src="assets/img/sparkle.png" class="spark sparkle2" alt="">
    <img src="assets/img/sparkle.png" class="spark sparkle3" alt="">

    <div class="hero-container">

        <!-- LEFT -->

        <div class="hero-content">

            <span class="badge">
                🌿 100% Homemade • Traditional Recipe
            </span>

            <h4>
                Authentic Homemade
            </h4>

            <h1>
                PICKLES
            </h1>

            <p>
                Traditional Taste, Made with Love.<br>
                Fresh ingredients, Grandma's recipes & handcrafted perfection.
            </p>

            <div class="hero-buttons">

                <a href="shop.php" class="btn-primary">
                    Shop Now →
                </a>

                <a href="#process" class="btn-secondary">
                    Our Process
                </a>

            </div>

            <div class="hero-features">

                <div class="feature">
                    🌿
                    <span>100% Natural</span>
                </div>

                <div class="feature">
                    🧄
                    <span>No Preservatives</span>
                </div>

                <div class="feature">
                    ❤️
                    <span>Made With Love</span>
                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="hero-image">

            <div class="circle-bg"></div>

            <img src="assets/img/hero-jar.png"
                 class="jar"
                 alt="Pickle Jar">

        </div>

    </div>

    <!-- Scroll -->

    <!-- <div class="scroll-down">

        <span></span>

    </div> -->

</section>


<!-- GSAP -->

<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>

<script src="hero.js"></script>





<!-------------------- popular pickle ---------------->


<div class="popular">
    <p> OUR POPULAR PICKLES</p>
</div>

<!---------------------- card ------------------------------------------>

<div id="card" class="main">

<?php

$result = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");

while($row = mysqli_fetch_assoc($result))
{
?>

<form action="cart/add-cart.php" method="POST" class="card">

    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
    <input type="hidden" name="image" value="<?php echo $row['image']; ?>">

    <img src="assets/img/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>">

    

    <div class="gram">

        <p><?php echo $row['product_name']; ?></p>

        <p>₹<?php echo $row['price']; ?></p>

        <p>⭐⭐⭐⭐⭐</p>

        <label >Grams:</label>

       <select name="grams" required>
    <option value="100">100g</option>
    <option value="200">200g</option>
    <option value="300">300g</option>
    <option value="500">500g</option>
</select>

        <button type="submit" name="add_cart">
            ADD TO CART
        </button>

    </div>

</form>

<?php } ?>

</div>









<!-- -------------------main section -------------------------------------->


<section class="process-section" id="process">

    <div class="process-heading">
        <span>🌿 OUR TRADITION, YOUR TASTE 🌿</span>
        <h2>THE PICKLE MAKING PROCESS</h2>
    </div>

    <div class="process-container">

        <div class="process-card">

            <span class="step-number">01</span>

            <div class="process-image">
                <img src="assets/img/fresh.png" alt="">
            </div>

            <div class="process-icon">🥗</div>

            <h3>Fresh Ingredients</h3>

            <p>
                We carefully select the freshest fruits &
                spices to ensure the best quality in every bite.
            </p>

        </div>

        <div class="process-card">

            <span class="step-number">02</span>

            <div class="process-image">
                <img src="assets/img/preparation.png" alt="">
            </div>

            <div class="process-icon">🥣</div>

            <h3>Traditional Preparation</h3>

            <p>
                Prepared using age-old recipes and
                traditional methods passed through generations.
            </p>

        </div>

        <div class="process-card">

            <span class="step-number">03</span>

            <div class="process-image">
                <img src="assets/img/jar.png" alt="">
            </div>

            <div class="process-icon">🫙</div>

            <h3>Natural Preservation</h3>

            <p>
                No chemicals. No shortcuts.
                Only natural ingredients and sun-kissed goodness.
            </p>

        </div>

        <div class="process-card">

            <span class="step-number">04</span>

            <div class="process-image">
                <img src="assets/img/delivery.png" alt="">
            </div>

            <div class="process-icon">🚚</div>

            <h3>Delivered Fresh</h3>

            <p>
                Packed with care and delivered fresh
                to your doorstep with love.
            </p>

        </div>

    </div>

</section>


<!------------------------ our story --------------------------------------->


<section  id= "ourstory"   class="story-section">

    <div class="story-content">

        <div class="story-text">
            <span class="tag">OUR STORY</span>

            <h2>How It All Started</h2>

            <p>
                In 2020, our journey began in a small home kitchen with a simple goal —
                to bring the authentic taste of homemade pickles to every family.
            </p>

            <p>
                Using traditional recipes passed down through generations, we started
                preparing pickles with fresh ingredients, natural spices, and lots of care.
            </p>

            <p>
                What began as a family passion soon grew into a trusted brand loved by
                customers across India. Every jar reflects our commitment to quality,
                purity, and the warmth of homemade food.
            </p>

            <p>
                Today, we continue to preserve traditional flavors while supporting local
                farmers and empowering women through employment opportunities.
            </p>

            <h4>❤️ From Our Kitchen to Your Table</h4>
        </div>

        <div class="story-image">
            <img src="assets/img/founder.png" alt="Founder Story">
        </div>

    </div>

</section>


<!-----------------------------review section ------------------------------->



<section class="testimonial">

    <h2>Client <span>Testimonials</span></h2>
    <p class="sub-title">
        What our customers say about our homemade pickles
    </p>

    <div class="slider-wrapper">

        <!-- <button id="prevBtn" class="arrow">&#10094;</button> -->

        <div class="review-container">

            <div class="cardi">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p>Jhaji Mango Pickle ka taste bilkul ghar jaisa hai.</p>
                <div class="user">
                    <img src="https://i.pravatar.cc/60?img=1">
                    <div>
                        <h4>Ravi Kumar</h4>
                        <span>Patna, Bihar</span>
                    </div>
                </div>
            </div>

            <div class="cardi">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p>Lemon Pickle fresh aur delicious tha.</p>
                <div class="user">
                    <img src="https://i.pravatar.cc/60?img=2">
                    <div>
                        <h4>Neha Singh</h4>
                        <span>Lucknow, UP</span>
                    </div>
                </div>
            </div>

            <div class="cardi">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p>Mixed Pickle ka flavour outstanding hai.</p>
                <div class="user">
                    <img src="https://i.pravatar.cc/60?img=3">
                    <div>
                        <h4>Amit Verma</h4>
                        <span>Delhi</span>
                    </div>
                </div>
            </div>

            <div class="cardi">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p>Garlic Pickle ka taste amazing tha. Pure homemade flavour.</p>
                <div class="user">
                    <img src="https://i.pravatar.cc/60?img=4">
                    <div>
                        <h4>Priya Sharma</h4>
                        <span>Jaipur</span>
                    </div>
                </div>
            </div>

            

        </div >
        <div  class="arrow-box">
              <button id="prevBtn" class="arrow">&#10094;</button>
        <button id="nextBtn" class="arrow">&#10095;</button>
        </div>
        

    </div>

</section>

    






<!--------------------------------- footer ------------------------------------>




        <footer class="footer">

    <div class="footer-container">

        <!-- Logo & About -->
        <div class="footer-col">
           <div class="footer-logo">
    <a href="index.php">
        <img src="assets/img/logo.png" alt="Pickle Delights Logo">
    </a>
</div>
            <p>
                Bringing you the most authentic homemade pickles
                with love and traditional Indian flavors.
            </p>

            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-pinterest-p"></i></a>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="footer-col">
            <h3>Quick Links</h3>

            <ul>
             

                <li><a href="#home"><i class="fa-solid fa-house"></i> Home</a></li>
<li><a href="#card"><i class="fa-solid fa-bag-shopping"></i> Shop</a></li>
<li><a href="#ourstory"><i class="fa-solid fa-circle-info"></i> About Us</a></li>
<li><a href="#process"><i class="fa-solid fa-gear"></i> Our Process</a></li>

            </ul>
        </div>

  

    <!-- Contact -->
<div class="footer-col">
    <h3>Contact Us</h3>

    <!-- Phone -->
    <a href="tel:+919876543210" class="contact-item">
        <i class="fa-solid fa-phone"></i>
        <span>+91 9876543210</span>
    </a>

    <!-- Location -->
    <a href="https://maps.google.com/?q=Ghaziabad,Uttar+Pradesh"
       target="_blank"
       class="contact-item">
        <i class="fa-solid fa-location-dot"></i>
        <span>Ghaziabad, Uttar Pradesh</span>
    </a>

    <!-- Email -->
    <a href="mailto:support@pickledelights.com" class="contact-item">
        <i class="fa-solid fa-envelope"></i>
        <span>support@pickledelights.com</span>
    </a>

</div>
 </div>
    <!-- Bottom Bar -->
    <div class="footer-bottom">
        ❤ © 2025 Pickle Delights. All Rights Reserved.
    </div>

</footer>




































<!------------------------ java script ------------------------------------>


        <script>
             const menuBtn = document.getElementById("menuBtn");
            //  const closeBtn = document.getElementById("closeBtn");
             const menu = document.querySelector(".offer");

             menuBtn.addEventListener("click", () => {
             menu.classList.toggle("active");
             
              if(menu.classList.contains("active")){
              menuBtn.src = "assets/img/x.svg";
               }else{
                menuBtn.src = "assets/img/bar.svg";
            }
             });

             // Anchor click par menu close
              document.querySelectorAll(".offer a").forEach(link => {
              link.addEventListener("click", () => {
              menu.classList.remove("active");
              menuBtn.src = "assets/img/bar.svg";
                });
            });
            
                                   //     client testimonials       

            const container = document.querySelector(".review-container");
            const nextBtn = document.getElementById("nextBtn");
            const prevBtn = document.getElementById("prevBtn");
            container.scrollLeft = 0;
            let scrollAmount = 0;
            
            const cardWidth = document.querySelector(".cardi").offsetWidth + 20;
            
            prevBtn.style.display = "none"; // start me left hide
            
            nextBtn.addEventListener("click", () => {
                scrollAmount += cardWidth;

                container.scrollTo({
                    left: scrollAmount,
                    behavior: "smooth"
                });
            
                updateArrows();
            });
            
            prevBtn.addEventListener("click", () => {
                scrollAmount -= cardWidth;
            
                if(scrollAmount < 0){
                    scrollAmount = 0;
                }
            
                           container.scrollTo({
                    left: scrollAmount,
                    behavior: "smooth"
                });
            
                updateArrows();
            });
            
            function updateArrows(){

                // Left Arrow
                if(scrollAmount <= 0){
                    prevBtn.style.display = "none";
                }else{
                    prevBtn.style.display = "block";
                }
            
                // Right Arrow
                           const maxScroll =
                    container.scrollWidth - container.clientWidth;
            
                if(scrollAmount >= maxScroll){
                    nextBtn.style.display = "none";
                           }else{
                    nextBtn.style.display = "block";
                }
            }






// for dropdown





                
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if(isset($_GET['logout']) && $_GET['logout']=="success"){ ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Logged Out!',
    text: 'You have been logged out successfully.',
    timer: 1800,
    showConfirmButton: false
});
</script>
<?php } ?>
     
        
    
        


 
</body>


</html>