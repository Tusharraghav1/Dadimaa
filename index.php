<!DOCTYPE html>
<?php
include 'config/db.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Document</title>
</head>
<body>






    <div class="tagline">
        <a href="">Maa Ke Haath - Meet the mothers behind your pickle.</a>

    </div>


   <!-- //navbar -->
    
<?php
session_start();
?>

<!-- Navbar -->
<!-- Navbar -->
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


  <!-- //banner -->

<div  id="home"class="banner">
    
   
</div>

<div class="popular">
    <p> OUR POPULAR PICKLES</p>
</div>


<!-- card -->
<!-- Products Section -->
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




<!-- main section -->

<section class="process-section" id="process">

    <div class="process-heading">
        <span>🌿 OUR TRADITION, YOUR TASTE 🌿</span>
        <h2>THE PICKLE MAKING PROCESS</h2>
    </div>

    <div class="process-container">

        <!-- Step 1 -->
        <div class="process-card">
            <div class="step-number">01</div>

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

        <div class="arrow1">➜</div>

        <!-- Step 2 -->
        <div class="process-card">
            <div class="step-number">02</div>

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

        <div class="arrow1">➜</div>

        <!-- Step 3 -->
        <div class="process-card">
            <div class="step-number">03</div>

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

        <div class="arrow1">➜</div>

        <!-- Step 4 -->
        <div class="process-card">
            <div class="step-number">04</div>

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
<!-- our story -->


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


<!-- review section -->
<!-- <section class="testimonial">

    <h2>Client <span>Testimonials</span></h2>
    <p class="sub-title">
        What our customers say about our homemade pickles
    </p>

    <div class="review-container">

        <div class="cardi">
            <div class="stars">⭐⭐⭐⭐⭐</div>
            <p>
                Jhaji Mango Pickle ka taste bilkul ghar jaisa hai.
                Pure masale aur authentic flavour ne dil jeet liya.
            </p>

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
            <p>
                Lemon Pickle fresh aur delicious tha.
                Packaging bhi bahut acchi thi.
            </p>

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
            <p>
                Mixed Pickle ka flavour outstanding hai.
                Family ko bahut pasand aaya.
            </p>

            <div class="user">
                <img src="https://i.pravatar.cc/60?img=3">
                <div>
                    <h4>Amit Verma</h4>
                    <span>Delhi</span>
                </div>
            </div>
        </div> -->

            <!-- Arrow -->
    <!-- <button class="next-btn">❯</button> -->
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

    







<!-- 
        footer section -->

        <!-- <div class="footer" >
            <div class="fif">
              <img src="assets/img/logo.png">
                <P>Bringing you the most authentic homemade pickles with love and  traditional indian flavors.</P>
                <div class="a1">
                    <a href=""><img src="assets/img/facebook.png" alt="Facebook"></a>
                    <a href=""><img src="assets/img/twitter.png" alt="Twitter"></a>
                    <a href=""><img src="assets/img/insta.png" alt="Instagram"></a>
                    <a href=""><img src="assets/img/pintrest.png" alt="Pinterest"></a>
                </div>
            </div>
            <div class="quick">
                <p><SPAN>QUICK LINKS</SPAN></p>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Shop</a></li>
                    <li> <a href="">About Us</a></li>
                    <li> <a href="">Our process</a></li>
                    <li> <a href="">Contact</a></li>
                </ul>
                 -->
                 
                 
                  
                   
            <!-- </div>
            <div class="customer">
                <P><SPAN>CUSTOMER SERVICE</SPAN></P>
                <ul>
                    <li><a href="">Shipping Policy</a></li>
                     <li> <a href="">Return & Refund</a></li>
                      <li> <a href="">Term & Conditions</a></li>
                       <li><a href="">FAQs</a></li>
                        <li> <a href="">Privacy Policy</a></li>
                </ul>
                
               
               
                
               
            </div>
            <div class="contact">
                <P><SPAN>CONTACT US</SPAN></P>
                <P>Phone no:</P>
                <p>location:</p>
               <p>Email:</p>
            </div>
        </div> -->






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
// const cardWidth = 370; // card + gap
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