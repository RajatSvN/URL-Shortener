<?php

    include("connection.php");

    $response = array();

    if(isset($_POST)){

        $url = $_POST['url'];

        // check if url is already shortened 

        $res = $mysqli->query("SELECT * from urlshort WHERE url = '$url' LIMIT 1");

        if($res->num_rows == 1){

            // the url is already shortened

            $response["error"] = "The URL is already shortened";
            
            // send the exsisting short url in response too.
            
            $row = $res->fetch_assoc();
            
            $short_url = "smlr.ml/".$row['identifier'];
            
            $response["short_url"] = $short_url;

            echo json_encode($response);
            
        }else{

            // create a random aplha numeric string

            $randomString = "1092837465qazwsxedcrfvtgbyhnujmikolp4509876wsdfvhn";

            // shuffle the string randomly

            $shuffle =  str_shuffle($randomString);

            // create a 4 letter identifier for your shortened URL

            $identifier = substr($shuffle,0,4);

            // check if given identifier is already in use

            $rows = $mysqli->query("SELECT identifier from urlshort WHERE identifier='$identifier' LIMIT 1")->num_rows;

            // if identifier is in use keep finding until we get a unique identifier

            while($rows == 1){

                $shuffle =  str_shuffle($randomString);

                $identifier = substr($shuffle,0,4);

                $rows = $mysqli->query("SELECT identifier from urlshort WHERE identifier='$identifier' LIMIT 1")->num_rows;

            }

            $insert = $mysqli->query("INSERT INTO urlshort(url,identifier) VALUES('$url','$identifier')");

            if($insert){

                // if the entry in table was successful, return success message with shortened URL

                $response["success"] = "The URL was successfully shortened!";

                $response["short_url"] = "smlr.ml/".$identifier;

                echo json_encode($response);

            }else{

                $response["error"] = "We are having some troubles shortening your URL. Please try again later!";

                echo json_encode($response);

            }

        }

    }else{

        // basic error handling

        $response["error"] = "Missing Form Parameters!";

            echo json_encode($response);

    }


?>