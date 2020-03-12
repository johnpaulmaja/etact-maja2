<?php

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="css/styleAdmin.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="google-signin-client_id" content="539246690236-tvoad6op2k24t4010o2re4nd9v2kjq1n.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
</head>

<body>
<form class="modal-content animate" method="POST" action="" name="login">
<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
<button onclick="signOut()">Sign out</button>
    <script>
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
      }

	  function signOut() {
  		gapi.auth2.getAuthInstance().signOut().then(function() {
    	console.log('user signed out')
  })
}
	</script>
</form>

</body>
</html>
