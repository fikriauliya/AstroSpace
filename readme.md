## AstroSpace

SHA1 of AstroSpaces_A1_18: 89721487d5486f469e7d1a769d0b382c295558eb

The apps will have 8 normal user with username: userX where X is in range [0, 7].
The email address and password for each user would be: userX@email.com/passw0rd

Notes on the feature implemented:

###Advertisement
Currently we allow ads from http and https connection (even though the web application is all on https).
Hence, for the newer browser, the ads using http will be blocked because of mixed active content. 
You see the ads using http by allowing the mixed active content.
    
###Social Netwoking and Collaboration
Since our application is Blogging Application, we implement the tagging & access control in blog post (verified with TA in IVLE forum).

- Create a new blog post from "Home" menu bar
- Set the privacy to "Private"
- Tag some of your friends
- Those friends will get notification in "Notification" menu bar
- Only those friends can see the blog post & leave comment

###Personal Theme
- Theme can be changed from "Settings" menu bar
- When the theme drop down list is changed, the preview is instantenously displayed.
- To save the selected theme, click "Update"
- Once updated, the user will see that themes applied in all pages he visit.
- Note that, the user must log in. Otherwise, the default theme is applied.

###Email Authentication
- Upon registration, email verification is sent to user email.
The email Server is from Gmail, make sure that user's email server doesn't automatically mark our Emails as spam.
If you can't receive the email, you may check Spam folder.
- When the user change password, email notification is sent
- When the user forget the password, the reset link can be sent user's email. 

