# wp-block-plugins-on-pages
## WordPress mu-plugin to block plugins from loading on specific pages

Background: I was working on a site that was using an overlay plugin to display a message about COVID-19-related updates. The plugin had options to load on every page, or to load only on specific pages, but no option to *not* load on specific pages. 

Additionally, some of the site's custom post types were not picked up by the plugin as options, and there was no option to automatically show the overlay on new posts/pages/etc.

To solve this, I set the plugin to display on every page, then used this plugin to prevent it from loading on specific pages where the message would be redundant (i.e. the COVID-19 update page that the overlay was linking to).


This is a modified version of [this StackOverflow answer](https://stackoverflow.com/questions/36050259/disable-specific-plugin-on-wordpress-frontpage-homepage-only/51506617#51506617). I'm sure there are better ways to do this, but this worked for me and is simple.

## How to Use

1. Gather the URL slugs of the pages where you don't want the plugin to load. You need everything after the home URL; i.e. everything after `https://your-site-here-.com/`.
For example, if you don't want the plugin to load on your contact page, located at `https://your-site-here-.com/contact-us/`, your URL slug would be `contact-us`.

2. Gather the names of the plugin folders and filenames that you don't want to load. Go to your WordPress folder, look in `/wp-content/plugins/` and find the plugin folder there. Inside it will be the plugin file; it's name will likely be the name of the plugin and the same/similar to the folder name. (Some plugins are a single file with no folder; in that case you just need the file name.)

3. Edit `wp-block-plugins-on-pages.php`:
    - Line 6: Leave this line intact if you want to blog the plugins from loading on your homepage.
    - Line 7: Replace `your-slug-here` with one of the URL slugs from Step 1.
    - Line 8: Do the same as above. Copy/paste this line as many times as is necessary so you can use it with the rest of the URL slugs from Step 1.
  
4. Continue editing `wp-block-plugins-on-pages.php`:
    - Line 12: Replace `your-plugin-folder-here/your-plugin-file-here.php` with the plugin folders and file names from Step 2.
    - Line 13: Continue replacing `your-second-plugin-folder-here/your-second-plugin-file-here.php` with your plugin folders/file names, copying/pasting the line as needed.

5. Put `wp-block-plugins-on-pages.php` in your `/wp-content/mu-plugins/` folder. (If you don't have a `mu-plugins` folder, you can just create it in the `wp-content` folder.

That's it!

## How it Works

The plugin grabs the URL of the current page and strips out the `http(s)://` portion, then compares it to a list of predetermined URLs (which also have had the `http(s)://` portion stripped out). It also contains a list of predetermined plugins.

If the current URL matches any of the predetermined URLs, it stops the listed plugins from loading.
