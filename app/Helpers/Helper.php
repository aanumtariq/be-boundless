<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Cache;
use \Nette\Utils\DateTime;
use App\Helpers\ImageUtil;
use App\Models\orderdetails;
use App\Models\products;
use Intervention\Image\Facades\Image;

class Helper
{
  public static function updtOrd($id)
  {
    try {
      DB::table('orders')
        ->where('Id', $id)
        ->update(['status' => 'Payment Successfull']);

      $odrDB = orderdetails::where('orderId', $id)->get();
      foreach ($odrDB as $key => $odrVal) {
        $por = products::where('Id', $odrVal->pId)->select('pStock')->first();
        $newStock = ((int)$por->pStock) - ((int)$odrVal->orderQty);
        DB::table('products')
          ->where('Id', $odrVal->pId)
          ->update(['pStock' => $newStock]);
      }
      return 'success';
    } catch (\Throwable $th) {
      return 'error';
    }
  }

  public static function OPImageResize($iFile, $iName, $destinFolder,  $iHeight, $iWidth, $createThumb, $tHeight, $tWidth)
  {

    $image = $iFile;
    $input['file'] = $iName . '.' . $image->getClientOriginalExtension();
    $input['thumb'] = $iName . '.' . $image->getClientOriginalExtension();
    $destinationPath =  public_path($destinFolder);

    !file_exists(public_path($destinFolder)) ? mkdir(public_path($destinFolder), 0777, true) : '';
    !file_exists(public_path($destinFolder . 'thumbnail/')) ? mkdir(public_path($destinFolder . 'thumbnail/'), 0777, true) : '';
    // if (!file_exists($destinationPath)) {
    //   mkdir($destinationPath, 0777, true);
    // }

    $imgFile = Image::make($image->getRealPath());
    $imgFile->resize($iHeight, $iWidth, function ($constraint) {
      $constraint->aspectRatio();
    })->save($destinationPath . $input['file']);

    if ($createThumb) {
      $destinationPath = public_path($destinFolder . 'thumbnail/');
      // $image->move($destinationPath, $input['file']);      
      $imgFile->resize($tHeight, $tWidth, function ($cons) {
        $cons->aspectRatio();
      })->save($destinationPath . $input['thumb']);

      $input['thumb'] = $destinFolder . 'thumbnail/' . $input['thumb'];
    }

    $input['file'] = $destinFolder . $input['file'];

    return $input;
  }


