<div id="modal_box" class="signup_box modalbox <?php if(get_field('signup_open')) echo 'auto-open'; ?>">

    <?php the_field('signup_introduction'); ?>

    <form id="register-form" class="register-form" method="POST" novalidate>

        <p class="error-message">Please ensure the highlighted fields are filled out correctly.</p>

        <div class="field50 required">
            <input id="first_name" name="first_name" required type="text" placeholder="First Name">
        </div>

        <div class="field50 required">
            <input id="last_name" name="last_name" required type="text" placeholder="Last Name">
        </div>

        <div class="field50">
            <input id="phone" name="phone" type="text" placeholder="Phone">
        </div>

        <div class="field50 required">
            <input id="email" name="email" required type="email" placeholder="Email Address">
        </div>
        <div class="field50">
            <?php get_template_part('partials/countries'); ?>
            <!-- <input id="country" name="country" required type="text" placeholder="Country" value="Australia"> -->
        </div>
        <div class="field50 required">
            <input id="postcode" name="postcode" required type="text" placeholder="Postcode">
        </div>
        <div class="clear_both"></div>

        <div class="field100 opt_in_field">
            <label for="opt_in"> By signing up to get the guide, you may receive communications about how you can help with our campaigns, on the understanding you agree to our <a href="http://www.greenpeace.org/australia/en/privacy-policy/?_ga=1.80231828.2032775040.1443430079" target="_blank">privacy policy.</a></label>
        </div>

        <?php //(isset($_GET['src'])) ? substr($_GET['src'], 0, 10) : 'UP'; ?>
        
        <input type="hidden" name="src" value="<?php echo (!empty($_SERVER['QUERY_STRING'])) ? filter_var($_SERVER['QUERY_STRING'], FILTER_SANITIZE_URL) : 'UP'; ?>" >
        <!--<input name="submit" type="submit" id="submit" class="submit" value="TAKE ME TO THE GUIDE">-->
        <!-- dummy submit btn for mockup -->
        <button type="submit"submit" class="submit" <a href="ab.com/c.html" onClick="ga('send', 'event', 'conversions', 'convert');">EMAIL ME THE GUIDE</button>

    </form>

    <p><a href="#" class="close-modalbox">I don't want a PDF - I'll view the guide online<i class="fa fa-chevron-right"></i></a></p>

</div>
