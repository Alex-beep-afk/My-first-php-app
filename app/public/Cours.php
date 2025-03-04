<!-- Balise html -->
<h1>hello</h1>
<!-- Balise php -->
<?php echo 'Hello World'; ?>
<!-- Balise php abrégée meme fonction que celle d'au dessus mais plus courte uniquement pour echo-->
<?="Hello World";?>
<?php
// Déclaration de variable
$firstName = 'John';
$lastName = 'Doe';
// Methode de concatenation
echo $firstName .''.$lastName;
// balise de debogage pour afficher les infos de ton environnement php
// phpinfo();
?>
<?php
// Déclaration de variable 
$val1 = 10;
$val2 = 20;
// Addition de variable
$resultat = $val1 + $val2;
// Affichage du resultat
echo $resultat;
// Incrementation de variable
$val1 += 20;
// Affichage de la variable
echo $val1;
?>

<?php
// Déclaration de variable
$age = 19;
// ouverture d'une structure conditionnelle avec une balise echo
if ($age >= 18) {
    echo 'Vous êtes majeur';
} else {
    echo 'Vous êtes mineur';
}
?>
<!-- Ouverture d'une structure conditionnelle -->
<?php if ($age >= 18): ?>
    <!-- Condition du if -->
    <h1>Vous êtes majeur</h1>
<?php else: ?>
    <!-- Condition du else -->
    <h1>Vous êtes mineur</h1>
<?php endif; ?>
<!-- Fermeture de la structure conditionnelle -->

<?php
// Déclaration de variable
$userAge = 19;

// ternaires

?>

<?php
// Déclaration de variable tableau
$user1 =['Alexandre', 'Prigent', 33 , 'alexandre.prigent@test.com'];
// Afficher la valeur d'un element du tableau
echo $user1[0];
// Afficher toutes les valeurs du tableau avec une boucle
foreach ($user1 as $value) {
    echo "$value<br>";
}
?>
<?php
// Déclaration de variable tableau associatif
$user1 = [
    'firstName' => 'Alexandre',
    'lastName' => 'Prigent',
    'age' => 33,
    'email' => 'alexandre.prigent@test.com',
];
// Afficher la valeur d'un element du tableau associatif
echo $user1['firstName'];
// Afficher toutes les valeurs du tableau associatif avec une boucle
foreach ($user1 as $info){
    echo "$info<br>";
}
foreach ($user1 as $key => $value) {
    echo "$key : $value<br>";
}
// Deboguer un tableau
// Permet d'afficher les informations d'un tableau de maniere plus lisible
var_dump($user1);

// Trois fonctions pour rechercher dans un tableau
// in_array() : permet de rechercher une valeur dans un tableau
if (in_array('Alexandre', $user1)) {
    echo 'Trouvé';
} else {
    echo 'Non trouvé';
}
?>
<?php
// Déclaration de variable tableau associatif
$users = [
    [
        'firstName' => 'Alexandre',
        'lastName' => 'Prigent',
        'age' => 33,
        'email' => 'Alexandre.Prigent@test.com',
        'actif' => true,],
        [ 
        'firstName' => 'John',
        'lastName' => 'Doe',
        'age' => 25,
        'email' => 'John.Doe@test.com',
        'actif' => false,],
        [
        'firstName' => 'Jane',
        'lastName' => 'Doe',
        'age' => 30,
        'email' => 'Jane.Doe@test.com',
        'actif' => true,
        ],
        ];
?>
<!-- Creation d'une boucle foreach pour afficher les données de mon tableau users -->
<?php foreach($users as $user): ?>
    <div class ="card-user">
        <h1 class="card-title"><?= $user['firstName']; ?></h1>
        <p>
            Age:
            <?= $user['lastName']; ?> 
        </p>
        <p>
            Email:
            <?= $user['email']; ?>
        </p>
        <p>
            Actif:
            <?= $user['actif'] ? 'Oui' : 'Non'; ?>
        </p>
    </div>
<?php endforeach; ?>

<?php
// Déclaration de fonction
// function nomDeLaFonction(parametre1, parametre2, ...):type de retour(string/bool/int/float/void=rien) {
//     code de la fonction
// }
function bonjour(string $firstName): void
{
    echo 'Bonjour'.' '. $firstName;
}
// Appel de la fonction
// ! Non sensible à la casse mais pour la lisibilité du code il est préférable de respecter la casse
bonjour('Alexandre');
?>
<?php
function checkUserEnabled(array $user):bool {
    return $user['actif'];
}
?>

<?php foreach ($users as $user): ?>
    <?php if (checkUserEnabled($user)): ?>
        <h1><?= $user['firstName']; ?></h1>
    <?php endif; ?>
<?php endforeach; ?>

    

