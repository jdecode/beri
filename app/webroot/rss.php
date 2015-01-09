<?php

$_url = 'https://www.odesk.com/jobs/rss?q=php&t[0]=0&t[1]=1&dur[0]=0&dur[1]=1&dur[2]=13&dur[3]=26&dur[4]=none&wl[0]=10&wl[1]=30&wl[2]=none&tba[0]=0&tba[1]=1-9&tba[2]=10-&exp[0]=1&exp[1]=2&exp[2]=3&amount[0]=Min&amount[1]=Max&sortBy=s_ctime+desc&from=find-work&skip=0';
//$_url = 'https://www.odesk.com/jobs/?q=php&spellcheck=1&highlight=1&sortBy=s_ctime+desc&skip=10';
//$_url = 'https://www.elance.com/r/rss/jobs/q-php';

$_xml = file_get_contents($_url);

$xml = simplexml_load_string($_xml, 'SimpleXMLElement', LIBXML_NOCDATA);



/*
  $p = xml_parser_create();
  xml_parse_into_struct($p, $_xml, $vals, $index);
  xml_parser_free($p);
 */

//echo '<pre>';
//print_r($vals);
//print_r($index);
//print_r($_xml);
//print_r($xml);
//print_r($_SERVER);
//echo '</pre>';
//die('1');
$sources = array(
    1 => 'oDesk',
    2 => 'Elance',
);

mysql_connect('localhost', 'root', '');
mysql_select_db('beri');
//if(is_object($xml->channel['item']) && count($xml->channel['item'])) {
foreach ($xml->channel->item as $k => $v) {
    //$uid = ;
    $link = mysql_real_escape_string($v->link);
    $title = mysql_real_escape_string($v->title);
    $desc = mysql_real_escape_string($v->description);
    $pubDate = mysql_real_escape_string($v->pubDate);


    preg_match('/<b>ID<\/b>:(.*?)<b>/', $desc, $match);

    if (!empty($match)) {
        $uid = trim(substr($match[1], 0, -6));
    } else {
        $uid = "";
    }
    preg_match('/<b>Budget<\/b>:(.*?)<b>/', $desc, $match1);
    if (!empty($match1)) {
        $budget_text = trim(substr($match1[1], 0, -6));
        $budget_amount = substr($budget_text, 1);
    } else {
        $budget_text = "";
        $budget_amount = "";
    }
    preg_match('/<b>Posted On<\/b>:(.*?)<b>/', $desc, $match2);
    if (!empty($match2)) {
        $posted_on = trim(substr($match2[1], 0, -6));
    } else {
        $posted_on = '';
    }
    
    
    /********************Categoty***********************************/
    preg_match('/<b>Category<\/b>:(.*?)<b>/', $desc, $match2);
    if (!empty($match2)) {
        $cat = trim(substr($match2[1], 0, -6));
    } else {
        $cat = '';
    }
    if (preg_match("/&gt;/", $cat)) {
        $rty = explode("&gt;", $cat);
        $cat_1 = $rty[0];
        $cat_2 = $rty[1];
        $query = "select id from lead_categories where name like '%$cat_1%' limit 0,1";
        $cat_result = mysql_query($query);
        if (mysql_num_rows($cat_result) > 0) {
            $row = mysql_fetch_array($cat_result);
            $pid_in = $row['id'];
        } else {

            mysql_query("insert into lead_categories(name)values('$cat_1')");
            $pid_in = mysql_insert_id();
        }

        if ($pid_in != '') {
            $c_query = "select id from lead_categories where parent_id=$pid_in and name like '%$cat_2%' limit 0,1";
            $c_res = mysql_query($c_query);
            if (mysql_num_rows($c_res) == 0) {
                mysql_query("insert into lead_categories(name,parent_id)values('$cat_2',$pid_in)");
                $cat_id_in = mysql_insert_id();
            } else {
                $row1 = mysql_fetch_array($c_res);
                $cat_id_in = $row1['id'];
            }
        }
    } else {
        mysql_query("insert into lead_categories(name)values('$cat')");
        $cat_id_in = mysql_insert_id();
    }
/*******************************End of category******************/


    $query = "select uid from leads where uid='{$uid}'";
    $result = mysql_query($query);


    if (mysql_num_rows($result) == 0) {
        $sql = "INSERT INTO leads (link,uid, title, description,budget_amount,budget_text,posted_on,category_id,published_date, source) 
                VALUES ('$link','$uid', '$title', '$desc','$budget_amount','$budget_text','$posted_on',$cat_id_in, '$pubDate', '1');";
        if (mysql_query($sql)) {
            echo 'Inserted index ' . mysql_insert_id() . '<br />';
        } else {
            echo '</strong>Error<strong>: ' . mysql_error() . '<br />';
        }
    }
}

die('!');

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
