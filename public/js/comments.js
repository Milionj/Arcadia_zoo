// Ne pas exécuter le script si on n’est pas sur la home-page
if (!document.body.classList.contains('home-page')) {
  console.log("comments.js ignoré sur cette page");
  throw new Error("Page non concernée");
}


import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
import {
  getDatabase,
  ref,
  push,
  onValue,
  update,
  remove
} from "https://www.gstatic.com/firebasejs/9.6.1/firebase-database.js";

// Config Firebase
const firebaseConfig = {
  apiKey: "AIzaSyCh2rRfRQX-9sO3AGuf2mq_m38MQ2Qqh-w",
  authDomain: "arcadia-zoo-a25b6.firebaseapp.com",
  databaseURL: "https://arcadia-zoo-a25b6-default-rtdb.europe-west1.firebasedatabase.app/",
  projectId: "arcadia-zoo-a25b6",
  storageBucket: "arcadia-zoo-a25b6.appspot.com",
  messagingSenderId: "821383300302",
  appId: "1:821383300302:web:41f5db39052c09f151bc9f",
  measurementId: "G-74X790YMW0"
};

const app = initializeApp(firebaseConfig);
const db = getDatabase(app);

// Partie publique : Affichage des commentaires approuvés
const commentList = document.getElementById('comments-list');
onValue(ref(db, 'comments'), (snapshot) => {
  commentList.innerHTML = '';
  snapshot.forEach((child) => {
    const data = child.val();
    if (data.approved) {
      commentList.innerHTML += `
        <div class="comment">
          <strong>${data.email}</strong>
          <p>${data.message}</p>
        </div>
      `;
    }
  });
});

// Envoi d'un commentaire en attente de validation
const commentForm = document.getElementById('comment-form');
const confirmationMessage = document.getElementById('confirmation-message');

commentForm.addEventListener('submit', (e) => {
  e.preventDefault();
  const email = document.getElementById('email').value;
  const message = document.getElementById('message').value;

  push(ref(db, 'comments'), {
    email,
    message,
    approved: false
  });

  commentForm.reset();

  // Affichage du message de confirmation
  confirmationMessage.textContent = "Merci pour votre commentaire, il sera validé sous peu.";
  confirmationMessage.style.display = 'block';

  setTimeout(() => {
    confirmationMessage.style.display = 'none';
  }, 5000); // 5 secondes
});

// Partie modération : visible uniquement si l'employé est connecté (HTML présent)
const pendingList = document.getElementById('pending-comments-list');
if (pendingList) {
  onValue(ref(db, 'comments'), (snapshot) => {
    pendingList.innerHTML = '';
    snapshot.forEach((child) => {
      const data = child.val();
      const key = child.key;

      if (!data.approved) {
        pendingList.innerHTML += `
          <div class="comment-pending" data-id="${key}">
            <strong>${data.email}</strong>
            <p>${data.message}</p>
            <button onclick="approveComment('${key}')">Valider</button>
            <button onclick="deleteComment('${key}')">Supprimer</button>
          </div>
        `;
      }
    });
  });
}

// Fonctions de modération
window.approveComment = function(key) {
  const commentRef = ref(db, 'comments/' + key);
  update(commentRef, { approved: true });
};

window.deleteComment = function(key) {
  const commentRef = ref(db, 'comments/' + key);
  remove(commentRef);
};
