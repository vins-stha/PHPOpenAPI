<?php

namespace importDataFromFile;
require_once('../resources/BAF_20191116.dat');
require_once('../resources/data.dat');
require_once('../core/posti.php');
require_once('config.php');


class importDataFromFile
{
    public function __construct()
    {
        $db = new \database\Database();
        $this->conn = $db->dbConnect();
    }

  /**
   * reads data from file and inserts into the database table
   *
   */
    public function readFromFile()
    {
       // $file = '../resources/BAF_20191116.dat';
        $file = '../resources/data.dat';
        $file_contents_array = array();
        $index = 0;

        try {
            $file_contents_array = file($file);
            if ($file_contents_array) {
                $length = count($file_contents_array);
                while ($index < $length) {
                    $postal_code[] = substr($file_contents_array[$index], 13, 5);
                    $postal_code_name_in_Finnish [] = substr($file_contents_array[$index], 18, 30);
                    $postal_code_name_in_Swedish[] = substr($file_contents_array[$index], 48, 30);
                    $postal_code_abbreviation_in_Finnish[] = substr($file_contents_array[$index], 78, 12);
                    $postal_code_abbreviation_in_Swedish[] = substr($file_contents_array[$index], 90, 12);
                    $street_name_in_Finnish[] = substr($file_contents_array[$index], 102, 30);
                    $street_name_in_Swedish[] = substr($file_contents_array[$index], 132, 30);
                    $municipality_code[] = substr($file_contents_array[$index], 213, 3);
                    $municipality_code_in_Finnish[] = substr($file_contents_array[$index], 216, 20);
                    $municipality_code_in_Swedish[] = substr($file_contents_array[$index], 236, 20);

                    if (preg_match('/^[\s]+/', $postal_code[$index])) {
                        unset($file_contents_array[$index]);
                    } else {
                        $posti = new \posti\Posti($this->conn);
                        $posti->postal_code = $postal_code[$index];
                        $posti->postal_code_name_fi = $postal_code_name_in_Finnish[$index];
                        $posti->postal_code_name_swe = $postal_code_name_in_Swedish[$index];
                        $posti->abbr_fi = $postal_code_abbreviation_in_Finnish[$index];
                        $posti->abbr_swe = $postal_code_abbreviation_in_Swedish[$index];
                        $posti->street_fi = $street_name_in_Finnish[$index];
                        $posti->street_swe = $street_name_in_Swedish[$index];
                        $posti->municipality_fi = $municipality_code_in_Finnish[$index];
                        $posti->municipality_swe = $municipality_code_in_Swedish[$index];

                        $posti->insert();
                    }

                    $index++;
                }
                //echo $length;
            }

        } catch (Exception $exception) {
            printf(" Could not read file %s" . $exception->getMessage());
        }

    }

}