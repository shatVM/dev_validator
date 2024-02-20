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
  orderBy,
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

//[START] Глобальні змінні
let userGoogle

let UsersArrayLocal = []

let userLocal

getUsersFromLocalStorage()

//Отримання локальних користувачів в масив UsersArrayLocal та окремого користувача в userLocal
function getUsersFromLocalStorage() {

  userGoogle = JSON.parse(localStorage.getItem("userGoogleLocal"))

  UsersArrayLocal.push(JSON.parse(localStorage.getItem("UsersArray")))
  //console.log(UsersArrayLocal) 
  UsersArrayLocal[0].forEach((e) => {
    //console.log(e.userName + " " + e.uid + " " + e.userGroup)
  })
  //отримання локального користувача за uid з локальної бази даних 
  userLocal = UsersArrayLocal[0].find(obj => obj.uid === userGoogle.uid);
  //console.log(userLocal)

}


//Виведення імені та групи локального користувача в меню
document.getElementById("userName").innerText = userLocal.userName + " " + userLocal.userGroup + " " + userLocal.userSubGroup

//Виведення фото локального користувача в меню
document.getElementById("userPhoto").src = userLocal.userPhoto
  ? userLocal.userPhoto
  : "_img/anonymous.png";

//Створення події на кнопку Користувач для виклику модального вікна результатами користувача та внесення в нього його даних (імені, фото та інше)
document.getElementById("userName").addEventListener("click", () => {
  showModalResults(userLocal.uid);
});

//Створення події на кнопку Рейтинг для виклику модального вікна з рейтингом усіх користувачів
document.getElementById("rank").addEventListener("click", () => {
  if (userLocal.uid == "Rq6LCl02TifWTeBdg5O1eChD8pU2") {
    showRating();
  } else {
  }
});

//[END]


//Робота з базою даних

//let uid = localStorage.getItem("userDataPath");
//console.log(uid);
if (!userLocal.uid) {
  uid = "template";
}



//виведення даних користувача в меню
async function getUserData(uid) {
  const q = doc(db, "main", uid);

  //console.log(q);

  const querySnapshot = await getDoc(q);

  //console.log(querySnapshot);

  const userDoc = querySnapshot.data();

  //console.log(userDoc.tasks); 
  //console.log(Object.entries(userDoc.tasks)[0])
  //console.log(userDoc)
  //console.log("ID: ", userDoc.uid)
  //console.log("Name: ", userDoc.userName)
  //console.log("Group: ",userDoc.userClass)
  //console.log("Version: ",userDoc.version)
  //console.log("Email: ",userDoc.userEmail)
  //console.log("Description: ",userDoc.userDescription)
  //console.log("Photo: ",userDoc.userPhoto)

  // Object.entries(userDoc.tasks).sort().forEach((task)=>{
  //   console.log(task[0]);
  //   (Object.entries(task[1]).sort().forEach((e)=>{
  //     console.log(e[0]," : ", e[1])
  //   }));
  // })
  return userDoc
}
//



//[START] побудова та відображення модального вікна з результатами користувача
//Get all documents in a collection
// async function showModalResults(uid, selectedClass) {
async function showModalResults(uid) {
  //
  document.getElementById("userNameModal").innerText = userLocal.userName
    ? userLocal.userName 
    : "Невідомий користувач";
  document.getElementById("userPhotoModal").src = userLocal.userPhoto
    ? userLocal.userPhoto
    : "_img/anonymous.png";
    document.getElementById("userClassModal").innerText = userLocal.userGroup
    ? userLocal.userGroup + " " + userLocal.userSubGroup
    : "";
    

    //textSuccess

  // selectedClass = document.getElementById('selectClass')
  if (document.getElementById("progress") && document.getElementById("progress").innerText == "Твій прогрес: 100%"){
    console.log(100)
    document.getElementById("Success").style.display = "block";
  } else {
    console.log(0)
    document.getElementById("Success").style.display = "none";
  }
  // selectedClass.addEventListener('change', event => {
  //   //showModalResults(uid, value)
  //   console.log(event.target.value)
  // })
  //
  // const docRef = db.collection('main').doc(uid);
  const docRef = doc(db, "main", uid);
  const templateDoc = await getDoc(docRef);

  if (templateDoc.exists) {
    // console.log('Document data:', templateDoc.data());

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
            //console.log(property[0],':', property[1]);
          });
      });
  } else {
    // doc.data() will be undefined in this case
    console.log("No such document!");
  }
}
// [END] ------------------------------------------------------------------------------------

