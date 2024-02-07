// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
import {
  getAuth,
  getIdToken,
  reload,
  getIdTokenResult,
  onAuthStateChanged,
  GoogleAuthProvider,
  signInWithPopup,
  signOut,
} from "https://www.gstatic.com/firebasejs/9.6.1/firebase-auth.js";
import {
  doc,
  getDoc,
  updateDoc,
  getFirestore,
  setDoc,
  collection,
  query,
  where,
  getDocs,
} from "https://www.gstatic.com/firebasejs/9.6.1/firebase-firestore.js";

// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
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
// const analytics = getAnalytics(app);
const auth = getAuth(app);
//Підключеня бази даних Firestore
const db = getFirestore(app);

// google pop up
const provider = new GoogleAuthProvider();
// sets pop up language
auth.useDeviceLanguage();

//[START} визначення основних глобальних контроллерів на сторінці

//Список з вибором класу
const regClass = document.getElementById("regClass");

//Кнопка входу
const btnUserLogin = document.getElementById("loginBtn");

//Кнопка відображення даних користувача
const infoUserName = document.getElementById("userName");

//Кнопка ОК на модальному вікні
document.getElementById("signUpBtnOK").addEventListener("click", register);

//[END} визначення основних глобальних контроллерів на сторінці

//[START] Глобальні змінні
let userGoogle

let UsersArrayLocal = []

//let uid = localStorage.getItem("userDataPath");
// let uid = userGoogle.uid;


// if (!uid) {
//   uid = "template";
// }

//let uid = userGoogle.uid;


// if (!uid) {
//   uid = "template";
// }
//[END] 

checkUserOnLoad();

//[START] отримання даних всіх користувачів в локальне сховище
async function getFirebaseUsers() {
  const firebaseUsersArray = []
  const usersCollection = collection(db, "main")
  const users = await getDocs(usersCollection);

  users.docs.sort().forEach((e) => (firebaseUsersArray.push(e.data())))
  //console.log(firebaseUsersArray)

  let firebaseUsersArraySorted = []
  firebaseUsersArray.forEach((e) => {
    //console.log(e)
    let obj = Object.keys(e).sort().reduce((acc, key) => ({
      ...acc, [key]: e[key]
    }), {})
    firebaseUsersArraySorted.push(obj)
  })
  //повертаємо масив об'єктів, які відсортовані за ключами
  return firebaseUsersArraySorted
}

async function setFirebaseUsersToLocalStorage() {
  console.log('запуск функції setFirebaseUsersToLocalStorage()')
  //якщо користувач увійшов то отримуєму всіх користувачів з бази даних в об'єкт firebaseUsersArray
  if (localStorage.getItem("boolUserLogin")) {

    const UsersArray = await getFirebaseUsers()
    //console.log(UsersArray)

    //UsersArray.forEach((e) => {
    //  console.log(e.userName + " " + e.uid + " " + e.userGroup)
    //})

    //встановлення в опції групи користувача


    localStorage.setItem("UsersArray", JSON.stringify(UsersArray))
    //firebaseUsersArray.sort().forEach((e) => console.log(e))
    //const firebaseUsersArrayLocal = []
    // firebaseUsersArrayLocal.push(JSON.parse(localStorage.getItem("firebaseUsersArray")))
    UsersArrayLocal.push(JSON.parse(localStorage.getItem("UsersArray")))
    //console.log(UsersArrayLocal)     
    //сортуванян масиву користувачів по ключам
    //let firebaseUsersArraySorted = []

    //firebaseUsersArrayLocal[0].forEach((e)=>{
    //console.log(e)
    // let obj = Object.keys(e).sort().reduce((acc, key) => ({
    //  ...acc, [key]: e[key]
    // }), {})
    //  firebaseUsersArraySorted.push(obj)
    //})

    //firebaseUsersArraySorted.forEach((e)=>{
    //  console.log(e.userName + " " + e.uid)
    //})
  }
}


//console.log(await getFirebaseUsers())

//getFirebaseUsers.forEach((e)=>console.log(e))
// const firebaseUsersArray = []
// firebaseUsersArray.push(JSON.parse(localStorage.getItem("firebaseUsersArray")))
//console.log(firebaseUsersArray[0][0])

//let firebaseUsersArraySorted
// firebaseUsersArray[0].forEach((e)=>{

//    firebaseUsersArraySorted = (Object.keys(e).sort())

// })

// 

// let firebaseUsersArraySorted = []

