<?php
	if(!$require_functions_allow){
		header('Location: /error');
		exit();
	}

	function check_user_loged($user_info){
		$temp = intable_search_item("SELECT * FROM `user` WHERE `id`=".$user_info['id']);

		if($temp['pass'] == $user_info['pass']) return true;
		else return false;
	}

	function intable_search_item_id($line, $table, $keys){
		$massive = split(" ", mb_strtolower($line), 5);
		$ret = array();

		$keys_line = "";

		for($i = 0; $i < count($keys); $i++){
			if($i == 0) $keys_line = "WHERE ";
			if($i > 0) $keys_line = $keys_line." AND ";
			$keys_line = $keys_line."`".$keys[$i][0]."`=".$keys[$i][1];
		}

		$query = mysql_query("SELECT `id`, `item_name` FROM `".$table."` ".$keys_line." ORDER BY `shop_items`.`time` DESC");
		$count = mysql_num_rows($query);

		for($i = 0; $i < $count; $i++){
			$temp = mysql_fetch_array($query);
			$item_name = split(" ", mb_strtolower($temp['item_name']), 5);
			if(strlen($line) == 0 || count(array_uintersect($massive, $item_name, "strcasecmp")) > 0) array_push($ret, $temp['id']);
		}

		return $ret;
	}
	
	function require_filter($line){
		$pattern = array("and", "insert", "(", ")", "select", "*", "from", "where", "id");
		$sql_line = split(" ", mb_strtolower($line));
		$count = count(array_intersect($sql_line, $pattern));
		if($count > 0) return false;
		return true;
	}

	function intable_count_items($line){
		$temp = mysql_query($line);
		return mysql_num_rows($temp);
	}
	
	function intable_search_item($line){
		$temp = mysql_query($line);
		return mysql_fetch_array($temp);
	}

	function intable_search_items($line, $count_elem){
		$temp = mysql_query($line);
		$ret_mas = array();

		$count = mysql_num_rows($temp);
		if($count_elem != -1 && $count > $count_elem) $count = $count_elem;

		for($i = 0; $i < $count; $i++)
			$ret_mas[$i] = mysql_fetch_array($temp);
		return $ret_mas;
	}

	function rand_mass($start, $end){
		$mass = array();

		for($i = 0; $i <= $end - $start; $i++)
			while (true){
			    $temp = rand($start, $end);
			    if(!in_array($temp, $mass)){
			    	array_push($mass, $temp);
			    	break;
			    }
			}

		return $mass;
	}

	function int_div($a, $b){
		return (int)($a/$b - ($a%$b)/$b);
	}

	function name_generate($count){
		$name = "";
		$chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
		for($i = 0; $i < $count; $i++)
			$name = $name.$chars[rand(0, 25)];
		return $name;
	}

	function upload_file($file, $max_size, $types, $user_id){
		$path = "uploads/";
		if($file['size'] <= $max_size && in_array($file['type'], $types)){
			while(true){
				$path = $path.name_generate(15)."_".$user_id.".".split("/", $file['type'])[1];
			    if(!file_exists($path)) break;
			}
			if(move_uploaded_file($file['tmp_name'], $path)) return $path;
			else return null;
		} else return null;
	}

	function upload_files($files, $max_size, $types, $user_id){
		$return_line = "";

		for($i = 0; $i < count($files['name']); $i++)
			if($files['size'][$i] <= $max_size && in_array($files['type'][$i], $types)){
				$path = "uploads/";
				while(true){
					$path = $path.name_generate(15)."_".$user_id.".".split("/", $files['type'][$i])[1];
				    if(!file_exists($path)) break;
				}
				if(move_uploaded_file($files['tmp_name'][$i], $path)) $return_line = $return_line.$path;
				if($i != count($files['name']) - 1) $return_line = $return_line." ";
			}

		if($return_line != "") return $return_line;
		else return null;
	}
?>