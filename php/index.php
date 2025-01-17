<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2015-2021 Game Maker 2k - https://github.com/GameMaker2k
    Copyright 2015-2021 Kazuki Przyborowski - https://github.com/KazukiPrzyborowski

    $FileInfo: index.php - Last Update: 1/15/2021 Ver. 0.5.0 RC 1 - Author: cooldude2k $
*/
if(!ob_start("ob_gzhandler")) { ob_start(); }
date_default_timezone_set("UTC");
header("Content-Style-Type: text/css");
header("Content-Script-Type: text/javascript");
header("Content-Language: en");
header("Vary: Accept-Encoding,Cookie");
header("X-Content-Type-Options: nosniff");
header("X-UA-Compatible: IE=Edge,Chrome=1");
header("Cache-Control: private, no-cache, no-store, must-revalidate, pre-check=0, post-check=0, max-age=0");
header("Pragma: private, no-cache, no-store, must-revalidate, pre-check=0, post-check=0, max-age=0");
header("Date: ".gmdate("D, d M Y H:i:s")." GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Expires: ".gmdate("D, d M Y H:i:s")." GMT");
$fullurl = "http://localhost/hockey/";
$fileurl = "index.php";
$databasefile = "hockey17-18";
$databasedir = "./data";
$databasedirglob = $databasedir."/*.db3";
$databaselist = glob($databasedirglob);
$dbi = 0;
$dbx = count($databaselist);
while($dbi < $dbx) {
$databasefnlist[$dbi] = basename($databaselist[$dbi], ".db3");
$dbshortname = $databasefnlist[$dbi];
$dbtofilename[$dbshortname] = $databaselist[$dbi];
$dbi++; }
if(isset($_SERVER['HTTPS'])) {
 $fullurl = "https://".$_SERVER["SERVER_NAME"].str_replace("//", "/", dirname($_SERVER["SCRIPT_NAME"])."/"); } 
if(!isset($_SERVER['HTTPS'])) {
 $fullurl = "http://".$_SERVER["SERVER_NAME"].str_replace("//", "/", dirname($_SERVER["SCRIPT_NAME"])."/"); }
if(!isset($_GET['output'])) { 
 if(isset($_GET['html'])) { 
    $_GET['output'] = "html"; }
 if(!isset($_GET['html']) && isset($_GET['xhtml'])) { 
    $_GET['output'] = "xhtml"; }
 if(!isset($_GET['html']) && !isset($_GET['xhtml']) && isset($_GET['xml'])) { 
    $_GET['output'] = "xml"; } }
if(!isset($_GET['output'])) { 
    $_GET['output'] = "html"; }
if($_GET['output']!="html" && $_GET['output']!="xhtml" && $_GET['output']!="xml") { 
   $_GET['output'] = "html"; }
if($_GET['output']=="xml") {
 if(isset($_GET['output'])) { unset($_GET['output']); }
 if(isset($_GET['xml'])) { unset($_GET['xml']); }
 if(isset($_GET['html'])) { unset($_GET['html']); }
 if(isset($_GET['xhtml'])) { unset($_GET['xhtml']); }
 $qstring = http_build_query($_GET);
 if(strlen($qstring)==0) {
  header("Location: ".$fullurl."xml.php", true, 303); }
 if(strlen($qstring)>0) {
  $qstring = str_replace("=&", "&", $qstring);
  $qstring = preg_replace("/".preg_quote("=", '/')."$/", "", $qstring);
  header("Location: ".$fullurl."xml.php?".$qstring, true, 303); } }
if($_GET['output']=="html") {
header("Content-Type: text/html; charset=UTF-8"); }
if($_GET['output']=="xhtml") {
header("Content-Type: application/xhtml+xml; charset=UTF-8"); }
if(!isset($_GET['database'])||!in_array($_GET['database'], $databasefnlist)) {
if($_GET['output']=="xhtml") {
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; }
?>
<!DOCTYPE html>
<?php if($_GET['output']=="xhtml") { ?>
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<?php } if($_GET['output']=="html") { ?>
<html lang="en">
<?php } ?>
 <head>
  <meta charset="UTF-8" />
  <base href="<?php echo $fullurl; ?>" />
  <title><?php echo $leaguename; ?> Games &amp; Team Stats</title>
 </head>
 <body>
<?php
echo "  <table style=\"width: 100%;\">\n";
echo "   <tr>\n    <th>Hockey Databases</th>\n    <th>Number of Leagues</th>\n   </tr>\n";
$dbi = 0;
$dbx = count($databasefnlist);
while($dbi < $dbx) {
 $sqldb = new SQLite3($databaselist[$dbi]);
 $PreNumHockeyLeagues = $sqldb->query("SELECT COUNT(*) as count FROM HockeyLeagues");
 $NumHockeyLeaguesArray = $PreNumHockeyLeagues->fetchArray();
 $NumHockeyLeagues = intval($NumHockeyLeaguesArray['count']);
 echo "   <tr>\n    <td style=\"width: 50%; text-align: center;\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;database=".urlencode($databasefnlist[$dbi])."\">".htmlspecialchars($databasefnlist[$dbi], ENT_COMPAT | ENT_HTML5, "UTF-8")."</a></td>\n    <td style=\"width: 50%; text-align: center;\">".htmlspecialchars($NumHockeyLeagues, ENT_COMPAT | ENT_HTML5, "UTF-8")."</td>\n   </tr>\n"; 
 $sqldb->close();
 ++$dbi; }
echo "  </table>\n";
?>
 </body>
</html>
<?php exit(); }
if(isset($_GET['database'])&&in_array($_GET['database'], $databasefnlist)) {
 $databasefile = $_GET['database']; }
if(file_exists($dbtofilename[$databasefile])) {
 $sqldb = new SQLite3($dbtofilename[$databasefile]); } 
if(!isset($_GET['league'])&&isset($leaguename)) { 
 $_GET['league'] = $leaguename; }
if(isset($_GET['league'])) {
 $getleague = $sqldb->querySingle("SELECT LeagueName, LeagueFullName, CountryName, FullCountryName, Date, PlayOffFMT, OrderType, NumberOfTeams, NumberOfConferences, NumberOfDivisions FROM HockeyLeagues WHERE LeagueName='".$sqldb->escapeString($_GET['league'])."'", true);
 if(count($getleague)==10) {
  $leaguename = $getleague['LeagueName']; }
 if(count($getleague)<10) {
  unset($leaguename);
  unset($_GET['league']); } }
