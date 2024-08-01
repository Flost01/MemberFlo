<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$ide = $_GET['id_projet'];
$stmt = $pdo->query("SELECT * FROM projets WHERE id_projet=$ide");
$projet = $stmt->fetch(PDO::FETCH_ASSOC);

$use = $pdo->query('SELECT * FROM users');
$uses = $use->fetchAll(PDO::FETCH_ASSOC);

$tache = $pdo->query("SELECT * FROM users JOIN tache ON tache.id=users.id JOIN projets ON tache.id_projet=projets.id_projet WHERE tache.id_projet=$ide");
$taches = $tache->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les messages du projet
$stm = $pdo->prepare("SELECT * FROM chat JOIN users ON chat.user_id = users.id WHERE chat.project_id = ? ORDER BY chat.timestamp");
$stm->execute([$ide]);
$messages = $stm->fetchAll();
<<<<<<< HEAD

$currentUserId = $_SESSION['user_id'];
$notificationQuery = $pdo->prepare("SELECT * FROM notification WHERE user_id = ?");
$notificationQuery->execute([$currentUserId]);
$notifications = $notificationQuery->fetchAll(PDO::FETCH_ASSOC);
$nbre=count($notifications);

=======
>>>>>>> 161084213f9226283744fdd74cebc48852e929ab
include 'squelette.php';
?>
<main>
    <div class="modif">
        <h1 style="margin-left:1rem;"><?php echo htmlspecialchars($projet['nom_projet']); ?></h1>
        <?php if ($_SESSION['role'] == 'chef') : ?>
            <button id="addProjet">Ajouter<i class="ri-add-circle-line"></i></button>
        <?php endif; ?>
<<<<<<< HEAD
        <button id="notificationButton" class="but"><i class="ri-notification-2-fill"></i><?php echo $nbre ?></button>

    </div>
    <div id="notificationPopup" class="poo" style="display:none;">
        <h3>Notifications</h3>
        <ul id="notificationList">
            <?php foreach ($notifications as $notification) { ?>
                <li data-notification-id="<?php echo $notification['id_notif'] ?>"><?php echo htmlspecialchars($notification['texte']) ?><i class="ri-checkbox-circle-line" class="deleteNotif"></i></li>
            <?php } ?>
        </ul>
        <button onclick="closePopup()" class="but">Fermer</button>
    </div>
=======
    </div>

>>>>>>> 161084213f9226283744fdd74cebc48852e929ab
    <!-- Champ de recherche -->
    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Rechercher une tâche..." />
    </div>

    <div class="tab">
        <table id="taskTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom Tâche</th>
                    <th>Créé le</th>
                    <th>Délai</th>
                    <th>Utilisateur</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($taches as $ta) { ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo htmlspecialchars($ta['nom_tache']); ?></td>
                        <td><?php echo htmlspecialchars($ta['create_at']); ?></td>
                        <td><?php echo htmlspecialchars($ta['delai']); ?></td>
                        <td><?php echo htmlspecialchars($ta['name']); ?></td>
                        <td><?php echo htmlspecialchars($ta['statut']);
                            if ($_SESSION['role'] == 'chef' || $_SESSION['user_id'] == $ta['id']) {
                                if ($ta['statut'] == 'Enregistrée') { ?>
                                    <a href="modifier.php?id_tache=<?php echo htmlspecialchars($ta['id_tache']); ?>&id_projet=<?php echo htmlspecialchars($ta['id_projet']); ?>"><i class="ri-arrow-right-circle-line"></i></a>
                                <?php } else if ($ta['statut'] == 'En cours') { ?>
                                    <a href="terminer.php?id_tache=<?php echo htmlspecialchars($ta['id_tache']); ?>&id_projet=<?php echo htmlspecialchars($ta['id_projet']); ?>"><i class="ri-thumb-up-line"></i></a>
                        </td>
                    </tr>
        <?php
                                }
                            }
                            $i++;
                        } ?>
            </tbody>
        </table>
    </div>

    <div id="modalOverlay" style="display:none;">
        <div id="addModalProjet" class="mod">
            <form id="addProjetForm">
                <label for="name">Nom Tâche:</label>
                <input type="text" id="name" name="name" required>
                <label for="desc">Délai d'exécution:</label>
                <input type="date" id="delai" name="delai" required>
                <label for="user">Choisir un membre:</label>
                <select name="user" id="user">
                    <?php foreach ($uses as $use) { ?>
                        <option value="<?php echo htmlspecialchars($use['id']); ?>"><?php echo htmlspecialchars($use['name']); ?></option>
                    <?php } ?>
                </select>
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </div>
    <button id="openChatButton" class="chat-button" title="openChatButton"><i class="ri-chat-1-fill"></i></button>
    <!-- Modal de chat -->

    <div id="chatModal" class="modal" style="display:none;">
        <div class="modal-content">
            <div class="chat-header">
                <h3>Chat -<?php echo htmlspecialchars($projet['nom_projet']); ?></h3>
                <span class="close-button">&times;</span>
            </div>
            <div class="chat-messages" id="chatMessages">
                <?php foreach ($messages as $message) {
                    $currentUserId = $_SESSION['user_id'];
                    $messageClass = ($message['user_id'] == $currentUserId) ? 'my-message' : 'other-message'; ?>
                    <div class="chat">
                        <small><?php echo $message['name'] ?></small>
                        <div><?php echo $message['message'] ?></div>
                        <p><?php if ($message['image_path']) {
                                echo '<img src="' . htmlspecialchars($message['image_path']) . '" alt="Image" style="max-width: 100%; height: 20%;" />';
                            } ?></p>
                        <small><i><?php echo $message['timestamp'] ?></i></small><br>
                    </div>
                <?php } ?>
            </div>
            <div class="chat-input">
                <input type="text" id="chatInput" placeholder="Entrez votre message..." />
                <button id="emojiButton">😊</button>
                <button id="images"><i class="ri-image-add-line"></i></button>
                <button id="chatSendButton"><i class="ri-send-plane-fill"></i></button>
            </div>
            <!-- Popup pour l'envoi d'image -->
            <div id="imagePopup" class="popup" style="display:none">
                <div class="popup-content">
                    <div style="display:flex; justify-content: space-between;">
