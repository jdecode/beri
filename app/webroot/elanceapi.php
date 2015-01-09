<?php


$_url = 'https://www.elance.com/r/rss/jobs/q-php';

$_xml = file_get_contents($_url);

$xml = simplexml_load_string($_xml, 'SimpleXMLElement', LIBXML_NOCDATA);

//print_r($xml);

$sources = array(
    1 => 'oDesk',
    2 => 'Elance',
);

mysql_connect('localhost', 'root', 'sftp22');
mysql_select_db('beri');
//if(is_object($xml->channel['item']) && count($xml->channel['item'])) {


foreach ($xml->channel->item as $k => $v) {
    //$uid = ;
	
  $link = mysql_escape_string($v->link);
    $title = mysql_escape_string($v->title);
    $desc = mysql_escape_string($v->description);
    $pubDate = mysql_real_escape_string($v->pubDate);


    preg_match('/<b>Job ID:<\/b>(.*?)<br.*/', $desc, $match);

    if (!empty($match)) {
		
        $uid = trim($match[1]);
    } else {
        $uid = "";
    }
	
    preg_match('/<b>Type and Budget:<\/b>(.*?)<br.*/', $desc, $match1);
    if (!empty($match1)) {
        $budget_text = trim($match1[1]);
        $budget_amount = "";
    } else {
        $budget_text = "";
        $budget_amount = "";
    }
    preg_match('/<b>Start Date:<\/b>(.*?)<br.*/', $desc, $match2);
    if (!empty($match2)) {
        $posted_on = trim($match2[1]);
    } else {
        $posted_on = '';
    }
    
    
    /********************Categoty***********************************/
    preg_match('/<b>Category:<\/b>(.*?)<br.*/', $desc, $match2);
    if (!empty($match2)) {
        $cat = trim($match2[1]);
    } else {
        $cat = '';
    }
	
	
	
  if (preg_match("/>/", $cat)) {
        $rty = explode(">", $cat);
        $cat_1 = $rty[0];
        $cat_2 = $rty[1];
	
		
		$query = "select id from lead_categories where name like '%{$cat_1}%' limit 0,1";
        $cat_result = mysql_query($query);
        if (mysql_num_rows($cat_result) > 0) {
            $row = mysql_fetch_array($cat_result);
            $pid_in = $row['id'];
        } else {

			mysql_query("insert into lead_categories(name)values('{$cat_1}')");
            $pid_in = mysql_insert_id();
        }

        if ($pid_in != '') {
			$c_query = "select id from lead_categories where parent_id=$pid_in and name like '%{$cat_2}%' limit 0,1";
            $c_res = mysql_query($c_query);
            if (mysql_num_rows($c_res) == 0) {
				mysql_query("insert into lead_categories(name,parent_id)values('{$cat_2}',$pid_in)");
                $cat_id_in = mysql_insert_id();
            } else {
                $row1 = mysql_fetch_array($c_res);
                $cat_id_in = $row1['id'];
            }
        }
    } else {
		mysql_query("insert into lead_categories(name)values('{$cat}')");
        $cat_id_in = mysql_insert_id();
    }
/*******************************End of category******************/


    $query = "select uid from leads where uid='{$uid}'";
    $result = mysql_query($query);


    if (mysql_num_rows($result) == 0) {
       $sql = "INSERT INTO leads (link,uid, title, description,budget_amount,budget_text,posted_on,category_id,published_date, source) 
				VALUES ('{$link}','{$uid}', '{$title}', '{$desc}','{$budget_amount}','{$budget_text}','{$posted_on}','{$cat_id_in}', '{$pubDate}', '2');";
	  
	
        if (mysql_query($sql)) {
            echo 'Inserted index ' . mysql_insert_id() . '<br />';
        } else {
            echo '</strong>Error<strong>: ' . mysql_error() . '<br />';
        }
    }
}


/* run mozilla agent */
$agent = 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.125 Safari/537.36';

$ch = curl_init();
curl_setopt($ch, CURLOPT_USERAGENT, $agent); //make it act decent
curl_setopt($ch, CURLOPT_URL, $_url);         //set the $url to where your request goes
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //set this flag for results to the variable
//curl_setopt($ch, CURLOPT_POST, 1);           //if you're making a post, put the data here
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post); //as a key/value pair in $post
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); //This is required for HTTPS certs if
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); //you don't have some key/password action

/* execute the request */
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
