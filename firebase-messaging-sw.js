importScripts('https://www.gstatic.com/firebasejs/8.8.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.8.1/firebase-messaging.js');
importScripts(
    "https://www.gstatic.com/firebasejs/8.8.1/firebase-analytics.js",
);

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
    apiKey: "AIzaSyAIlyjZcxAahf_btdEQta50-HGtFdKPXf4",
    authDomain: "jadwalmengajar-27129.firebaseapp.com",
    projectId: "jadwalmengajar-27129",
    storageBucket: "jadwalmengajar-27129.appspot.com",
    messagingSenderId: "661918687191",
    appId: "1:661918687191:web:7f8780327f5c0d63bc7592",
    measurementId: "G-52X82F2BZL"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
    // Customize notification here
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});