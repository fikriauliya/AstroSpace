<h3>Hi, {{ $username }}!</h3>
 
<p>We'd like to personally welcome you to the AstroSpace. Thank you for registering!</p>

<p>Please click the link below to active your account:</p>
{{ HTML::link($verification_url, $verification_url) }}