if($_GET['output']=="xhtml") {
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; }
?>
<!DOCTYPE html>
<?php if($_GET['output']=="xhtml") { ?>
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<?php } if($_GET['output']=="html") { ?>
<html lang="en">
<?php } ?>
 <head>
  <meta charset="UTF-8" />
  <base href="<?php echo $fullurl; ?>" />
  <title><?php echo $leaguename; ?> Games &amp; Team Stats</title>
 </head>
 <body>
<?php
if(!isset($_GET['act'])&&isset($_GET['view'])) { $_GET['act'] = "view"; }
if(!isset($_GET['act'])&&isset($_GET['games'])) { $_GET['act'] = "view"; }
if(!isset($_GET['act'])&&isset($_GET['stats'])) { $_GET['act'] = "stats"; }
if(!isset($_GET['act'])&&isset($_GET['standing'])) { $_GET['act'] = "standing"; }
if(!isset($_GET['act'])&&isset($_GET['calendar'])) { $_GET['act'] = "calendar"; }
if(!isset($_GET['order'])&&isset($_GET['asc'])) { $_GET['order'] = "ascending"; }
if(isset($_GET['order'])&&$_GET['order']=="asc") { $_GET['order'] = "ascending"; }
if(!isset($_GET['order'])&&isset($_GET['ascending'])) { $_GET['order'] = "ascending"; }
if(!isset($_GET['order'])&&isset($_GET['desc'])) { $_GET['order'] = "descending"; }
if(isset($_GET['order'])&&$_GET['order']=="desc") { $_GET['order'] = "descending"; }
if(!isset($_GET['order'])&&isset($_GET['descending'])) { $_GET['order'] = "descending"; }
if(!isset($leaguename)) {
echo "  <table style=\"width: 100%;\">\n";
echo "   <tr>\n    <th>Hockey League Initials</th>\n    <th>Hockey League Name</th>\n    <th>Country Initials</th>\n    <th>Country Name</th>\n    <th>Number of Teams</th>\n    <th>Number of Conferences</th>\n    <th>Number of Divisions</th>\n   </tr>\n";
$lresults = $sqldb->query("SELECT LeagueName, LeagueFullName, CountryName, FullCountryName, Date, PlayOffFMT, OrderType, NumberOfTeams, NumberOfConferences, NumberOfDivisions FROM HockeyLeagues");
while ($lrow = $lresults->fetchArray()) {
 $lstartdate = $lrow[4];
 $lchckyear = substr($lstartdate, 0, 4);
 $lchckmonth = substr($lstartdate, 4, 2);
 $fullstart = $lchckyear.$lchckmonth;
 echo "   <tr>\n    <td style=\"width: 11%; text-align: center;\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;calendar&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($lrow[0])."&amp;date=".urlencode($fullstart)."\">".htmlspecialchars($lrow[0], ENT_COMPAT | ENT_HTML5, "UTF-8")."</a></td>\n    <td style=\"width: 23%;\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;calendar&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($lrow[0])."&amp;date=".urlencode($fullstart)."\">".htmlspecialchars($lrow[1], ENT_COMPAT | ENT_HTML5, "UTF-8")."</a></td>\n    <td style=\"width: 10%; text-align: center;\">".$lrow[2]."</td>\n    <td style=\"width: 23%;\">".$lrow[3]."</td>\n    <td style=\"width: 10%; text-align: center;\">".$lrow[7]."</td>\n    <td style=\"width: 11%; text-align: center;\">".$lrow[8]."</td>\n    <td style=\"width: 10%; text-align: center;\">".$lrow[9]."</td>\n   </tr>\n"; }
echo "  </table>\n";
?>
 </body>
</html>
<?php
$sqldb->close();
exit(); }
if(isset($_GET['month']) && strlen($_GET['month'])==1) {
 $_GET['month'] = "0".$_GET['month']; }
if(isset($_GET['day']) && strlen($_GET['day'])==1) {
 $_GET['day'] = "0".$_GET['day']; }
if(isset($_GET['date']) && strlen($_GET['date'])==8) {
 $chckyear = substr($_GET['date'], 0, 4);
 $chckmonth = substr($_GET['date'], 4, 2);
 if($chckmonth>12) { $chckmonth = $chckmonth = "12"; }
 if($chckmonth<1) { $chckmonth = $chckmonth = "01"; }
 $chckday = substr($_GET['date'], 6, 2);
 if($chckday>gmdate("t", gmmktime(0, 0, 0, $chckmonth, 1, $chckyear))) { $chckday = gmdate("t", gmmktime(0, 0, 0, $chckmonth, 1, $chckyear)); }
 if($chckday<1) { $chckday = "01"; } 
 $_GET['date'] = $chckyear.$chckmonth.$chckday; }
if(isset($_GET['date']) && strlen($_GET['date'])==6) {
 $chckyear = substr($_GET['date'], 0, 4);
 if($chckmonth>12) { $chckmonth = $chckmonth = "12"; }
 if($chckmonth<1) { $chckmonth = $chckmonth = "01"; }
 $chckmonth = substr($_GET['date'], 4, 2);
 $_GET['date'] = $chckyear.$chckmonth; }
