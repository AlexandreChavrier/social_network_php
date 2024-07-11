<?php       
    function extractTrailingNumbers($str) 
    {
    preg_match('/\d+$/', $str, $matches);
    return isset($matches[0]) ? $matches[0] : '';
    }
    function all_tags($tab) 
    {
    $new_tab = array();
    $tag_array = explode(",", $tab);
    for ($i = 0; $i < count($tag_array); $i++) 
    {
        array_push($new_tab, extractTrailingNumbers($tag_array[$i]));
        $new_string = implode(",", $new_tab);
    }
    return $new_string;
    }
?>



<a href="http://localhost/resoc/resoc_n1/tags.php?tag_id=<?php
    $id_tag = all_tags($tag_id);
    for ($i = 0; $i < count($tag_id); $i++) {
        if (count($tag_id) > 0) {
            $tag_id[$i] = $id_tag[$i];
            echo $tag_id[$i];?>">#<?php echo($tags)?></a><?php
        }
        else {
            echo implode($id_tag);?>">#<?php echo($tags)?></a><?php
        }
    }

?>