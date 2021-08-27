<html>
<title>Firebase Messaging Demo</title>
<style>
    div {
        margin-bottom: 15px;
    }
</style>
<body>
    <div id="token"></div>
    <div id="msg"></div>
    <div id="notis"></div>
    <div id="err"></div>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-analytics.js"></script>

<script>
            MsgElem = document.getElementById('msg');
            TokenElem = document.getElementById('token');
            NotisElem = document.getElementById('notis');
            ErrElem = document.getElementById('err');

            // TODO: Replace firebaseConfig you get from Firebase Console
            var firebaseConfig = {
                apiKey: "AIzaSyAIlyjZcxAahf_btdEQta50-HGtFdKPXf4",
                authDomain: "jadwalmengajar-27129.firebaseapp.com",
                projectId: "jadwalmengajar-27129",
                storageBucket: "jadwalmengajar-27129.appspot.com",
                messagingSenderId: "661918687191",
                appId: "1:661918687191:web:7f8780327f5c0d63bc7592",
                measurementId: "G-52X82F2BZL"
            };
            firebase.initializeApp(firebaseConfig);

            const messaging = firebase.messaging();
            messaging
                .requestPermission()
                .then(function () {
                    MsgElem.innerHTML = 'Notification permission granted.';
                    console.log('Notification permission granted.');

                    // get the token in the form of promise
                    return messaging.getToken();
                })
                .then(function (token) {
                    TokenElem.innerHTML = 'Device token is : <br>' + token;
                })
                .catch(function (err) {
                    ErrElem.innerHTML = ErrElem.innerHTML + '; ' + err;
                    console.log('Unable to get permission to notify.', err);
                });

            let enableForegroundNotification = true;
            messaging.onMessage(function (payload) {
                console.log('Message received. ', payload);
                NotisElem.innerHTML =
                    NotisElem.innerHTML + JSON.stringify(payload);

                if (enableForegroundNotification) {
                    let notification = payload.notification;
                    navigator.serviceWorker
                        .getRegistrations()
                        .then((registration) => {
                            registration[0].showNotification(notification.title);
                        });
                }
            });
        </script>

    </body>

</html>