  public static function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
  {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
      $ip = $_SERVER["REMOTE_ADDR"];
      if ($deep_detect) {
        if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
          $ip = $_SERVER['HTTP_CLIENT_IP'];
      }
    }
    // $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
      "AF" => "Africa",
      "AN" => "Antarctica",
      "AS" => "Asia",
      "EU" => "Europe",
      "OC" => "Australia (Oceania)",
      "NA" => "North America",
      "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
      $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
      if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
        switch ($purpose) {
          case "location":
            $output = array(
              "city"           => @$ipdat->geoplugin_city,
              "state"          => @$ipdat->geoplugin_regionName,
              "country"        => @$ipdat->geoplugin_countryName,
              "country_code"   => @$ipdat->geoplugin_countryCode,
              "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
              "continent_code" => @$ipdat->geoplugin_continentCode,
              "ip" => @$ip
            );
            break;
          case "address":
            $address = array($ipdat->geoplugin_countryName);
            if (@strlen($ipdat->geoplugin_regionName) >= 1)
              $address[] = $ipdat->geoplugin_regionName;
            if (@strlen($ipdat->geoplugin_city) >= 1)
              $address[] = $ipdat->geoplugin_city;
            $output = implode(", ", array_reverse($address));
            break;
          case "city":
            $output = @$ipdat->geoplugin_city;
            break;
          case "state":
            $output = @$ipdat->geoplugin_regionName;
            break;
          case "region":
            $output = @$ipdat->geoplugin_regionName;
            break;
          case "country":
            $output = @$ipdat->geoplugin_countryName;
            break;
          case "countrycode":
            $output = @$ipdat->geoplugin_countryCode;
            break;
        }
      }
    }
    return $output;
  }
  public static function cleanDomain($string, $replace = "")
  {
    $string = str_replace('.com', '', $string);
    if (strpos($string, '/') !== false) {
      $string = explode('/', $string)[0];
    }
    return ucwords(preg_replace('/[^A-Za-z0-9]/', $replace, $string));
  }
  public static function t12($time)
  {
    if ($time) {
      return date('h:i a', strtotime($time));
    }
  }
  public static function tdiff($start_date, $since_date, $returntype = 'd')
  {
    $s_date = new DateTime(date('Y-m-d H:i:s', strtotime($start_date)));
    $since_start = $s_date->diff(new DateTime(date('Y-m-d H:i:s', strtotime($since_date))));
    switch ($returntype) {
      case "d":
        return $since_start->days;
        break;
      case "y":
        return $since_start->y;
        break;
      case "m":
        return $since_start->m;
        break;
      case "d":
        return $since_start->d;
        break;
      case "h":
        return $since_start->h;
        break;
      case "i":
        return $since_start->i;
        break;
      case "s":
        return $since_start->s;
        break;
      default:
        return '';
    }
  }
  public static function returnval($Row, $col)
  {
    if ($Row) {
      if (isset($Row->$col)) {
        return $Row->$col;
      }
    }
    return false;
  }
  public static function returnIssetValues($variable, $index)
  {
    return self::returnval($variable, $index);
  }
  public static function getPaginator($pageLimit = 20)
  {
    //$pageLimit = 20;
    $pageNo = 0;
    if (isset($_GET['pageNo'])) {
      $pageNo = intval($_GET['pageNo']);
    }
    $pageNo = $pageNo == 1 ? 0 : $pageNo;
    $limit = (($pageLimit * $pageNo));
    if ($pageNo > 1) {
      $limit = $limit - $pageLimit;
    }
    $querylimit = " limit " . $limit . "," . $pageLimit;
    return $querylimit;
  }
  public static function colsData($colCondition, $colData)
  {
    /*foreach($colCondition as $cond){

      }*/
    foreach ($colCondition as $key => $value) {
      if ($key == $colData) {
        return self::getBadge($key, $value);
      }
    }
  }
  public static function checkSession($sessionId)
  {
    if (Session::has($sessionId)) {
      return Session::get($sessionId);
    } else {
      return '';
    }
  }
  public static function putSession($sessionId, $value)
  {
    if (Session::has($sessionId)) {
      Session::put($sessionId, $value);
    } else {
      return '';
    }
  }
  public static function OneColData($table, $col, $condition, $modifiedCol = "")
  {
    $where = $condition == '' ? '' : ' WHERE ' . $condition;
    $data = collect(DB::select("SELECT " . $col . " FROM " . $table . " " . $where))->first();
    if ($data) {
      if ($modifiedCol != "") {
        return $data->$modifiedCol;
      }
      return $data->$col;
    } else {
      return '';
    }
  }
  public static function returnDropDownQuery($query, $key, $value, $generate = false)
  {
    $data = self::fireQuery($query);
    $result = array();
    if ($data) {
      foreach ($data as $items) {
        $result[$items->$key] = $items->$value;
      }
    }
    if ($generate) {
      self::generateOptionsFromArray($result);
      return;
    }
    return $result;
  }
  public static function insertDataruntime($table, $cols)
  {
    DB::table($table)->insert($cols);
  }
  public static function returnAutocomplete($table, $where, $key, $value, $generate = false, $selected = '')
  {
    $data = self::returnDataSet($table, $where);
    $result = array();
    if ($data) {
      foreach ($data as $items) {
        if (is_array($value)) {
          $coll = array();
          foreach ($value as $val) {
            array_push($coll, $items->$val);
          }
          $result[$items->$key] = implode(' - ', $coll);
        } else {
          $result[$items->$key] = $items->$value;
        }
      }
    }
    if ($generate) {
      self::generateOptionsFromArray($result, $selected);
      return;
    }
    return $result;
  }
  public static function generateOptionsFromArray($arr, $selected = '')
  {
    if ($arr) {
      foreach ($arr as $key => $value) {
        $select = $key == $selected ? 'selected="selected"' : '';
        print '<option ' . $select . '  value="' . $key . '">' . $value . '</option>';
      }
    }
  }
  public static function fireQuery($query)
  {
    return DB::select($query);
  }
  public static function getImageWithRow($table, $col, $id, $where = '')
  {
    $add = '';
    if ($where != '') {
      $add = ' AND ' . $where;
    }
    $query = "SELECT " . $table . ".*,imagetable.img_path,imagetable.id as img_id from " . $table . " left join imagetable on imagetable.ref_id = " . $table . "." . $col . " and imagetable.table_name = '" . $table . "' and imagetable.type = '1' where " . $table . "." . $col . " = " . $id . $add;
    return self::firstRow($query);
  }
  public static function getImageWithRowDC($table, $col, $id, $where = '')
  {
    $add = '';
    if ($where != '') {
      $add = ' AND ' . $where;
    }
    $query = "SELECT " . $table . ".*,imagetable.img_path,imagetable.id as img_id from " . $table . " left join imagetable on imagetable.ref_id = " . $table . ".id and imagetable.table_name = '" . $table . "' and imagetable.type = '1' where " . $table . "." . $col . " = '" . $id . "'" . $add;
    return self::firstRow($query);
  }
  public static function getImageWithData($table, $col, $id, $where = '', $chunked = 0, $extra = '')
  {
    $add = '';
    if ($where != '') {
      $add = ' where ' . $where;
    }
    $query = "SELECT " . $table . ".*,imagetable.img_path,imagetable.id as img_id from " . $table . " left join imagetable on imagetable.ref_id = " . $table . "." . $col . " and imagetable.table_name = '" . $table . "' and imagetable.type = '1' " . $add;
    if ($extra == '') {
      $query .= " order by " . $table . ".created_at desc";
    } else {
      $query .= " " . $extra;
    }
    $data =  self::fireQuery($query);
    if ($chunked > 0) {
      return array_chunk($data, $chunked);
    }
    return $data;
  }
  public static function firstRow($query)
  {
    return collect(DB::select($query))->first();
  }
  public static function returnFlag($id, $col = 'flag_value')
  {
    if ($id) {
      $data =  self::returnRow("m_flag", "id=" . $id);
      if ($data) {
        return $data->$col;
      } else {
        return '';
      }
    } else {
      return '';
    }
  }
  public static function returnFlagT($id, $col = 'flag_value')
  {
    if ($id) {
      $data =  self::returnRow("m_flag", "flag_type='" . $id . "'");
      if ($data) {
        return $data->$col;
      } else {
        return '';
      }
    } else {
      return '';
    }
  }
  public static function returnRow($table, $where)
  {
    $whereCond = $where == '' ? '' : ' WHERE ' . $where;
    $data = collect(DB::select("SELECT * FROM " . $table . " " . $whereCond))->first();
    return $data;
  }
  public static function returnDataSet($table, $where, $chunked = 0)
  {
    $whereCond = $where == '' ? '' : ' WHERE ' . $where;
    $data = DB::select("SELECT * FROM " . $table . " " . $whereCond);
    if ($chunked > 0) {
      return array_chunk($data, $chunked);
    }
    return $data;
  }
  public static function isThispw($pw)
  {
    if (self::checkforSpecials($pw)) {
      if (strlen($pw) >= 8) {
        return true;
      }
      return false;
    }
    return false;
  }
  public static function checkforSpecials($string)
  {
    if (preg_match('/[\'^£$%&*()}{@#~?><>,.!|=_+¬-]/', $string)) {
      if (preg_match('/[a-z,A-Z]/', $string)) {
        return true;
      }
    }
    return false;
  }
  public static function inlineEditableTableWise($element, $styles, $textContent, $infoTable, $key, $returnResult = false)
  {
    $creating = "<" . $element;
    $id = $key;
    if (is_admin()) {
      if (admin()->is_active == '1') {
        if ($element == 'a') {
          $creating .= ' data-anchorupdate="true" data-before="" data-update="' . $id . '" ';
        } else {
          $creating .= ' contenteditable="true" data-before="" data-update="' . $id . '" ';
        }
        $creating .= ' data-table="' . $infoTable[0] . '" data-col="' . $infoTable[1] . '" ';
      }
    }
    if (is_array($styles)) {
      if (count($styles) > 0) {
        foreach ($styles as $key => $values) {
          $class = trim($values);
          $creating .= ' ' . $key . '="' . $class . '" ';
        }
      }
    }
    $creating .= '>';
    $creating .= $textContent;
    $creating .= "</" . $element . ">";
    if ($returnResult) {
      return html_entity_decode($creating);
    } else {
      print html_entity_decode($creating);
    }
  }
  public static function inlineEditable($element, $styles, $textContent, $key, $returnResult = false)
  {
    $creating = "<" . $element;
    $elementId = debug_backtrace();
    $id = $key . $elementId[0]['line'];
    if ($returnResult) {
      $id = $key;
    }
    // $m_flag = Cache::remember('m_flag', 1, function() {
    //   $data = DB::SELECT("SELECT * FROM m_flag");
    //   $arr = array();
    //   foreach($data as $dat){
    //     $arr[$dat->flag_type] = $dat;
    //   }
    //   return $arr;
    // });
    // if(isset($m_flag[$id])){
    //   $textContent = $m_flag[$id]->flag_additionalText;
    // }
    $db = self::returnRow("m_flag", " flag_type = '" . $id . "'");
    if ($db) {
      if ($element == 'a') {
        if (empty($styles)) {
          $styles = array("href" => $db->flag_show_text);
        } else {
          $styles['href'] = $db->flag_show_text;
        }
      }
      $textContent = $db->flag_additionalText;
    }
    if (is_admin()) {
      if (admin()->is_active == '1') {
        if ($element == 'a') {
          $creating .= ' data-anchorupdate="true" data-before="" data-update="' . $id . '" ';
        } else {
          $creating .= ' contenteditable="true" data-before="" data-update="' . $id . '" ';
        }
      }
    }
    if (is_array($styles)) {
      if (count($styles) > 0) {
        foreach ($styles as $key => $values) {
          $class = trim($values);
          $creating .= ' ' . $key . '="' . $class . '" ';
        }
      }
    }
    $creating .= '>';
    $creating .= $textContent;
    $creating .= "</" . $element . ">";
    if ($returnResult) {
      return html_entity_decode($creating);
    } else {
      print html_entity_decode($creating);
    }
  }
  /*
    background: url(http://localhost:8000/images/freeaccountbanner.jpg);
    background-size: 100% 100%;
    background-repeat: no-repeat;
*/
  public static function setbackground($default, $styles, $key, $hardUrl, $width, $height)
  {
    $elementId = debug_backtrace();
    $id = $key . $elementId[0]['line'];

    $creating = 'style="';
    $classAft = '';
    if (is_array($styles)) {
      if (count($styles) > 0) {
        foreach ($styles as $key => $values) {
          $class = trim($values);
          $classAft .= '' . $key . ':' . $class . ';';
        }
      }
    }
    $db = self::OneColData("imagetable", "img_path", " imagetable.table_name = '" . $id . "' and imagetable.ref_id = 0 and imagetable.type='1' and imagetable.is_active_img='1'");
    if ($db != "") {
      $default = $db;
      $hardUrl .= 'Uploads/';
    }
    $creating .= 'background-image:url(' . $hardUrl . '' . $default . ');';
    $creating .= $classAft;
    $creating .= '" data-width="' . $width . '" data-height="' . $height . '" contentbackground="true" data-key="' . $id . '"';
    print $creating;
  }
  public static function dynamicImagesTable($imageUrl, $styles, $key, $common)
  {
    $element = 'img';
    $creating = "<" . $element;
    $id = $key;
    if (is_array($styles)) {
      if (count($styles) > 0) {
        foreach ($styles as $key => $values) {
          $class = trim($values);
          $creating .= ' ' . $key . '="' . $class . '" ';
        }
      }
    }
    $creating .= 'data-url="' . $imageUrl . '"';
    if (is_admin()) {
      if (admin()->is_active == '1') {
        $creating .= ' data-key="' . $id . '" ';
        $creating .= ' data-imgid = "' . $id . '"';
        $creating .= ' data-table="' . $common[0] . '"';
        $creating .= ' data-ref_id="' . $common[1] . '"';
      }
    }
    $creating .= "/>";
    print $creating;
  }
  public static function dynamicImages($hardUrl, $default, $styles, $key, $returnResult = false)
  {
    $element = 'img';
    $creating = "<" . $element;
    $elementId = debug_backtrace();
    $id = $key . $elementId[0]['line'];
    if ($returnResult) {
      $id = $key;
    }
    //$db = self::OneColData("imagetable","img_path"," imagetable.table_name = '".$id."' and imagetable.ref_id = 0 and imagetable.type='1' and imagetable.is_active_img='1'");
    $imageRow =  self::returnRow("imagetable", " imagetable.table_name = '" . $id . "' and imagetable.ref_id = 0 and imagetable.type='1'");
    $db = '';
    if ($imageRow) {
      $db = $imageRow->img_path;
      if (!empty($imageRow->img_href)) {
        $creating = '<a href="' . $imageRow->img_href . '">' . $creating;
      }
    }
    if (is_array($styles)) {
      if (count($styles) > 0) {
        foreach ($styles as $key => $values) {
          $class = trim($values);
          $creating .= ' ' . $key . '="' . $class . '" ';
        }
      }
    }
    if ($db != "") {
      if ($imageRow->is_active_img == '1') {
        $default = $db;
        $hardUrl .= '';
        $hardUrl = '';
        $default = ImageUtil::gethref($imageRow->id, $styles['data-width'], $styles['data-height']);
      } else if ($imageRow->is_active_img == '0' && is_admin()) {
        if (admin()->is_active == '1') {
          $default = $db;
          $hardUrl .= '';
        } else {
          $default = '';
          if ($returnResult) {
            return '';
          } else {
            print '';
            return;
          }
        }
      } else {
        $default = '';
        if ($returnResult) {
          return '';
        } else {
          print '';
          return;
        }
      }
    } else {
      $hardUrl .= '';
    }
    $imageUrl = $hardUrl . '' . $default;
    $creating .= 'data-url="' . $imageUrl . '"';
    if (is_admin()) {
      if (admin()->is_active == '1') {
        $creating .= ' data-key="' . $id . '" ';
        if ($db != "") {
          $creating .= ' data-imgid = "' . $imageRow->id . '"';
        }
      }
    }
    $creating .= "/>";
    if ($db != "") {
      if (!empty($imageRow->img_href)) {
        $creating .= '</a>';
      }
    }
    if ($returnResult) {
      return $creating;
    } else {
      print $creating;
    }
  }
  public static function multipleContent($key, $styles, $childDefault, $chunked = 0, $defaultLoop, $contentArray, $element = "div", $showbtns = true)
  {
    $creating = "<" . $element;
    $elementId = debug_backtrace();
    $id = $key . $elementId[0]['line'];
    if (is_array($styles)) {
      if (count($styles) > 0) {
        foreach ($styles as $keys => $values) {
          $class = trim($values);
          $creating .= ' ' . $keys . '="' . $class . '" ';
        }
      }
    }
    $creating .= '>';
    $data = self::OneColData("m_flag", "flag_value", " flag_type = '" . $key . "'");
    if ($data != "") {
      $counter = 0;
      for ($i = 0; $i < intval($data); $i++) {
        $loopingData = $childDefault;
        for ($j = 0; $j < count($contentArray); $j++) {
          if ($contentArray[$j][0] != "img") {
            $innData = self::inlineEditable($contentArray[$j][0], $contentArray[$j][1], $contentArray[$j][2], $id . $i . $j, true);
            $loopingData = str_replace("{" . $contentArray[$j][3] . "}", $innData, $loopingData);
          } else {
            $innData = self::dynamicImages($contentArray[$j][1], $contentArray[$j][2], $contentArray[$j][3], $id . $i . $j, true);
            $loopingData = str_replace("{" . $contentArray[$j][4] . "}", $innData, $loopingData);
          }
        }
        $creating .= str_replace("{countring}", $counter, $loopingData);
        $counter++;
        if ($chunked > 0) {
          if ($counter == $chunked) {
            $counter = 0;
            $creating .= "<div class='clearfix'></div>";
          }
        }
      }
      $creating .= "</" . $element . ">";
      print $creating;
    }
    if (is_admin()) {
      if (admin()->is_active == '1') {
        if (intval($data) > 0) {
          if ($showbtns) {
            print "<button data-counter='" . $data . "' data-update-key='" . $key . "' class='contentEditBtn contentEditBtnLess " . $key . "'>Less</button>";
          }
        }
        if ($showbtns) {
          print "<button data-counter='" . $data . "' data-update-key='" . $key . "' class='contentEditBtn " . $key . "'>Add</button>";
        }
      }
    }
  }
  public static function isValid($response)
  {
    if (is_null(self::returnFlag(516)))
      throw new \Exception('You must set your secret key');
    if (empty($response))
      return false;
    $params = array(
      'secret'    => self::returnFlag(516),
      'response'  => $response,
      'remoteip'  => $_SERVER['REMOTE_ADDR'],
    );
    $url = 'https://www.google.com/recaptcha/api/siteverify?' . http_build_query($params);
    if (function_exists('curl_version')) {
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_TIMEOUT, 1);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      $response = curl_exec($curl);
    } else {
      $response = file_get_contents($url);
    }
    if (empty($response) || is_null($response)) {
      return false;
    }
    $json = json_decode($response);
    return $json->success;
  }
  public static function errorField($field, $errors)
  {
    if ($errors->first($field) != "") {
      print '<label class="label label-danger" style="margin-bottom: 10px;display: inline-block;padding: 5px;background: transparent;color: #d9534f;font-size: 12px;font-weight: bolder;">' . $errors->first($field) . '</label>';
    }
  }
  public static function getimageoftable($table, $refid, $default)
  {
    $data = self::returnRow('imagetable', "table_name='" . $table . "' and type=1 and ref_id=" . $refid);
    if (!$data) {
      return asset($default);
    } else {
      return asset($data->img_path);
    }
  }
  public static function returnMod($modelname)
  {
    $model_name = 'App\Model\\' . $modelname;
    return $model_name::where('is_active', 1)->where('is_deleted', 0);
  }
  public static function discountedValue($amount, $discount, $format = false)
  {
    if ($discount > 0) {
      $amount = ($amount - (($amount / 100) * $discount));
    }
    if ($format === true) {
      return number_format($amount, 2, '.', ',');
    }
    return $amount;
  }

  public static function time_elapsed_string($datetime, $full = false)
  {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'min',
      's' => 'sec',
    );
    foreach ($string as $k => &$v) {
      if ($diff->$k) {
        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
        unset($string[$k]);
      }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(' ', $string) . ' ago' : 'just now';
  }
  // public static function getImageWithRowDC($table,$col,$id,$where=''){
  //     $add = '';
  //     if($where!=''){
  //       $add = ' AND '.$where;
  //     }
  //     $query = "SELECT ".$table.".*,imagetable.img_path,imagetable.id as img_id from ".$table." left join imagetable on imagetable.ref_id = ".$table.".id and imagetable.table_name = '".$table."' and imagetable.type = '1' where ".$table.".".$col." = '".$id."'".$add;
  //      return self::firstRow($query);
  // }
}
