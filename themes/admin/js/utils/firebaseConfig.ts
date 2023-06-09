import firebase from "firebase";
import 'firebase/firestore'
import 'firebase/storage'


if(process.env.MIX_APP_URL === 'prod'){
    var firebaseConfig = {
        apiKey: "AIzaSyA3wUibEoiKjgWWy7S5MGEilfUrj0OI8h0",
        authDomain: "tradekunj-prod.firebaseapp.com",
        projectId: "tradekunj-prod",
        storageBucket: "tradekunj-prod.appspot.com",
        messagingSenderId: "560965009183",
        appId: "1:560965009183:web:7a3fdb8eceb6f54eb2ba2a",
        measurementId: "G-RPH12SHNFC"
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


