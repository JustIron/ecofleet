<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registrace uživatele</title>
    </head>
    <body>
        <h1>Zaregistrujte se, prosím.</h1> <br />
        <?php
        require_once('Db.php');
        Db::connect('127.0.0.1', 'ukol_ecofleet', 'root', '');
        if ($_POST)
        {
                        $datum = date("Y-m-d H:i:s", strtotime($_POST['datum_narozeni']));
                        Db::query('
                                INSERT INTO uzivatele (jmeno, prijmeni, datum_narozeni)
                                VALUES (?, ?, ?)
                        ', $_POST['jmeno'], $_POST['prijmeni'], $datum);

                        echo('<p>Byl jste úspěšně zaregistrován.</p>');
                }
                $uzivatele = Db::queryAll('
                SELECT *
                FROM uzivatele
        ');
        echo('<h2>Uživatelé</h2><table border="1">');
        foreach ($uzivatele as $u)
        {
                echo('<tr><td>' . htmlspecialchars($u['jmeno']));
                echo('</td><td>' . htmlspecialchars($u['prijmeni']));
                $datum = date("d.m.Y", strtotime($u['datum_narozeni']));
                echo('</td><td>' . htmlspecialchars($datum));
                
                echo('</td></tr>');
        }
        echo('</table>');
        ?>
        
        
        <form method="post">
            Jméno:<br />
            <input type="text" name="jmeno" /><br />
            Příjmení: <br />
            <input type="text" name="prijmeni" /><br />
            Datum narození: <br />
            <input type="text" name="datum_narozeni" /><br />
            <input type="submit" value="registrovat" />
        </form>
    </body>
</html>
