const hamburger = document.querySelector("#toggle-btn");

hamburger.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("expand");
});

//Liste dans le menu client
function toggleDropdown(menuId) {
    var dropdownMenu = document.getElementById(menuId);
    dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
}

//Update des employés
function openEditModal() {
    // Récupérer les données de l'employé à éditer (si nécessaire) et les afficher dans la fenêtre modale
    // Vous pouvez utiliser AJAX pour récupérer les données de l'employé à partir du serveur si elles ne sont pas déjà chargées
    // Une fois que vous avez les données de l'employé, vous pouvez les afficher dans la fenêtre modale
    // Ensuite, ouvrez la fenêtre modale avec JavaScript, par exemple :
    $('#exampleModal2').modal('show');
}

//Sweet Alert ==> Delete employee
$(document).on('click', '#suppression', function(){
    var numEmp = $(this).closest('td').attr('id'); // Récupérer l'identifiant de l'employé à supprimer
    console.log(numEmp);
    Swal.fire({
        title: "Êtes-vous sûr(e)?",
        text: "Vous ne pourrez pas revenir en arrière!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Oui, supprimez-le!",
        cancelButtonText: "Annuler"
      }).then((result) => {
        if (result.isConfirmed) {
          // Effectuer une requête AJAX pour supprimer l'employé de la base de données
          $.ajax({
            type: 'POST',
            url: 'Delete_Employe.php',
            data: { numEmp: numEmp },
            success: function(response) {
                // Afficher une boîte de dialogue de succès
                Swal.fire({
                    title: "Supprimer!",
                    text: "Cet(te) employé(e) a été supprimé(e)",
                    icon: "success"
                }).then(() => {
                    // Recharger la page après la suppression
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Afficher une boîte de dialogue d'erreur
                Swal.fire({
                    title: "Error!",
                    text: "An error occurred while deleting the employee.",
                    icon: "error"
                });
            }
          });
        }
      });
});

//Sweet Alert ==> Delete lieu
$(document).on('click', '#supprimer', function(){
    var idlieu = $(this).closest('td').attr('id'); // Récupérer l'identifiant du lieu à supprimer
    Swal.fire({
        title: "Êtes-vous sûr(e)?",
        text: "Vous ne pourrez pas revenir en arrière!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Oui, supprimez-le!",
        cancelButtonText: "Annuler"
    }).then((result) => {
        if (result.isConfirmed) {
        // Effectuer une requête AJAX pour supprimer le lieu de la base de données
        $.ajax({
            type: 'POST',
            url: 'Delete_Lieu.php',
            data: { idlieu: idlieu },
            success: function(response) {
                // Afficher une boîte de dialogue de succès
                Swal.fire({
                    title: "Supprimer!",
                    text: "Ce lieu a été supprimé",
                    icon: "success"
                }).then(() => {
                    // Recharger la page après la suppression
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Afficher une boîte de dialogue d'erreur
                Swal.fire({
                    title: "Error!",
                    text: "An error occurred while deleting the place.",
                    icon: "error"
                });
            }
        });
        }
    });
});
