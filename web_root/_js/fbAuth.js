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

//Кнопка ОК на модальному вікні
//document.querySelector("#signUpBtnOK").addEventListener("click", register);

checkUserOnLoad();

async function register() {
  signInWithPopup(auth, provider)
    .then(async (result) => {
      // успішна авторизація
      const userGoogle = result.user;
      //console.log(userGoogle)
      const docBool = (await getDoc(doc(db, "main", userGoogle.uid))).exists();
      if (!docBool) { 
        //createUser(user.uid, user.displayName, regClass.value);
        createUser(userGoogle, regClass.value);

      } else if (docBool) {
        updateDoc(doc(db, "main", userGoogle.uid), { class: regClass.value });
      }
      // із-за перезавнтаження сторінки onAuthStateChanged може спрацювати двічі
      // що створює зайвий запит до бази даних
      // window.location.reload();
    })
    .catch((error) => {
      // помилка при авторизації
      console.log("clicked the X or this:" + error);
    });
}

// відповідає за появу вікна для авторизації через гугл аккаунт
export async function popupGoogle() {
  signInWithPopup(auth, provider)
    .then((result) => {
      // успішна авторизація
      const userGoogle = result.user;
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
      //console.log("clicked the X or this:" + error);
      const btn = document.getElementById("loginBtn");
      btn.addEventListener("click", popupGoogle, { once: true });
    });
}

// спрацьовує на завантаженні сторінки
// перевіряє чи ввійшов користувач у систему
// перевіряє версію уже ввійшовшого користувача
export async function checkUserOnLoad() {
  onAuthStateChanged(auth, async function (userGoogle) {
    const btn = document.getElementById("loginBtn");

    //якщо користувач увійшов, то приховуємо кнопку Зареєструватись
    document.getElementById("btnReg").style.display = "none";

    

    if (userGoogle) {
      const uid = userGoogle.uid;
      //console.log(userGoogle)
      localStorage.setItem("userDataPath", userGoogle.uid);
      localStorage.setItem("userName", swapFirstNameAndLastName(userGoogle.displayName));
      localStorage.setItem("userEmail", userGoogle.email);
      localStorage.setItem("userPhoto", userGoogle.photoURL);
      
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
      const returnValue = await checkUserVersion(uid);
      //console.log(returnValue);
      const correctVersion = returnValue[0]; // boolean
      const userDoc = returnValue[1];
      const templateDoc = returnValue[2];
      if (!correctVersion) {
        await mergeDocs(uid, userDoc, templateDoc);
      }

      // тепер кнопка відповідає за вихід користувача
      btn.innerText = "Вийти";
      btn.addEventListener("click", signOutVar, { once: true });

      document
        .getElementById("signUpBtnOK")
        .addEventListener("click", () => console.log("bruh"));

      // завантажує опції з документу користувача

      // checkUserVersion(null, null, uid, false);
      //const select = document.getElementById("task");
      //const obj = "option";
      // tasksLoad(select, obj, uid);

      //виведення даних користувача в меню та модальне вікно
      const userName = document.getElementById("userName");
      userName.innerText = userGoogle.displayName;
      //document.getElementById("userNameModal").innerText = user.displayName;
      //showModalResults(uid, "");
    } else {
      //showModalResults("template", "");
      // тепер кнопка відповідає за вхід користувача
      btn.innerText = "Увійти";
      btn.addEventListener("click", popupGoogle, { once: true });
      console.log("user is not signed in");

      //якщо користувач не увійшов, то відображаємо кнопку Зареєструватись
    document.getElementById("btnReg").style.display = "block";

     
    }
  });
}

//mergeStudentManually('05xYEJI4V6XyJqI48c5lFRam6Gg2')
//console.log('User' + uid + 'updated from template')

//[START] Примусове оновлення користувача
export async function mergeStudentManually(uid){

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


// createUser("21321321", "hgfhgfhg");
// Створення нового користувача та копіювання бази даних з шаблону template
// uid - отримуємо з LocalStorage
// userName - отримуємо  при авторизації з Гугл аккаунту
async function createUser(userGoogle, userClass) {
  const template = (await getDoc(doc(db, "main", "template"))).data();
  
  template.uid = userGoogle.uid; 
  template.userClass = userClass;
  template.userName = swapFirstNameAndLastName(userGoogle.displayName) 
  template.userEmail = userGoogle.email
  template.userDescription = userGoogle.displayName + ' '+ userClass 
  template.userCreationTime = userGoogle.metadata.creationTime
  template.userLastSignInTime = userGoogle.metadata.lastSignInTime
  template.userPhoto = userGoogle.photoURL

  console.log(template);

  const ref = doc(db, "main", uid);
  await setDoc(ref, template);
  //console.log("ok");
}

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

//Робота з базою даних

let uid = localStorage.getItem("userDataPath");

if (!uid) {
  uid = "template";
}

//import {checkUserOnSignIn, tasksLoad, checkUserVersion} from "./firebaseFirestore.js";
//для відображення результатів роботи
// function showModalRegister(){
//     let lessonsList = document.getElementById('userResult');

// }




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

