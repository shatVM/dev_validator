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
document.querySelector("#signUpBtn").addEventListener("click", register);

checkUserOnLoad();

async function register() {
  signInWithPopup(auth, provider)
    .then(async (result) => {
      // успішна авторизація
      const user = result.user;
      const docBool = (await getDoc(doc(db, "main", user.uid))).exists();
      if (!docBool) {
        createUser(user.uid, user.displayName, regClass.value);
      } else if (docBool) {
        updateDoc(doc(db, "main", user.uid), { class: regClass.value });
      }
      localStorage.setItem("userDataPath", user.uid);
      // із-за перезавнтаження сторінки onAuthStateChanged може спрацювати двічі
      // що створює зайвий запит до бази даних
      // window.location.reload();
    })
    .catch((error) => {
      // помилка при авторизації
      //console.log("clicked the X or this:" + error);
    });
}

// відповідає за появу вікна для авторизації через гугл аккаунт
export async function popupGoogle() {
  signInWithPopup(auth, provider)
    .then((result) => {
      // успішна авторизація
      const user = result.user;
      localStorage.setItem("userDataPath", user.uid);
      // із-за перезавнтаження сторінки onAuthStateChanged може спрацювати двічі
      // що створює зайвий запит до бази даних
      window.location.reload();
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
  onAuthStateChanged(auth, async function (user) {
    const btn = document.getElementById("loginBtn");

    //якщо користувач увійшов, то приховуємо кнопку Зареєструватись
    document.getElementById("btnReg").style.display = "none";

    //відображає плаваючу кнопку по відправці програм

    // на головній сторінці немає btnUploadSquare, щоб його ховати
    try {
      document.getElementById("btnUploadSquare").style.display = "inline-block";
    } catch { }

    showRating();

    if (user) {
      const uid = user.uid;
      // showModalResults(uid);
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
        .getElementById("signUpBtn")
        .addEventListener("click", () => console.log("bruh"));

      // завантажує опції з документу користувача

      // checkUserVersion(null, null, uid, false);
      const select = document.getElementById("task");
      const obj = "option";
      // tasksLoad(select, obj, uid);

      //виведення даних користувача в меню та модальне вікно
      const userName = document.getElementById("userName");
      userName.innerText = user.displayName;
      document.getElementById("userNameModal").innerText = user.displayName;
      showModalResults(uid, '');
    } else {
      showModalResults("template", '');
      // тепер кнопка відповідає за вхід користувача
      btn.innerText = "Увійти";
      btn.addEventListener("click", popupGoogle, { once: true });
      console.log("user is not signed in");

      // приховує плаваючу кнопку по відправці програм
      try {
        document.getElementById("btnUploadSquare").style.display = "none";
      } catch { }

      //якщо користувач увійшов, то приховуємо кнопку Зареєструватись
      document.getElementById("btnReg").style.display = "block";

      // завантажує опціїї з шаблонного документу
      //const select = document.getElementById("task");
      //const obj = "option";
      // tasksLoad(select, obj, "template");
    }
  });
}

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

// Атавізм рудимент
// Перевіряє чи існує документ користувача в базі даних
// Повертає Promise
// export async function checkUserOnSignIn(uid){
//     // uid - посилання на документ (userId), отримане при авторизації
//     const theDoc = (await getDoc( doc(db, "main", uid) )).exists();

//     if(!theDoc){
//         return false;
//     }else{
//         return true;
//     }
// };

// createUser("21321321", "hgfhgfhg");
// Створення нового користувача та копіювання бази даних з шаблону template
// uid - отримуємо з LocalStorage
// userName - отримуємо  при авторизації з Гугл аккаунту
async function createUser(uid, userName, userClass) {
  const template = (await getDoc(doc(db, "main", "template"))).data();
  template.userName = userName;
  template.uid = uid;
  //console.log(userClass);
  template.class = userClass;
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



//[START] фільтрація класів за вибором 
function showResultOfSelectedClass() {
  document.getElementById('selectClass').addEventListener('change', function (event) {
    var selectedValue = event.target.value;
   // console.log(selectedValue);

    // Отримуємо всі елементи з класом "userResult"
    var userResults = document.querySelectorAll('.userResult');
    //console.log(userResults);
    // Перебираємо кожен елемент
    userResults.forEach(function (userResult) {
      userResult.style.display = 'none';
      // Отримуємо елемент з класом "userClass" в кожному блоку "userResult"
      var userClassElement = userResult.querySelector('.userClass');

      // Перевіряємо, чи має "userClass" значення "11-А"
      if (selectedValue === "Всі") {
        userResult.style.display = 'flex';
      }

      if (userClassElement.textContent.trim() === selectedValue) {
        // Якщо так, відображаємо блок
        userResult.style.display = 'flex';
      }
    });
  });
}
//[END] фільтрація класів за вибором

//[START] побудова та відображення модального вікна з результатами ------------------------------------------------------------------------------------

//Get all documents in a collection
async function showModalResults(uid, selectedClass) {
  //
  showResultOfSelectedClass()


  // selectedClass = document.getElementById('selectClass')
  // //console.log('-------------selectedClass')
  // selectedClass.addEventListener('change', event => {
  //   //showModalResults(uid, value)
  //   console.log(event.target.value)
  // })
  //
  // const docRef = db.collection("main").doc(uid);
  const docRef = doc(db, "main", uid);
  const templateDoc = await getDoc(docRef);

  if (templateDoc.exists) {
    // console.log("Document data:", templateDoc.data());

    var tasksList = templateDoc.data().tasks;
    Object.entries(tasksList)
      .sort()
      .forEach((property) => {
        let lessonsList = document.getElementById("userResult");

        //https://learn.javascript.ru/modifying-document Изменение документа
        //контейнер для відображення результатів
        let divLessons = document.createElement("div");
        divLessons.className = "divLessons";
        lessonsList.insertAdjacentElement("beforeend", divLessons);

        //Відображення назви курсу
        const lessonName = property[0];
        let divLessonName = document.createElement("div");
        divLessonName.id = lessonName;
        divLessonName.className = "divLessonName";
        divLessons.insertAdjacentElement("afterbegin", divLessonName);

        let h3LessonName = document.createElement("h3");
        h3LessonName.innerHTML = lessonName;
        divLessonName.insertAdjacentElement("afterbegin", h3LessonName);

        //контейнер для відображення результатів завдань
        let divTasks = document.createElement("div");
        divTasks.className = "divTasks";
        divLessons.insertAdjacentElement("beforeend", divTasks);

        Object.entries(property[1])
          .sort()
          .forEach((property) => {
            //посилання на завдання

            let aTask = document.createElement("a");

            //умова на шлях до різних папок
            let path = window.location.href;
            let file = path.substring(path.length, path.length - 8);

            if (file == "task.php") {
              aTask.href =
                "../../tasks/" + lessonName + "_" + property[0] + "/task.php";
            } else {
              aTask.href =
                "tasks/" + lessonName + "_" + property[0] + "/task.php";
            }

            aTask.class = "a-class";
            divTasks.insertAdjacentElement("beforeend", aTask);
            let divTaskResult = document.createElement("div");
            divTaskResult.id = lessonName + "_" + property[0];
            divTaskResult.className = "divTaskResult";
            aTask.insertAdjacentElement("beforeend", divTaskResult);

            //заголовок назва завдання
            let h4TaskName = document.createElement("h3");
            h4TaskName.innerHTML = property[0];
            divTaskResult.insertAdjacentElement("afterbegin", h4TaskName);

            //результат виконання завдання
            let h5TaskResult = document.createElement("h5");
            h5TaskResult.innerHTML = property[1] + "%";
            divTaskResult.insertAdjacentElement("beforeend", h5TaskResult);

            //графічне відображення прогресу https://ru.stackoverflow.com/questions/110066/%D0%9A%D0%B0%D0%BA-%D1%81%D0%B4%D0%B5%D0%BB%D0%B0%D1%82%D1%8C-%D1%84%D0%BE%D0%BD-%D0%B1%D0%BB%D0%BE%D0%BA%D0%B0-div-html-%D0%BD%D0%B5-%D0%B4%D0%BE-%D0%BA%D0%BE%D0%BD%D1%86%D0%B0
            let progress = document.createElement("progress");
            progress.min = 0;
            progress.max = 100;
            progress.value = property[1];
            divTaskResult.insertAdjacentElement("beforeend", progress);

            //console.log(property[0],":", property[1]);
          });
      });
  } else {
    // doc.data() will be undefined in this case
    console.log("No such document!");
  }
}
// [END] ------------------------------------------------------------------------------------





async function testSend(input) {
  const uid = localStorage.getItem("userDataPath");
  // const userDoc = (await getDoc(doc(db,"main", uid))).data();
  await updateDoc(doc(db, "main", uid), input);
  // console.log(result);
}

//отримує результати завдання з бази даних для відображення через php викликається в t_task.php
async function testGet(defOutObj, taskTheme, task) {
  // defOutObj - об'єкт в які владені теми завданнь
  // taskTheme - тема завдань (з номером на початку)
  // task -  номер завдання
  let uid = localStorage.getItem("userDataPath");
  if (!uid) {
    uid = "template";
  }
  const toReturn = (await getDoc(doc(db, "main", uid))).data()[defOutObj][taskTheme][task];
  return toReturn;
}

export { testSend, testGet };


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



//отримуємо Назви тем  з шаблону
const docRef = doc(db, "main", "template");
const templateDoc = await getDoc(docRef);
var tasksList = templateDoc.data().tasks;

console.log(tasksList);
console.log("-----------------------------------------------");
let t = Object.entries(tasksList);

let tt = Object.entries(t);
console.log(tt);

Object.entries(tasksList)
  .sort()
  .forEach((property) => {
    //console.log(property[0]);
    //getAverageUserResult(property[0]);
    //const array1 = Object.entries(userDoc.tasks[property[0]]);

  })


// [START] Рейтинг______________________________________
async function showRating() {



  
  // отримаує чергу для запиту документів з бази данних
  const q = query(collection(db, "main"));

  // where("class", "==", userClass)
  // запитує документи з бази данних та повертає у вигляді масиву документів
  const querySnapshot = await getDocs(q);
  //console.log(querySnapshot);


  // на кожний документ в масиві виконується ця функція створення вікна учня
  querySnapshot.forEach((doc) => {
    // console.log((doc.data()).userName);
    const userDoc = doc.data();
    //console.log(userDoc);

    const initialValue = 0;

    const array1 = Object.entries(userDoc.tasks["01_Form"]);
    try {

    } catch {

    }

    //const array1 = Object.entries(userDoc.tasks["01_Form"]);
    //console.log(userDoc.tasks);
    //---------------------------------------------
    // const array1 = Object.entries(userDoc.tasks[0]);
    // const array2 = Object.entries(userDoc.tasks).forEach( element => Object.entries(element));
    // const sumWithInitial = array1.reduce(
    //   (accumulator, currentValue) => accumulator + Number(currentValue[1]),
    //   initialValue
    // );
    //--------------------------------------------




    //const array2 = Object.entries(userDoc.tasks["02_Event"]);
    // const array2 = Object.entries(userDoc.tasks).forEach( element => Object.entries(element));
    //let sumWithInitial = getAverageUserResult(array1);
    //console.log( Math.round(sumWithInitial));

    //функція обрахунку суми всіх значень по заданій назві завданню
    function getAverageUserResult(array) {
      return array.reduce(
        (accumulator, currentValue) => accumulator + Number(currentValue[1]),
        initialValue
      );
    }

    ////контейнер для відображення результатів
    const parentNode = document.querySelector("#userList");

    let userDiv = document.createElement("div");
    userDiv.className = "userResult";
    parentNode.insertAdjacentElement("beforeend", userDiv);

    //Відображення Прізвища та імені
    let divUserName = document.createElement("div");
    divUserName.className = "userName";
    divUserName.innerHTML = userDoc.userName;
    userDiv.insertAdjacentElement("afterbegin", divUserName);

    //Відображення Класу
    let divUserClass = document.createElement("div");
    divUserClass.className = "userClass";
    divUserClass.innerHTML = userDoc.class;
    userDiv.insertAdjacentElement("beforeend", divUserClass);

    //контейнер для відображення результатів завдань

    let divLesson = document.createElement("div");
    divLesson.className = "divLesson";
    userDiv.insertAdjacentElement("beforeend", divLesson);
    //userDiv.innerText = userDoc.userName;


    //графічне відображення прогресу https://ru.stackoverflow.com/questions/110066/%D0%9A%D0%B0%D0%BA-%D1%81%D0%B4%D0%B5%D0%BB%D0%B0%D1%82%D1%8C-%D1%84%D0%BE%D0%BD-%D0%B1%D0%BB%D0%BE%D0%BA%D0%B0-div-html-%D0%BD%D0%B5-%D0%B4%D0%BE-%D0%BA%D0%BE%D0%BD%D1%86%D0%B0
    //https://developer.mozilla.org/ru/docs/Web/HTML/Element/progress
    //<label for="file"></label>

    let progress = document.createElement("progress");
    progress.min = 0;
    progress.max = 100;
    progress.value = Math.round(getAverageUserResult(array1) / array1.length);
    //progress.innerText = Math.round(sumWithInitial/array1.length) + "%";
    divLesson.insertAdjacentElement("beforeend", progress);

    //результат виконання набору завдань 1
    let divLessonResult = document.createElement("div");
    divLessonResult.innerText = Math.round(getAverageUserResult(array1) / array1.length) + "%";
    divLesson.insertAdjacentElement("beforeend", divLessonResult);

    //результат виконання набору завдань 2
    //let divLessonResult2 = document.createElement("div");
    // divLessonResult2.innerText = Math.round(sumWithInitial/array1.length) + "%";
    // divLesson.insertAdjacentElement("beforeend", divLessonResult2);

    //userDiv.innerText += " Form: " + Math.round(sumWithInitial/array1.length) + "%" ;
    //console.log( Math.round(sumWithInitial));
    //userDiv.className = "divLessons";
    //parentNode.insertAdjacentElement("beforeend", userDiv);
  });
}
// [END]  ______________________________________



//отримати всю базу даних

const q = (doc(db, "main", "template"));

const querySnapshot = await getDoc(q);


let us = [];

const userDoc = querySnapshot.data();
//console.log(userDoc.tasks["01_Form"]);
us.push(userDoc);
console.log(us);
//   //console.log(Object.entries(userDoc.tasks["03_Button"]));

//   let t = Object.entries(userDoc.tasks);
//   t.forEach((task) => {
//     //console.log(task[0]);
//   });

//   //отримуємо назви полів в базі даниїх
//   //const array1 = Object.entries(userDoc[1]);
//   // const array1 = Object.entries(userDoc.uid);

//   // const array1 = Object.entries(userDoc.class["11"]);
//   //console.log(array1);
// });


//Видалення докумнтів з бази даних РОЗІБРАТИСЯ
//https://ru.stackoverflow.com/questions/1000534/%D0%9A%D0%B0%D0%BA-%D1%83%D0%B4%D0%B0%D0%BB%D0%B8%D1%82%D1%8C-%D0%B4%D0%BE%D0%BA%D1%83%D0%BC%D0%B5%D0%BD%D1%82-%D0%B8%D0%B7-firebase-%D0%BF%D0%BE-%D0%B5%D0%B3%D0%BE-id-%D0%B4%D0%B8%D0%BD%D0%B0%D0%BC%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%B8