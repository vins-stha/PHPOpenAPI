<?php
/**
 * @OA\Info(title="PostiBasicAddressAPI", version="1.0")
 */

namespace posti;
require_once('..\includes\config.php');

class Posti
{
  private $conn;
  private $table = "posti_address";

  public $id;
  public $postal_code;
  public $postal_code_name_fi;
  public $postal_code_name_swe;
  public $abbr_fi;
  public $abbr_swe;
  public $street_fi;
  public $street_swe;
  public $municipality_fi;
  public $municipality_swe;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  /**
   * @OA\Get(path="/RESTAPI/PHPRestOpenAPI/api/read.php/",
   * @OA\Response(response="200", description="Successful"),
   * @OA\Response(response="404", description="Not Found!")
   * )
   */
  public function retreiveAll()
  {
    $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id';
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt;
  }

  /**
   * @OA\Post(path="/RESTAPI/PHPRestOpenAPI/api/readOne.php/",
   *   @OA\RequestBody(
   *        @OA\MediaType(
   *          mediaType="multipart/form-data",
   *          @OA\Schema( required={"id"}, @OA\Property(property="id", type="integer"))   *
   * )
   * ),
   * @OA\Response(response="200", description="Successful"),
   * @OA\Response(response="404", description="Not Found!")
   * )
   */
  public function retrieveOne()
  {
    $query = 'SELECT * FROM ' . $this->table . ' p WHERE p.id = ? LIMIT 0,1';
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(\PDO::FETCH_ASSOC);

    $this->id = $row['id'];
    $this->postal_code = $row['postal_code'];
    $this->postal_code_name_fi = $row['postal_code_name_fi'];
    $this->postal_code_name_swe = $row['postal_code_name_swe'];
    $this->abbr_fi = $row['abbr_fi'];
    $this->abbr_swe = $row['abbr_swe'];
    $this->street_fi = $row['street_fi'];
    $this->street_swe = $row['street_swe'];
    $this->municipality_fi = $row['municipality_fi'];
    $this->municipality_swe = $row['municipality_swe'];

    return $stmt;
  }

  public function insert()
  {
    $query = 'INSERT INTO ' . $this->table .
        ' SET
                postal_code  = :postal_code,
                postal_code_name_fi = :postal_code_name_fi,
                postal_code_name_swe = :postal_code_name_swe,
                abbr_fi = :abbr_fi,
                abbr_swe = :abbr_swe,
                street_fi = :street_fi,
                street_swe = :street_swe,
                municipality_fi = :municipality_fi,
                municipality_swe = :municipality_swe           
            ';
    $stmt = $this->conn->prepare($query);

    //cleaning the data received
    $this->postal_code = strip_tags($this->postal_code);
    $this->postal_code_name_fi = strip_tags($this->postal_code_name_fi);
    $this->postal_code_name_swe = strip_tags($this->postal_code_name_swe);
    $this->abbr_fi = strip_tags($this->abbr_fi);
    $this->abbr_swe = strip_tags($this->abbr_swe);
    $this->street_fi = strip_tags($this->street_fi);
    $this->street_swe = strip_tags($this->street_swe);
    $this->municipality_fi = strip_tags($this->municipality_fi);
    $this->municipality_swe = strip_tags($this->municipality_swe);

    //binding parameters to the statement
    $stmt->bindParam(':postal_code', $this->postal_code);
    $stmt->bindParam('postal_code_name_fi', $this->postal_code_name_fi);
    $stmt->bindParam('postal_code_name_swe', $this->postal_code_name_swe);
    $stmt->bindParam('abbr_fi', $this->abbr_fi);
    $stmt->bindParam('abbr_swe', $this->abbr_swe);
    $stmt->bindParam('street_fi', $this->street_fi);
    $stmt->bindParam('street_swe', $this->street_swe);
    $stmt->bindParam('municipality_fi', $this->municipality_fi);
    $stmt->bindParam('municipality_swe', $this->municipality_swe);

    if ($stmt->execute()) {
      printf("Successfully inserted  ");
      return true;
    } else {
      printf("Could not perform the action. ");

      return false;
    }
  }

  /**
   * @OA\Post(path="/RESTAPI/PHPRestOpenAPI/api/streetName.php/",
   *   @OA\RequestBody(
   *        @OA\MediaType(
   *          mediaType="multipart/form-data",
   *          @OA\Schema( required={"postal_code"}, @OA\Property(property="postal_code", type="integer"))
   * )
   * ),
   * @OA\Response(response="200", description="Successful"),
   * @OA\Response(response="404", description="Not Found!")
   * )
   */
  public function retrieveStreetName($postal_code)
  {
    $query = "SELECT id , postal_code, `street_fi`,`municipality_fi`,`municipality_swe`, `street_swe`  FROM " . $this->table .
        " WHERE `postal_code` = :postal_code;";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':postal_code', $postal_code);

    $stmt->execute();

    $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    if ($row) {
      return $row;
    } else {
      printf("Record not found for postal code %s \n", $postal_code);

    }
  }


}