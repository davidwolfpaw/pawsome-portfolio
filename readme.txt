=== Pawsome Portfolio ===
Contributors:      wolfpaw
Tags:              block, portfolio, tags, filter
Tested up to:      6.5.2
Stable tag:        1.0.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

A Portfolio Block with a custom Portfolio Item post type that can then be tagged, and filtered by tag

== Description ==

Do you have a portfolio of projects that you want to share? Perhaps a gallery of your artwork, or a selection of your web design clients?

Pawsome Portfolio allows you to create individual pages for portfolio items of any type, using all of the WordPress block editor features that a normal page or post has. Then you can tag items if you want, allowing you to display a portfolio that visitors can filter.

For instance: let's say you're a mixed media artist. You may want to display all of your art at once, but also allow viewers to see just digital art, or just paintings, or just sketches. Maybe as a designer you want to display logos, branding, mockups, wireframes, etc as different tags.

This plugin is a work in progress, with a goal of being flexible for any WordPress website, while a bit opinionated on layout and design.

== Installation ==

After you have installed and activated the plugin via the Add New Plugin, here are the steps to create your first portfolio:

1. Go to the Pawsome page in your WordPress Dashboard
2. Start adding portfolio items, like you would add a post or a page. The title, featured image, and excerpt can be used as part of displaying the portfolio, so remember to add those!
3. Portfolio Categories are how you organize portfolio items to be able to display multiple portfolios in different places. You can apply multiple categories to a portfolio item, but a displayed portfolio only covers one category.
4. Portfolio Tags are how you organize portfolio items to make them filterable. Apply as many tags as you want to be able to filter projects by. If you activate the tag filter in a portfolio, visitors will be able to select tags to view only portfolio items that fit those tags.
5. Now that you have portfolio items tagged and categorized, time to insert a portfolio onto a page! Edit a page with the block editor, and add the Pawsome Portfolio block via one of the block insertion tools.
   1. You have to select a portfolio category to get items to display. After that, all of the other options are... well, optional!
   2. Choose if you want to use a Card or List style to display portfolio items, or style your own
   3. Choose the link behavior that you want:
      1. Link to Page: Clicking an item takes you to the portfolio page of that item
      2. Open as Modal: Clicking an item opens the contents of the page as a lightbox modal on the same page
      3. None: don't link to the portfolio pages
   4. Toggle which data related to a portfolio item you want to display
6. That's it! Let your visitors peruse your portfolio!


== Screenshots ==

TODO
1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).

== Changelog ==

= 1.0.1 =
* adds query string to URL for selected tags and loads them

= 1.0.0 =
* Initial Release
