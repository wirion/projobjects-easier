<?php

namespace Classes\Webforce3\DB;

use Classes\Webforce3\Config\Config;

class City extends DbObject {

	private $country;
	private $name;

	public function __construct ($cityId = 0, $inserted='', $country = null, $cityName = '') {
		parent::__construct($cityId, $inserted);
		$this->country = !empty($country) ? $country : new Country();
		$this->name = $cityName;
	}

	/**
	 * @param int $id
	 * @return DbObject
	 */
	public static function get($id) {
		// TODO: Implement get() method.
		$sql = "
			SELECT *
			FROM city
			WHERE cit_id = {$id};
		";
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		if ($stmt->execute() === false) {
			print_r($stmt->errorInfo());
		}
		else {
			$row = $stmt->fetch(\PDO::FETCH_ASSOC);
			if (!empty($row)) {
				$currentObject = new City(
					$row['cit_id'],
					'',
					Country::get($row['country_cou_id']),
					$row['cit_name']
				);
				return $currentObject;
			}
		}
	}

	function getName() {
		return $this->name;
	}

	/**
	 * @return DbObject[]
	 */
	public static function getAll() {
		// TODO: Implement getAll() method.
		$sql = '
			SELECT *
			FROM city
			WHERE cit_id > 0
			ORDER BY cit_name ASC
		';
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		if ($stmt->execute() === false) {
			print_r($stmt->errorInfo());
		}
		else {
			$allDatas = $stmt->fetchAll();
			// foreach ($allDatas as $row) {
			// 	$returnList[$row['cit_id']] = $row['cit_name'];
			// }
		}
	}

	/**
	 * @return array
	 */
	public static function getAllForSelect() {
		$returnList = array();

		$sql = '
			SELECT cit_id, cit_name
			FROM city
			WHERE cit_id > 0
			ORDER BY cit_name ASC
		';
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		if ($stmt->execute() === false) {
			print_r($stmt->errorInfo());
		}
		else {
			$allDatas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			foreach ($allDatas as $row) {
				$returnList[$row['cit_id']] = $row['cit_name'];
			}
		}

		return $returnList;
	}

	/**
	 * @return bool
	 */
	public function saveDB() {
		// TODO: Implement saveDB() method.
		$sql = "
			UPDATE city
			SET cit_name = :name, country_cou_id = :countryId
			WHERE cit_id = :id;
		";
		$stmt = Config::getInstance()->getPDO()->prepare($sql);
		$stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);
		$stmt->bindValue(':name', $this->name, \PDO::PARAM_STR);
		$stmt->bindValue(':countryId', $this->country->getId(), \PDO::PARAM_INT);
    //
		if ($stmt->execute() === false) {
			print_r($stmt->errorInfo());
			return false;
		}
		else {
			return true;
		}
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public static function deleteById($id) {
		// TODO: Implement deleteById() method.
	}

	/**
	 * @return Country
	 */
	public function getCountry() {
		return $this->country;
	}

}