// firebaseUsersArray[0].forEach((e)=>{
//   //console.log(e)
//   let obj = Object.keys(e).sort().reduce((acc, key) => ({
//     ...acc, [key]: e[key]
//   }), {})
//   firebaseUsersArraySorted.push(obj)
// })
//console.log(firebaseUsersArraySorted)

// firebaseUsersArraySorted.forEach((e)=>{
//   console.log(e.userName + " " + e.uid)
// })

//[END] отримання даних всіх користувачів в локальне сховище






async function register() {
  //console.log(userGoogle)
  signInWithPopup(auth, provider).then(async (result) => {
  // успішна авторизація
  userGoogle = result.user;
  //console.log(userGoogle)
  const firebaseUserDoc = await getDoc(doc(db, "main", userGoogle.uid));
  const docBool = firebaseUserDoc.exists();
  //console.log(firebaseUserDoc.data())


  //console.log(regClass.value)
  //const docBool = (await getDoc(doc(db, "main", userGoogle.uid))).exists();
  if (!docBool) {
    //createUser(user.uid, user.displayName, regClass.value);
    createUser(userGoogle, regClass.value);
    // createUser(userGoogle, regClass.value);

  } else {


    updateDoc(doc(db, "main", userGoogle.uid), {
      //Оновлення даних користувача
      userGroup: regClass.value,
      userName: swapFirstNameAndLastName(userGoogle.displayName),
      userEmail: userGoogle.email,
      userDescription: userGoogle.displayName + ' ' + regClass.value,
      userCreationTime: userGoogle.metadata.creationTime,
      userLastSignInTime: userGoogle.metadata.lastSignInTime,
      userPhoto: userGoogle.photoURL,
    });
    console.log('Дані користувача змінено')
    localStorage.clear();
    window.location.reload();

    //console.log(firebaseUserDoc.data())
  }
  // із-за перезавнтаження сторінки onAuthStateChanged може спрацювати двічі
  // що створює зайвий запит до бази даних
  // window.location.reload();
  //})
  // .catch((error) => {
  //   // помилка при авторизації
  //   console.log("clicked the X or error: " + error);
   });
}

// відповідає за появу вікна для авторизації через гугл аккаунт
export async function popupGoogle() {
  signInWithPopup(auth, provider)
    .then((result) => {
      // успішна авторизація
      userGoogle = result.user;
      // console.log(userGoogle)
      // localStorage.setItem("userDataPath", userGoogle.uid);
      // localStorage.setItem("userName", userGoogle.displayName);
      // localStorage.setItem("userEmail", userGoogle.email);
      // localStorage.setItem("userPhoto", userGoogle.photoURL);


      // із-за перезавнтаження сторінки onAuthStateChanged може спрацювати двічі
      // що створює зайвий запит до бази даних
      //window.location.reload();
    })
    .catch((error) => {
      // помилка при авторизації
      console.log("clicked the X or error:" + error);
      // const btn = document.getElementById("loginBtn");
      btnUserLogin.addEventListener("click", popupGoogle, { once: true });
    });
}

