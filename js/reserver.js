
 document.addEventListener('DOMContentLoaded', function () {
    // Récupérer les éléments HTML nécessaires
    const form = document.querySelector('form');
    const dateDInput = document.getElementById('date_d');
    const dateFInput = document.getElementById('date_f');
    const heureSelect = document.getElementById('heure');
    const serviceSelect = document.getElementById('service_id');
    const prixElement = document.getElementById('prix');
    const durjElement = document.getElementById('durj');
    const durElement = document.getElementById('dur');
    const hdElement = document.getElementById('hd');
    const serElement = document.getElementById('ser');
    const phElement = document.getElementById('ph');
    const fsElement = document.getElementById('fs');
   

    // Fonction pour calculer la différence en jours entre deux dates
    function getDifferenceInDays(date1, date2) {
        const diffTime = date2 - date1; 
        return (diffTime / (1000 * 3600 * 24)) + 1; 
    }

    // Fonction pour récupérer les détails du service choisi via une requête AJAX
    async function getServiceDetails(serviceId) {
        // Effectuer une requête AJAX pour récupérer le prix par heure du service sélectionné
        const response = await fetch(`getService.php?service_id=${serviceId}`);
        const data = await response.json(); // Attendre la réponse en JSON
        return data.price_per_hour; // On suppose que le prix est dans la propriété `price_per_hour`
    }
    function convertToHour(){
        let [hours , minutes] = hourString.split(':').map(num =>parseInt(num));
        let Time = hours + (minutes / 60);
        return Time;
    }
    // Fonction pour mettre à jour les informations de la facture 
    function updateFacture() {
       
        const nom = document.getElementById('nom').value;
        const adresse = document.getElementById('adresse').value;
        const serviceId = serviceSelect.value;
        const TimeStart = document.getElementById('heure_d').value;
        const dateD = new Date(dateDInput.value);
        const dateF = new Date(dateFInput.value);
        const heures = parseFloat(heureSelect.value);
       /* const heure = convertToHour(heureSelect.value);*/

        // Mettre à jour la facture avec les informations récupérées
        document.getElementById('dat').textContent = new Date().toLocaleDateString(); 
        document.getElementById('ser').textContent = serviceSelect.options[serviceSelect.selectedIndex].text; 
        document.getElementById('datd').textContent = dateD.toLocaleDateString(); 
        durjElement.textContent = getDifferenceInDays(dateD, dateF).toFixed(0); 
        durElement.textContent = heures; 
        hdElement.textContent = TimeStart;
        const durj = getDifferenceInDays(dateD, dateF);

        // Récupérer le prix du service choisi via AJAX
        getServiceDetails(serviceId).then(pricePerHour => {
            phElement.textContent = `${pricePerHour} FCFA`; 
            const totalPrice = (pricePerHour * heures * durj) + 1000; 
            prixElement.textContent = `${totalPrice} FCFA`; 
            fsElement.textContent = " 1000 FCFA"; 
        });
    }

    // Fonction pour valider les dates
    function validateDates() {
        const today = new Date(); 
        const dateD = new Date(dateDInput.value); 
        const dateF = new Date(dateFInput.value); 
        const diffDays = getDifferenceInDays(today, dateD); 

      
        if (diffDays < 2) {
            alert('La date de début doit être à au moins 2 jours avant le jour de la prestation'); 
            return false; // Retourner false pour empêcher la soumission du formulaire
        }

        // Si la date de fin est avant la date de début
        if (dateF < dateD) {
            alert('La date de fin doit être après la date de début.'); 
            return false; 
        }
        return true; 
    }

    // Mettre à jour la facture lorsqu'une des entrées change
    dateDInput.addEventListener('change', function() {
        if (validateDates()) {
            updateFacture(); 
        }
    });

    dateFInput.addEventListener('change', function() {
        if (validateDates()) {
            updateFacture(); 
        }
    });

    heureSelect.addEventListener('change', updateFacture); 
    serviceSelect.addEventListener('change', updateFacture); 
   

    // Lorsque le formulaire est soumis, vérifier si les dates sont valides
    form.addEventListener('submit', function(event) {
        if (!validateDates()) {
            event.preventDefault(); // Empêcher la soumission du formulaire si les dates sont incorrectes
        }
    });
});

/*const urlParams = new URLSearchParams(window.location.search);
    const message = urlParams.get('message');
    if (message) {
        alert(message);
        window.history.replaceState(null, "", window.location.pathname); // Supprime le paramètre après l'affichage
    }*/

