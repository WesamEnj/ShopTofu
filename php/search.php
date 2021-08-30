<?php

$link = mysqli_connect("localhost", "root", "", "tofushop");

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_REQUEST["term"])) {
    $sql = "SELECT * FROM articles WHERE name LIKE ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_term);

        $param_term = $_REQUEST["term"] . '%';

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Tofusorte</th>";
                    echo "<th>Preis</th>";
                    echo "<th>Deets</th>";
                    //echo "<th>Buy!</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    //echo "<td>" . $row["id"] . "</td>";
                    echo "</tr>";
                    echo "</table>";
                }
            } else {
                echo "<p>keine Tofus :(</p>";
            }
        } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($link);