if((isset($_GET['day']) && strlen($_GET['day'])==2)) {
 if((isset($_GET['year']) && strlen($_GET['year'])==4)) {
  if((isset($_GET['month']) && strlen($_GET['month'])==2)) {
   if($_GET['month']>12) { $_GET['month'] = 12; }
   if($_GET['month']<1) { $_GET['month'] = "01"; }
   if($_GET['day']<1) { $_GET['day'] = "01"; }
   if($_GET['day']>gmdate("t", gmmktime(0, 0, 0, $_GET['month'], 1, $_GET['year']))) { $_GET['day'] = gmdate("t", gmmktime(0, 0, 0, $_GET['month'], 1, $_GET['year'])); } }
  if((!isset($_GET['month']) || strlen($_GET['month'])!=2)) {
   $_GET['month'] = gmdate("m");
   if($_GET['day']<1) { $_GET['day'] = "01"; }
   if($_GET['day']>gmdate("t", gmmktime(0, 0, 0, $_GET['month'], 1, $_GET['year']))) { $_GET['day'] = gmdate("t", gmmktime(0, 0, 0, $_GET['month'], 1, $_GET['year'])); } } }
 if((!isset($_GET['year']) || strlen($_GET['year'])!=4)) {
  if((isset($_GET['month']) && strlen($_GET['month'])==2)) {
   if($_GET['month']>12) { $_GET['month'] = 12; }
   if($_GET['month']<1) { $_GET['month'] = "01"; }
   $_GET['year'] = gmdate("Y");
   if($_GET['day']<1) { $_GET['day'] = "01"; }
   if($_GET['day']>gmdate("t", gmmktime(0, 0, 0, $_GET['month'], 1, $_GET['year']))) { $_GET['day'] = gmdate("t", gmmktime(0, 0, 0, $_GET['month'], 1, $_GET['year'])); } }
  if((!isset($_GET['month']) || strlen($_GET['month'])!=2)) {
   if($_GET['month']>12) { $_GET['month'] = 12; }
   if($_GET['month']<1) { $_GET['month'] = "01"; }
   $_GET['year'] = gmdate("Y");
   $_GET['month'] = gmdate("m");
   if($_GET['day']<1) { $_GET['day'] = "01"; }
   if($_GET['day']>gmdate("t", gmmktime(0, 0, 0, $_GET['month'], 1, $_GET['year']))) { $_GET['day'] = gmdate("t", gmmktime(0, 0, 0, $_GET['month'], 1, $_GET['year'])); } } } }
if(!isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day']) &&
   is_numeric($_GET['month']) && is_numeric($_GET['day']) &&
   strlen($_GET['month'])==2 && strlen($_GET['day'])==2) {
   $_GET['date'] = gmdate("Y").$_GET['month'].$_GET['day']; }
if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day']) &&
   is_numeric($_GET['year']) && is_numeric($_GET['month']) && is_numeric($_GET['day']) &&
   strlen($_GET['year'])>=4 && strlen($_GET['month'])==2 && strlen($_GET['day'])==2) {
   $_GET['date'] = $_GET['year'].$_GET['month'].$_GET['day']; }
if($_GET['act']=="stats") {
 if(!isset($_GET['conference'])) { $_GET['conference'] = "All"; }
 if(!isset($_GET['division'])) { $_GET['division'] = "All"; } }
if(!isset($_GET['act'])) { $_GET['act'] = "calendar"; }
if($_GET['act']!="view" && $_GET['act']!="games" && $_GET['act']!="stats" && $_GET['act']!="calendar") { $_GET['act'] = "calendar"; }
$sqldb->exec("PRAGMA encoding = \"UTF-8\";");
$sqldb->exec("PRAGMA auto_vacuum = 1;");
$sqlite_games_string = "";
$firstgamedate = $sqldb->querySingle("SELECT Date FROM ".$leaguename."Games WHERE id=1");
$lastgamedate = $sqldb->querySingle("SELECT Date FROM ".$leaguename."Games WHERE id=(SELECT MAX(id) FROM ".$leaguename."Games)");
if($lastgamedate<gmdate("Y").gmdate("m").gmdate("d")) {
 $lastgamedate = gmdate("Y").gmdate("m").gmdate("d"); }
