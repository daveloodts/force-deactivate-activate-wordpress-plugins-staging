# force-deactivate-activate-wordpress-plugins-staging
Force deactivate and activate WordPress plugins on staging

Deactivated:
Jetpack.php
Redis-cache
wp-redis
wp-mail-smtp
facebook-for-woocommerce
mailchimp-for-woocommerce
klaviyo
official-facebook-pixel
google-site-kit

Activated
https://wordpress.org/plugins/disable-emails
https://wordpress.org/plugins/password-protected


Step 1 : How to Add Required plugin in our plugin file ?

Answer :

1. First, Navigate to the required-plugins.php file located at plugin > woofers-developement-env > includes > admin > required-plugins.php

2. Copy the array we have already added. First, add the plugin slug, then the file path of the plugin you want to require. After the plugin name, add the slug parameter. Finally, include the plugin URL. This will display the plugin name with a clickable URL. you can see this screenshot, https://prnt.sc/guPTm29TKPcY

3. This screenshot will more help to you, https://prnt.sc/c1WSgxWzJSXK

Step 2 : How to Add Deactivate plugin in our plugin file ?

Answer :

1. First, Navigate to the required-plugins.php file located at plugin > woofers-developement-env > includes > admin > deactivate-plugins.php

2. You just Simply include the file path of the desired plugin in the array. So currently i have added some free plugin file path so check this screenshot URL, https://prnt.sc/pmpz9TYzd1ni

Currently i have no filepath for some Premium plugins so if you have, you can easily add it to the array in the same format as the free plugins. Follow the example structure in the screenshot provided, and insert the file path for the premium plugins.

Note : In the future, if you don't have a .dev site, you just need to add your domain name extension in the woofers-developement-env.php file. You can find this file at plugin > woofers-developement-env.php. Simply add your new domain name extension to the array. You can refer to this screenshot for assistance, https://prnt.sc/aYViqUWtV5p0