// спрацьовує на завантаженні сторінки
// перевіряє чи ввійшов користувач у систему
// перевіряє версію уже ввійшовшого користувача
export async function checkUserOnLoad() {
  onAuthStateChanged(auth, async function (userGoogle) {
    //const btn = document.getElementById("loginBtn");
    //btnUserLogin.innerText = "Увійти";
    //якщо користувач увійшов, то приховуємо кнопку Зареєструватись
    //document.getElementById("btnReg").style.display = "none";

    if (userGoogle) {
      btnUserLogin.innerText = "Вийти";
      btnUserLogin.addEventListener("click", signOutVar, { once: true });

      localStorage.setItem("boolUserLogin", "1")
      localStorage.setItem("userGoogleLocal", JSON.stringify(userGoogle));

      //infoUserName.innerText = swapFirstNameAndLastName(userGoogle.displayName) + " " + userGoogle.email;

      await setFirebaseUsersToLocalStorage()


      //const uid = userGoogle.uid;
      let userFromUsersArrayLocal = UsersArrayLocal[0].find(obj => obj.uid === userGoogle.uid);
      infoUserName.innerText = userFromUsersArrayLocal.userName + " " + userFromUsersArrayLocal.userGroup + " " + userFromUsersArrayLocal.userEmail;

      console.log(userFromUsersArrayLocal)
      //localStorage.setItem("userDataPath", userGoogle.uid);
      //localStorage.setItem("userID", userGoogle.uid);

      //localStorage.setItem("userName", swapFirstNameAndLastName(userGoogle.displayName));
      //localStorage.setItem("userEmail", userGoogle.email);



      // Якщо дійдуть руки, то буде перевірка версії через localStorage, а саме:
      // при вході користувача його документ зберігається локально, тоді
      // при зміні документу (наприклад при виконанні завданнь) потрібно буде
      // крім оновлення документу в базі даних, ще й оновляти локальний документ
      // ЗАВДЯКИ чому при перевірці версії запит документу користувача йде в локальне сховище,
      // що в свою чергу зменшує загальну кількість запитів на один при перевірці версії
      // АЛЕ перевірка версії відбувається досить часто (кожний раз коли спрацьовує onAuthStateChanged),
      // тому це може того вартувати
      // const userDocLocal = JSON.parse(localStorage.getItem("userData"));

      // перевіряє версійність
      //const returnValue = await checkUserVersion(uid);
      //console.log(returnValue);
      //const correctVersion = returnValue[0]; // boolean
      //const userDoc = returnValue[1];
      //const templateDoc = returnValue[2];
      //if (!correctVersion) {
      //  await mergeDocs(uid, userDoc, templateDoc);
      //}

      // тепер кнопка відповідає за вихід користувача


      //document.getElementById("signUpBtnOK").addEventListener("click", () => console.log("bruh"));

      // завантажує опції з документу користувача

      // checkUserVersion(null, null, uid, false);
      //const select = document.getElementById("task");
      //const obj = "option";
      // tasksLoad(select, obj, uid);

      //виведення даних користувача в меню та модальне вікно
      //const userName = document.getElementById("userName");

      //document.getElementById("userNameModal").innerText = user.displayName;
      //showModalResults(uid, "");
    } else {

      // тепер кнопка відповідає за вхід користувача
      btnUserLogin.innerText = "Увійти";
      btnUserLogin.addEventListener("click", popupGoogle, { once: true });
      console.log("user is not loggin in");
    }
  });
}

//mergeStudentManually('05xYEJI4V6XyJqI48c5lFRam6Gg2')
//console.log('User' + uid + 'updated from template')

//[START] Примусове оновлення користувача
export async function mergeStudentManually(uid) {

  // перевіряє версійність
  const returnValue = await checkUserVersion(uid);
  //console.log(returnValue);
  const correctVersion = returnValue[0]; // boolean
  const userDoc = returnValue[1];
  const templateDoc = returnValue[2];
  if (!correctVersion) {
    await mergeDocs(uid, userDoc, templateDoc);
  }
  console.log('User ' + uid + ' updated from template')
}
//[END]

// [START] вихід користувача
const signOutVar = async function () {
  signOut(auth)
    .then(() => {
      localStorage.clear();
      window.location.reload();
      // showModalResults("template");
      // future popUp here
    })
    .catch((error) => {
      // future error popUp here
    });
};
// [END] вихід користувача

// [START] Зміна імені та прізвища місцями
function swapFirstNameAndLastName(inputString) {
  // Split the string into first name and last name using space as the delimiter
  var parts = inputString.split(' ');

  // Check if both elements (first name and last name) are present
  if (parts.length === 2) {
    // Swap the first name and last name
    var firstName = parts[0];
    var lastName = parts[1];

    // Return the string with swapped first name and last name
    return lastName + ' ' + firstName;
  } else {
    // If the string doesn't have both parts, return an error or null
    return null;
  }
}
// [END] Зміна імені та прізвища місцями


// [START] Створення нового користувача та копіювання бази даних з шаблону template
// uid - отримуємо з LocalStorage
// userName - отримуємо  при авторизації з Гугл аккаунту
async function createUser(userGoogle, userGroup) {
  const template = (await getDoc(doc(db, "main", "template"))).data();

  template.uid = userGoogle.uid;
  template.userGroup = userGroup;
  template.userName = swapFirstNameAndLastName(userGoogle.displayName)
  template.userEmail = userGoogle.email
  template.userDescription = userGoogle.displayName + ' ' + userGroup
  template.userCreationTime = userGoogle.metadata.creationTime
  template.userLastSignInTime = userGoogle.metadata.lastSignInTime
  template.userPhoto = userGoogle.photoURL
  //console.log(template);
  const ref = doc(db, "main", uid);
  await setDoc(ref, template);
  console.log("Створено користувача " + template.userName + " з " + template.userGroup + " класу " + template.uid);
}
// [END] Створення нового користувача та копіювання бази даних з шаблону template

