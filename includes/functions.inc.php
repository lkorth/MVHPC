<?PHP

function returnImage($id) {
  $db = Database::getDatabase();
  return ($db->getRow("SELECT * FROM search WHERE id = '$id'"));
}

function updateImageViews($views, $trueViews, $id){
  $db = Database::getDatabase();
  return ($db->query("UPDATE search SET views = '$views', trueviews = '$trueViews' WHERE id = '$id'"));
}

function returnCentennialIndex($letter){
  $db = Database::getDatabase();
  return ($db->getRow("SELECT data FROM centennial_book_index WHERE letter = '$letter'"));
}

function returnPosts($page, $maxNumberResults = 1){
    $db = Database::getDatabase();
    return ($db->getRows("SELECT * FROM posts WHERE page='$page' order by date desc limit $maxNumberResults"));
}

function returnAPost($id){
    $db = Database::getDatabase();
    return ($db->getRow("SELECT * FROM posts WHERE id='$id'"));
}

function featuredImages(){
    $db = Database::getDatabase();
    return ($db->getRows("SELECT id, thumbnail FROM search where live = '1' ORDER BY RAND() LIMIT 5"));
}

function renderPaging($pager, $url, $rewrite = false){
    if($rewrite)
        $pre = '/';
    else
        $pre = '&page=';

    if ($pager->hasNextPage() || $pager->hasPrevPage()) {
        echo '<div><br>';

        if ($pager->hasPrevPage()) {
            echo '<a href="' . $url . $pre . $pager->prevPage() . '"/><=Prevous Page=</a>';
            echo "&nbsp;&nbsp;&nbsp;";
        }

        if ($pager->prevPage() > 1) {
            $previousPageNumbers = '';
            $j = $pager->prevPage();
            $previousCount = 0;
            while ($j >= 1 && $previousCount < 3) {
                $previousPageNumbers = '<a href="' . $url . $pre . $j . '"/>' . $j . '</a>&nbsp;&nbsp;&nbsp;' . $previousPageNumbers;
                $previousCount++;
                $j--;
            }
            echo $previousPageNumbers;
        }

        echo "<span>" . $pager->page . "</span>";
        echo "&nbsp;&nbsp;&nbsp;";

        if ($pager->hasNextPage()) {
            if ($pager->nextPage() != $pager->numPages) {
                $k = $pager->nextPage();
                $nextCount = 0;
                while ($k <= $pager->numPages && $nextCount < 3) {
                    echo '<a href="' . $url . $pre . $k . '"/>' . $k . '</a>&nbsp;&nbsp;&nbsp;';
                    $nextCount++;
                    $k++;
                }
            }

            echo '<a href="' . $url . $pre . $pager->nextPage() . '"/>=Next Page=></a>';
        }

        echo '<br></div>';
    }
}

function autocomplete($field, $searchString, $fullText = false) {
    $db = Database::getDatabase();

    $q = mysql_real_escape_string(strtolower($searchString));

    if (!$q)
        return;

    if($fullText){
        $result = $db->query("SELECT tags, MATCH(tags, information) AGAINST('$q') AS score FROM search WHERE MATCH(tags, information) AGAINST('$q') and live = '1' ORDER BY score DESC, views DESC");
    }
    if (isset($result) && $result != false && $db->numRows($result) > 0) {
        $num = $db->numRows($result);
    } else {
        $result = $db->query("SELECT $field FROM search WHERE $field LIKE '%$q%' and live = '1' ORDER BY views DESC");
        $num = $db->numRows($result);
    }

    $tags = '';
    for($i = 0; $i < $num; $i++) {
        $tags = $tags . ";" . mysql_result($result, $i, "tags");
    }

    $final = array_unique(array_map("trim", explode(";", $tags)), SORT_STRING);

    $stop = 0;
    foreach ($final as $value) {
        if ($stop < 8 && strpos($value, $q) !== false) {
            echo "$value\n";
            $stop++;
        }
    }
}

function set_option($key, $val) {
    $db = Database::getDatabase();
    $db->query('REPLACE INTO options (`key`, `value`) VALUES (:key:, :value:)', array('key' => $key, 'value' => $val));
}

