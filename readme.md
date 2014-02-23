## AstroSpace

MD5: ec904013024dac4f856f04fee149c73b astrospaces_a1_18_last.vdi

The apps will have 8 normal user with username: userX where X is in range [0, 8].
The email address and password for each user would be: userX@email.com/passw0rd

Notes on the feature implemented:

##SSL
All traffic to the web application will be converted from HTTPS regardless whether the user did or did not specify the HTTPS header in the browser.

###Web-Statistics
When the user opens up the page that shows statistics, it will show the the number of comments of each post and the number of incoming emails.


###Advertisement
Currently we allow ads from http and https connection (even though the web application is all on https).
Hence, for the newer browser, the ads using http will be blocked because of mixed active content. 
You see the ads using http by allowing the mixed active content.


###Virtual Assistant
A virtual assistant showing tutorial about video call (webRTC) is created. Moreover, there is various interactive explanation if the user hover their mouse to a feature.


###WebRTC
In current implementation every user can only have one active video call room. And if the user want to switch room (go to other friend video call room), he / she must exit from the current video call room first.

Another thing, for the video call, only one person can initiate the video call at one session (initiate by pushing the button "Start a new video call".
If you created a new room, you will be automatically initiate the video call (without even push any button).
If you approve other request for video call, the button will appear after 7.5 seconds.
If you have current active room and go to that room by clicking "Go to video chat room", then the button will appear after 3.5 seconds.

>>To create a new room, we use the following method:
Login -> click Home -> click Video Call Info  -> Create new room    

>>To go to current active video call room:
Login -> click Home -> click Video Call Info -> Go to video chat room

>>To invite friend to current video call room:
Go to current active video call room -> click invite (beside the friend name)

>>To exit current active video call room:
Go to current active video call room -> exit room

>>To approve your friend video call request
Login -> click Home -> click Video Call Info -> click approve button besides your friend name

    
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