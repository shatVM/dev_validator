console.log(11);

// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
import {
  getFirestore,
  collection,
  getDocs,
  doc,
  getDoc,
  setDoc,
  updateDoc,
  query,
} from "https://www.gstatic.com/firebasejs/10.7.2/firebase-firestore.js";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyCxDs2c5zvgXmaao6a2JpeSKmXL4OdmIIE",
  authDomain: "dev-validator-test.firebaseapp.com",
  databaseURL: "https://dev-validator-test.firebaseio.com",
  projectId: "dev-validator-test",
  storageBucket: "dev-validator-test.appspot.com",
  messagingSenderId: "313228527018",
  appId: "1:313228527018:web:3dbaefd97fe8b0f98dd7d3",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);

//
const usersCollection = collection(db,"main")
const users = await getDocs(usersCollection);

// users.docs.forEach((user)=>{
//   showUserResult(user.id)
// })

showUserResult('Rq6LCl02TifWTeBdg5O1eChD8pU2')
//console.log(db);

async function showUserResult(uid){
  const q = doc(db, "main", uid);

  //console.log(q);
  
  const querySnapshot = await getDoc(q);
  
  //console.log(querySnapshot);
  
  const userDoc = querySnapshot.data();
  
  //console.log(userDoc.tasks); 
  //console.log(Object.entries(userDoc.tasks)[0])
  console.log(userDoc)

  console.log("Name: ", userDoc.userName)
  console.log("Group: ",userDoc.class)
  console.log("Version: ",userDoc.version)
  console.log("Email: ",userDoc.email)
  console.log("Description: ",userDoc.description)

  // Object.entries(userDoc.tasks).sort().forEach((task)=>{
  //   console.log(task[0]);
  //   (Object.entries(task[1]).sort().forEach((e)=>{
  //     console.log(e[0]," : ", e[1])
  //   }));
  // })
}