function get_option($key, $default = null) {
    $db = Database::getDatabase();
    $db->query('SELECT `value` FROM options WHERE `key` = :key:', array('key' => $key));
    if ($db->hasRows())
        return $db->getValue();
    else
        return $default;
}

function delete_option($key) {
    $db = Database::getDatabase();
    $db->query('DELETE FROM options WHERE `key` = :key:', array('key' => $key));
    return $db->affectedRows();
}

function pr($var) {
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

// Formats a given number of seconds into proper mm:ss format
function format_time($seconds) {
    return floor($seconds / 60) . ':' . str_pad($seconds % 60, 2, '0');
}

// Given a string such as "comment_123" or "id_57", it returns the final, numeric id.
function split_id($str) {
    return match('/[_-]([0-9]+)$/', $str, 1);
}

// Creates a friendly URL slug from a string
function slugify($str) {
    $str = preg_replace('/[^a-zA-Z0-9 -]/', '', $str);
    $str = strtolower(str_replace(' ', '-', trim($str)));
    $str = preg_replace('/-+/', '-', $str);
    return $str;
}

// Computes the *full* URL of the current page (protocol, server, path, query parameters, etc)
function full_url() {
    $s = empty($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';
    $protocol = substr(strtolower($_SERVER['SERVER_PROTOCOL']), 0, strpos(strtolower($_SERVER['SERVER_PROTOCOL']), '/')) . $s;
    $port = ($_SERVER['SERVER_PORT'] == '80') ? '' : (":" . $_SERVER['SERVER_PORT']);
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $port . $_SERVER['REQUEST_URI'];
}

// Returns an English representation of a date
// Graciously stolen from http://ejohn.org/files/pretty.js
function time2str($ts) {
    if (!ctype_digit($ts))
        $ts = strtotime($ts);

    $diff = time() - $ts;
    if ($diff == 0)
        return 'now';
    elseif ($diff > 0) {
        $day_diff = floor($diff / 86400);
        if ($day_diff == 0) {
            if ($diff < 60)
                return 'just now';
            if ($diff < 120)
                return '1 minute ago';
            if ($diff < 3600)
                return floor($diff / 60) . ' minutes ago';
            if ($diff < 7200)
                return '1 hour ago';
            if ($diff < 86400)
                return floor($diff / 3600) . ' hours ago';
        }
        if ($day_diff == 1)
            return 'Yesterday';
        if ($day_diff < 7)
            return $day_diff . ' days ago';
        if ($day_diff < 31)
            return ceil($day_diff / 7) . ' weeks ago';
        if ($day_diff < 60)
            return 'last month';
        $ret = date('F Y', $ts);
        return ($ret == 'December 1969') ? '' : $ret;
    }
    else {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);
        if ($day_diff == 0) {
            if ($diff < 120)
                return 'in a minute';
            if ($diff < 3600)
                return 'in ' . floor($diff / 60) . ' minutes';
            if ($diff < 7200)
                return 'in an hour';
            if ($diff < 86400)
                return 'in ' . floor($diff / 3600) . ' hours';
        }
        if ($day_diff == 1)
            return 'Tomorrow';
        if ($day_diff < 4)
            return date('l', $ts);
        if ($day_diff < 7 + (7 - date('w')))
            return 'next week';
        if (ceil($day_diff / 7) < 4)
            return 'in ' . ceil($day_diff / 7) . ' weeks';
        if (date('n', $ts) == date('n') + 1)
            return 'next month';
        $ret = date('F Y', $ts);
        return ($ret == 'December 1969') ? '' : $ret;
    }
}

// Returns an array representation of the given calendar month.
// The array values are timestamps which allow you to easily format
// and manipulate the dates as needed.
function calendar($month = null, $year = null) {
    if (is_null($month))
        $month = date('n');
    if (is_null($year))
        $year = date('Y');

    $first = mktime(0, 0, 0, $month, 1, $year);
    $last = mktime(23, 59, 59, $month, date('t', $first), $year);

    $start = $first - (86400 * date('w', $first));
    $stop = $last + (86400 * (7 - date('w', $first)));

    $out = array();
    while ($start < $stop) {
        $week = array();
        if ($start > $last)
            break;
        for ($i = 0; $i < 7; $i++) {
            $week[$i] = $start;
            $start += 86400;
        }
        $out[] = $week;
    }

    return $out;
}

// Processes mod_rewrite URLs into key => value pairs
// See .htacess for more info.
function pick_off($grab_first = false, $sep = '/') {
    $ret = array();
    $arr = explode($sep, trim($_SERVER['REQUEST_URI'], $sep));
    if ($grab_first)
        $ret[0] = array_shift($arr);
    while (count($arr) > 0)
        $ret[array_shift($arr)] = array_shift($arr);
    return (count($ret) > 0) ? $ret : false;
}

// Creates a list of <option>s from the given database table.
// table name, column to use as value, column(s) to use as text, default value(s) to select (can accept an array of values), extra sql to limit results
function get_options($table, $val, $text, $default = null, $sql = '') {
    $db = Database::getDatabase(true);
    $out = '';

    $table = $db->escape($table);
    $rows = $db->getRows("SELECT * FROM `$table` $sql");
    foreach ($rows as $row) {
        $the_text = '';
        if (!is_array($text))
            $text = array($text); // Allows you to concat multiple fields for display
        foreach ($text as $t)
            $the_text .= $row[$t] . ' ';
        $the_text = htmlspecialchars(trim($the_text));

        if (!is_null($default) && $row[$val] == $default)
            $out .= '<option value="' . htmlspecialchars($row[$val], ENT_QUOTES) . '" selected="selected">' . $the_text . '</option>';
        elseif (is_array($default) && in_array($row[$val], $default))
            $out .= '<option value="' . htmlspecialchars($row[$val], ENT_QUOTES) . '" selected="selected">' . $the_text . '</option>';
        else
            $out .= '<option value="' . htmlspecialchars($row[$val], ENT_QUOTES) . '">' . $the_text . '</option>';
    }
    return $out;
}

// More robust strict date checking for string representations
function chkdate($str) {
    // Requires PHP 5.2
    if (function_exists('date_parse')) {
        $info = date_parse($str);
        if ($info !== false && $info['error_count'] == 0) {
            if (checkdate($info['month'], $info['day'], $info['year']))
                return true;
        }

        return false;
    }

    // Else, for PHP < 5.2
    return strtotime($str);
}

// Converts a date/timestamp into the specified format
function dater($date = null, $format = null) {
    if (is_null($format))
        $format = 'Y-m-d H:i:s';

    if (is_null($date))
        $date = time();

    if (is_int($date))
        return date($format, $date);
    if (is_float($date))
        return date($format, $date);
    if (is_string($date)) {
        if (ctype_digit($date) === true)
            return date($format, $date);
        if ((preg_match('/[^0-9.]/', $date) == 0) && (substr_count($date, '.') <= 1))
            return date($format, floatval($date));
        return date($format, strtotime($date));
    }

    // If $date is anything else, you're doing something wrong,
    // so just let PHP error out however it wants.
    return date($format, $date);
}

// Formats a phone number as (xxx) xxx-xxxx or xxx-xxxx depending on the length.
function format_phone($phone) {
    $phone = preg_replace("/[^0-9]/", '', $phone);

    if (strlen($phone) == 7)
        return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
    elseif (strlen($phone) == 10)
        return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
    else
        return $phone;
}

// Outputs hour, minute, am/pm dropdown boxes
function hourmin($hid = 'hour', $mid = 'minute', $pid = 'ampm', $hval = null, $mval = null, $pval = null) {
    // Dumb hack to let you just pass in a timestamp instead
    if (func_num_args() == 1) {
        list($hval, $mval, $pval) = explode(' ', date('g i a', strtotime($hid)));
        $hid = 'hour';
        $mid = 'minute';
        $aid = 'ampm';
    } else {
        if (is_null($hval))
            $hval = date('h');
        if (is_null($mval))
            $mval = date('i');
        if (is_null($pval))
            $pval = date('a');
    }

    $hours = array(12, 1, 2, 3, 4, 5, 6, 7, 9, 10, 11);
    $out = "<select name='$hid' id='$hid'>";
    foreach ($hours as $hour)
        if (intval($hval) == intval($hour))
            $out .= "<option value='$hour' selected>$hour</option>";
        else
            $out .= "<option value='$hour'>$hour</option>";
    $out .= "</select>";

    $minutes = array('00', 15, 30, 45);
    $out .= "<select name='$mid' id='$mid'>";
    foreach ($minutes as $minute)
        if (intval($mval) == intval($minute))
            $out .= "<option value='$minute' selected>$minute</option>";
        else
            $out .= "<option value='$minute'>$minute</option>";
    $out .= "</select>";

    $out .= "<select name='$pid' id='$pid'>";
    $out .= "<option value='am'>am</option>";
    if ($pval == 'pm')
        $out .= "<option value='pm' selected>pm</option>";
    else
        $out .= "<option value='pm'>pm</option>";
    $out .= "</select>";

    return $out;
}

// Returns the HTML for a month, day, and year dropdown boxes.
// You can set the default date by passing in a timestamp OR a parseable date string.
// $prefix_ will be appened to the name/id's of each dropdown, allowing for multiple calls in the same form.
// $output_format lets you specify which dropdowns appear and in what order.
function mdy($date = null, $prefix = null, $output_format = 'm d y') {
    if (is_null($date))
        $date = time();
    if (!ctype_digit($date))
        $date = strtotime($date);
    if (!is_null($prefix))
        $prefix .= '_';
    list($yval, $mval, $dval) = explode(' ', date('Y n j', $date));

    $month_dd = "<select name='{$prefix}month' id='{$prefix}month'>";
    for ($i = 1; $i <= 12; $i++) {
        $selected = ($mval == $i) ? ' selected="selected"' : '';
        $month_dd .= "<option value='$i'$selected>" . date('F', mktime(0, 0, 0, $i, 1, 2000)) . "</option>";
    }
    $month_dd .= "</select>";

    $day_dd = "<select name='{$prefix}day' id='{$prefix}day'>";
    for ($i = 1; $i <= 31; $i++) {
        $selected = ($dval == $i) ? ' selected="selected"' : '';
        $day_dd .= "<option value='$i'$selected>$i</option>";
    }
    $day_dd .= "</select>";

    $year_dd = "<select name='{$prefix}year' id='{$prefix}year'>";
    for ($i = date('Y'); $i < date('Y') + 10; $i++) {
        $selected = ($yval == $i) ? ' selected="selected"' : '';
        $year_dd .= "<option value='$i'$selected>$i</option>";
    }
    $year_dd .= "</select>";

    $trans = array('m' => $month_dd, 'd' => $day_dd, 'y' => $year_dd);
    return strtr($output_format, $trans);
}

// Redirects user to $url
function redirect($url = null) {
    if (is_null($url))
        $url = $_SERVER['PHP_SELF'];
    header("Location: $url");
    exit();
}

// Ensures $str ends with a single /
function slash($str) {
    return rtrim($str, '/') . '/';
}

// Ensures $str DOES NOT end with a /
function unslash($str) {
    return rtrim($str, '/');
}

// Returns an array of the values of the specified column from a multi-dimensional array
function gimme($arr, $key = null) {
    if (is_null($key))
        $key = current(array_keys($arr));

    $out = array();
    foreach ($arr as $a)
        $out[] = $a[$key];

    return $out;
}

// Fixes MAGIC_QUOTES
function fix_slashes($arr = '') {
    if (is_null($arr) || $arr == '')
        return null;
    if (!get_magic_quotes_gpc())
        return $arr;
    return is_array($arr) ? array_map('fix_slashes', $arr) : stripslashes($arr);
}

// Returns the first $num words of $str
function max_words($str, $num, $suffix = '') {
    $words = explode(' ', $str);
    if (count($words) < $num)
        return $str;
    else
        return implode(' ', array_slice($words, 0, $num)) . $suffix;
}

// Serves an external document for download as an HTTP attachment.
function download_document($filename, $mimetype = 'application/octet-stream') {
    if (!file_exists($filename) || !is_readable($filename))
        return false;
    $base = basename($filename);
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Disposition: attachment; filename=$base");
    header("Content-Length: " . filesize($filename));
    header("Content-Type: $mimetype");
    readfile($filename);
    exit();
}

// Retrieves the filesize of a remote file.
function remote_filesize($url, $user = null, $pw = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    if (!is_null($user) && !is_null($pw)) {
        $headers = array('Authorization: Basic ' . base64_encode("$user:$pw"));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }

    $head = curl_exec($ch);
    curl_close($ch);

    preg_match('/Content-Length:\s([0-9].+?)\s/', $head, $matches);

    return isset($matches[1]) ? $matches[1] : false;
}

// Inserts a string within another string at a specified location
function str_insert($needle, $haystack, $location) {
    $front = substr($haystack, 0, $location);
    $back = substr($haystack, $location);

    return $front . $needle . $back;
}

// Outputs a filesize in human readable format.
function bytes2str($val, $round = 0) {
    $unit = array('', 'K', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y');
    while ($val >= 1000) {
        $val /= 1024;
        array_shift($unit);
    }
    return round($val, $round) . array_shift($unit) . 'B';
}

// Tests for a valid email address and optionally tests for valid MX records, too.
function valid_email($email, $test_mx = false) {
    if (preg_match("/^([_a-z0-9+-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $email)) {
        if ($test_mx) {
            list(, $domain) = explode("@", $email);
            return getmxrr($domain, $mxrecords);
        }
        else
            return true;
    }
    else
        return false;
}

// Grabs the contents of a remote URL. Can perform basic authentication if un/pw are provided.
function geturl($url, $username = null, $password = null) {
    if (function_exists('curl_init')) {
        $ch = curl_init();
        if (!is_null($username) && !is_null($password))
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . base64_encode("$username:$password")));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $html = curl_exec($ch);
        curl_close($ch);
        return $html;
    }
    elseif (ini_get('allow_url_fopen') == true) {
        if (!is_null($username) && !is_null($password))
            $url = str_replace("://", "://$username:$password@", $url);
        $html = file_get_contents($url);
        return $html;
    }
    else {
        // Cannot open url. Either install curl-php or set allow_url_fopen = true in php.ini
        return false;
    }
}

// Returns the user's browser info.
// browscap.ini must be available for this to work.
// See the PHP manual for more details.
function browser_info() {
    $info = get_browser(null, true);
    $browser = $info['browser'] . ' ' . $info['version'];
    $os = $info['platform'];
    $ip = $_SERVER['REMOTE_ADDR'];
    return array('ip' => $ip, 'browser' => $browser, 'os' => $os);
}

// Quick wrapper for preg_match
function match($regex, $str, $i = 0) {
    if (preg_match($regex, $str, $match) == 1)
        return $match[$i];
    else
        return false;
}

// Sends an HTML formatted email
function send_html_mail($to, $subject, $msg, $from, $plaintext = '') {
    if (!is_array($to))
        $to = array($to);

    foreach ($to as $address) {
        $boundary = uniqid(rand(), true);

        $headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: multipart/alternative; boundary = $boundary\n";
        $headers .= "This is a MIME encoded message.\n\n";
        $headers .= "--$boundary\n" .
                "Content-Type: text/plain; charset=ISO-8859-1\n" .
                "Content-Transfer-Encoding: base64\n\n";
        $headers .= chunk_split(base64_encode($plaintext));
        $headers .= "--$boundary\n" .
                "Content-Type: text/html; charset=ISO-8859-1\n" .
                "Content-Transfer-Encoding: base64\n\n";
        $headers .= chunk_split(base64_encode($msg));
        $headers .= "--$boundary--\n" .
                mail($address, $subject, '', $headers);
    }
}

// Quick and dirty wrapper for curl scraping.
function curl($url, $referer = null, $post = null) {
    static $tmpfile;

    if (!isset($tmpfile) || ($tmpfile == ''))
        $tmpfile = tempnam('/tmp', 'FOO');

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $tmpfile);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $tmpfile);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en-US; rv:1.8.1) Gecko/20061024 BonEcho/2.0");
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_VERBOSE, 1);

    if ($referer)
        curl_setopt($ch, CURLOPT_REFERER, $referer);
    if (!is_null($post)) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }

    $html = curl_exec($ch);

    // $last_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    return $html;
}

// Accepts any number of arguments and returns the first non-empty one
function pick() {
    foreach (func_get_args() as $arg)
        if (!empty($arg))
            return $arg;
    return '';
}

// This is easier than typing 'echo WEB_ROOT'
function WEBROOT() {
    echo WEB_ROOT;
}

// Class Autloader
spl_autoload_register('framework_autoload');

function framework_autoload($class_name) {
    $filename = DOC_ROOT . '/includes/class.' . strtolower($class_name) . '.php';
    if (file_exists($filename))
        require $filename;
}