async function testSend(input) {
  //const uid = localStorage.getItem("userDataPath");
  // const userDoc = (await getDoc(doc(db,'main', uid))).data();
  await updateDoc(doc(db, "main", userLocal.uid), input);
  // console.log(result);
}

//отримує результати завдання з бази даних для відображення через php викликається в t_task.php
async function testGet(defOutObj, taskTheme, task) {
  // defOutObj - об'єкт в які владені теми завданнь
  // taskTheme - тема завдань (з номером на початку)
  // task -  номер завдання
  let uid = userLocal.uid;
  console.log(uid);
  if (!uid) {
    uid = "template";
  }
  const toReturn = (await getDoc(doc(db, "main", uid))).data()[defOutObj][
    taskTheme
  ][task];
  return toReturn;
}

export { testSend, testGet };

//отримуємо Назви тем  з шаблону
//const docRef = doc(db, 'main', 'template');
//const templateDoc = await getDoc(docRef);
//var tasksList = templateDoc.data().tasks;

//console.log(tasksList);
//console.log('-----------------------------------------------');
//let t = Object.entries(tasksList);

//let tt = Object.entries(t);
//console.log(tt);

//Object.entries(tasksList).sort().forEach((property) => {
//console.log(property[0]);
//getAverageUserResult(property[0]);
//const array1 = Object.entries(userDoc.tasks[property[0]]);
// });

//[START] фільтрація класів за вибором
function showResultOfSelectedClass() {
  document
    .getElementById("selectClass")
    .addEventListener("change", function (event) {
      var selectedValue = event.target.value;
      // console.log(selectedValue);

      // Отримуємо всі елементи з класом 'userResult'
      var userResults = document.querySelectorAll(".userResult");
      //console.log(userResults);
      // Перебираємо кожен елемент
      userResults.forEach(function (userResult) {
        userResult.style.display = "none";
        // Отримуємо елемент з класом 'userClass' в кожному блоку 'userResult'
        var userClassElement = userResult.querySelector(".userClass");

        // Перевіряємо, чи має 'userClass' значення '11-А'
        if (selectedValue === "Всі") {
          userResult.style.display = "flex";
        }

        if (userClassElement.textContent.trim() === selectedValue) {
          // Якщо так, відображаємо блок
          userResult.style.display = "flex";
        }
      });
    });

    
}
//[END] фільтрація класів за вибором

//[START] фільтрація підгрупи за вибором
function showResultOfSelectedSubGroup() {
  document
    .getElementById("selectSubGroup")
    .addEventListener("change", function (event) {
      var selectedValue = event.target.value;
      // console.log(selectedValue);

      // Отримуємо всі елементи з класом 'userResult'
      var userResults = document.querySelectorAll(".userResult");
      //console.log(userResults);
      // Перебираємо кожен елемент
      userResults.forEach(function (userResult) {
        userResult.style.display = "none";
        // Отримуємо елемент з класом 'userSubGroup' в кожному блоку 'userResult'
        var userSubGroupElement = userResult.querySelector(".userSubGroup");

        // Перевіряємо, чи має 'userClass' значення '11-А'
        if (selectedValue === "Всі") {
          userResult.style.display = "flex";
        }

        if (userSubGroupElement.textContent.trim() === selectedValue) {
          // Якщо так, відображаємо блок
          userResult.style.display = "flex";
        }
      });
    });
}
//[END] фільтрація підгрупи за вибором


