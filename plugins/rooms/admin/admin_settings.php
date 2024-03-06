
<h1>Projects Settings</h1>

<h2>How to use the shortcodes for displaying custom post fields</h2>
<h3>Copy this code in Custom Post Type template where do you want to display custom main fields</h3>
<blockquote>
  <pre>&lt;?php do_shortcode('[jmc_show_main_fields id="'.$post->ID.'"]')?&gt;</pre>
</blockquote>
<h3>Copy this code in Custom Post Type single-template where do you want to display all custom fields</h3>
<blockquote>
  <pre>&lt;?php do_shortcode('[jmc_show_all_fields id="'.$post->ID.'"]')?&gt;</pre>
</blockquote>

<h3>Copy this code in Custom Post Type to display the categories</h3>
<blockquote>
  <pre>&lt;?php do_shortcode('[jmc_show_categories]')?&gt;</pre>
</blockquote>

<h3>Copy this code in Custom Post Type to display the tags</h3>
<blockquote>
  <pre>&lt;?php do_shortcode('[jmc_show_tags]')?&gt;</pre>
</blockquote>

<h2>Settings List:</h2>
<form method="post" action="options.php">
    <?php
        settings_fields('jmc_rooms_settings');
        do_settings_sections('jmc_rooms_settings');
        
        // Grab the settings data
        $options = get_option('jmc_rooms_settings');
        $yes_checked = '';
        $no_checked = '';

        if ( $options['jmc_allow_rating'] == 'yes' ) {
            $yes_checked = 'checked';
        } else {
            $no_checked = 'checked';
        }

    ?>
    <label for="jmc_color">Color:</label>
    <input type="color" id="jmc_color" name="jmc_rooms_settings[jmc_color]" value="<?php echo $options['jmc_color'];?>">
    <p>
      <label for="jmc_allow_rating">Allow Rating:</label>
      <input type="radio" id="jmc_allow_rating" name="jmc_rooms_settings[jmc_allow_rating]" value="yes" <?php echo $yes_checked?>> Yes
      <input type="radio" id="jmc_allow_rating" name="jmc_rooms_settings[jmc_allow_rating]" value="no" <?php echo $no_checked?>> No
    </p>
    <p>
      <label for="jmc_rating_max">Max Rating:</label>
      <input type="number" size="2" id="jmc_rating_max" name="jmc_rooms_settings[jmc_rating_max]" value="<?php echo $options['jmc_rating_max'];?>">
    </p>
    <p>
      <input type="submit" class="button button-primary" value="Save Settings"> 
    </p>
    
    
</form>