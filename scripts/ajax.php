<?php
date_default_timezone_set('Asia/Calcutta');
$time = mktime(true);
include("settings.php");

$q = htmlspecialchars(urldecode(strtoupper($_GET["term"])), ENT_QUOTES);
if (!$q) return;

if(isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
}
else {
	$id='';
}
$result = array();
if($id=='cust_name') {
	$sql = 'select * from customer where (cus_name like "%'.$q.'%" or sno like "'.$q.'%" or mobile like "%'.$q.'%" or tin like "%'.$q.'%" or account_no like "%'.$q.'%") and parent not in ("BANK","CASH", 6, 1) limit 20'; 
	//echo $sql;
	$res = execute_query($db, $sql);
	while($row = mysqli_fetch_array($res)) {
		$row['balance']=get_cust_balace('1970-01-01',date("Y-m-d"),$row['sno']);
		$sql = 'select * from invoice_sale where supplier_id="'.$row['sno'].'" order by sno desc limit 1';
		$last_invoice = execute_query($db, $sql);
		if(mysqli_num_rows($last_invoice)!=0){
			$last_invoice = mysqli_fetch_assoc($last_invoice);
			$last_invoice_sno = $last_invoice['sno'];
			$last_invoice = 'Rs.'.$last_invoice['total_amount1'].'. Dt: '.date("d-m-Y", strtotime($last_invoice['dateofdispatch'])).' Inv#: '.$last_invoice['invoice_no'];
		}
		else{
			$last_invoice = '';
			$last_invoice_sno = '';
		}
		array_push($result, array("id"=>$row['sno'], "label"=>$row['cus_name'], "cust_name"=>$row['cus_name'], "address" => $row['address'], "address2" => $row['add_2'], "city" => $row['city'], "mobile" => $row['mobile'], "tin" => $row['tin'], "aadhar" => $row['adhar_no'], "state" => $row['state'], "state_name" => get_state($row['state']), "opening" => $row['opening_balance'], "category"=>$row['parent'], "balance"=>$row['balance'],"zipcode"=>$row['zipcode'], "last_invoice"=>$last_invoice, "last_invoice_sno"=>$last_invoice_sno));
	}
}
elseif($id=='cash_sales'){
	$sql = 'select * from invoice_sale where concerned_person like "%'.$q.'%" group by concerned_person, cash_mobile';
	$res = execute_query($db, $sql);
	while($row = mysqli_fetch_array($res)) {
		array_push($result, array("label"=>$row['concerned_person'].' '.$row['cash_mobile'], "concerned_person"=>$row['concerned_person'], "cash_mobile"=>$row['cash_mobile'], "cash_address"=>$row['cash_address']));
		
	}
}
elseif($id=='cust_name_import') {
	$sql = 'select * from customer where (cus_name like "%'.$q.'%" or sno like "'.$q.'%" or mobile like "%'.$q.'%" or tin like "%'.$q.'%" or account_no like "%'.$q.'%") limit 20'; 
	//echo $sql;
	$res = execute_query($db, $sql);
	while($row = mysqli_fetch_array($res)) {
		$row['balance']=get_cust_balace('1970-01-01',date("Y-m-d"),$row['sno']);
		$sql = 'select * from invoice_sale where supplier_id="'.$row['sno'].'" order by sno desc limit 1';
		$last_invoice = execute_query($db, $sql);
		if(mysqli_num_rows($last_invoice)!=0){
			$last_invoice = mysqli_fetch_assoc($last_invoice);
			$last_invoice_sno = $last_invoice['sno'];
			$last_invoice = 'Rs.'.$last_invoice['total_amount1'].'. Dt: '.date("d-m-Y", strtotime($last_invoice['dateofdispatch'])).' Inv#: '.$last_invoice['invoice_no'];
		}
		else{
			$last_invoice = '';
			$last_invoice_sno = '';
		}
		array_push($result, array("id"=>$row['sno'], "label"=>$row['cus_name'].' (A/C: '.$row['account_no'].'. IFS: '.$row['ifsc'].')', "cust_name"=>$row['cus_name'], "address" => $row['address'], "address2" => $row['add_2'], "city" => $row['city'], "mobile" => $row['mobile'], "tin" => $row['tin'], "aadhar" => $row['adhar_no'], "state" => $row['state'], "state_name" => get_state($row['state']), "opening" => $row['opening_balance'], "category"=>$row['parent'], "balance"=>$row['balance'],"zipcode"=>$row['zipcode'], "last_invoice"=>$last_invoice, "last_invoice_sno"=>$last_invoice_sno));
	}
}
elseif($id=='invoice_sno'){
	$sql = 'select customer.sno as sno, customer.cus_name as cus_name, customer.address as address, customer.add_2 as add_2, customer.city as city, customer.mobile as mobile, customer.tin as tin, customer.adhar_no as adhar_no, customer.state as state, customer.opening_balance as opening_balance, customer.parent as parent, customer.zipcode as zipcode, cash_mobile, cash_address from invoice_sale left join customer on customer.sno = invoice_sale.supplier_id where invoice_sale.sno = "'.$q.'"'; 
	//echo $sql;
	$res = execute_query($db, $sql);
	while($row = mysqli_fetch_array($res)) {
		$row['balance']=get_cust_balace('1970-01-01',date("Y-m-d"),$row['sno']);
		$sql = 'select * from invoice_sale where supplier_id="'.$row['sno'].'" order by sno desc limit 1';
		$last_invoice = execute_query($db, $sql);
		if(mysqli_num_rows($last_invoice)!=0){
			$last_invoice = mysqli_fetch_assoc($last_invoice);
			$last_invoice_sno = $last_invoice['sno'];
			$last_invoice = 'Rs.'.$last_invoice['total_amount1'].'. Dt: '.date("d-m-Y", strtotime($last_invoice['dateofdispatch'])).' Inv#: '.$last_invoice['invoice_no'];
		}
		else{
			$last_invoice = '';
			$last_invoice_sno = '';
		}
		array_push($result, array("id"=>$row['sno'], "label"=>$row['cus_name'], "cust_name"=>$row['cus_name'], "address" => $row['address'], "address2" => $row['add_2'], "city" => $row['city'], "mobile" => $row['mobile'], "tin" => $row['tin'], "aadhar" => $row['adhar_no'], "state" => $row['state'], "state_name" => get_state($row['state']), "opening" => $row['opening_balance'], "category"=>$row['parent'], "balance"=>$row['balance'],"zipcode"=>$row['zipcode'], "last_invoice"=>$last_invoice, "last_invoice_sno"=>$last_invoice_sno, "cash_address"=>$row['cash_address'], "cash_mobile"=>$row['cash_mobile']));
	}
}
elseif($id=='edl'){
	$sql = 'select * from pl_heads where sno="'.$_GET['value'].'"';
	//echo $sql;
	$result_pl = execute_query($db, $sql);
	if(mysqli_num_rows($result_pl)==1){
		$sql = 'update customer set parent="'.$_GET['value'].'" where sno='.$_GET['sno'];
		execute_query($db, $sql);
		echo get_parent($_GET['value']);
		return;
	}
	else{
		$sql = 'select * from customer where sno='.$_GET['sno'];
		$customer = mysqli_fetch_assoc(execute_query($db, $sql));
		echo get_parent($customer['parent']);
	}
	return;
}
elseif($id=='edit_batch'){
	$sql = 'select * from stock_purchase where s_no="'.$_GET['sno'].'"';
	$result_pl = execute_query($db, $sql);
	if(mysqli_num_rows($result_pl)==1){
		$sql = 'update stock_purchase set pur_qty="'.$_GET['value'].'" where s_no='.$_GET['sno'];
		execute_query($db, $sql);
		echo $_GET['value'];
		return;
	}
	return;
}
elseif($id=='create_ledger'){
	$sno = add_customer($_GET['cus_name'], $_GET['address'], $_GET['add_2'], '', $_GET['state'], '', 'India', $_GET['mobile'], $_GET['tin'], '', '', '', '', '', '', '', '', 0, '', $_GET['parent']);
	echo $sno;
}
elseif($id=='create_category'){
	if($_GET['category_name']!=''){
		$sql='select * from cust_category where category="'.$_GET['category_name'].'"';
		$result = execute_query($db, $sql);
		if(mysqli_num_rows($result)==0){
			if($_GET['edit_sno_category']!=''){
				$sql = 'update cust_category set category="'.$_GET['category_name'].'", edited_by="'.$_SESSION['username'].'", edition_time="'.date("Y-m-d H:i:s").'" where sno='.$_GET['edit_sno_category'];
			}
			else{
				$sql = 'insert into cust_category(category, created_by, creation_time) values("'.$_GET['category_name'].'" , "'.$_SESSION['username'].'","'.date("Y-m-d H:i:s").'")';	
			}
			execute_query($db, $sql);
		}
	}
	$sql='select * from cust_category';
	$row_category=execute_query($db, $sql);
	echo '<option value=""></option>';
	while($category_details=mysqli_fetch_array($row_category)){
		echo '<option value="'.$category_details['sno'].'">'.$category_details['category'].'</option>';
	}
	return 0;
}
elseif($id=='delete_category'){
	if($_GET['category']!=''){
		$sql='delete from cust_category where sno="'.$_GET['category'].'"';
		$result = execute_query($db, $sql);
	}
	$sql='select * from cust_category';
	$row_category=execute_query($db, $sql);
	echo '<option value=""></option>';
	while($category_details=mysqli_fetch_array($row_category)){
		echo '<option value="'.$category_details['sno'].'">'.$category_details['category'].'</option>';
	}
	return 0;
}
elseif($id=='create_type'){
	if($_GET['type_name']!=''){
		$sql='select * from cust_type where type="'.$_GET['type_name'].'"';
		$result = execute_query($db, $sql);
		if(mysqli_num_rows($result)==0){
			if($_GET['edit_sno_type']!=''){
				$sql = 'update cust_type set type="'.$_GET['type_name'].'", edited_by="'.$_SESSION['username'].'", edition_time="'.date("Y-m-d H:i:s").'" where sno='.$_GET['edit_sno_type'];
			}
			else{
				$sql = 'insert into cust_type(type, created_by, creation_time) values("'.$_GET['type_name'].'" , "'.$_SESSION['username'].'","'.date("Y-m-d H:i:s").'")';	
			}
			execute_query($db, $sql);
		}
	}
	$sql='select * from cust_type';
	$row_type=execute_query($db, $sql);
	echo '<option value=""></option>';
	while($type_details=mysqli_fetch_array($row_type)){
		echo '<option value="'.$type_details['sno'].'">'.$type_details['type'].'</option>';
	}
	return 0;
}
elseif($id=='delete_type'){
	if($_GET['type']!=''){
		$sql='delete from cust_type where sno="'.$_GET['type'].'"';
		$result = execute_query($db, $sql);
	}
	$sql='select * from cust_type';
	$row_type=execute_query($db, $sql);
	echo '<option value=""></option>';
	while($type_details=mysqli_fetch_array($row_type)){
		echo '<option value="'.$type_details['sno'].'">'.$type_details['type'].'</option>';
	}
	return 0;
}
elseif($id=='create_product_company'){
	if($_GET['company_name']!=''){
		$sql='select * from company where description="'.$_GET['company_name'].'"';
		$result = execute_query($db, $sql);
		if(mysqli_num_rows($result)==0){
			if($_GET['edit_sno_company']!=''){
				$sql = 'update company set description="'.$_GET['company_name'].'", edited_by="'.$_SESSION['username'].'", edition_time="'.date("Y-m-d H:i:s").'" where sno='.$_GET['edit_sno_company'];
			}
			else{
				$sql = 'insert into company(description, created_by, creation_time) values("'.$_GET['company_name'].'" , "'.$_SESSION['username'].'","'.date("Y-m-d H:i:s").'")';	
			}
			execute_query($db, $sql);
		}
	}
	$sql='select * from company';
	$row_category=execute_query($db, $sql);
	echo '<option value=""></option>';
	while($category_details=mysqli_fetch_array($row_category)){
		echo '<option value="'.$category_details['sno'].'">'.$category_details['description'].'</option>';
	}
	return 0;
}
elseif($id=='delete_product_company'){
	if($_GET['company']!=''){
		$sql='delete from company where sno="'.$_GET['company'].'"';
		$result = execute_query($db, $sql);
	}
	$sql='select * from company';
	$row_category=execute_query($db, $sql);
	echo '<option value=""></option>';
	while($category_details=mysqli_fetch_array($row_category)){
		echo '<option value="'.$category_details['sno'].'">'.$category_details['description'].'</option>';
	}
	return 0;
}
elseif($id=='create_product_type'){
	if($_GET['product_type_name']!=''){
		$sql='select * from new_type where description="'.$_GET['product_type_name'].'"';
		$result = execute_query($db, $sql);
		if(mysqli_num_rows($result)==0){
			if($_GET['edit_sno_product_type']!=''){
				$sql = 'update new_type set description="'.$_GET['product_type_name'].'", edited_by="'.$_SESSION['username'].'", edition_time="'.date("Y-m-d H:i:s").'" where sno='.$_GET['edit_sno_product_type'];
			}
			else{
				$sql = 'insert into new_type (description, created_by, creation_time) values("'.$_GET['product_type_name'].'" , "'.$_SESSION['username'].'","'.date("Y-m-d H:i:s").'")';	
			}
			execute_query($db, $sql);
		}
	}
	$sql='select * from new_type';
	$row_type=execute_query($db, $sql);
	echo '<option value=""></option>';
	while($type_details=mysqli_fetch_array($row_type)){
		echo '<option value="'.$type_details['sno'].'">'.$type_details['description'].'</option>';
	}
	return 0;
}
elseif($id=='delete_product_type'){
	if($_GET['product_type']!=''){
		$sql='delete from new_type where sno="'.$_GET['product_type'].'"';
		$result = execute_query($db, $sql);
	}
	$sql='select * from new_type';
	$row_type=execute_query($db, $sql);
	echo '<option value=""></option>';
	while($type_details=mysqli_fetch_array($row_type)){
		echo '<option value="'.$type_details['sno'].'">'.$type_details['description'].'</option>';
	}
	return 0;
}
elseif($id=='create_product_category'){
	if($_GET['product_category_name']!=''){
		$sql='select * from product_category where description="'.$_GET['product_category_name'].'"';
		$result = execute_query($db, $sql);
		if(mysqli_num_rows($result)==0){
			if($_GET['edit_sno_product_category']!=''){
				$sql = 'update product_category set description="'.$_GET['product_category_name'].'", edited_by="'.$_SESSION['username'].'", edition_time="'.date("Y-m-d H:i:s").'" where sno='.$_GET['edit_sno_product_category'];
			}
			else{
				$sql = 'insert into product_category (description, created_by, creation_time) values("'.$_GET['product_category_name'].'" , "'.$_SESSION['username'].'","'.date("Y-m-d H:i:s").'")';	
			}
			execute_query($db, $sql);
		}
	}
	$sql='select * from product_category';
	$row_category=execute_query($db, $sql);
	echo '<option value=""></option>';
	while($category_details=mysqli_fetch_array($row_category)){
		echo '<option value="'.$category_details['sno'].'">'.$category_details['description'].'</option>';
	}
	return 0;
}
elseif($id=='delete_product_category'){
	if($_GET['product_category']!=''){
		$sql='delete from product_category where sno="'.$_GET['product_category'].'"';
		//echo $sql;
		$result = execute_query($db, $sql);
	}
	$sql='select * from product_category';
	$row_category=execute_query($db, $sql);
	echo '<option value=""></option>';
	while($category_details=mysqli_fetch_array($row_category)){
		echo '<option value="'.$category_details['sno'].'">'.$category_details['description'].'</option>';
	}
	return 0;
}
elseif($id=='cust_name_enquiry') {
	$sql = 'select * from enquiry_customer where (cus_name like "%'.$q.'%" or sno like "'.$q.'%") and parent not in ("BANK","CASH", 6, 1) limit 20'; 
	//echo $sql;
	$res = execute_query($db, $sql);
	while($row = mysqli_fetch_array($res)) {
		$row['balance']=get_cust_balace('1970-01-01',date("Y-m-d"),$row['sno']);
		array_push($result, array("id"=>$row['sno'], "label"=>$row['cus_name'], "cust_name"=>$row['cus_name'], "address" => $row['address'], "address2" => $row['add_2'], "city" => $row['city'], "mobile" => $row['mobile'], "tin" => $row['tin'], "aadhar" => $row['adhar_no'], "opening" => $row['opening_balance'], "category"=>$row['parent'], "balance"=>$row['balance'],"zipcode"=>$row['zipcode']));
	}
}
elseif($id=='contra') {
	$sql = 'select * from customer where cus_name like "%'.$q.'%" and parent in ("BANK","CASH", 6, 1) limit 20'; 
	//echo $sql;
	$res = execute_query($db, $sql);
	while($row = mysqli_fetch_array($res)) {
		array_push($result, array("id"=>$row['sno'], "label"=>$row['cus_name'], "cust_name"=>$row['cus_name'], "address" => $row['address'], "mobile" => $row['mobile'], "tin" => $row['tin'], "aadhar" => $row['adhar_no'], "opening" => $row['opening_balance'], "category"=>$row['parent']));
	}
}
elseif($id=='journal') {
	$sql = 'select * from customer where cus_name like "%'.$q.'%" and parent not in ("BANK","CASH", 6, 1) limit 20'; 
	//echo $sql;
	$res = execute_query($db, $sql);
	while($row = mysqli_fetch_array($res)) {
		array_push($result, array("id"=>$row['sno'], "label"=>$row['cus_name'], "cust_name"=>$row['cus_name'], "address" => $row['address'], "mobile" => $row['mobile'], "tin" => $row['tin'], "aadhar" => $row['adhar_no'], "opening" => $row['opening_balance'], "category"=>$row['parent']));
	}
}
elseif($id=='pending_sale') {
	
	$overdue_days = mysqli_fetch_array(execute_query("select * from general_settings where `desc`='overdue_days'"));
	$overdue_days = $overdue_days['rate'];

	
	$sql = 'select invoice_sale.sno as sno, concerned_person, department, invoice_type, invoice_no, taxable_amount, tot_vat, tot_sat, total_amount1, grand_total, amount_paid, quantity, dateofdispatch, cus_name from invoice_sale left join customer on customer.sno = supplier_id where (grand_total!=amount_paid or amount_paid is null) and supplier_id='.$q.' order by dateofdispatch'; 
	//echo $sql;
	$res = execute_query($db, $sql);
	while($row = mysqli_fetch_array($res)) {
		
		$overdue_date = date("Y-m-d", strtotime($row['dateofdispatch'] ."+".$overdue_days."  days"));
		
		$date1=date_create($row['dateofdispatch']);
		$date2=date_create(date("Y-m-d"));
		$diff=date_diff($date1,$date2);
		
		array_push($result, array("id"=>$row['sno'], "label"=>$row['cus_name'], "cust_name"=>$row['cus_name'], "concerned_person" => $row['concerned_person'], "department" => $row['department'], "invoice_type" => $row['invoice_type'], "taxable_amount" => $row['taxable_amount'], "tot_vat" => $row['tot_vat'], "tot_sat"=>$row['tot_sat'], "total_amount1"=>$row['total_amount1'], "grand_total"=>$row['grand_total'], "amount_paid"=>$row['amount_paid'], "amount_due"=>$row['grand_total']-$row['amount_paid'], "quantity"=>$row['quantity'], "dateofdispatch"=>$row['dateofdispatch'], "overdue_date"=>$overdue_date, "overdue_days"=>$diff->days));
	}
}
elseif($id=='pending_purchase') {
	
	$overdue_days = mysqli_fetch_array(execute_query("select * from general_settings where `desc`='overdue_days'"));
	$overdue_days = $overdue_days['rate'];

	
	$sql = 'select invoice_purchase.sno as sno, invoice_type, invoice_no, taxable_amount, tot_vat, tot_sat, total_amount1, grand_total, amount_paid, quantity, dateofdispatch, cus_name from invoice_purchase left join customer on customer.sno = supplier_id where (grand_total!=amount_paid or amount_paid is null) and supplier_id='.$q.' order by dateofdispatch'; 
	//echo $sql;
	$res = execute_query($db, $sql);
	while($row = mysqli_fetch_array($res)) {
		
		$overdue_date = date("Y-m-d", strtotime($row['dateofdispatch'] ."+".$overdue_days."  days"));
		
		$date1=date_create($row['dateofdispatch']);
		$date2=date_create(date("Y-m-d"));
		$diff=date_diff($date1,$date2);
		
		array_push($result, array("id"=>$row['sno'], "label"=>$row['cus_name'], "cust_name"=>$row['cus_name'], "concerned_person" => "", "department" => "", "invoice_type" => $row['invoice_type'], "taxable_amount" => $row['taxable_amount'], "tot_vat" => $row['tot_vat'], "tot_sat"=>$row['tot_sat'], "total_amount1"=>$row['total_amount1'], "grand_total"=>$row['grand_total'], "amount_paid"=>$row['amount_paid'], "amount_due"=>$row['grand_total']-$row['amount_paid'], "quantity"=>$row['quantity'], "dateofdispatch"=>$row['dateofdispatch'], "overdue_date"=>$overdue_date, "overdue_days"=>$diff->days));
	}
}
elseif($id=='tax_rates'){
	$sql = 'select vat from ((select (vat+excise) as vat from stock_purchase group by vat) union all (select (vat+excise) as vat from stock_sale group by vat)) t group by vat';
	//echo $sql;
	$result_tax = execute_query($db, $sql);
	while($row = mysqli_fetch_assoc($result_tax)){
		array_push($result, array("id"=>$row['vat'], "label"=>$row['vat']));
	}
}
elseif($id=='chk_inventory'){
	$sql = 'select * from general_settings where `desc`="negative_stock_sale"';
	$negative_stock_sale = mysqli_fetch_assoc(execute_query($db, $sql));
	$negative_stock_sale = $negative_stock_sale['rate'];
	if(!isset($_GET['return'])){
		$sql = "(select `sno`, `description`, `type`, `product`, `vat`, `excise`, `basicprice`, `mrp`, `srp`, `msrp`, `warranty`, `warning`, `barcode`, `part_no`, `group`, `sub_group`, `company`, `unit`, `opening` ,  'no' as `data_type`,`enable_barcode` ,`enable_batch_no`, `inv_type`, `enable_multiple_price`, 'stock_available' as tablename from stock_available where (description = '$q' or barcode = '$q') and (status='' or status=0 or status is null)) union distinct (SELECT `stock_available`.`sno` , `stock_available`.`description` , `stock_available`.`type` , `stock_available`.`product`, `stock_available`.`vat` , `stock_available`.`excise`, `basicprice`, `mrp`, `srp`, `msrp`, `warranty`, `warning`, `stock_available`.`barcode`, `stock_available`.`part_no`, `group`, `sub_group`, `stock_available`.`company` , `stock_available`.`unit` , `stock_available`.`opening`, 'yes' as `data_type`,`enable_barcode`,`enable_batch_no`,`inv_type`, `enable_multiple_price`, 'barcode_new' as tablename FROM `barcode_new` JOIN stock_available ON stock_available.sno = p_id WHERE `barcode_new`.`barcode` = '$q' and (status='' or status=0 or status is null))";
		$rsd = execute_query($db, $sql);
		//echo $sql;
		//echo mysqli_error($db);
		if($_GET['type']=='sale'){
			$table_stock = 'stock_sale';
			$table_invoice = 'invoice_sale';
		}
		elseif($_GET['type']=='purchase'){
			$table_stock = 'stock_purchase';
			$table_invoice = 'invoice_purchase';
		}
		elseif($_GET['type']=='sale_pos'){
			$table_stock = 'stock_sale';
			$table_invoice = 'invoice_sale';
		}
		elseif($_GET['type']=='sale_revert'){
			$table_stock = 'stock_sale_revert';
			$table_invoice = 'invoice_sale_revert';
		}
		elseif($_GET['type']=='purchase_revert'){
			$table_stock = 'stock_purchase_revert';
			$table_invoice = 'invoice_purchase_revert';
		}
		if(mysqli_num_rows($rsd)==1){
			$rs = mysqli_fetch_assoc($rsd);
			if(isset($_GET['cust'])){
				if($_GET['cust']!=''){
					$sql = 'select * from '.$table_stock.' where part_id='.$rs['sno'].' and supplier_id='.$_GET['cust'].' order by part_dateofpurchase desc limit 1';
					//echo $sql;
					$rate = execute_query($db, $sql);
					if(mysqli_num_rows($rate)!=0){
						$rate = mysqli_fetch_array($rate);
						$sale_price = $rate['effective_price'];
					}
					else{
						unset($rate);
						$rate['basicprice']=$rs['srp'];
						$rate['description']='';
						$rate['discount']='';
						$sale_price = $rs['srp'];

					}
				}
				else{
					$sql = 'select * from '.$table_stock.' where part_id='.$rs['sno'].' order by part_dateofpurchase desc limit 1';
					//echo $sql;
					$rate = execute_query($db, $sql);
					if(mysqli_num_rows($rate)!=0){
						$rate = mysqli_fetch_array($rate);
						$sale_price = $rate['effective_price'];
					}
					else{
						unset($rate);
						$rate['basicprice']=$rs['srp'];
						$rate['description']='';
						$rate['discount']='';
						$sale_price = $rs['srp'];

					}
				}
			}
			else{
				$sql = 'select * from '.$table_stock.' where part_id='.$rs['sno'].' order by part_dateofpurchase desc, s_no desc limit 1';
				//echo $sql;
				$rate = execute_query($db, $sql);
				if(mysqli_num_rows($rate)==0){
					unset($rate);
					$rate['basicprice']=$rs['srp'];
					$rate['description']='';
					$rate['discount']='';
					$sale_price = $rs['srp'];
				}
				else{
					$rate = mysqli_fetch_array($rate);	
					$sale_price = $rate['effective_price'];
				}
			}
			$srp = round($rate['basicprice']+($rate['basicprice']*$rs['vat']*2)/100,2);
			if($_GET['type']=='sale_pos'){
				$srp = $rs['srp'];
			}
			$type_array = array();
			$company_array=array();
			$unit_array = array();
			$unit_conv_array = array();
			$unit_conv_value_array = array();
			$batch_no_array = array();

			if($_GET['type']=='sale' || $_GET['type']=='sale_pos' ){
				$sql = 'select * from stock_purchase where part_id="'.$rs['sno'].'" and batch_no is not null and pur_qty>0';
				//echo $sql;
				$result_batch_no = execute_query($db, $sql);
				while($row_batch_no = mysqli_fetch_array($result_batch_no)){
					$batch_qty = unit_conv($row_batch_no['part_id'], $row_batch_no['pur_qty'], $row_batch_no['unit'], $rs['unit']);
					
					$batch_no_array[$row_batch_no['s_no']] = $row_batch_no['batch_no'].', EXP- '.$row_batch_no['expiry'].', MFG- '.$row_batch_no['mfg_date'].', Qty- '.$batch_qty.', SRP-'.$row_batch_no['srp'];
				}
				$final_batch_no_array = array();
				$final_batch_no_array[] = $batch_no_array;
			}
			else{
				$final_batch_no_array = array();
			}

			$sql = 'select * from unit where sno<=44';
			$result_unit = execute_query($db, $sql);
			while($row_unit = mysqli_fetch_array($result_unit)){
				$unit_array[$row_unit['sno']] = $row_unit['unit'].'-'.$row_unit['unit_desc'];
			}
			$final_unit_array = array();
			$final_unit_array[] = $unit_array;

			$sql = 'select * from new_type';
			$result_type = execute_query($db, $sql);
			while($row_type = mysqli_fetch_array($result_type)){
				$type_array[$row_type['sno']] = $row_type['description'];
			}
			$final_type_array = array();
			$final_type_array[] = $type_array;

			$sql_company= 'select * from company';
			$result_company = execute_query($sql_company);
			while($row_company= mysqli_fetch_array($result_company)){
				$company_array[$row_company['sno']]=$row_company['description'];
			}
			$final_company_array = array();
			$final_company_array[] = $company_array;

			$unit_conv_array[$rs['unit']] = get_unit($rs['unit']);
			$sql = 'select * from unit_conversion where part_id='.$rs['sno'];
			$result_conv = execute_query($db, $sql);
			if(mysqli_num_rows($result_conv)>0){
				while($row_conv = mysqli_fetch_array($result_conv)){
					$unit_conv_array[$row_conv['unit']]=get_unit($row_conv['unit']);
					$unit_conv_value_array[$row_conv['unit']]=$row_conv['conversion'];
				}
			}
			$final_unit_conv_array = array();
			$final_unit_conv_array[] = $unit_conv_array;
			$final_unit_conv_value_array = array();
			$final_unit_conv_value_array[] = $unit_conv_value_array;
			$qty = store_balance($_GET['store'], $rs['sno'], $_GET['cur_date']);
			
			$sql = 'select * from general_settings where `desc`="selling_price"';
			//echo $sql;
			$selling_price = mysqli_fetch_array(execute_query($db, $sql));
			if($selling_price['rate']=='srp'){
				if($rate['discount']!=''){
					if(strpos($rate['discount'], "%")){
						$discount = str_replace("%", "", $rate['discount']);
						$tax = (100+$rs['vat']+$rs['excise'])/100;
						$base_price = $rs['srp']/$tax;
						$unit_price = $base_price;
						$base_price -= $base_price*$discount/100;
						$base_price += ($base_price*($rs['vat']+$rs['excise']))/100;
						$sale_price = $base_price;
					}
					else{
						$discount = $rate['discount'];
						$tax = (100+$rs['vat']+$rs['excise'])/100;
						$base_price = $rs['srp']/$tax;
						$unit_price = $base_price;
						$base_price -= $discount;
						$base_price += ($base_price*($rs['vat']+$rs['excise']))/100;
						$sale_price = $base_price;
					}
				}
				else{
					$tax = (100+$rs['vat']+$rs['excise'])/100;
					$sale_price = $rs['srp'];
					$unit_price = $rs['srp']/$tax;
				}
			}
			
			$sql = 'select * from general_settings where `desc`="multi_store"';
			//echo $sql;
			$multi_store = mysqli_fetch_array(execute_query($db, $sql));
			

			array_push($result, array("id"=>$rs['sno'], "label"=>htmlspecialchars_decode($rs['description'], ENT_QUOTES), "description"=>htmlspecialchars_decode($rs['description'], ENT_QUOTES), "product_description"=>htmlspecialchars_decode($rate['description'], ENT_QUOTES), "type"=>$rs['type'], "product"=>$rs['product'], "unit_price"=>$unit_price, "sale_price"=>$sale_price, "mrp"=>$rs['mrp'], "srp"=>$srp, "msrp"=>$rs['msrp'], "warranty"=>$rs['warranty'], "warning"=>$rs['warning'], "barcode"=>$rs['barcode'], "hsn_code"=>$rs['part_no'], "vat"=>$rs['vat'], "excise"=>$rs['excise'], "discount"=>$rate['discount'], "company"=>$rs['company'], "unit"=>$rs['unit'], "opening"=>$rs['opening'],  "barcode1"=>$q, "data_type"=>$rs['data_type'], "enable_barcode"=>$rs['enable_barcode'], "enable_batch_no"=>$rs['enable_batch_no'], "inv_type"=>$rs['inv_type'], "batch_no_options"=>$final_batch_no_array, "unit_options"=>$final_unit_array, "type_options"=>$final_type_array, "company_options"=>$final_company_array, "unit_conv"=>$final_unit_conv_array, "unit_conv_value"=>$final_unit_conv_value_array, "avail_qty"=>$qty, "enable_multiple_price"=>$rs['enable_multiple_price'], "multi_store"=>$multi_store['rate'], "table_name"=>$rs['tablename'], "negative_stock_sale"=>$negative_stock_sale ));
		}
		else{
			array_push($result, array("id"=>"0"));
		}
	}
	else{
		$type_array = array();
		$company_array=array();
		$unit_array = array();
		$unit_conv_array = array();
		$unit_conv_value_array = array();
		$batch_no_array = array();

		$sql = 'select * from general_settings where `desc`="return_date"';
		$return = mysqli_fetch_array(execute_query($db, $sql));
		$return = $return['rate'];

		$return_date = date('Y-m-d', strtotime("-".$return." days"));

		$sql = "select stock_available.sno as sno, stock_sale.s_no, stock_sale.pur_qty, stock_available.description, stock_sale.mrp, stock_sale.msrp, 'no' as data_type, stock_sale.warranty, warning, barcode, part_no, stock_sale.description as product_description, part_dateofpurchase, invoice_sale.invoice_no, stock_available.type, stock_sale.vat, stock_sale.excise, company, company.description as company_name, stock_sale.unit, opening,`enable_barcode`,`enable_batch_no`, stock_sale.srp, stock_sale.basicprice, stock_sale.vat_value, stock_sale.excise_value, stock_sale.discount, stock_sale.discount_value, stock_sale.taxable_amount, stock_sale.effective_price, qty, stock_available.product, stock_available.inv_type, batch_no, expiry, mfg_date, batch_sno, enable_multiple_price from stock_sale left join stock_available on stock_sale.part_id = stock_available.sno left join company on company.sno = stock_available.company left join invoice_sale on invoice_sale.sno = stock_sale.invoice_no where stock_available.description like '%$q%' and part_dateofpurchase>='".$return_date."'  and stock_sale.supplier_id=".$_GET['cust'];
		$rsd = execute_query($db, $sql);
		if(mysqli_error($db)){
			echo mysqli_error($db).'<br><br>';
			echo $sql;
		}
		while($rs = mysqli_fetch_array($rsd)){
			$unit_conv_array = array();
			$unit_conv_value_array = array();
			$unit_conv_array[$rs['unit']] = get_unit($rs['unit']);
			$sql = 'select * from unit_conversion where part_id='.$rs['sno'];
			$result_conv = execute_query($db, $sql);
			if(mysqli_num_rows($result_conv)>0){
				while($row_conv = mysqli_fetch_array($result_conv)){
					$unit_conv_array[$row_conv['unit']]=get_unit($row_conv['unit']);
					$unit_conv_value_array[$row_conv['unit']]=$row_conv['conversion'];
				}
			}
			$final_unit_conv_value_array = array();
			$final_unit_conv_value_array[] = $unit_conv_value_array;
			$batch_no_array = array();
			
			$sql = 'select * from unit where sno<=44';
			$result_unit = execute_query($db, $sql);
			while($row_unit = mysqli_fetch_array($result_unit)){
				$unit_array[$row_unit['sno']] = $row_unit['unit'].'-'.$row_unit['unit_desc'];
			}
			$final_unit_array = array();
			$final_unit_array[] = $unit_array;
			$final_unit_conv_array = array();
			$final_unit_conv_array[] = $unit_conv_array;
			
			$sql_company= 'select * from company';
			$result_company = execute_query($sql_company);
			while($row_company= mysqli_fetch_array($result_company)){
				$company_array[$row_company['sno']]=$row_company['description'];
			}
			$final_company_array = array();
			$final_company_array[] = $company_array;
			
			$batch_no_array[$rs['s_no']] = $rs['batch_no'].', EXP- '.$rs['expiry'].', MFG- '.$rs['mfg_date'].', Qty- '.$rs['pur_qty'];
			$final_batch_no_array = array();
			$final_batch_no_array[] = $batch_no_array;
			
			$sql = 'select * from new_type';
			$result_type = execute_query($db, $sql);
			while($row_type = mysqli_fetch_array($result_type)){
				$type_array[$row_type['sno']] = $row_type['description'];
			}
			$final_type_array = array();
			$final_type_array[] = $type_array;
			
			array_push($result, array("id"=>$rs['sno'], "label"=>htmlspecialchars_decode($rs['description'], ENT_QUOTES), "description"=>htmlspecialchars_decode($rs['description'], ENT_QUOTES), "product_description"=>htmlspecialchars_decode($rs['description'], ENT_QUOTES), "type"=>$rs['type'], "product"=>$rs['product'], "sale_price"=>$rs['basicprice'], "mrp"=>$rs['mrp'], "srp"=>$rs['basicprice'], "msrp"=>$rs['msrp'], "warranty"=>$rs['warranty'], "warning"=>$rs['warning'], "barcode"=>$rs['barcode'], "hsn_code"=>$rs['part_no'], "vat"=>$rs['vat'], "excise"=>$rs['excise'], "discount"=>$rs['discount'], "company"=>$rs['company'], "unit"=>$rs['unit'], "opening"=>$rs['opening'],  "barcode1"=>$q, "data_type"=>$rs['data_type'], "enable_barcode"=>$rs['enable_barcode'], "enable_batch_no"=>$rs['enable_batch_no'], "inv_type"=>$rs['inv_type'], "batch_no_options"=>$final_batch_no_array, "unit_options"=>$final_unit_array, "type_options"=>$final_type_array, "company_options"=>$final_company_array, "unit_conv"=>$final_unit_conv_array, "unit_conv_value"=>$final_unit_conv_value_array, "avail_qty"=>$rs['pur_qty'], "batch_no"=>$rs['batch_no'], "batch_sno"=>$rs['batch_sno'], "expiry"=>$rs['expiry'], "enable_multiple_price"=>$rs['enable_multiple_price'], "negative_stock_sale"=>$negative_stock_sale));
		}		
	}
}
elseif($id=='save_stock'){
	$_GET['prod_desc']=urldecode($_GET['prod_desc']);
	$_GET['stock_barcode']=htmlspecialchars(urldecode($_GET['stock_barcode']), ENT_QUOTES);
	$_GET['company'] = str_replace("key_","",$_GET['company']);
	$_GET['type'] = str_replace("key_","",$_GET['type']);
	$_GET['enable_batch_no'] = strtoupper($_GET['enable_batch_no']);
	$gst = is_numeric($_GET['gst'])?$_GET['gst']/2:$_GET['gst'];
	//echo $_GET['enable_barcode'];
	$sno = add_stock($_GET['prod_desc'], $_GET['unit'], $gst, $gst, '', $_GET['company'], '', $_GET['type'], $_GET['hsn_code'], '', $_GET['mrp'], $_GET['srp'], $_GET['msrp'], '', $_GET['stock_barcode'], $_GET['stock_warning'], '', '', $_GET['stock_warranty'], $_GET['enable_barcode'], $_GET['enable_batch_no'], $_GET['inv_type'], '', $_GET['unit2'], $_GET['unit2_conv'], $_GET['unit3'], $_GET['unit3_conv']);
}
elseif($id=='misc'){
	$unit = array();
	$type = array();
	$company = array();
	$gst = array();
	$sql = 'select * from unit where sno';
	$result_unit = execute_query($db, $sql);
	while($row_unit = mysqli_fetch_array($result_unit)){
		$unit[$row_unit['sno']]= $row_unit['unit'].'-'.$row_unit['unit_desc'];
	}
	
	$sql = 'select * from new_type';
	$result_type = execute_query($db, $sql);
	while($row_type = mysqli_fetch_array($result_type)){
		$type[$row_type['sno']] = $row_type['description'];
	}
	
	$sql = 'select * from company';
	$result_company = execute_query($db, $sql);
	while($row_company = mysqli_fetch_array($result_company)){
		$company[$row_company['sno']] = $row_company['description'];
	}
	
	$sql = 'select * from gst_rates where status=1';
	$resul_gst = execute_query($db, $sql);
	while($row_gst = mysqli_fetch_assoc($resul_gst)){
		$gst[$row_gst['gst_rate']] = $row_gst['display'];
	}
	
	array_push($result, array("unit"=>$unit, "type"=>$type, "company"=>$company, "gst"=>$gst));
}
elseif($id=='nav'){
	$sql = '(select * from navigation where link_description like "'.$q.'%") union distinct (select * from navigation where link_description like "%'.$q.'%") order by parent, link_description';
	$result_query = execute_query($db, $sql);
	while($row = mysqli_fetch_assoc($result_query)){
		if($row['parent']!='' && $row['parent']!='P'){
			$sql = 'select * from navigation where sno="'.$row['parent'].'"';
			$parent = mysqli_fetch_assoc(execute_query($db, $sql));
			array_push($result, array("label"=>$parent['link_description'].' > '.$row['link_description'], "hyper_link"=>$row['hyper_link']));
		}
		else{
			array_push($result, array("label"=>$row['link_description'], "hyper_link"=>$row['hyper_link']));
		}
	}
	/*$sql = 'select * from navigation where link_description like "%'.$q.'%"';
	$result_query = execute_query($db, $sql);
	while($row = mysqli_fetch_assoc($result_query)){
		if($row['parent']!='' && $row['parent']!='P'){
			$sql = 'select * from navigation where sno="'.$row['parent'].'"';
			$parent = mysqli_fetch_assoc(execute_query($db, $sql));
			array_push($result, array("label"=>$parent['link_description'].' > '.$row['link_description'], "hyper_link"=>$row['hyper_link']));
		}
		else{
			array_push($result, array("label"=>$row['link_description'], "hyper_link"=>$row['hyper_link']));
		}
	}*/
	//echo $sql;
}
elseif($id=='return'){
	$sql = 'select * from general_settings where `desc`="return_date"';
	$return = mysqli_fetch_array(execute_query($db, $sql));
	$return = $return['rate'];
	
	$return_date = date('Y-m-d', strtotime("-".$return." days"));
	
	$sql = "select stock_available.sno, stock_available.description, stock_sale.description as product_description, part_dateofpurchase, invoice_sale.invoice_no, stock_available.type, stock_sale.vat, stock_sale.excise, company, company.description as company_name, stock_sale.unit, opening,`enable_barcode`,`enable_batch_no`, stock_sale.srp, stock_sale.basicprice, stock_sale.vat_value, stock_sale.excise_value, stock_sale.discount, stock_sale.discount_value, stock_sale.taxable_amount, stock_sale.effective_price, qty, stock_available.product, stock_available.inv_type, batch_no, expiry, mfg_date from stock_sale left join stock_available on stock_sale.part_id = stock_available.sno left join company on company.sno = stock_available.company left join invoice_sale on invoice_sale.sno = stock_sale.invoice_no where stock_available.description like '%$q%' and part_dateofpurchase>='".$return_date."' and stock_sale.supplier_id=".$_GET['cust'];
	$rsd = execute_query($db, $sql);
	while($rs = mysqli_fetch_array($rsd)){
		$unit_conv_array = array();
		$unit_conv_value_array = array();
		$unit_conv_array[$rs['unit']] = get_unit($rs['unit']);
		$sql = 'select * from unit_conversion where part_id='.$rs['sno'];
		$result_conv = execute_query($db, $sql);
		if(mysqli_num_rows($result_conv)>0){
			while($row_conv = mysqli_fetch_array($result_conv)){
				$unit_conv_array[$row_conv['unit']]=get_unit($row_conv['unit']);
				$unit_conv_value_array[$row_conv['unit']]=$row_conv['conversion'];
			}
		}
		$final_unit_conv_array = array();
		$final_unit_conv_array[] = $unit_conv_array;
		$final_unit_conv_value_array = array();
		$final_unit_conv_value_array[] = $unit_conv_value_array;		
		
		array_push($result, array("id"=>$rs['sno'], "label"=>htmlspecialchars_decode($rs['description'].' (INV : #'.$rs['invoice_no'].'. DT : '.$rs['part_dateofpurchase'].'. Batch : '.$rs['batch_no'].'. QTY : '.$rs['qty'].')', ENT_QUOTES).' - '.$rs['company_name'], "description"=>htmlspecialchars_decode($rs['description'], ENT_QUOTES), "product_description"=>$rs['product_description'], "type"=>$rs['type'], "product"=>$rs['product'], "sale_price"=>$rs['basicprice'], "vat"=>$rs['vat'], "excise"=>$rs['excise'], "discount"=>$rs['discount'], "company"=>$rs['company'], "unit"=>get_unit($rs['unit']), "unit_sno"=>$rs['unit'], "opening"=>$rs['opening'],"enable_barcode"=>$rs['enable_barcode'],"enable_batch_no"=>$rs['enable_batch_no'],"inv_type"=>$rs['inv_type'], "qty"=>$rs['qty'], "batch"=>$rs['batch_no'], "expiry"=>$rs['expiry'], "mfg_date"=>$rs['mfg_date'], "unit_conv"=>$final_unit_conv_array));
	}

}
elseif($id=='get_batch'){
	if($_GET['form_type']=='purchase'){
		$sql = 'select * from stock_purchase where invoice_no="'.$_GET['edit_sno'].'" limit '.($_GET['part_desc']-1).',1';
	}
	elseif($_GET['form_type']=='sale'){
		$sql = 'select * from stock_sale where invoice_no="'.$_GET['edit_sno'].'" limit '.($_GET['part_desc']-1).',1';
		//echo $sql;
	}
	$stock_row = mysqli_fetch_array(execute_query($db, $sql));
	
	array_push($result, array("id"=>$stock_row['s_no'], "batch_no"=>$stock_row['batch_no'], "expiry"=>$stock_row['expiry'], "mfg_date"=>$stock_row['mfg_date']));
}
else{
	$q = explode("^", $q);
	if(sizeof($q)>1){
		$q[0] = str_replace(" ", "%", $q[0]);
		$comp = ' and company.description like "%'.$q[1].'%"';
		$q = $q[0];
	}
	else{
		$comp = '';
		$q[0] = str_replace(" ", "%", $q[0]);
		$q = $q[0];
	}
	$sql = "(select stock_available.sno, stock_available.description, type, product, vat, excise, company, company.description as company_name, unit, opening,`enable_barcode`,`enable_batch_no`, srp ,`inv_type` from stock_available left join company on company.sno = stock_available.company where (stock_available.description like '%$q%' or barcode like '%$q%' or stock_available.sno='$q') ".$comp." and (status='' or status=0 or status is null))  union distinct (SELECT `stock_available`.`sno` , `stock_available`.`description` , `stock_available`.`type` , `stock_available`.`product`, `stock_available`.`vat` , `stock_available`.`excise` , `stock_available`.`company` , company.description as company_name, `stock_available`.`unit` , `stock_available`.`opening`,`enable_barcode`,`enable_batch_no`, srp ,`inv_type` FROM `barcode_new` JOIN stock_available ON stock_available.sno = p_id join company on company.sno = stock_available.company WHERE `barcode_new`.`barcode` LIKE '%$q%' and (status='' or status=0 or status is null)) limit 20";
	//echo $sql;
	$rsd = execute_query($db, $sql);
	while($rs = mysqli_fetch_array($rsd)){
		$unit_conv_array = array();
		$unit_conv_value_array = array();
		$unit_conv_array[$rs['unit']] = get_unit($rs['unit']);
		$sql = 'select * from unit_conversion where part_id='.$rs['sno'];
		$result_conv = execute_query($db, $sql);
		if(mysqli_num_rows($result_conv)>0){
			while($row_conv = mysqli_fetch_array($result_conv)){
				$unit_conv_array[$row_conv['unit']]=get_unit($row_conv['unit']);
				$unit_conv_value_array[$row_conv['unit']]=$row_conv['conversion'];
			}
		}
		$final_unit_conv_array = array();
		$final_unit_conv_array[] = $unit_conv_array;
		$final_unit_conv_value_array = array();
		$final_unit_conv_value_array[] = $unit_conv_value_array;		
		
		if(isset($_GET['cust'])){
			if($_GET['cust']!=''){
				$sql = 'select * from stock_sale where part_id='.$rs['sno'].' and supplier_id='.$_GET['cust'].' order by part_dateofpurchase desc limit 1';
				$rate = execute_query($db, $sql);
				if(mysqli_num_rows($rate)!=0){
					$rate = mysqli_fetch_array($rate);
				}
				else{
					unset($rate);
					$rate['basicprice']=$rs['srp'];
					$rate['description']='';
					$rate['discount']='';
					
				}
			}
			else{
				$sql = 'select * from stock_sale where part_id='.$rs['sno'].' order by basicprice desc limit 1';
				$rate = execute_query($db, $sql);
				if(mysqli_num_rows($rate)!=0){
					$rate = mysqli_fetch_array($rate);
				}
				else{
					unset($rate);
					$rate['basicprice']=$rs['srp'];
					$rate['description']='';
					$rate['discount']='';
					
				}
			}
		}
		else{
			$sql = 'select * from stock_sale where part_id='.$rs['sno'].' order by basicprice desc limit 1';
			$rate = execute_query($db, $sql);
			if(mysqli_num_rows($rate)==0){
				unset($rate);
				$rate['basicprice']=$rs['srp'];
				$rate['description']='';
				$rate['discount']='';
			}
			else{
				$rate = mysqli_fetch_array($rate);	
			}
		}
		
		$sql = 'select * from general_settings where `desc`="selling_price"';
		//echo $sql;
		$selling_price = mysqli_fetch_array(execute_query($db, $sql));
		if($selling_price['rate']=='srp'){
			if($rate['discount']!=''){
				if(strpos($rate['discount'], "%")){
					$discount = str_replace("%", "", $rate['discount']);
					$tax = (100+$rs['vat']+$rs['excise'])/100;
					$base_price = $rs['srp']/$tax;
					$unit_price = $base_price;
					$base_price -= $base_price*$discount/100;
					$base_price += ($base_price*($rs['vat']+$rs['excise']))/100;
					$sale_price = $base_price;
				}
				else{
					$discount = $rate['discount'];
					$tax = (100+$rs['vat']+$rs['excise'])/100;
					$base_price = $rs['srp']/$tax;
					$unit_price = $base_price;
					$base_price -= $discount;
					$base_price += ($base_price*($rs['vat']+$rs['excise']))/100;
					$sale_price = $base_price;
				}
			}
			else{
				$tax = (100+$rs['vat']+$rs['excise'])/100;
				$sale_price = $rs['srp'];
				$unit_price = $rs['srp']/$tax;
			}
		}
		
		//echo json_encode($rs['description']);
		array_push($result, array("id"=>$rs['sno'], "label"=>htmlspecialchars_decode($rs['description'], ENT_QUOTES).' - '.$rs['company_name'], "description"=>htmlspecialchars_decode($rs['description'], ENT_QUOTES), "product_description"=>$rate['description'], "type"=>$rs['type'], "product"=>$rs['product'], "unit_price"=>$unit_price, "sale_price"=>$sale_price, "vat"=>$rs['vat'], "excise"=>$rs['excise'], "discount"=>$rate['discount'], "company"=>$rs['company'], "unit"=>get_unit($rs['unit']), "unit_sno"=>$rs['unit'], "opening"=>$rs['opening'],"enable_barcode"=>$rs['enable_barcode'],"enable_batch_no"=>$rs['enable_batch_no'],"inv_type"=>$rs['inv_type'], "unit_conv"=>$final_unit_conv_array));
	}
}
if(empty($result)!=true){
	echo array_to_json($result);
}
function array_to_json( $array ){

    if( !is_array( $array ) ){
        return false;
    }

    $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
    if( $associative ){

        $construct = array();
        foreach( $array as $key => $value ){

            // We first copy each key/value pair into a staging array,
            // formatting each key and value properly as we go.

            // Format the key:
            if( is_numeric($key) ){
                $key = "key_$key";
            }
            $key = json_encode($key);

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = json_encode($value);
            }

            // Add to staging array:
            $construct[] = "$key: $value";
        }

        // Then we collapse the staging array into the JSON form:
        $result = "{ " . implode( ", ", $construct ) . " }";

    } else { // If the array is a vector (not associative):

        $construct = array();
        foreach( $array as $value ){

            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = json_encode($value);
            }

            // Add to staging array:
            $construct[] = $value;
        }

        // Then we collapse the staging array into the JSON form:
        $result = "[ " . implode( ", ", $construct ) . " ]";
    }

    return $result;
}
?>