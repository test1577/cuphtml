

  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
//    console.log('statusChangeCallback');
    if ( response.authResponse ) {
      service.object.accessToken = response.authResponse.accessToken; 
    }
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
    console.log('connected');
      // Logged into your app and Facebook.
      connectFacebookAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
//      document.getElementById('status').innerHTML = 'Please log ' +
//        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
//      document.getElementById('status').innerHTML = 'Please log ' +
//        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function (response) {
      statusChangeCallback(response);
    });
  }
  function facebookLogin() {
    window.fbAsyncInit();
    FB.login(function(response) {
      // user is now logged out
      statusChangeCallback(response);
      console.log(response);
    });
  }
  function facebookLogout() {
    FB.logout(function(response) {
      // user is now logged out
//      console.log(response);
    });
  }

  window.fbAsyncInit = function () {
    FB.init({
      appId: '1735762206651614',
      xfbml: true,
      version: 'v2.4'
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function (response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
      return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function connectFacebookAPI() {
//    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function (response) {
      response.access_token = service.object.accessToken;
      response.social = 'facebook';
      response.email = response.id;
      response.fullname = response.name;
//      console.log(response);

      service.register(response);
//      facebookLogout();
//      document.getElementById('status').innerHTML = 'Thanks for logging in, ' + response.name + '!';
    });
  }