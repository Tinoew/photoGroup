<?php
include_once 'includes/head.php';
include_once 'functions/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>
    <form method="post" action="" id="searchForm">
        <input type="text" name="zoek" placeholder="Search for a name">
        <button type="submit" name="zoeken">Search</button>
        <button type="button" onclick="resetSearch()">Reset</button>
    </form>

    <?php
    if (!isset($_POST['zoeken'])) {
        $sql = "SELECT title FROM images";
        $conn = dbConnect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        foreach ($result as $title) {
            echo "Title: " . $title['title'] . "<br>";
            echo "<br>";
        }
    } 
    else {
        $zoeken = $_POST['zoek'];

        $sql = "SELECT title FROM images WHERE title LIKE :zoek";
        $conn = dbConnect();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':zoek', $zoeken);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();

        foreach ($result as $title) {
            echo "Title: " . $title['title'] . "<br>";
            echo "<br>";
        }
    }

    if(!isset($_POST['zoeken'])) {
        if(!isset($_GET['sorteren'])) {
            $sql = "SELECT naam, email FROM persons";
        } elseif($_GET['sorteren'] == "asc") {
            $sql = "SELECT naam, email FROM persons ORDER BY naam ASC";
        } elseif($_GET['sorteren'] == "desc") {
            $sql = "SELECT naam, email FROM persons ORDER BY naam DESC";
        }
    }

    ?>

    <script>
        function resetSearch() {
            document.getElementsByName('zoek')[0].value = '';
            document.getElementById('searchForm').submit();
        }
    </script>
</body>

</html>
