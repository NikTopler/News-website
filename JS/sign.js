// /** Google */
//     function onSignIn(googleUser) {
//         console.log('Logged in as: ' + JSON.stringify(googleUser.getBasicProfile()))

//         let profile = googleUser.getBasicProfile()
//         // console.log('ID: ' + profile.getId()) // Do not send to your backend! Use an ID token instead.
//         // console.log('Name: ' + profile.getName())
//         // console.log('Image URL: ' + profile.getImageUrl())
//         // console.log('Email: ' + profile.getEmail())
//     }

//     function onFailure(error) {
//         console.log(error)
//     }
//     var googleUser = {};
//     var startApp = function() {
//         gapi.load('auth2', function(){
//         auth2 = gapi.auth2.init({
//             client_id: '571327981909-r5sunoo4l6uqducmqm7vjon1af0tmso1.apps.googleusercontent.com',
//             cookiepolicy: 'single_host_origin',
//         });
//         attachSignin(document.getElementById('googleBtn'));
//         });
//     };
//     function attachSignin(element) {
//         auth2.attachClickHandler(element, {},
//             (googleUser) =>{
//               console.log(googleUser.getBasicProfile())}, 
//               (error) => {
//               // alert(JSON.stringify(error, undefined, 2));
//             });
//       }
//     startApp()
//     function signOut() {
//         var auth2 = gapi.auth2.getAuthInstance()
//         auth2.signOut().then(function () {
//         console.log('User signed out.')
//         })
//     }



// /** GitHub */

//       document.getElementById('github-button').addEventListener('click', () => {     
//         // Initialize with your OAuth.io app public key
//         OAuth.initialize('_nPRfzTNGplyDCW0vD9dmek5QAg');
//         // Use popup for oauth
//         // Alternative is redirect
//         OAuth.popup('github').then(github => {
//           console.log('github:', github);
//           // Retrieves user data from oauth provider
//           // Prompts 'welcome' message with User's email on successful login
//           // #me() is a convenient method to retrieve user data without requiring you
//           // to know which OAuth provider url to call
//           github.me().then(data => {
//             console.log('me data:', data);
//             // alert('GitHub says your email is:' + data.email + ".\nView browser 'Console Log' for more details");
//           });
//           // Retrieves user data from OAuth provider by using #get() and
//           // OAuth provider url
//           github.get('/user').then(data => {
//             console.log('self data:', data);
//           })
//         });
//       })


// /** FaceBook */

//     // function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
//     //     console.log('statusChangeCallback');
//     //     console.log(response);                   // The current login status of the person.
//     //     if (response.status === 'connected') {   // Logged into your webpage and Facebook.
//     //     testAPI();  
//     //     } else {                                 // Not logged into your webpage or we are unable to tell.
//     //     document.getElementById('status').innerHTML = 'Please log ' +
//     //         'into this webpage.';
//     //     }
//     // }


//     // function checkLoginState() {               // Called when a person is finished with the Login Button.
//     //     FB.getLoginStatus(function(response) {   // See the onlogin handler
//     //     statusChangeCallback(response);
//     //     });
//     // }


//     // window.fbAsyncInit = function() {
//     //     FB.init({
//     //     appId      : '1318555625202480',
//     //     cookie     : true,                     // Enable cookies to allow the server to access the session.
//     //     xfbml      : true,                     // Parse social plugins on this webpage.
//     //     version    : ''           // Use this Graph API version for this call.
//     //     });


//     //     FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
//     //     statusChangeCallback(response);        // Returns the login status.
//     //     });
//     // };
    
//     // function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
//     //     console.log('Welcome!  Fetching your information.... ');
//     //     FB.api('/me', function(response) {
//     //     console.log('Successful login for: ' + response.name);
//     //     document.getElementById('status').innerHTML =
//     //         'Thanks for logging in, ' + response.name + '!';
//     //     });
//     // }

  