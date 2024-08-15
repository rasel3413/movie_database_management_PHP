<?php 

interface IMovie {
 
    public function getDescription($attribute, $conn,$searchValue);
    public function updateDetails($newDetails);
    public function saveToDatabase($conn);
}
?>