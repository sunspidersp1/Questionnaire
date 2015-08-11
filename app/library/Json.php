<?php
/**
 * @Author: sxf
 * @Date:   2015-08-11 09:18:33
 * @Last Modified by:   sxf
 * @Last Modified time: 2015-08-11 15:24:49
 */

/**
* 
*/
class Json
{

	public $factor_json;
	public $index_json;

	public function __construct($db) {
		$this->db = $db;
	}

	public function Load()
	{
		$factor_file = __DIR__ . "/../../app/config/factor.json";
		$index_file = __DIR__ . "/../../app/config/index.json";
		$this->factor_json = $this->loadJson($factor_file);
		$this->index_json = $this->loadJson($index_file);
		$this->db->begin();
		try {
			$this->updateSQL($this->factor_json, 'Factor');
			$this->updateSQL($this->index_json, 'Index');
		} catch (Exception $ex) {
			echo $ex->getMessage() ."\n";
			$this->db->rollback();
		}
		$this->db->commit();
	}

	// 加载一个json文件，可选传入是否转换为数组
	private function loadJson($filename, $toarray = true)
	{
		$json_string = file_get_contents($filename);
		$json_string = preg_replace('/[\r\n]/', '', $json_string);
		$json = json_decode($json_string, $toarray);
		if ($json == null) {
			echo json_last_error_msg();
			throw new Exception(json_last_error_msg());
		} 
		return $json;
	}

	// 更新数据库
	function updateSQL($json_array, $class_name)
	{
		foreach ($json_array as $key => $value) {
			$obj = $this->getObj($key, $class_name);
			$this->jsonToObject($obj, $class_name, $key, $value);
			if (!$obj->save())
				foreach ($obj->getMessages() as $msg) {
					throw new Exception($msg);
				}
		}
	}

	function getObj($name, $classname)
	{
		$obj = $classname::findFirst(array(
			'name = :name:',
			'bind' => array('name' => $name)));
		if (!$obj) {
			$obj = new $classname();
		}
		return $obj;
	}

	function jsonToObject($obj, $class_name, $name, $array)
	{
		$obj->name = $name;
		foreach ($array as $key => $value) {
			if ($key == 'question' || $key == 'factor' || $key == 'index') {
				$obj->children = $value;
				$b = $key == lcfirst($class_name) ? 0 : 1;
				$obj->children_type = $this->makeArray($value, $b);
			}
			if ($key == 'action' || $key == 'ans') {
				$obj->$key = $value;
			}
			if ($key == 'module_name')
		}
	}

	// 根据array字段，生成新的children_type
	function makeArray($array, $data)
	{
		$children_len = count(explode($array));
		$chilren_type = array();
		array_pad($children_type, $children_len, $data);
		return $children_type;
	}
}