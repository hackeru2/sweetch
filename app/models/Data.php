<?php
require_once "DB.php";

class Data
{
    private $db;
    public  $data;
    public $delimiter = 10000;
    public function __construct()
    {

        $this->db = new Database;
    }

    public function upload()
    {


        set_time_limit(10000); // 
        $file =  'c:/tmp/Data8277.csv';
        // $output = shell_exec("cat $file  | wc -l");
        // // $loop =  ceil(intval($output) / $this->delimiter);
        // echo $output;
        $handle = fopen($file, "r") or die("Couldn't get handle");
        $i = 0;
        $count = 0;
        $chunk = 0;
        $arr = [];
        if ($handle) {
            while (!feof($handle)) {
                // while ($chunk < $output ) {
                //  echo(feof($handle));

                // $line = fgets($handle);
                $line = fgetcsv($handle);

                $arr[] = $line;
                if ($i > $this->delimiter) {
                    sl eep(0.3);
                    if ($arr[0][0]  == "Year")  array_shift($arr);
                    $this->data = $arr;
                    $this->insert();
                    $chunk++;
                    $i = 1;
                    $arr = [];
                }
                $count++;
                $i++;
            }
            echo ("chinkl " . $chunk);
            fclose($handle);
        }
    }
    public function insert()
    {
        return $this->db->insert($this->data, 'data_cli');
        $this->data = [];
    }
}

$data = new Data;
$data->upload();
echo "done";
