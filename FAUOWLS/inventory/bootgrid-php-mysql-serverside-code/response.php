
<?php
	//include connection file 
	include_once("connection.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$itmCls = new Item($connString);

	switch($action) {
	 case 'add':
		$itmCls->insertItem($params);
	 break;
	 case 'edit':
		$itmCls->updateItem($params);
	 break;
	 case 'delete':
		$itmCls->deleteItem($params);
	 break;
	 default:
	 $itmCls->getItems($params);
	 return;
	}
	
	class Item {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getItems($params) {
		$this->data = $this->getRecords($params);
		echo json_encode($this->data);
	}
	
	function insertItem($params) {
		$data = array();;
		$sql = "INSERT INTO `Inventory` (";
		$sql .= "perry_part_num";
		$sql .= ", short_description, long_description";
		$sql .= ", quantity";
		$sql .= ", purchase_or_rent";
		$sql .= ", retail_price, retail_price_promo, retail_markup";
		$sql .= ", jobber_price, jobber_markup";
		$sql .= ", bulk_price, bulk_markup";
		$sql .= ", cost_to_replace, cost_avg";
		$sql .= ", category_code";
		$sql .=	") VALUES('";
		$sql .= $params["perry_part_num"] . "', '";
		$sql .= $params["short_description"] . "','";
		$sql .= $params["long_description"] . "','";
		$sql .= $params["quantity"] . "','";
		$sql .= $params["purchase_or_rent"] . "','";
		$sql .= $params["retail_price"] . "','";
		$sql .= $params["retail_price_promo"] . "','";
		$sql .= $params["retail_markup"] . "','";
		$sql .= $params["jobber_price"] . "','";
		$sql .= $params["jobber_markup"] . "','"
		$sql .= $params["bulk_price"] . "','"
		$sql .= $params["bulk_markup"] . "','"
		$sql .= $params["cost_to_replace"] . "','";
		$sql .= $params["cost_avg"] . "','";
		$sql .= $params["category_code"];
		$sql .= "');  ";
		echo $result = mysqli_query($this->conn, $sql) or die("error in attempting to insert new item");
	}
	
	
	function getRecords($params) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE ";
			$where .=" ( perry_part_num LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR short_description LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR long_description LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR category_code LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number of records without any search
		$sql = "SELECT * FROM `Inventory` ";
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exists
		if(isset($where) && $where != '') {
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp != -1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("Error fetching all item info");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("Error fetching item info");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10,
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		
		return $json_data;
	}
	function updateItem($params) {
		$data = array();
		//print_R($_POST);
		//die;
		$sql = "Update `Inventory`";
		$sql .= " set short_description = '" . $params["edit_short_description"];
		$sql .= "', long_description = '" . $params["edit_long_description"];
		$sql .= "', quantity = '" . $params["edit_quantity"];
		$sql .= "', purchase_or_rent = '" . $params["edit_purchase_or_rent"];
		$sql .= "', retail_price = '" . $params["edit_retail_price"];
		$sql .= "', retail_price_promo = '" . $params["edit_retail_price_promo"];
		$sql .= "', retail_markup = '" . $params["edit_retail_markup"];
		$sql .= "', jobber_price = '" . $params["edit_jobber_price"];
		$sql .= "', jobber_markup = '" . $params["edit_jobber_markup"];
		$sql .= "', bulk_price = '" . $params["edit_bulk_price"];
		$sql .= "', bulk_markup = '" . $params["edit_bulk_markup"];
		$sql .= "', cost_avg = '" . $params["edit_cost_avg"];
		$sql .= "', category_code = '" . $params["edit_category_code"];
		$sql .= "' WHERE perry_part_num='" . $_POST["edit_perry_part_num"] . "'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("Error updating item info");
	}
	
	function deleteItem($params) {
		$data = array();
		//print_R($_POST);
		//die;
		$sql = "delete from `Inventory` WHERE perry_part_num = '"
		$sql .= $params["perry_part_num"]
		$sql .= "'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("Error attempting to delete item data");
	}
}
?>
	