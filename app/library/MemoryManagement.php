<?php

use Phalcon\Mvc\Model\Transaction\Failed as TxFailed;
use Phalcon\Mvc\Model\Transaction\Manager as TxManager;

class MemoryManagement {
	private static $mysql_memory_list = array(
		'cpidf' , 'eppsdf', 'epqadf', 'ksdf','spmdf'
	);
	public static function startMysqlMemoryTable($table_name){
		$table_name = strtolower($table_name);
		if(!in_array($table_name, self::$mysql_memory_list, true)){
			throw new Exception ('There is no memory table for this table!');
		}
		$state = false;
		switch ($table_name){
			case 'cpidf' : $state = self::startMysqlCpidfMemory();  break;
			case 'eppsdf' : $state = self::startMysqlEppsdfMemory();  break;
			case 'epqadf' :$state = self::startMysqlEpqadfMemory(); break;
			case 'ksdf' : $state = self::startMysqlKsdfMemory(); break;
			case 'spmdf' : $state = self::startMysqlSpmdfMemory(); break;
		}
		return $state;
		
	}
	/**
	public $TH;
	public $XZ;
	public $DO;
	public $CS;
	public $SY;
	public $SP;
	public $SA;
	public $WB;
	public $RE;
	public $SO;
	public $SC;
	public $PO;
	public $GI;
	public $CM;
	public $AC;
	public $AI;
	public $IE;
	public $PY;
	public $FX;
	public $FE;
	 */
	/**
	 * true 表示内存表ok了
	 * @throws Exception
	 * @return boolean
	 */
	private static function startMysqlCpidfMemory(){
		#先检测内存中是否存在cpidf_memory
		$cpidf_first = CpidfMemory::findFirst();
		if(isset($cpidf_first->TH)){
			return true;
		}else{
		     try {
				$manager     = new TxManager();
				$transaction = $manager->get();
				$cpidf_data = Cpidf::find();
				foreach($cpidf_data as $cpidf_record ){
					$cpidf_memory = new CpidfMemory();
					$cpidf_memory->TH = $cpidf_record->TH;
					$cpidf_memory->XZ = $cpidf_record->XZ;
					$cpidf_memory->AC = $cpidf_record->AC;
					$cpidf_memory->AI = $cpidf_record->AI;
					$cpidf_memory->CM = $cpidf_record->CM;
					$cpidf_memory->CS = $cpidf_record->CS;
					$cpidf_memory->DO = $cpidf_record->DO;
					$cpidf_memory->FE = $cpidf_record->FE;
					$cpidf_memory->GI = $cpidf_record->GI;
					$cpidf_memory->IE = $cpidf_record->IE;
					$cpidf_memory->PO = $cpidf_record->PO;
					$cpidf_memory->PY = $cpidf_record->PY;
					$cpidf_memory->RE = $cpidf_record->RE;
					$cpidf_memory->SA = $cpidf_record->SA;
					$cpidf_memory->SO = $cpidf_record->SO;
					$cpidf_memory->SP = $cpidf_record->SP;
					$cpidf_memory->SY = $cpidf_record->SY;
					$cpidf_memory->WB = $cpidf_record->WB;
					if( $cpidf_memory->create() == false) {
						unset($cpidf_data);
						$transaction->rollback("CPIDF DATA INSERT INTO MEMORY TABLE ERROR!");
					}
				}
				$transaction->commit();
				return true;
		   		}catch (TxFailed $e) {
    				throw new Exception("Failed, reason: ".$e->getMessage());
    			}	
		}
	}
	/**
	 * EPPSDF:
	 * public $TH;
	 * public $A;
	 * public $B;
	 * 
	 */
	/**
	 * true
	 * @throws Exception
	 * @return boolean
	 */
	private static function startMysqlEppsdfMemory(){
		#先检测内存中是否存在epppsdf_memory
		$eppsdf_first = EppsdfMemory::findFirst();
		if(isset($eppsdf_first->TH)){
			return true;
		}else{
			try {
				$manager     = new TxManager();
				$transaction = $manager->get();
				$eppsdf_data = Eppsdf::find();
				foreach($eppsdf_data as $eppsdf_record ){
					$eppsdf_memory = new EppsdfMemory();
					$eppsdf_memory->TH = $eppsdf_record->TH;
					$eppsdf_memory->A  = $eppsdf_record->A;
					$eppsdf_memory->B  = $eppsdf_record->B;
					if( $eppsdf_memory->create() == false) {
						unset($eppsdf_data);
						$transaction->rollback("EPPSDF DATA INSERT INTO MEMORY TABLE ERROR!");
					}
				}
				$transaction->commit();
				return true;
			}catch (TxFailed $e) {
				throw new Exception("Failed, reason: ".$e->getMessage());
			}
		}
		
	}
	/**
	 * public $TH;

	public $XZ;

	public $E;

	public $N;

	public $P;

	public $L;
	 */
	/**
	 * 
	 * @throws Exception
	 * @return boolean
	 */
	private static function startMysqlEpqadfMemory(){
		#先检测内存中是否存在epqadf_memory
		$epqadf_first = EpqadfMemory::findFirst();
		if(isset($epqadf_first->TH)){
			return true;
		}else{
			try {
				$manager     = new TxManager();
				$transaction = $manager->get();
				$epqadf_data = Epqadf::find();
				foreach($epqadf_data as $epqadf_record ){
					$epqadf_memory = new EpqadfMemory();
					$epqadf_memory->TH = $epqadf_record->TH;
					$epqadf_memory->XZ = $epqadf_record->XZ;
					$epqadf_memory->E = $epqadf_record->E;
					$epqadf_memory->N = $epqadf_record->N;
					$epqadf_memory->P = $epqadf_record->P;
					$epqadf_memory->L = $epqadf_record->L;
					if( $epqadf_memory->create() == false) {
						unset($epqadf_data);
						$transaction->rollback("EPQADF DATA INSERT INTO MEMORY TABLE ERROR!");
					}
				}
				$transaction->commit();
				return true;
			}catch (TxFailed $e) {
				throw new Exception("Failed, reason: ".$e->getMessage());
			}
		}
		
	}
	/**
	 * public $TH;

	public $A;
	
	public $B;
	
	public $C;
	 */
	/**
	 * true
	 * @throws Exception
	 * @return boolean
	 */
	private static function startMysqlKsdfMemory(){
		#先检测内存中是否存在ksdf_memory
		$ksdf_first = KsdfMemory::findFirst();
		if(isset($ksdf_first->TH)){
			return true;
		}else{
			try {
				$manager     = new TxManager();
				$transaction = $manager->get();
				$ksdf_data = Ksdf::find();
				foreach($ksdf_data as $ksdf_record ){
					$ksdf_memory = new KsdfMemory();
					$ksdf_memory->TH = $ksdf_record->TH;
					$ksdf_memory->A  = $ksdf_record->A;
					$ksdf_memory->B  = $ksdf_record->B;
					$ksdf_memory->C  = $ksdf_record->C;
					if( $ksdf_memory->create() == false) {
						unset($ksdf_data);
						$transaction->rollback("KSDF DATA INSERT INTO MEMORY TABLE ERROR!");
					}
				}
				if(isset($ksdf_data)){
					unset($ksdf_data);
				}
				$transaction->commit();
				return true;
			}catch (TxFailed $e) {
				throw new Exception("Failed, reason: ".$e->getMessage());
			}
		}
	}
	/**
	 * 	public $BZ;
		public $XH;
	 */
	/**
	 * 
	 * @throws Exception
	 * @return boolean
	 */
	private static function startMysqlSpmdfMemory(){
		#先检测内存中是否存在spmdf_memory
		$spmdf_first = SpmdfMemory::findFirst();
		if(isset($spmdf_first->XH)){
			return true;
		}else{
			try {
				$manager     = new TxManager();
				$transaction = $manager->get();
				$spmdf_data = Spmdf::find();
				foreach($spmdf_data as $spmdf_record ){
					$spmdf_memory = new SpmdfMemory();
					$spmdf_memory->XH = $spmdf_record->XH;
					$spmdf_memory->BZ = $spmdf_record->BZ;
					if( $spmdf_memory->create() == false) {
						unset($spmdf_data);
						$transaction->rollback("SPMDF DATA INSERT INTO MEMORY TABLE ERROR!");
					}
				}
				if(isset($ksdf_data)){
					unset($ksdf_data);
				}
				$transaction->commit();
				return true;
			}catch (TxFailed $e) {
				throw new Exception("Failed, reason: ".$e->getMessage());
			}
		}
	}
}