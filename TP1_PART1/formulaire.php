<?php
session_start();
$d = $_SESSION['data'] ?? [];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulaire</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 style="text-align: center;">Fiche de Renseignements</h1>
    <form action="recap.php" method="POST" enctype="multipart/form-data"  >
        <fieldset>
            <legend>Renseignements Personnels</legend>
            Nom : <input type="text" name="nom" value="<?= htmlspecialchars($d['nom'] ?? '') ?>">
            <br><br>
            Prénom :<input type="text" name="prenom" value="<?= htmlspecialchars($d['prenom'] ?? '') ?>">
            <br><br>
            Age :<input type="number" name="age" value="<?= htmlspecialchars($d['age'] ?? '') ?>">
            <br><br>
            Numero de Telephone : <input type="tel" name="telephone" value="<?= htmlspecialchars($d['telephone'] ?? '') ?>">
            <br><br>
            Email : <input type="email" name="email" value="<?= htmlspecialchars($d['email'] ?? '') ?>">
        </fieldset>

        <fieldset>
            <legend>Renseignements Academique</legend>
            <p style="text-align: center;">Vous etes en :</p> <br>
            <div class="filiere" >
            
            2AP: <input type="radio"  name="filiere" value="2AP" <?= ($d['filiere'] ?? '') === '2AP' ? 'checked' : '' ?>>
            GSTR: <input type="radio" name="filiere"  value="GSTR" <?= ($d['filiere'] ?? '') === 'GSTR' ? 'checked' : '' ?>>
            GI: <input type="radio" name="filiere" value="GI" <?= ($d['filiere'] ?? '') === 'GI' ? 'checked' : '' ?>>
            SCM: <input type="radio" name="filiere" value="SCM" <?= ($d['filiere'] ?? '') === 'SCM' ? 'checked' : '' ?>>
            GC: <input type="radio" name="filiere" value="GC" <?= ($d['filiere'] ?? '') === 'GC' ? 'checked' : '' ?>>
            MS: <input type="radio" name="filiere" value="MS" <?= ($d['filiere'] ?? '') === 'MS' ? 'checked' : '' ?>>
</div>
            <div class="annee">
            
        1èr annee: <input type="radio"  name="annee" value="1èr annee" <?= ($d['annee'] ?? '') === '1èr annee' ? 'checked' : '' ?>>
        2ème annee: <input type="radio" name="annee"  value="2ème annee" <?= ($d['annee'] ?? '') === '2ème annee' ? 'checked' : '' ?>>
        3ème annee: <input type="radio" name="annee" value="3ème annee" <?= ($d['annee'] ?? '') === '3ème annee' ? 'checked' : '' ?>>
            
</div>

            <div class="Modules">
             <p style="text-align: center;">Modules suivies cette annee :</p> <br>

            Pro Av: <input type="checkbox"  name="Modules[]" value="Pro Av" <?= in_array('Pro Av', $d['Modules'] ?? []) ? 'checked' : '' ?>>
            Compilation: <input type="checkbox" name="Modules[]"  value="Compilation" <?= in_array('Compilation', $d['Modules'] ?? []) ? 'checked' : '' ?>>
            reseaux Av: <input type="checkbox" name="Modules[]" value="reseaux Av" <?= in_array('reseaux Av', $d['Modules'] ?? []) ? 'checked' : '' ?>>
            Web Avancee: <input type="checkbox"  name="Modules[]" value="Web Avancee" <?= in_array('Web Avancee', $d['Modules'] ?? []) ? 'checked' : '' ?>>
            POO: <input type="checkbox" name="Modules[]"  value="POO" <?= in_array('POO', $d['Modules'] ?? []) ? 'checked' : '' ?>>
            BD: <input type="checkbox" name="Modules[]" value="BD" <?= in_array('BD', $d['Modules'] ?? []) ? 'checked' : '' ?>>
            </div>
            <br><br>
            <label >Nombre de projets réalisés cette année:</label>
            <select id="nombre_projets" name="nombre_projets" >
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
</select>
            </fieldset>

<fieldset>
    <legend>Projets et stages</legend>

    <div id="projets-container"></div>

    <button type="button" onclick="ajouterProjet()">
        Ajouter un projet ou stage
    </button>
</fieldset>

<fieldset>
    <legend>Centres d'intérêt</legend>
    Centres d'intérêt :<textarea name="interets"><?= htmlspecialchars($d['interets'] ?? '') ?></textarea>
</fieldset>

<fieldset>
    <legend>Compétences et Langues</legend>
    Compétences : <textarea name="competences"><?= htmlspecialchars($d['competences'] ?? '') ?></textarea>

    <br><br>
    Langues : <textarea name="langues"><?= htmlspecialchars($d['langues'] ?? '') ?></textarea>

</fieldset>

    <fieldset>
         Vos remarques <textarea name="remarques"><?= htmlspecialchars($d['remarques'] ?? '') ?></textarea>
        <br>
          <input type="file" name="fichier" >
</fieldset>
<br>
<button type="submit">Envoyer</button>
<button type="reset">Effacer</button>
</form>

<script>

function ajouterProjet() {

    let container = document.getElementById("projets-container");

    let projet = document.createElement("div");

    projet.innerHTML = `
        <hr>

        <h3>Projet / Stage</h3>

        <label>Type :</label>
        <select name="type[]">
            <option value="Projet">Projet</option>
            <option value="Stage">Stage</option>
        </select>

        <br><br>

        <label>Date de début :</label>
        <input type="date" name="date_debut[]">

        <br><br>

        <label>Date de fin :</label>
        <input type="date" name="date_fin[]">

        <br><br>

        <label>Lieu :</label>
        <input type="text" name="lieu[]">

        <br><br>

        <label>Description :</label><br>
        <textarea name="description[]"></textarea>

         <br><br>
        <button type="button" onclick="this.parentElement.remove()">Supprimer</button>

    `;

    container.appendChild(projet);
    return projet;
}



function creerProjets() {
    let nombre = parseInt(document.getElementById("nombre_projets").value);
    let container = document.getElementById("projets-container");

    while (container.children.length < nombre) {
        ajouterProjet();
    }

    while (container.children.length > nombre) {
        container.removeChild(container.lastElementChild);
    }
}


const saved = <?= json_encode($d) ?>;

window.addEventListener('load', function () {
    (saved.type || []).forEach(function (t, i) {
        let p = ajouterProjet();
        p.querySelector('[name="type[]"]').value = t;
        p.querySelector('[name="date_debut[]"]').value = saved.date_debut[i];
        p.querySelector('[name="date_fin[]"]').value = saved.date_fin[i];
        p.querySelector('[name="lieu[]"]').value = saved.lieu[i];
        p.querySelector('[name="description[]"]').value = saved.description[i];
    });
    document.getElementById("nombre_projets").value = saved.nombre_projets || 0;
});

</script>



</body>
</html>