// З'єднує два документи (користувача та шаблону).
// Функція потрібена для версійності.
export async function mergeDocs(uid, userDoc, templateDoc) {
  if (!uid && !userDoc) {
    console.error(
      "to merge template into userDoc you have to provide uid or userDoc"
    );
    return;
  }
  if (!userDoc) {
    userDoc = (await getDoc(doc(db, "main", uid))).data();
  }
  if (!templateDoc) {
    templateDoc = (await getDoc(doc(db, "main", template))).data();
    // із-за мутації шаблоного документу після з'єднання
    // змінюється і його версія на ту що була в користувача,
    // тому її збережено в примітивну змінну
  }
  var templateVersion = templateDoc.version;
  const mergedObject = mergeObjects(templateDoc, userDoc);
  mergedObject.version = templateVersion;
  // return mergeObjects(templateDoc, userDoc);
  await setDoc(doc(db, "main", uid), mergedObject);
}

// нажаль ця функція зміннює вхідні об'єкти
// (наразі проблем з цим немає, але можуть виникнути у майбутньому)
// я намагався зробити її через функційне програмування,
// але мені не вистачає часу це доробити, тому поки що залишив так
export function mergeObjects(mergeFrom, mergeIn) {
  // mergeFrom - шаблон з новими властивостями
  // mergeIn - об'єкт зі значеннями, які потрібно зберегти
  // проходиться по кожній властивості mergeFrom
  // (припускається, що mergeFrom має більше властивостей, ніж mergeIn)
  // console.log(mergeFrom,mergeIn);
  Object.entries(mergeFrom).forEach((property) => {
    const mergeInPropertyObj = mergeIn[property[0]];
    const mergeFromPropertyObj = property[1];
    if (
      typeof property == "object" &&
      typeof mergeFromPropertyObj == "object" &&
      !Array.isArray(mergeFromPropertyObj) &&
      property !== null &&
      mergeInPropertyObj
    ) {
      // якщо властивість має непримітивне значення (об'єкт)
      // та якщо ця властивість має теж ім'я, що й у mergeIn
      // якщо значення другого об'єкту існує
      // поєднує вкладені об'єкти
      mergeObjects(mergeFromPropertyObj, mergeInPropertyObj);
    } else if (Array.isArray(mergeFromPropertyObj)) {
      // якщо властивість має непримітивне значення (масив)
      // надає властивості шаблонного об'єкту масив неповторних значень
      mergeFrom[property[0]] = mergeUnique(
        mergeFromPropertyObj,
        mergeInPropertyObj
      );
    } else if (
      mergeInPropertyObj !== undefined &&
      mergeInPropertyObj !== null
    ) {
      // якщо властивість має примітивне значення
      // якщо значення другого об'єкту існує
      // надає властивості шаблонного об'єкту значення другого об'єкту
      mergeFrom[property[0]] = mergeInPropertyObj;
    }
  });
  // повертає зміненний шаблонний об'єкт
  return mergeFrom;
}

// поєднує унікальні елементи в масиві
// (на майбутнє, якщо прийдеться використовувати масиви)
// вкрадено з https://stackoverflow.com/a/44464083
function mergeUnique(arr1, arr2) {
  return arr1.concat(
    arr2.filter(function (item) {
      return arr1.indexOf(item) === -1;
    })
  );
}

// ------------------------------------------------------------------------------------



// [START]перевірка версії______________________________________

// Перевіряє версію документу користувача
// додатково є можливість надати об'єкт даних користувача та об'єкт шаблону
// для того щоб за можливості не робити зайвого запиту до бази даних
export async function checkUserVersion(uid, userDoc, templateDoc) {
  // uid - айді користувача
  // userDoc - об'єкт даних користувача
  // templateDoc - об'єкт шаблонних даних
  if (!uid && !userDoc) {
    console.error("to check version you have to provide uid or userDoc");
    return;
  }
  if (!userDoc) {
    try {
      userDoc = (await getDoc(doc(db, "main", uid))).data();
    } catch (err) {
      console.error(err);
      return;
    }
  }
  if (!templateDoc) {
    try {
      templateDoc = (await getDoc(doc(db, "main", "template"))).data();
    } catch (err) {
      console.error(err);
      return;
    }
  }
  if (templateDoc.version == userDoc.version) {
    return [true, userDoc, templateDoc];
  } else {
    return [false, userDoc, templateDoc];
  }
}
// [END] перевірка версії ______________________________________