if($_GET['act']=="calendar") {
if(isset($_GET['date']) && strlen($_GET['date'])==8) {
 if(!isset($_GET['month']) || !is_numeric($_GET['month'])) {
  $_GET['month'] = substr($_GET['date'], 4, 2); }
 if(!isset($_GET['year']) || !is_numeric($_GET['year'])) {
  $_GET['year'] = substr($_GET['date'], 0, 4); } }
if(isset($_GET['date']) && strlen($_GET['date'])==6) {
 if(!isset($_GET['month']) || !is_numeric($_GET['month'])) {
  $_GET['month'] = substr($_GET['date'], 4, 2); }
 if(!isset($_GET['year']) || !is_numeric($_GET['year'])) {
  $_GET['year'] = substr($_GET['date'], 0, 4); } }
if(!isset($_GET['month']) || !is_numeric($_GET['month']) or !strlen($_GET['month'])==2) {
 $_GET['month'] = gmdate("m"); }
if(!isset($_GET['date']) && is_numeric($_GET['month']) && strlen($_GET['month'])==2) {
 if(!isset($_GET['year']) || !is_numeric($_GET['year']) || strlen($_GET['year'])<4) {
  $_GET['year'] = gmdate("Y"); }
 $startday = $_GET['year'].$_GET['month']."01";
 $tmplastdaymonth = gmdate("t", gmmktime(12, 30, 0, intval($_GET['month']), 1, intval($_GET['year'])));
 $endday = $_GET['year'].$_GET['month'].$tmplastdaymonth; }
$curtimestamp = gmmktime(12, 30, 0, intval($_GET['month']), 1, intval($_GET['year']));
$weekdaystart = intval(gmdate("w", $curtimestamp));
$numofdays = intval(gmdate("t", $curtimestamp));
$endtimestamp = gmmktime(12, 30, 0, intval($_GET['month']), $numofdays, intval($_GET['year']));
$weekdayend = intval(gmdate("w", $endtimestamp));
$monthonly = gmdate("F", $curtimestamp);
$yearonly = gmdate("Y", $curtimestamp);
$monthyear = $monthonly." ".$yearonly;
$daycount = 1;
$daynextcount = 1;
$prevmonth = intval($_GET['month']);
$prevmonthyear = intval($_GET['year']);
if($prevmonth>1) {
 $prevmonth -= 1; }
if($prevmonth<=1) { 
 $prevmonth = 12;
 $prevmonthyear -= 1; }
if(intval($_GET['month'])==2) {
 $prevmonth += 1; }
$prevmonthstamp = gmmktime(12, 30, 0, intval($prevmonth), 1, intval($prevmonthyear));
$prevmonthonly = gmdate("F", $prevmonthstamp);
$prevyearonly = gmdate("Y", $prevmonthstamp);
$prevmonthyear = $prevmonthonly." ".$prevyearonly;
$nextmonth = intval($_GET['month']);
$nextmonthyear = intval($_GET['year']);
if($nextmonth<=12) { 
 $nextmonth += 1; }
if($nextmonth>12) { 
 $nextmonth = 1;
 $nextmonthyear += 1; }
if(intval($_GET['month'])==11) {
 $nextmonth = 12; }
$nextmonthstamp = gmmktime(12, 30, 0, intval($nextmonth), 1, intval($nextmonthyear));
$nextmonthonly = gmdate("F", $nextmonthstamp);
$nextyearonly = gmdate("Y", $nextmonthstamp);
$nextmonthyear = $nextmonthonly." ".$nextyearonly;
echo "  <table style=\"width: 100%;\">\n";
echo "   <tr>\n    <th><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;calendar&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode(gmdate("Y", $prevmonthstamp).gmdate("m", $prevmonthstamp))."\">".$prevmonthyear."</a></th>\n    <th colspan=\"5\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode(gmdate("Y", $curtimestamp).gmdate("m", $curtimestamp))."\">".$monthyear."</a></th>\n    <th><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;calendar&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode(gmdate("Y", $nextmonthstamp).gmdate("m", $nextmonthstamp))."\">".$nextmonthyear."</a></th>\n   </tr>\n";
echo "   <tr>\n    <td style=\"width: 14%; font-weight: bold;\">Sunday</td>\n    <td style=\"width: 14%; font-weight: bold;\">Monday</td>\n    <td style=\"width: 14%; font-weight: bold;\">Tuesday</td>\n    <td style=\"width: 14%; font-weight: bold;\">Wednesday</td>\n    <td style=\"width: 14%; font-weight: bold;\">Thursday</td>\n    <td style=\"width: 14%; font-weight: bold;\">Friday</td>\n    <td style=\"width: 14%; font-weight: bold;\">Saturday</td>\n   </tr>\n";
while($daynextcount <= $weekdaystart) {
 if($daynextcount==1) { echo "   <tr>\n"; }
 echo "    <td style=\"width: 14%; height: 100px; vertical-align: top;\">&#xA0;</td>\n";
 $daynextcount += 1; }
while($daycount <= $numofdays) {
 $daycheck = $daycount;
 if(strlen($daycount)==1) { $daycheck = "0".$daycount; }
 $numofgames = 0;
 if($_GET['year'].$_GET['month'].$daycheck>=$firstgamedate && $_GET['year'].$_GET['month'].$daycheck<=$lastgamedate) {
 $prenumofgames = $sqldb->query("SELECT COUNT(*) as count FROM ".$leaguename."Games WHERE Date=".$_GET['year'].$_GET['month'].$daycheck." ORDER BY Date DESC, id DESC");
 $numofgamesarray = $prenumofgames->fetchArray();
 $numofgames = intval($numofgamesarray['count']);
 $gamedaystr = $daycount;
 $numgamesstr = "No Games"; }
 if($_GET['year'].$_GET['month'].$daycheck<$firstgamedate || $_GET['year'].$_GET['month'].$daycheck>$lastgamedate) {
  $gamedaystr = $daycount;
  $numgamesstr = "&#xA0;"; }
 if($_GET['year'].$_GET['month'].$daycheck>=$firstgamedate && $_GET['year'].$_GET['month'].$daycheck<=$lastgamedate) {
 if($numofgames>0) {
 $gamedaystr = "<a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode(gmdate("Y", $curtimestamp).gmdate("m", $curtimestamp).$daycheck)."\">".$daycount."</a>"; }
 if($numofgames==1) { $numgamesstr = "1 Game"; }
 if($numofgames>1) { $numgamesstr = $numofgames." Games"; } }
 if($daynextcount==1) { echo "   <tr>\n"; }
 echo "    <td style=\"width: 14%; height: 100px; vertical-align: top;\">".$gamedaystr."<br /><br /><div style=\"text-align: center;\">".$numgamesstr."</div></td>\n"; 
 if($daynextcount==7) { echo "   </tr>\n"; $daynextcount = 0; }
 $daynextcount += 1; $daycount += 1; }
if($daynextcount>1) {
while($daynextcount <= 7) {
 if($daynextcount==1) { echo "   <tr>\n"; }
 echo "    <td style=\"width: 14%; height: 100px; vertical-align: top;\">&#xA0;</td>\n";
 if($daynextcount==7) { echo "   </tr>\n"; }
 $daynextcount += 1; } }
echo "  </table>\n"; }
if($_GET['act']=="view") {
$SelectWhere = "";
$SelectWhereNext = false;
if(isset($_GET['date']) && is_numeric($_GET['date']) && strlen($_GET['date'])==8) {
 $SelectWhere = "WHERE Date=".$sqldb->escapeString($_GET['date'])." ";
 $SelectWhereNext = true; }
if(isset($_GET['date']) && is_numeric($_GET['date']) && strlen($_GET['date'])==6) {
 $getyear = substr($_GET['date'], 0, 4);
 $getmonth = substr($_GET['date'], 4, 2);
 $startday = $getyear.$getmonth."01";
 $tmplastdaymonth = gmdate("t", gmmktime(12, 30, 0, intval($_GET['month']), 1, intval($_GET['year'])));
 $endday = $getyear.$getmonth.$tmplastdaymonth;
 $SelectWhere = "WHERE (Date>=".$sqldb->escapeString($startday)." AND Date<=".$sqldb->escapeString($endday).") ";
 $SelectWhereNext = true; }
if(!isset($_GET['month']) || !is_numeric($_GET['month']) or !strlen($_GET['month'])==2) {
 $_GET['month'] = gmdate("m"); }
if(!isset($_GET['date']) && is_numeric($_GET['month']) && strlen($_GET['month'])==2) {
 if(!isset($_GET['year']) || !is_numeric($_GET['year']) || strlen($_GET['year'])<4) {
  $_GET['year'] = gmdate("Y"); }
 $startday = $_GET['year'].$_GET['month']."01";
 $tmplastdaymonth = gmdate("t", gmmktime(12, 30, 0, intval($_GET['month']), 1, intval($_GET['year'])));
 $endday = $_GET['year'].$_GET['month'].$tmplastdaymonth;
 $SelectWhere = "WHERE (Date>=".$sqldb->escapeString($startday)." AND Date<=".$sqldb->escapeString($endday).") ";
 $SelectWhereNext = true; }
if(isset($_GET['team'])) {
 if($SelectWhereNext==true) {
  $SelectWhere .= " AND (HomeTeam='".$sqldb->escapeString($_GET['team'])."' OR AwayTeam='".$sqldb->escapeString($_GET['team'])."') "; }
 if($SelectWhereNext==false) {
  $SelectWhere = "WHERE (HomeTeam='".$sqldb->escapeString($_GET['team'])."' OR AwayTeam='".$sqldb->escapeString($_GET['team'])."') ";
  $SelectWhereNext = true; } }
if(!isset($_GET['order'])) { $_GET['order'] = "descending"; }
if($_GET['order']=="asc" || $_GET['order']=="ascending") {
 $results = $sqldb->query("SELECT * FROM ".$leaguename."Games ".$SelectWhere."ORDER BY Date ASC, id ASC"); }
if($_GET['order']=="desc" || $_GET['order']=="descending") {
 $results = $sqldb->query("SELECT * FROM ".$leaguename."Games ".$SelectWhere."ORDER BY Date DESC, id DESC"); }
echo "<table style=\"width: 100%;\">\n";
while ($row = $results->fetchArray()) {
    $toneres = $sqldb->querySingle("SELECT CityName, TeamName, FullName FROM ".$leaguename."Teams WHERE FullName='".$sqldb->escapeString($row['HomeTeam'])."'", true);
    $ttwores = $sqldb->querySingle("SELECT CityName, TeamName, FullName FROM ".$leaguename."Teams WHERE FullName='".$sqldb->escapeString($row['AwayTeam'])."'", true);
    $tarenares = $sqldb->querySingle("SELECT CityName, ArenaName, FullArenaName FROM ".$leaguename."Arenas WHERE FullArenaName='".$sqldb->escapeString($row['AtArena'])."'", true);
    if($row['NumberPeriods']==3) {
       $PerPeriodScore = explode(",", $row['TeamScorePeriods']);
       $PerTeamScoreOne = explode(":", $PerPeriodScore[0]);
       $PerTeamScoreTwo = explode(":", $PerPeriodScore[1]);
       $PerTeamScoreThree = explode(":", $PerPeriodScore[2]);
       $PerTeamScoreTotal = explode(":", $row['TeamFullScore']);
       $PerPeriodSOG = explode(",", $row['ShotsOnGoal']);
       $PerTeamSOGOne = explode(":", $PerPeriodSOG[0]);
       $PerTeamSOGTwo = explode(":", $PerPeriodSOG[1]);
       $PerTeamSOGThree = explode(":", $PerPeriodSOG[2]);
       $PerTeamSOGTotal = explode(":", $row['FullShotsOnGoal']);
       $tonebold = "";
       if($PerTeamScoreTotal[0]>$PerTeamScoreTotal[1]) { $tonebold = " font-weight: bold;"; }
       $ttwobold = "";
       if($PerTeamScoreTotal[0]<$PerTeamScoreTotal[1]) { $ttwobold = " font-weight: bold;"; }
       $LineOne = " <tr>\n   <th colspan=\"7\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($row['Date'])."&amp;team=".urlencode($toneres['FullName'])."&amp;#".$leaguename."Game-".$row['Date']."-".urlencode(preg_replace('/\s+/', '', $toneres['FullName']))."-vs-".urlencode(preg_replace('/\s+/', '', $ttwores['FullName']))."\" id=\"".$leaguename."Game-".urlencode($row['Date'])."-".preg_replace('/\s+/', '', htmlspecialchars($toneres['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8"))."-vs-".preg_replace('/\s+/', '', htmlspecialchars($ttwores['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8"))."\">".htmlspecialchars($toneres['TeamName'], ENT_COMPAT | ENT_XHTML, "UTF-8")." vs ".htmlspecialchars($ttwores['TeamName'], ENT_COMPAT | ENT_XHTML, "UTF-8")." at ".htmlspecialchars($tarenares['ArenaName'], ENT_COMPAT | ENT_XHTML, "UTF-8")." on ".substr($row['Date'], 4, 2)."/".substr($row['Date'], 6, 2)."/".substr($row['Date'], 0, 4)."</a></th>\n </tr>\n <tr>\n   <th>Teams</th>\n   <th>1st</th>\n   <th>2nd</th>\n   <th>3rd</th>\n   <th>&#xA0;</th>\n   <th>&#xA0;</th>\n   <th>Total</th>\n </tr>\n <tr>\n   <td style=\"text-align: center;".$tonebold."\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($row['Date'])."&amp;team=".urlencode($toneres['FullName'])."\">".htmlspecialchars($toneres['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8")."</a></td>\n   <td style=\"text-align: center;\">".$PerTeamScoreOne[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTwo[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreThree[0]."</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTotal[0]."</td>\n </tr>\n <tr>\n   <td style=\"text-align: center;\">Shots on Goal</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGOne[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTwo[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGThree[0]."</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTotal[0]."</td>\n </tr>\n <tr>\n   <th>Teams</th>\n   <th>1st</th>\n   <th>2nd</th>\n   <th>3rd</th>\n   <th>&#xA0;</th>\n   <th>&#xA0;</th>\n   <th>Total</th>\n </tr>\n <tr>\n   <td style=\"text-align: center;".$ttwobold."\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($row['Date'])."&amp;team=".urlencode($ttwores['FullName'])."\">".htmlspecialchars($ttwores['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8")."</a></td>\n   <td style=\"text-align: center;\">".$PerTeamScoreOne[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTwo[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreThree[1]."</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTotal[1]."</td>\n </tr>\n <tr>\n   <td style=\"text-align: center;\">Shots on Goal</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGOne[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTwo[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGThree[1]."</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTotal[1]."</td>\n </tr>\n"; }
    if($row['NumberPeriods']==4) {
       $PerPeriodScore = explode(",", $row['TeamScorePeriods']);
       $PerTeamScoreOne = explode(":", $PerPeriodScore[0]);
       $PerTeamScoreTwo = explode(":", $PerPeriodScore[1]);
       $PerTeamScoreThree = explode(":", $PerPeriodScore[2]);
       $PerTeamScoreFour = explode(":", $PerPeriodScore[3]);
       $PerTeamScoreTotal = explode(":", $row['TeamFullScore']);
       $PerPeriodSOG = explode(",", $row['ShotsOnGoal']);
       $PerTeamSOGOne = explode(":", $PerPeriodSOG[0]);
       $PerTeamSOGTwo = explode(":", $PerPeriodSOG[1]);
       $PerTeamSOGThree = explode(":", $PerPeriodSOG[2]);
       $PerTeamSOGFour = explode(":", $PerPeriodSOG[3]);
       $PerTeamSOGTotal = explode(":", $row['FullShotsOnGoal']);
       $tonebold = "";
       if($PerTeamScoreTotal[0]>$PerTeamScoreTotal[1]) { $tonebold = " font-weight: bold;"; }
       $ttwobold = "";
       if($PerTeamScoreTotal[0]<$PerTeamScoreTotal[1]) { $ttwobold = " font-weight: bold;"; }
       $LineOne = " <tr>\n   <th colspan=\"7\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($row['Date'])."&amp;team=".urlencode($toneres['FullName'])."&amp;#".$leaguename."Game-".$row['Date']."-".urlencode(preg_replace('/\s+/', '', $toneres['FullName']))."-vs-".urlencode(preg_replace('/\s+/', '', $ttwores['FullName']))."\" id=\"".$leaguename."Game-".urlencode($row['Date'])."-".preg_replace('/\s+/', '', htmlspecialchars($toneres['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8"))."-vs-".preg_replace('/\s+/', '', htmlspecialchars($ttwores['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8"))."\">".htmlspecialchars($toneres['TeamName'], ENT_COMPAT | ENT_XHTML, "UTF-8")." vs ".htmlspecialchars($ttwores['TeamName'], ENT_COMPAT | ENT_XHTML, "UTF-8")." at ".htmlspecialchars($tarenares['ArenaName'], ENT_COMPAT | ENT_XHTML, "UTF-8")." on ".substr($row['Date'], 4, 2)."/".substr($row['Date'], 6, 2)."/".substr($row['Date'], 0, 4)."</a></th>\n </tr>\n <tr>\n   <th>Teams</th>\n   <th>1st</th>\n   <th>2nd</th>\n   <th>3rd</th>\n   <th>OT</th>\n   <th>&#xA0;</th>\n   <th>Total</th>\n </tr>\n <tr>\n   <td style=\"text-align: center;".$tonebold."\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($row['Date'])."&amp;team=".urlencode($toneres['FullName'])."\">".htmlspecialchars($toneres['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8")."</a></td>\n   <td style=\"text-align: center;\">".$PerTeamScoreOne[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTwo[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreThree[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreFour[0]."</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTotal[0]."</td>\n </tr>\n <tr>\n   <td style=\"text-align: center;\">Shots on Goal</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGOne[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTwo[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGThree[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGFour[0]."</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTotal[0]."</td>\n </tr>\n <tr>\n   <th>Teams</th>\n   <th>1st</th>\n   <th>2nd</th>\n   <th>3rd</th>\n   <th>OT</th>\n   <th>&#xA0;</th>\n   <th>Total</th>\n </tr>\n <tr>\n   <td style=\"text-align: center;".$ttwobold."\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($row['Date'])."&amp;team=".urlencode($ttwores['FullName'])."\">".htmlspecialchars($ttwores['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8")."</a></td>\n   <td style=\"text-align: center;\">".$PerTeamScoreOne[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTwo[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreThree[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreFour[1]."</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTotal[1]."</td>\n </tr>\n <tr>\n   <td style=\"text-align: center;\">Shots on Goal</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGOne[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTwo[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGThree[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGFour[1]."</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTotal[1]."</td>\n </tr>\n"; }
    if($row['NumberPeriods']==5) {
       $PerPeriodScore = explode(",", $row['TeamScorePeriods']);
       $PerTeamScoreOne = explode(":", $PerPeriodScore[0]);
       $PerTeamScoreTwo = explode(":", $PerPeriodScore[1]);
       $PerTeamScoreThree = explode(":", $PerPeriodScore[2]);
       $PerTeamScoreFour = explode(":", $PerPeriodScore[3]);
       $PerTeamScoreFive = explode(":", $PerPeriodScore[4]);
       $PerTeamScoreTotal = explode(":", $row['TeamFullScore']);
       $PerPeriodSOG = explode(",", $row['ShotsOnGoal']);
       $PerTeamSOGOne = explode(":", $PerPeriodSOG[0]);
       $PerTeamSOGTwo = explode(":", $PerPeriodSOG[1]);
       $PerTeamSOGThree = explode(":", $PerPeriodSOG[2]);
       $PerTeamSOGFour = explode(":", $PerPeriodSOG[3]);
       $PerTeamSOGTotal = explode(":", $row['FullShotsOnGoal']);
       $tonebold = "";
       if($PerTeamScoreTotal[0]>$PerTeamScoreTotal[1]) { $tonebold = " font-weight: bold;"; }
       $ttwobold = "";
       if($PerTeamScoreTotal[0]<$PerTeamScoreTotal[1]) { $ttwobold = " font-weight: bold;"; }
       $LineOne = " <tr>\n   <th colspan=\"7\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($row['Date'])."&amp;team=".urlencode($toneres['FullName'])."&amp;#".$leaguename."Game-".$row['Date']."-".urlencode(preg_replace('/\s+/', '', $toneres['FullName']))."-vs-".urlencode(preg_replace('/\s+/', '', $ttwores['FullName']))."\" id=\"".$leaguename."Game-".urlencode($row['Date'])."-".preg_replace('/\s+/', '', htmlspecialchars($toneres['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8"))."-vs-".preg_replace('/\s+/', '', htmlspecialchars($ttwores['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8"))."\">".htmlspecialchars($toneres['TeamName'], ENT_COMPAT | ENT_XHTML, "UTF-8")." vs ".htmlspecialchars($ttwores['TeamName'], ENT_COMPAT | ENT_XHTML, "UTF-8")." at ".htmlspecialchars($tarenares['ArenaName'], ENT_COMPAT | ENT_XHTML, "UTF-8")." on ".substr($row['Date'], 4, 2)."/".substr($row['Date'], 6, 2)."/".substr($row['Date'], 0, 4)."</a></th>\n </tr>\n <tr>\n   <th>Teams</th>\n   <th>1st</th>\n   <th>2nd</th>\n   <th>3rd</th>\n   <th>OT</th>\n   <th>SO</th>\n   <th>Total</th>\n </tr>\n <tr>\n   <td style=\"text-align: center;".$tonebold."\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($row['Date'])."&amp;team=".urlencode($toneres['FullName'])."\">".htmlspecialchars($toneres['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8")."</a></td>\n   <td style=\"text-align: center;\">".$PerTeamScoreOne[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTwo[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreThree[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreFour[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreFive[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTotal[0]."</td>\n </tr>\n <tr>\n   <td style=\"text-align: center;\">Shots on Goal</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGOne[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTwo[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGThree[0]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGFour[0]."</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTotal[0]."</td>\n </tr>\n <tr>\n   <th>Teams</th>\n   <th>1st</th>\n   <th>2nd</th>\n   <th>3rd</th>\n   <th>OT</th>\n   <th>SO</th>\n   <th>Total</th>\n </tr>\n <tr>\n   <td style=\"text-align: center;".$ttwobold."\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($row['Date'])."&amp;team=".urlencode($ttwores['FullName'])."\">".htmlspecialchars($ttwores['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8")."</a></td>\n   <td style=\"text-align: center;\">".$PerTeamScoreOne[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTwo[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreThree[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreFour[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreFive[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamScoreTotal[1]."</td>\n </tr>\n <tr>\n   <td style=\"text-align: center;\">Shots on Goal</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGOne[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTwo[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGThree[1]."</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGFour[1]."</td>\n   <td style=\"text-align: center;\">&#xA0;</td>\n   <td style=\"text-align: center;\">".$PerTeamSOGTotal[1]."</td>\n </tr>\n"; }
    echo $LineOne."\n <tr>\n   <td colspan=\"7\" style=\"text-align: center;\">&#xA0;</td>\n </tr>\n <tr>\n   <td colspan=\"7\" style=\"text-align: center;\">&#xA0;</td>\n </tr>\n"; }
echo "</table>\n<div>&#xA0;<br />&#xA0;</div>\n\n"; }
if($_GET['act']=="stats" or $_GET['act']=="standing") {
$lsotres = $sqldb->querySingle("SELECT OrderType FROM HockeyLeagues WHERE LeagueName='".$sqldb->escapeString($leaguename)."'", true);
$SelectWhere = "";
$SelectWhereNext = false;
if(isset($_GET['date']) && is_numeric($_GET['date']) && strlen($_GET['date'])==8) {
 $SelectWhere = "WHERE Date<=".$sqldb->escapeString($_GET['date'])." ";
 $SelectWhereNext = true; }
$sqldb->exec("CREATE TEMP TABLE ".$leaguename."Standings AS SELECT * FROM ".$leaguename."Stats ".$SelectWhere." GROUP BY TeamID ORDER BY TeamID ASC, Date DESC");
echo "<table style=\"width: 100%;\">";
$tresults = $sqldb->query("SELECT * FROM ".$leaguename."Standings ".$lsotres['OrderType']);
echo "\n <tr>\n   <th colspan=\"18\"><a href=\"index.php?stats&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;#OverallStats\" id=\"OverallStats\">".$leaguename." Team Stats &amp; Standings</a></th>\n </tr>";
echo "\n <tr>\n   <th colspan=\"2\">Team</th>\n   <th>GP</th>\n   <th>W</th>\n   <th>L</th>\n   <th>OTL</th>\n   <th>SOL</th>\n   <th>P</th>\n   <th>PCT</th>\n   <th>ROW</th>\n   <th>GF</th>\n   <th>GA</th>\n   <th>DIFF</th>\n   <th>Home</th>\n   <th>Away</th>\n   <th>S/O</th>\n   <th>L10</th>\n   <th>Streak</th>\n </tr>";
$teamplace = 1;
while ($trow = $tresults->fetchArray()) {
    if($trow['Shootouts']=="0:0") { $trow['Shootouts'] = "-"; }
    if($trow['GoalsDifference']=="0") { $trow['GoalsDifference'] = "E"; }
    echo "\n <tr>\n   <td style=\"text-align: center;\">".$teamplace."</td>\n   <td style=\"text-align: center;\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($trow['Date'])."&amp;team=".urlencode($trow['FullName'])."\">".htmlspecialchars($trow['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8")."</a></td>\n   <td style=\"text-align: center;\">".$trow['GamesPlayed']."</td>\n   <td style=\"text-align: center;\">".$trow['TWins']."</td>\n   <td style=\"text-align: center;\">".$trow['Losses']."</td>\n   <td style=\"text-align: center;\">".$trow['OTLosses']."</td>\n   <td style=\"text-align: center;\">".$trow['SOLosses']."</td>\n   <td style=\"text-align: center;\">".$trow['Points']."</td>\n   <td style=\"text-align: center;\">".number_format($trow['PCT'], 3)."</td>\n   <td style=\"text-align: center;\">".$trow['ROW']."</td>\n   <td style=\"text-align: center;\">".$trow['GoalsFor']."</td>\n   <td style=\"text-align: center;\">".$trow['GoalsAgainst']."</td>\n   <td style=\"text-align: center;\">".$trow['GoalsDifference']."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['HomeRecord'])."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['AwayRecord'])."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['Shootouts'])."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['LastTen'])."</td>\n   <td style=\"text-align: center;\">".$trow['Streak']."</td>\n </tr>"; $teamplace += 1; }
$conresults = $sqldb->query("SELECT * FROM ".$leaguename."Conferences");
while ($conrow = $conresults->fetchArray()) {
if($_GET['conference']=="All" || $_GET['conference']==$conrow['Conference']) {
echo " <tr>\n   <td colspan=\"18\" style=\"text-align: center;\">&#xA0;</td>\n </tr>\n <tr>\n   <td colspan=\"18\" style=\"text-align: center;\">&#xA0;</td>\n </tr>\n";
$tresults = $sqldb->query("SELECT * FROM ".$leaguename."Standings WHERE Conference='".$sqldb->escapeString($conrow['Conference'])."' ".$lsotres['OrderType']);
echo "\n <tr>\n   <th colspan=\"18\"><a href=\"index.php?stats&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;#".$conrow['Conference']."ConferenceStats\" id=\"".$conrow['Conference']."ConferenceStats\">".$leaguename." ".$conrow['Conference']." Conference Stats &amp; Standings</a></th>\n </tr>";
echo "\n <tr>\n   <th colspan=\"2\">Team</th>\n   <th>GP</th>\n   <th>W</th>\n   <th>L</th>\n   <th>OTL</th>\n   <th>SOL</th>\n   <th>P</th>\n   <th>PCT</th>\n   <th>ROW</th>\n   <th>GF</th>\n   <th>GA</th>\n   <th>DIFF</th>\n   <th>Home</th>\n   <th>Away</th>\n   <th>S/O</th>\n   <th>L10</th>\n   <th>Streak</th>\n </tr>";
$teamplace = 1;
while ($trow = $tresults->fetchArray()) {
    if($trow['Shootouts']=="0:0") { $trow['Shootouts'] = "-"; }
    if($trow['GoalsDifference']=="0") { $trow['GoalsDifference'] = "E"; }
    echo "\n <tr>\n   <td style=\"text-align: center;\">".$teamplace."</td>\n   <td style=\"text-align: center;\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($trow['Date'])."&amp;team=".urlencode($trow['FullName'])."\">".htmlspecialchars($trow['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8")."</a></td>\n   <td style=\"text-align: center;\">".$trow['GamesPlayed']."</td>\n   <td style=\"text-align: center;\">".$trow['TWins']."</td>\n   <td style=\"text-align: center;\">".$trow['Losses']."</td>\n   <td style=\"text-align: center;\">".$trow['OTLosses']."</td>\n   <td style=\"text-align: center;\">".$trow['SOLosses']."</td>\n   <td style=\"text-align: center;\">".$trow['Points']."</td>\n   <td style=\"text-align: center;\">".number_format($trow['PCT'], 3)."</td>\n   <td style=\"text-align: center;\">".$trow['ROW']."</td>\n   <td style=\"text-align: center;\">".$trow['GoalsFor']."</td>\n   <td style=\"text-align: center;\">".$trow['GoalsAgainst']."</td>\n   <td style=\"text-align: center;\">".$trow['GoalsDifference']."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['HomeRecord'])."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['AwayRecord'])."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['Shootouts'])."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['LastTen'])."</td>\n   <td style=\"text-align: center;\">".$trow['Streak']."</td>\n </tr>"; $teamplace += 1; } } }
$divresults = $sqldb->query("SELECT * FROM ".$leaguename."Divisions");
while ($divrow = $divresults->fetchArray()) {
if($_GET['division']=="All" || $_GET['division']==$divrow['Division']) {
echo " <tr>\n   <td colspan=\"18\" style=\"text-align: center;\">&#xA0;</td>\n </tr>\n <tr>\n   <td colspan=\"18\" style=\"text-align: center;\">&#xA0;</td>\n </tr>\n";
$tresults = $sqldb->query("SELECT * FROM ".$leaguename."Standings WHERE Division='".$sqldb->escapeString($divrow['Division'])."' ".$lsotres['OrderType']);
echo "\n <tr>\n   <th colspan=\"18\"><a href=\"index.php?stats&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;#".$divrow['Division']."DivisionStats\" id=\"".$divrow['Division']."DivisionStats\">".$leaguename." ".$divrow['Division']." Division Team Stats &amp; Standings</a></th>\n </tr>";
echo "\n <tr>\n   <th colspan=\"2\">Team</th>\n   <th>GP</th>\n   <th>W</th>\n   <th>L</th>\n   <th>OTL</th>\n   <th>SOL</th>\n   <th>P</th>\n   <th>PCT</th>\n   <th>ROW</th>\n   <th>GF</th>\n   <th>GA</th>\n   <th>DIFF</th>\n   <th>Home</th>\n   <th>Away</th>\n   <th>S/O</th>\n   <th>L10</th>\n   <th>Streak</th>\n </tr>";
$teamplace = 1;
while ($trow = $tresults->fetchArray()) {
    if($trow['Shootouts']=="0:0") { $trow['Shootouts'] = "-"; }
    if($trow['GoalsDifference']=="0") { $trow['GoalsDifference'] = "E"; }
    echo "\n <tr>\n   <td style=\"text-align: center;\">".$teamplace."</td>\n   <td style=\"text-align: center;\"><a href=\"".$fileurl."?".urlencode($_GET['output'])."&amp;games&amp;database=".urlencode($databasefile)."&amp;league=".urlencode($leaguename)."&amp;date=".urlencode($trow['Date'])."&amp;team=".urlencode($trow['FullName'])."\">".htmlspecialchars($trow['FullName'], ENT_COMPAT | ENT_XHTML, "UTF-8")."</a></td>\n   <td style=\"text-align: center;\">".$trow['GamesPlayed']."</td>\n   <td style=\"text-align: center;\">".$trow['TWins']."</td>\n   <td style=\"text-align: center;\">".$trow['Losses']."</td>\n   <td style=\"text-align: center;\">".$trow['OTLosses']."</td>\n   <td style=\"text-align: center;\">".$trow['SOLosses']."</td>\n   <td style=\"text-align: center;\">".$trow['Points']."</td>\n   <td style=\"text-align: center;\">".number_format($trow['PCT'], 3)."</td>\n   <td style=\"text-align: center;\">".$trow['ROW']."</td>\n   <td style=\"text-align: center;\">".$trow['GoalsFor']."</td>\n   <td style=\"text-align: center;\">".$trow['GoalsAgainst']."</td>\n   <td style=\"text-align: center;\">".$trow['GoalsDifference']."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['HomeRecord'])."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['AwayRecord'])."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['Shootouts'])."</td>\n   <td style=\"text-align: center;\">".str_replace(":", "-", $trow['LastTen'])."</td>\n   <td style=\"text-align: center;\">".$trow['Streak']."</td>\n </tr>"; $teamplace += 1; } } }
echo " <tr>\n   <td colspan=\"18\" style=\"text-align: center;\">&#xA0;</td>\n </tr>\n <tr>\n   <td colspan=\"18\" style=\"text-align: center;\">&#xA0;</td>\n </tr>\n";
echo "\n</table>\n<div>&#xA0;<br />&#xA0;</div>\n\n"; }
$sqldb->close();
?>
 </body>
</html>
