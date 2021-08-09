import firebase from "firebase";
import 'firebase/firestore'
import 'firebase/storage'

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
firebase.initializeApp(firebaseConfig);
firebase.analytics();

const projectStorage = firebase.storage()
const projectFirestore = firebase.firestore()

export {projectStorage, projectFirestore}
