<?php
include('config/db_connect.php');

if (isset($_POST['query'])) {
    $query = "SELECT * FROM meal_ideas WHERE mealName LIKE '{$_POST['query']}%' LIMIT 100";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($res = mysqli_fetch_array($result)) {
            echo '<div class="search-results d-flex align-items-center p-2"';
            echo '<span>' . $res['mealName'] . ' - ' . $res['ingredients'] . '</span>';
            echo '<img  src="data:image/jpeg;base64,' . base64_encode($res['mealImage']) . 'alt="' . $res['imageName'] . '" class="rounded"/>';
            echo '<button class="btn btn-primary"><a href="details.php?id= ' . $res['id'] . ' " class="text-light text-decoration-none">Details</a></button>';
            echo '</div>';
        }
    } else {
        echo "
        <div class='alert alert-danger mt-3 text-center'>
            Recipe not found.
        </div>
        ";
    }
}
