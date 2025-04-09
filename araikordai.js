// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyC4hPVlMgdqW03UhlwP5i3Rst2Zr8XJFyQ",
  authDomain: "daily-checktime.firebaseapp.com",
  projectId: "daily-checktime",
  storageBucket: "daily-checktime.firebasestorage.app",
  messagingSenderId: "687849172493",
  appId: "1:687849172493:web:13d9b1bc9a48baaf406f44",
  measurementId: "G-79SVJSWYNQ"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);