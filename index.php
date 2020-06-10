<?Php

    include("connection.php");
    
    $identifier = preg_replace('#[^0-9a-z]#i','',$_GET['r']);
    
    
    $res = $mysqli->query("SELECT url from urlshort WHERE identifier = '$identifier' LIMIT 1");
    
    if($res->num_rows==1){
        // given url is a valid shortened url
    
        $row = $res->fetch_assoc();
        $url = $row['url'];
        header("Location:".$url);
        
    }else{
        
        header("Location:http://smlr.ml/service.php");
        
    }

?>
