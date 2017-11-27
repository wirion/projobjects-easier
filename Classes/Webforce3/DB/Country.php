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
          '',
          $row['cou_name']
				);
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

  public function getName () {
    return $this->name;
  }
}
