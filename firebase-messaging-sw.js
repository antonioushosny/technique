 

importScripts('https://www.gstatic.com/firebasejs/7.9.3/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.9.3/firebase-messaging.js');
 
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyAEuoiuQtUnYvTe9ihxzzRHK0qQ1GY0SNk",
    authDomain: "adam-4860e.firebaseapp.com",
    databaseURL: "https://adam-4860e.firebaseio.com",
    projectId: "adam-4860e",
    storageBucket: "adam-4860e.appspot.com",
    messagingSenderId: "149553610470",
    appId: "1:149553610470:web:6b2d65230778fd9b004527",
    measurementId: "G-V4Z5MSCJ3B"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
 
  const messaging = firebase.messaging();
    messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    const notificationTitle = 'Background Message from html';
        const notificationOptions = {
        body: 'Background Message body.',
        icon: '/favicon.png',
        sound:'default'
    };
    
  
  });