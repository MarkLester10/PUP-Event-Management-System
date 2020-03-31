<div class="main-footer" id="follow">
    <div class="footer-content">
        <div class="footer-section one">
            <h2>Quick Links</h2>
            <br>
            <ul>
                <a href="#">
                    <li>Gallery</li>
                </a>
                <a href="#">
                    <li>Events</li>
                </a>
                <a href="#">
                    <li>Previews Guests</li>
                </a>
                <a href="#">
                    <li>Performers</li>
                </a>
                <a href="#">
                    <li>Calendar of Activities</li>
                </a>
                <a href="#">
                    <li>Schedule your Events with Us</li>
                </a>
                <a href="#">
                    <li>Terms and Conditions</li>
                </a>
            </ul>

        </div>
        <div class="footer-section two">
            <h2>Our Company</h2>
            <br>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab similique quae cumque nam? Quisquam,
                eum
                numquam
                distinctio molestiae veritatis aliquam. </p>
            <div class="contact">
                <span><i class="fas fa-phone">&nbsp; 8700-1234-852</i></span>
                <span> <i class="fas fa-envelope">&nbsp; pupevents@gmail.com</i></span>
            </div>
            <div class="o-social">
                <a href="#"><i class="fab fa-facebook-f f"></i></a>
                <a href="#"><i class="fab fa-instagram i"></i></a>
                <a href="#"><i class="fab fa-twitter t"></i></a>
                <a href="#"><i class="fab fa-google-plus-g g"></i></a>
                <a href="#"><i class="fab fa-youtube y"></i></a>
            </div>
        </div>
        <div class="footer-section three">
            <h2>Share Your Thoughts</h2>
            <br>
            <form action="index.php" method="POST">
                <textarea rows="4" name="comment" class="text-input contact-input" placeholder="Message..."
                    required></textarea>
                <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">

                <?php if (isset($_SESSION['id'])): ?>
                <?php if ($sqlImg['status'] == 0): ?>
                <input type="hidden" name="image" value="<?php echo "profile" . $id . "." . $fileRealExt ?>">
                <?php else: ?>
                <input type="hidden" name="image" value="<?php echo "user.svg" ?>">
                <?php endif;?>
                <?php endif;?>
                <input type="hidden" name="status" value="0">
                <div class="role-btn">
                    <select name="role">
                        <option value="Anonymous"></option>
                        <option value="Student">Student</option>
                        <option value="Teacher">Teacher</option>
                    </select>
                    <button type="submit" class="btn" name="send">
                        <i class="fas fa-envelope"></i>
                        Send
                    </button>
                </div>

            </form>
        </div>
    </div>
    <div class="footer-bottom">&copy; PUPEvents.com 2020 | Designed by Petecus</div>
</div>