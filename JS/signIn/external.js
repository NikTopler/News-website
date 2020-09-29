/** Google */
    let clientID = '571327981909-r5sunoo4l6uqducmqm7vjon1af0tmso1.apps.googleusercontent.com'
    let googleUser = {}
    function startApp() {
        gapi.load('auth2', function () {
            auth2 = gapi.auth2.init({
                client_id: clientID,
                cookiepolicy: 'single_host_origin',
            }) 
            attachSignin(document.getElementById('googleBtn'))
        })
    }
    function attachSignin(element) {
        auth2.attachClickHandler(element, {},
            function (googleUser) {
                let id_token = googleUser.getAuthResponse().id_token;
                php.userInsertInDB('google', googleUser.getBasicProfile(), id_token, clientID)}, 
                (error) => {
                alert(JSON.stringify(error, undefined, 2))
            }
        )
    }
    startApp()
    function signOut() {
        let auth2 = gapi.auth2.getAuthInstance()
        auth2.signOut().then(function () {
            console.log('User signed out.')
        })
    }

/** GitHub */
    // OAuth.initialize('qFa2sjgoyyIVRhaoOePG2ie1RqY') 
    //   document.getElementById('github-btn').onclick = () => {     
    //     // Initialize with your OAuth.io app public key
    //     OAuth.initialize('_nPRfzTNGplyDCW0vD9dmek5QAg')
    //     // Use popup for oauth
    //     // Alternative is redirect
    //     OAuth.popup('github').then(github => {
    //     //   console.log('github:', github)
    //       // Retrieves user data from oauth provider
    //       // Prompts 'welcome' message with User's email on successful login
    //       // #me() is a convenient method to retrieve user data without requiring you
    //       // to know which OAuth provider url to call
    //       github.me().then(data => {
    //         // console.log('me data:', data)
    //         // alert('GitHub says your email is:' + data.email + ".\nView browser 'Console Log' for more details")
    //       })
    //     })
    //   }


/** FaceBook */
// [0] = id
// [1] = id_token
// [2] = clientID
// [3] = name
// [4] = surname
// [5] = img
// [6] = email
    document.getElementById('facebook-btn').onclick = () => {
        FB.login(function (res) {
            if(res.status === 'connected') {
                let id = res.authResponse.userID
                let id_token = res.authResponse.accessToken

                FB.api('/me?fields=id,first_name,last_name,picture.type(large),email', function (userData) {
                    php.userInsertInDB('facebook', [id, id_token, '',userData.first_name, userData.last_name, userData.picture, userData.email], )
                })
                
            }
        }, { scope: 'public_profile, email'})
    }
    window.fbAsyncInit = function() {
        FB.init({
        appId            : '3448140125279175',
        autoLogAppEvents : true,
        cookie           : true,
        status           : true,
        xfbml            : true,
        version          : 'v8.0'
        });
    };
