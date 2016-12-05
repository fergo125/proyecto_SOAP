<?php
class Scores extends ADOdb_Active_Record{
  var $_table = 'eb23990_scores';
  function __construct() {
    parent::__construct();
    $row = $GLOBALS['db']->GetRow("SELECT nextval('eb23990_score_id_seq'::regclass) AS id");
    $this->id = $row['id'];
  }
}
?>
