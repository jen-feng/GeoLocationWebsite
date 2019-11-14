<?php include "../inc/dbinfo.inc"; ?>
<?php 
    // using php data objects we set the login parameters for the database. 
    // More information here: https://www.php.net/manual/en/intro.pdo.php
    $pdo = new PDO('mysql:host=localhost;dbname=test', DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['email']) && isset($_POST['password'])){

        // Query we are using to check if the user is legit
        $sql = "INSERT INTO users (Email, FirstName, LastName, Password) VALUES (?, ?, ?, ?)";

        // Prepared statements: For when we don't have all the parameters so we store a template to be executed
        // More information here: https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        $stmnt = $pdo->prepare($sql);
        try {
            $stmnt->execute([$_POST['email'], $_POST['password'], $_POST['firstname'], $_POST['lastname']]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // Redirect to login page
        header("Location: ../registerSuccessPage.php");

    } else {
        // This path is dependent on where the root of your documents is located.
        // For this it is made to point back to the register file if registering has failed.
        header("Location: ../registration.php");
    }
?>