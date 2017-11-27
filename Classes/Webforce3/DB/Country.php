<?php

namespace Classes\Webforce3\DB;

use Classes\Webforce3\Config\Config;

class Country extends DbObject {

  private $name;

  public function __construct ($id = null, $inserted = '', $name = '') {
    parent::__construct($id, $inserted);
    $this->name = $name;
  }

  public static function get($id) {
    $sql = '
      SELECT *
      FROM country
      WHERE cou_id = :id;
    ';
    $stmt = Config::getInstance()->getPDO()->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);

    if ($stmt->execute() === false) {
			throw new InvalidSqlQueryException($sql, $stmt);
		}
		else {
			$row = $stmt->fetch(\PDO::FETCH_ASSOC);
			if (!empty($row)) {
				$currentObject = new Country(
					$row['cou_id'],
          $row['cou_name']
				);
        // echo "Country::get() returns: ";
        // print_r($currentObject);
				return $currentObject;
			}
		}
  }

  public static function getAll() {

  }
  public static function getAllForSelect() {
    $returnList = array();

    $sql = '
      SELECT cou_id, cou_name
      FROM country
      WHERE cou_id > 0
      ORDER BY cou_name ASC;
    ';
    $stmt = Config::getInstance()->getPDO()->prepare($sql);
    if ($stmt->execute() === false) {
      print_r($stmt->errorInfo());
    }
    else {
      $allDatas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      foreach ($allDatas as $row) {
        $returnList[$row['cou_id']] = $row['cou_name'];
      }
    }

    return $returnList;
  }
  public function saveDB() {

  }
  public static function deleteById($id) {
  }
}


// class Country extends DbObject {
// 	/**
// 	 * @param int $id
// 	 * @return DbObject
// 	 */
// 	public static function get($id) {
// 		// TODO: Implement get() method.
// 	}
//
// 	/**
// 	 * @return DbObject[]
// 	 */
// 	public static function getAll() {
// 		// TODO: Implement getAll() method.
// 	}
//
// 	/**
// 	 * @return array
// 	 */
// 	public static function getAllForSelect() {
// 		$returnList = array();
//
// 		$sql = '
// 			SELECT cit_id, cit_name
// 			FROM city
// 			WHERE cit_id > 0
// 			ORDER BY cit_name ASC
// 		';
// 		$stmt = Config::getInstance()->getPDO()->prepare($sql);
// 		if ($stmt->execute() === false) {
// 			print_r($stmt->errorInfo());
// 		}
// 		else {
// 			$allDatas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
// 			foreach ($allDatas as $row) {
// 				$returnList[$row['cit_id']] = $row['cit_name'];
// 			}
// 		}
//
// 		return $returnList;
// 	}
//
// 	/**
// 	 * @return bool
// 	 */
// 	public function saveDB() {
// 		// TODO: Implement saveDB() method.
// 	}
//
// 	/**
// 	 * @param int $id
// 	 * @return bool
// 	 */
// 	public static function deleteById($id) {
// 		// TODO: Implement deleteById() method.
// 	}
//
// }