// [START] Рейтинг______________________________________
async function showRating() {
  showResultOfSelectedClass();
  showResultOfSelectedSubGroup()

  // if (uid.exists) {
  //   //----------------
  //   const docRef = doc(db, 'main', uid);
  //   const templateDoc = await getDoc(docRef);
  // } else

  //----------------
  const docRef = doc(db, "main", "template");
  const templateDoc = await getDoc(docRef);

  if (templateDoc.exists) {
    // console.log('Document data:', templateDoc.data());
    var tasksList = templateDoc.data().tasks;
    //console.log("tasksList", tasksList);
  }
  //----------------

  // отримаує чергу для запиту документів з бази данних
  const q = query(collection(db, "main"), orderBy("userName"));

  // where('class', '==', userClass)
  // запитує документи з бази данних та повертає у вигляді масиву документів
  const querySnapshot = await getDocs(q);
  //console.log(querySnapshot);

  ////контейнер для відображення результатів
  const parentNode = document.querySelector("#userList");
  parentNode.innerText = ''
  //побудова заголовку таблиці
  let userDiv = document.createElement("div");
  userDiv.className = "userResult";
  userDiv.className = "divTasks";
  parentNode.insertAdjacentElement("beforeend", userDiv);

  //Відображення Прізвища та імені
  let divUserName = document.createElement("div");
  divUserName.className = "userName";
  divUserName.innerHTML = "Користувач";
  userDiv.insertAdjacentElement("afterbegin", divUserName);

  //Відображення Класу
  let divUserClass = document.createElement("div");
  divUserClass.className = "userClass";
  divUserClass.innerHTML = "Клас";
  userDiv.insertAdjacentElement("beforeend", divUserClass);

  //Відображення підгрупи
  let divUserSubGroup = document.createElement("div");
  divUserSubGroup.className = "userClass";
  divUserSubGroup.innerHTML = "Підгрупа";
  userDiv.insertAdjacentElement("beforeend", divUserSubGroup);

  //Відображення заголовку зі списком уроків
  Object.entries(tasksList)
    .sort()
    .forEach((property) => {
      //console.log(property[0]);
      let divLesson = document.createElement("div");
      divLesson.className = "divTaskResult";
      divLesson.innerText = property[0];
      userDiv.insertAdjacentElement("beforeend", divLesson);

      //графічне відображення прогресу https://ru.stackoverflow.com/questions/110066/%D0%9A%D0%B0%D0%BA-%D1%81%D0%B4%D0%B5%D0%BB%D0%B0%D1%82%D1%8C-%D1%84%D0%BE%D0%BD-%D0%B1%D0%BB%D0%BE%D0%BA%D0%B0-div-html-%D0%BD%D0%B5-%D0%B4%D0%BE-%D0%BA%D0%BE%D0%BD%D1%86%D0%B0
      //https://developer.mozilla.org/ru/docs/Web/HTML/Element/progress
      //<label for='file'></label>

      //результат виконання набору завдань 1
      //let divLessonResult = document.createElement('div');

      //divLessonResult.innerText = property[0]
      //divLesson.insertAdjacentElement('beforeend', divLessonResult);
    });

  // на кожний документ в масиві виконується ця функція створення вікна учня
  querySnapshot.forEach((doc) => {
    //console.log((doc.data()).userName);
    const userDoc = doc.data();
    //console.log(userDoc);

    const initialValue = 0;

    let userDiv = document.createElement("div");
    userDiv.className = "userResult";
    parentNode.insertAdjacentElement("beforeend", userDiv);

    //Відображення Прізвища та імені користувача
    let divUserName = document.createElement("div");
    divUserName.className = "userName";
    divUserName.innerHTML = userDoc.userName;
    userDiv.insertAdjacentElement("afterbegin", divUserName);

    //Відображення Класу користувача
    let divUserClass = document.createElement("div");
    divUserClass.className = "userClass";
    divUserClass.innerHTML = userDoc.userGroup;
    userDiv.insertAdjacentElement("beforeend", divUserClass);

    //Відображення підгрупи
    let divUserSubGroup = document.createElement("div");
    divUserSubGroup.className = "userClass userSubGroup";
    divUserSubGroup.innerHTML = userDoc.userSubGroup;
    userDiv.insertAdjacentElement("beforeend", divUserSubGroup);

    //
    Object.entries(tasksList)
      .sort()
      .forEach((property) => {
        //console.log(Object.entries(userDoc.tasks[property[0]]));
        //const array1 = []
        // if (Object.entries(userDoc.tasks[property[0]])) {
        const array1 = Object.entries(userDoc.tasks[property[0]]);
        //}

        //const array1 = Object.entries(userDoc.tasks['01_Form']);
        //console.log(userDoc.tasks);
        //---------------------------------------------
        // const array1 = Object.entries(userDoc.tasks[0]);
        // const array2 = Object.entries(userDoc.tasks).forEach( element => Object.entries(element));
        // const sumWithInitial = array1.reduce(
        //   (accumulator, currentValue) => accumulator + Number(currentValue[1]),
        //   initialValue
        // );
        //--------------------------------------------

        //const array2 = Object.entries(userDoc.tasks['02_Event']);
        // const array2 = Object.entries(userDoc.tasks).forEach( element => Object.entries(element));
        //let sumWithInitial = getAverageUserResult(array1);
        //console.log( Math.round(sumWithInitial));

        //функція обрахунку суми всіх значень по заданій назві завданню
        function getAverageUserResult(array) {
          return array.reduce(
            (accumulator, currentValue) =>
              accumulator + Number(currentValue[1]),
            initialValue
          );
        }

        //контейнер для відображення результатів виконання завдань учнем

        let divLesson = document.createElement("div");
        divLesson.className = "divTaskResult";
        userDiv.insertAdjacentElement("beforeend", divLesson);
        //userDiv.innerText = userDoc.userName;

        //результат виконання набору завдань 1
        // let divLessonResult = document.createElement('div');
        // divLessonResult.innerText =
        //   Math.round(getAverageUserResult(array1) / array1.length) + '%';
        // divLesson.insertAdjacentElement('beforeend', divLessonResult);
        //результат виконання завдання
        let h5TaskResult = document.createElement("h5");
        h5TaskResult.innerHTML =
          Math.round(getAverageUserResult(array1) / array1.length) + "%";
        divLesson.insertAdjacentElement("beforeend", h5TaskResult);

        //графічне відображення прогресу https://ru.stackoverflow.com/questions/110066/%D0%9A%D0%B0%D0%BA-%D1%81%D0%B4%D0%B5%D0%BB%D0%B0%D1%82%D1%8C-%D1%84%D0%BE%D0%BD-%D0%B1%D0%BB%D0%BE%D0%BA%D0%B0-div-html-%D0%BD%D0%B5-%D0%B4%D0%BE-%D0%BA%D0%BE%D0%BD%D1%86%D0%B0
        //https://developer.mozilla.org/ru/docs/Web/HTML/Element/progress
        //<label for='file'></label>
        let progress = document.createElement("progress");
        progress.min = 0;
        progress.max = 100;
        progress.value = Math.round(
          getAverageUserResult(array1) / array1.length
        );
        //progress.innerText = Math.round(sumWithInitial/array1.length) + '%';
        divLesson.insertAdjacentElement("beforeend", progress);
      });
  });
}
// [END]  ______________________________________

