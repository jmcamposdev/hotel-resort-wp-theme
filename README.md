# Hotel Resort WordPress Theme

This repository contains a WordPress theme designed for hotels and resorts.

## Repository Structure

- **hotel-resort-theme**: Main folder containing all theme files.

  - **front-page.php**: Main page displaying Custom Post Type (CPT) 'rooms' and latest blog entries using `WP_Query`.

  - **blog.php**: Blog page featuring the first highlighted post and subsequent posts using `WP_Query`. Includes a sidebar with a search form and widgets for tag cloud and calendar.

  - **sidebar.php**: Contains the search form, widgets for tag cloud and calendar, a list of categories using `wp_list_categories`, latest 3 posts, a list of authors with `wp_list_authors`, and a list of site pages using `get_pages`.

  - **facilities.php**: "Facilities" page displaying the 'rooms' CPT list using Custom Fields and a sidebar.

  - **archives.php**: "Archives" page presenting a compilation of site data, including latest posts, latest 'rooms' CPT, tag list, category list, daily posts, monthly posts, and yearly posts. Also includes author lists, most visited posts, and posts with the most comments.

  - **contact.php**: "Contact" page with static content.

  - **login.php**: "Log In" page showing a login form if the user is not logged in, or buttons to access the admin area and log out if logged in.

- **plugins**: Folder containing custom plugins.

  - **mymessage**: Plugin displaying messages to different WordPress roles on the login page.

  - **rooms**: Plugin creating the 'rooms' CPT with categories, tags, and shortcodes for use.

## Installation

1. Clone this repository into the `wp-content/themes/` folder of your WordPress installation.

2. Activate the theme from the WordPress admin panel.

3. Install and activate the `mymessage` and `rooms` plugins from the WordPress admin panel.

4. Customize the theme settings as needed.

## Requirements

- WordPress 5.0 or higher.

## Contributions

Contributions are welcome! If you encounter any issues or have suggestions, please create an issue or a pull request.

## License

This theme is licensed under the [GNU General Public License v3.0](LICENSE).
