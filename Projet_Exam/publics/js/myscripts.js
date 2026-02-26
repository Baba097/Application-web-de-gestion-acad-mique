
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".niveau").forEach(function(niveauSelect){

        niveauSelect.addEventListener("change", function(){

            let id_niveau = this.value;
            let form = this.closest("form");
            let classeSelect = form.querySelector(".classe");

            classeSelect.innerHTML = '<option value="">Chargement...</option>';

            if(id_niveau !== ""){

                fetch("http://localhost/php%20project/Projet_Exam/traitements/actions.php?id_niveau=" + id_niveau)
                .then(response => response.json())
                .then(data => {

                    classeSelect.innerHTML = '<option value="">-- Choisir une classe --</option>';

                    if(data.length === 0){
                        classeSelect.innerHTML = '<option value="">Aucune classe disponible</option>';
                        return;
                    }

                    data.forEach(function(classe){
                        let option = document.createElement("option");
                        option.value = classe.id_classe;
                        option.textContent = classe.codeClasse;
                        option.title = classe.nomClasse;
                        classeSelect.appendChild(option);
                    });

                })
                .catch(error => {
                    console.error("Erreur :", error);
                    classeSelect.innerHTML = '<option value="">Erreur de chargement</option>';
                });

            } else {
                classeSelect.innerHTML = '<option value="">-- Choisir une classe --</option>';
            }

        });

    });

});


document.addEventListener("DOMContentLoaded", function(){
    

    const codeInput = document.querySelector(".code_evalu");
    const matriculeInput = document.querySelector(".matricule");
    const moduleInput = document.querySelector(".code_modu");

    codeInput.addEventListener("blur", function(){

        let code = this.value.trim();

        if(code === ""){
            matriculeInput.value = "";
            moduleInput.value = "";
            return;
        }

        fetch("http://localhost/php%20project/Projet_Exam/traitements/actions.php?code_evalu=" + code)
        .then(response => response.json())
        .then(data => {

            if(Object.keys(data).length === 0){
                matriculeInput.value = "";
                moduleInput.value = "";
                alert("Aucune évaluation trouvée !");
                return;
            }

            matriculeInput.value = data.matricule;
            moduleInput.value = data.code_modu;

        })
        .catch(error => {
            console.error("Erreur :", error);
        });

    });

});