//отримати всю базу даних

//const q = doc(db, "main", "template");

//const querySnapshot = await getDoc(q);

//let us = [];

//const userDoc = querySnapshot.data();
//console.log(userDoc.tasks['01_Form']);
//us.push(userDoc);
//console.log(userDoc);
//   //console.log(Object.entries(userDoc.tasks['03_Button']));

//   let t = Object.entries(userDoc.tasks);
//   t.forEach((task) => {
//     //console.log(task[0]);
//   });

//   //отримуємо назви полів в базі даниїх
//   //const array1 = Object.entries(userDoc[1]);
//   // const array1 = Object.entries(userDoc.uid);

//   // const array1 = Object.entries(userDoc.class['11']);
//   //console.log(array1);
// });

//Видалення докумнтів з бази даних РОЗІБРАТИСЯ
//https://ru.stackoverflow.com/questions/1000534/%D0%9A%D0%B0%D0%BA-%D1%83%D0%B4%D0%B0%D0%BB%D0%B8%D1%82%D1%8C-%D0%B4%D0%BE%D0%BA%D1%83%D0%BC%D0%B5%D0%BD%D1%82-%D0%B8%D0%B7-firebase-%D0%BF%D0%BE-%D0%B5%D0%B3%D0%BE-id-%D0%B4%D0%B8%D0%BD%D0%B0%D0%BC%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%B8