<<<<<<< HEAD
                        <h2>Envoyer une image</h2>
                        <span class="close-button" id="closePopup"><i class="ri-close-circle-fill"></i></span>
=======
                    <h2>Envoyer une image</h2>
                    <span class="close-button" id="closePopup"><i class="ri-close-circle-fill"></i></span>
>>>>>>> 161084213f9226283744fdd74cebc48852e929ab
                    </div>
                    <input type="file" id="chatImageInput" accept="image/*" />
                </div>
            </div>
            <div id="emojiMenu" class="emoji-menu" style="display: none;">
                <span class="emoji" data-emoji="😀">😀</span>
                <span class="emoji" data-emoji="😁">😁</span>
                <span class="emoji" data-emoji="😂">😂</span>
                <span class="emoji" data-emoji="😊">😊</span>
                <span class="emoji" data-emoji="😒">😒</span>
                <span class="emoji" data-emoji="🎉">🎉</span>
                <span class="emoji" data-emoji="🌈">🌈</span>
                <span class="emoji" data-emoji="😼">😼</span>
                <span class="emoji" data-emoji="👍">👍</span>
                <span class="emoji" data-emoji="😵‍💫">😵‍💫</span>
                <span class="emoji" data-emoji="😭">😭</span>
                <span class="emoji" data-emoji="😔">😔</span>
                <span class="emoji" data-emoji="😥">😥</span>
                <span class="emoji" data-emoji="😏">😏</span>
                <span class="emoji" data-emoji="😇">😇</span>
                <span class="emoji" data-emoji="😎">😎</span>
                <span class="emoji" data-emoji="🤒">🤒</span>
                <span class="emoji" data-emoji="🐇">🐇</span>
                <span class="emoji" data-emoji="💯">💯</span>
            </div>
        </div>
    </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojione/3.1.0/lib/js/emojione.min.js"></script>
<script>
<<<<<<< HEAD
    function openPopup() {
        document.getElementById('notificationPopup').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('notificationPopup').style.display = 'none';
    }

    document.getElementById('notificationButton').onclick = openPopup;
    document.getElementById('images').addEventListener('click', function() {
        // Ouvrir la popup
        document.getElementById('imagePopup').style.display = 'block';
    });

    // Fermer la popup
    document.getElementById('closePopup').addEventListener('click', function() {
        document.getElementById('imagePopup').style.display = 'none';
    });
=======
     document.getElementById('images').addEventListener('click', function() {
            // Ouvrir la popup
            document.getElementById('imagePopup').style.display = 'block';
        });

        // Fermer la popup
        document.getElementById('closePopup').addEventListener('click', function() {
            document.getElementById('imagePopup').style.display = 'none';
        });
