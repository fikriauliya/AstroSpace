## AstroSpace

SHA1 of AstroSpaces_A1_18: 89721487d5486f469e7d1a769d0b382c295558eb

The apps will have 8 normal user with username: userX where X is in range [0, 8].
The email address and password for each user would be: userX@email.com/passw0rd

Notes on the feature implemented:

###Ads
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


