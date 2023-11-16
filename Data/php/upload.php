<?php    
    // ############# METHOD - QUERY DATA #############
    if (isset($_GET)) {
        // gets entire POST body
        file_put_contents('php://stdout', "---------------- POST Query Data Processing Start ----------------\n");
        # get parameters
        # '/wwwroot/127.0.0.1' in BT
        $htmlDIR = '/var/www/html';
        $file = file_get_contents('php://input');
        $fileName = $_GET['fileName']; // = 2
        $fileDir = $htmlDIR . $_GET['fileDir']; // = 3
        $fileDir = str_replace(':', '%3A', $fileDir);
        $result = $fileDir . $fileName;

        file_put_contents('php://stdout', "$__DIR__\n");
        
        file_put_contents('php://stdout', "$result\n");
        if (!is_dir($fileDir)) 
        {
            file_put_contents('php://stdout', "FOLDER $fileDir is not exist\n");
            @mkdir($fileDir, 0777, true);
        }
        else{
            file_put_contents('php://stdout', "FOLDER $fileDir already exists\n");
        }

        if(file_exists("$result")) 
        {
            file_put_contents('php://stdout', "FILE $fileName already exists in dir\n");
            unlink("$result");
            file_put_contents('php://stdout', "FILE $fileName was unlinked successfully\n");
        }

        // write the data out to the file
        $fp = fopen("$result", "wb");
        fwrite($fp, $file);
        fclose($fp);
        
        file_put_contents('php://stdout', "FILE $result was written successfully\n");
        file_put_contents('php://stdout', "---------------- POST Query Data Processing End ----------------\n");
    }

   
?>