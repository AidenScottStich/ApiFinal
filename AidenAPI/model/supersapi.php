<?php



header('Content-Type: application/json');
include "database.php";
global $db;

$sql = "SELECT * FROM super";

$action = filter_input(INPUT_GET, 'action');

// this sees if there is a action then puts the action name into the variable
$action ? $action : $action = filter_input(INPUT_POST, 'action');

// The switch statement will look to see which action has been taken
switch ($action) {
    // Add will take in to parameters and that is superName and imageName
    case 'add':
        if (isset($_GET['superName']) && isset($_GET['imageName'])) {
            // This is the sql statement for inserting that superhero
            $sql2 = "INSERT INTO super (`Super_Name`, `Super_Image`) VALUES (:superName, :imageName)";
        
            // This conbines our parameters in the sql statement
            $stmt = $db->prepare($sql2);
            $stmt->bindValue(':superName', filter_input(INPUT_GET, 'superName', FILTER_SANITIZE_SPECIAL_CHARS));
            $stmt->bindValue(':imageName', filter_input(INPUT_GET, 'imageName', FILTER_SANITIZE_SPECIAL_CHARS));
    
            // This will execute our sql in the database
            $stmt->execute();
            
            // Optionally, you can fetch and display it in the console
            $qry = $stmt->fetchAll();
            echo json_encode($qry);
        } 
        break;

        // If the change was an edit and it will take the parameters and then put them into the sql statement and bind them. then execute
        case 'edit':
            if (isset($_GET['superId']) && isset($_GET['superName']) && isset($_GET['imageName'])) {
                $superId = filter_input(INPUT_GET, 'superId', FILTER_SANITIZE_SPECIAL_CHARS);
                $superName = filter_input(INPUT_GET, 'superName', FILTER_SANITIZE_SPECIAL_CHARS);
                $imageName = filter_input(INPUT_GET, 'imageName', FILTER_SANITIZE_SPECIAL_CHARS);
        
                $sql = "UPDATE super SET Super_Name = :superName, Super_Image = :imageName WHERE Super_ID = :superId";
                
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':superId', $superId);
                $stmt->bindValue(':superName', $superName);
                $stmt->bindValue(':imageName', $imageName);
                $stmt->execute();
            } 
            break;

            // This is if a delete function is called and it will delete the row form the database with the id parameter
        case 'delete':
            if (isset($_GET['superId'])) {
                $sql = "DELETE FROM super WHERE Super_ID = :id";
            
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':id', filter_input(INPUT_GET, 'superId', FILTER_SANITIZE_SPECIAL_CHARS));
                $stmt->execute();

                
            } 
            break;

    default:
        // Default case for fetching data
        $qry = $db->query($sql)->fetchAll();
        echo json_encode($qry);
        break;
}
?>