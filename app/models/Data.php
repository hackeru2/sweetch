<?php
class Data {
    private $db;
    public  $data;
    public function __construct() {
        
        $this->db = new Database;
    }

    /* Test (database and table needs to exist before this works)*/
    public function getData() : array {
        $this->db->query("SELECT * FROM data limit ");
        $result = $this->db->resultSet();
        print_r($result);
        die;
        return $result;
    }

     public function upload()
     {


                 
                    $file =  '../../../../../tmp/Data8277.csv';
                $output = shell_exec("cat $file  | wc -l");
                echo $output ; die;
            $handle = fopen($file, "r") or die("Couldn't get handle");
        $i = 0;
        $count = 0;
        $chunk = 0;
        $arr = [];
            if ($handle) {
                while (!feof($handle)) {
                     echo(feof($handle));
                     
                    // $line = fgets($handle);
                     $line = fgetcsv($handle);
 
                    $arr[] = $line ;
                    if($i > 50000){
                        if($arr[0][0]  == "Year")  array_shift($arr);
                        $this->data = $arr;
                    $this->insert();
                      $chunk ++;  
                      $i = 1    ;
                       $arr = [] ;
                    }
                     $count  ++;
                     $i ++;     
                }
            echo("chinkl " .$chunk);
            fclose($handle);
        }
        
     }
     public function insert()
     {
       return $this->db->insert($this->data ,'data');
       $this->data = [];
     }
    }

 ?>  