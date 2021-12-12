<!DOCTYPE html>

<head>
    <title>Search Results</title>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #main {
            text-align: center;
        }

        div h2 {
            width: 100%;
            display: inline-block;
            padding-top: 0px;
        }

        .imgHolder {
            width: 100%;
        }

        .boxart {
            height: 150px;
            padding-left: 30px;
            padding-right: 30px;
        }

        div.item {
            vertical-align: top;
            display: inline-block;
            text-align: center;
            width: 200px;
        }
        .caption {
            display: block;
        }
    </style>
</head>

<body>
    
 <div class="topnav">
    <a href = "index.html"><img src="vidisite.png" width="30" height="15"> </a>
    <a href="form.html">Catalog</a>
    <a href="services.html">Our Services</a>
    <a href="jobs.html">Careers</a>
    <a href="contact.html">Contact Us</a>
</div>
<div class="spacer">a</div>

    <div id="image"></div>
<div id="mainbody">
    <div id="main">
        <h1 style="display: inline-block;">Search Results</h1><br>
        <a class="button" href="form.html">Back to Form</a><br><br>
        <div class="imgHolder">
<?php

    $server = "sql307.epizy.com";
    $userid = "epiz_29659974";
    $pw = "Tc5yso93uDR";
    $db = "epiz_29659974_vidisite";

    $conn = new mysqli($server, $userid, $pw);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->select_db($db);

    extract($_POST);

    $sql = "SELECT * FROM games 
            WHERE price<=" . $_POST["price"]
         . " AND releaseyear<=" . $_POST["years"];
    
    if ($_POST["platform"] != "any") {
        $sql .= " AND platform='" . $_POST["platform"] . "'";
    }

    $result = $conn->query($sql);
    echo "$result->num_rows result(s) found.<br><br>";

    if ($result->num_rows > 0) {
        $s = "";
        while ($row = $result->fetch_assoc()) {
            $s .= "<div class='item'>";
            $s .= "<img class='boxart' src='imagefolder/" . $row["imageaddress"] . "'>";
            $s .= "<span class='caption'></span>";
            $s .= "<b>" . $row["name"] . "</b><br>";
            $s .= "$" . $row["price"] . "<br>";
            $s .= $row["platform"] . "<br>";
            $s .= "Released " . $row["releaseyear"] . "<br>";
            $s .= "<br>";
            $s .= "</div>";
        }

        echo $s;
    } else {
        echo "Try broadening your search criteria.";
    }

?>
        </div>
    </div>
</div>
</body>

</html>