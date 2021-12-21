import firebase from "firebase";
import 'firebase/firestore'
import 'firebase/storage'


if(process.env.MIX_APP_URL === 'prod'){
    var firebaseConfig = {
        apiKey: "AIzaSyCtkWxzOfucBkkslGt6_dTj5XIs779XcNo",
        authDomain: "tradekunj-frontend.firebaseapp.com",
        projectId: "tradekunj-frontend",
        storageBucket: "tradekunj-frontend.appspot.com",
        messagingSenderId: "1030106343915",
        appId: "1:1030106343915:web:bbf4fd8c69cd57b97fd1ae",
        measurementId: "G-0FRXL7QG0K"
    };
}else{
    var firebaseConfig = {
        apiKey: "AIzaSyArSlU7AFfjZonYTnR4HLSrWNWkxuhU6oc",
        authDomain: "tradekunj.firebaseapp.com",
        projectId: "tradekunj",
        storageBucket: "tradekunj.appspot.com",
        messagingSenderId: "385622279403",
        appId: "1:385622279403:web:91949255d312d75b882aae",
        measurementId: "G-B3KQQGYCN4"
    };
// Initialize Firebase
}

firebase.initializeApp(firebaseConfig);
firebase.analytics();

const projectStorage = firebase.storage()
const projectFirestore = firebase.firestore()
export {projectStorage, projectFirestore}
