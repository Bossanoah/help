function filterTable() {
    let searchInput = document.getElementById("searchInput").value.toLowerCase();
    let statusFilter = document.getElementById("statusFilter").value;
    let table = document.getElementById("reservationTable");
    let rows = table.getElementsByTagName("tr");

    for (let i = 0; i < rows.length; i++) {
        let service = rows[i].getElementsByTagName("td")[0]?.textContent.toLowerCase();
        let status = rows[i].getElementsByTagName("td")[2]?.textContent;
        let showRow = true;

        if (searchInput && service.indexOf(searchInput) === -1) {
            showRow = false;
        }

        if (statusFilter && status !== statusFilter) {
            showRow = false;
        }

        rows[i].style.display = showRow ? "" : "none";
    }
}

function cancelReservation(reservationId) {
    if (confirm("Voulez-vous vraiment annuler cette réservation ?")) {
        window.location.href = "cancel_reservation.php?id=" + reservationId;
    }
}
