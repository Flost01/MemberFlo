document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("registrationForm");

    form.addEventListener("submit", function(event) {
        let valid = true;
        let messages = [];

        // Récupérer les valeurs des champs
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value;

        // Validation du nom
        if (name === "") {
            valid = false;
            messages.push("Le nom est requis.");
        }

        // Validation de l'email
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            valid = false;
            messages.push("Veuillez entrer une adresse email valide.");
        }

        // Validation du mot de passe
        function validatePassword(pwd) {
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        
            if (passwordPattern.test(pwd)) {
                console.log("Le mot de passe est valide.");
                return true;
            } else {
                console.log("Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.");
                return false;
            }
        }
        
        if (!validatePassword(password)) {
            valid = false;
            messages.push("Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.");
        }

        // Afficher les messages d'erreur si le formulaire n'est pas valide
        if (!valid) {
            event.preventDefault(); 
            alert(messages.join("\n")); 
        }
    });
});