>>>>>>> 161084213f9226283744fdd74cebc48852e929ab
    // Affichage de la modal de chat
    document.getElementById('openChatButton').onclick = function() {
        document.getElementById('chatModal').style.display = 'flex';
        // loadChatMessages();
    };

    // Fermeture de la modal
    document.querySelector('.close-button').onclick = function() {
        document.getElementById('chatModal').style.display = 'none';
    };

<<<<<<< HEAD
    // //supprimer une notification
    // const deleteNotifIcons = document.querySelectorAll('.deleteNotif');
    // deleteNotifIcons.forEach(icon => {
    //     icon.addEventListener('click', deleteNotification);
    // });

    // function deleteNotification(event) {
    //     // Récupérer l'élément <li> parent de l'icône cliquée
    //     const notificationItem = event.target.closest('li');

    //     const notificationId = notificationItem.dataset.notificationId;

    //     const xhr = new XMLHttpRequest();
    //     xhr.open('POST', 'check.php', true);
    //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    //             // Supprimer l'élément <li> de la liste des notifications
    //             notificationItem.remove();
    //         }
    //     };
    //     xhr.send('notification_id=' + encodeURIComponent(notificationId));
    // }
=======
>>>>>>> 161084213f9226283744fdd74cebc48852e929ab
    // Fonction de recherche instantanée avec AJAX
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value;

        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'search_tasks.php?query=' + encodeURIComponent(searchTerm) + '&id_projet=<?php echo $ide; ?>', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.querySelector('#taskTable tbody').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });

    // Fonction pour charger les tâches
    function loadTasks() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'tache_list.php?id_projet=<?php echo $ide; ?>', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.querySelector('#taskTable tbody').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    //enregistrement dans la bd
    document.getElementById('addProjetForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        formData.append('id_projet', <?php echo $ide; ?>); // Ajouter l'id_projet aux données du formulaire

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_tache.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                //alert('Tâche ajoutée avec succès !');
                document.getElementById('addProjetForm').reset(); // Réinitialiser le formulaire
                document.getElementById('modalOverlay').style.display = 'none';
                loadTasks();
            } else {
                alert('Une erreur est survenue lors de l\'ajout de la tâche.');
            }
        };
        xhr.send(formData);
    });

    document.getElementById('chatSendButton').addEventListener('click', function() {
        let chatInput = document.getElementById('chatInput');
        let message = chatInput.value.trim();
        const imageInput = document.getElementById('chatImageInput').files[0];

        // Créer un objet FormData pour envoyer le message et l'image
        let formData = new FormData();
        formData.append('message', message);

        // Ajouter l'image si elle existe
        if (imageInput) {
            formData.append('image', imageInput);
        }

        if (message !== '' || imageInput) {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'chat.php?project_id=<?php echo $ide; ?>', true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            chatInput.value = '';
                            document.getElementById('chatImageInput').value = '';
                            loadChatMessages();
                        } else {
                            console.error('Erreur lors de l\'envoi du message :', response.error);
                        }
                    } else {
                        console.error('Erreur de réseau:', xhr.statusText);
                    }
                }
            };
            xhr.send(formData);
        }
    });


    function loadChatMessages() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'chat.php?project_id=<?php echo $ide; ?>', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                let chatMessages = document.getElementById('chatMessages');
                chatMessages.innerHTML = xhr.responseText;
                // Faire défiler jusqu'au dernier message
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        };
        xhr.send();
    }

    // Mettre à jour les messages toutes les 5 secondes
    setInterval(loadChatMessages, 500);

    document.getElementById('emojiButton').addEventListener('click', function() {
        const emojiMenu = document.getElementById('emojiMenu');
        emojiMenu.style.display = emojiMenu.style.display === 'none' ? 'block' : 'none';
    });

    document.querySelectorAll('.emoji').forEach(item => {
        item.addEventListener('click', () => {
            const emoji = item.getAttribute('data-emoji');
            const chatInput = document.getElementById('chatInput');
            chatInput.value += emoji;
            document.getElementById('emojiMenu').style.display = 'none'; // Ferme le menu
        });
    });
    // Affichage de la modal
    document.getElementById('addProjet').onclick = function() {
        document.getElementById('modalOverlay').style.display = 'flex';
    };

    // Fermeture de la modal
    document.getElementById('modalOverlay').onclick = function(event) {
        if (event.target === this) {
            this.style.display = 'none';
        }
    };
</script>