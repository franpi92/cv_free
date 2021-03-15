<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:dt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 14">
<meta name=Originator content="Microsoft Word 14">
<link rel="stylesheet" media="screen" type="text/css" title="Exemple" href="global.css"/>

<title><?php echo "CV de François DORN"?></title>

</head>

<body lang=FR width=700px>
 <!-------------------------------------------------------
 	ETAT CIVIL 
 !------------------------------------------------------->
        <div class="WordSection1">
	<h1><a name="_Toc1">_____________________________________________________________________________________________
	</a><o:p></o:p></h1>

	<div id="photo_cv">
            <img width=240px height=240px
               src="img/image002.jpg"
               alt="Description&nbsp;: PhotoFDornSftt">
        </div>
 
<?php
// ---------------------------
// Connection à la Base MySql
// ---------------------------
$serveur = 'localhost';
$login = 'root';
$mot_de_passe = '';
$base_de_donnees = 'fdo';
$pdo = new PDO('mysql:host='.$serveur.';dbname='.$base_de_donnees, $login, $mot_de_passe);
$type_precedent='';

$requete = 'SELECT * FROM cv ORDER BY ID';
$requete_preparee = $pdo->prepare($requete);
$requete_preparee->execute();
$i=0;

while ($row = $requete_preparee->fetch())
{   $texte = utf8_encode($row['Descriptif']."<br>");
    $date_debut = $row['Date_debut'];
    $date_fin = $row['Date_fin'];
    $type_paragraphe = $row['Type_paragraphe'];
    $i++;

    if ( (($type_precedent == 'sous-tache') || ($type_precedent == 'Tache')) && ($type_paragraphe != $type_precedent))
    {
        echo "\n</ul>";
    }
    switch($type_paragraphe)
    {
        case 'Etat_civil':
            if ($type_paragraphe != $type_precedent)
            {
                echo "\n <div id=\"Colonne-etat-civil\"><p><o:p>&nbsp;</o:p></p>";
                $type_precedent = $type_paragraphe;
            } 
            echo "\n<p>".$texte."<o:p></o:p></p>";
            break;
        case 'Titre':
            if ($type_paragraphe != $type_precedent)
            {
                echo "\n</div>";
                echo "\n<h1 <a name=\"_Toc$i\">_____________________________________________________________________________________________</a><o:p></o:p></h1>";
                $type_precedent = $type_paragraphe;
            } 
            echo "\n<p><b>".$texte."<o:p></o:p></b></p>";
            break; 
        case 'Titre_competences':
            if ($type_paragraphe != $type_precedent)
            {
                echo "\n</div>";
                echo "\n<h1 <a name=\"_Toc$i\">_____________________________________________________________________________________________</a><o:p></o:p></h1>";
                $type_precedent = $type_paragraphe;
            } 
            echo "\n<p><b>".$texte."<o:p></o:p></b></p>";
            break;              
        case 'Competence':
            if ($type_paragraphe != $type_precedent)
            {
                echo "\n <div id=\"Colonne-types-competences\"><p><o:p>&nbsp;</o:p></p>";
                $type_precedent = $type_paragraphe;
            } 
            echo "\n<p>".$texte."<o:p></o:p></p>";
            break;
        case 'Descriptif_competence':
            if ($type_paragraphe != $type_precedent)
            {
                echo "\n </div>";
                echo "\n <div id=\"Colonne-competences\"><p><o:p>&nbsp;</o:p></p>";
                $type_precedent = $type_paragraphe;
            } 
            echo "\n<p>".$texte."<o:p></o:p></p>";
            break;
        case 'Nom_client':
            if ($type_paragraphe != $type_precedent)
            {
                echo "\n </div>";
                if ($type_precedent=="Descriptif_competence") 
                {
                    echo "\n<h1 <a name=\"_Toc$i\">_____________________________________________________________________________________________</a><o:p></o:p></h1>";
                    echo "\n<p><b>EXPERIENCES<o:p></o:p></b></p>";
                }
                else echo "<div class=\"WordSection1\"><p><h1>&nbsp;</h1></p>";
                echo "\n<div id=\"Colonne-dates\">";
		echo "\n<b>".$date_debut." à ".$date_fin."</b>";
                echo "\n </div>";
                echo "\n <div id=\"Colonne-experiences\">";
                $type_precedent = $type_paragraphe;
            } 
            echo "\n<b>".$texte."<o:p></o:p></b>";
            break;
        case 'Type_experience':
            echo "\n<h4><br>".$texte."</h4>";
            $type_precedent = $type_paragraphe;
            break;
        case 'Titre_mission':
            echo "\n<h5>&nbsp;&nbsp;&nbsp;&nbsp;".$texte."</h5>";
            $type_precedent = $type_paragraphe;
            break;
        case 'Tache':
            if ($type_paragraphe != $type_precedent)
                echo "\n<ul>";
            echo "\n<li>".$texte."</li>";
            $type_precedent = $type_paragraphe;
            break;
        case 'sous_tache':
            echo "\n<ul><li>".$texte."</li></ul>";
            $type_precedent = $type_paragraphe;
            break;
        default:   
            echo "\n<p>".$texte."<o:p></o:p></p>";
            break;
    }
}
?>
        </div>
    </div>
</body>
</html>
