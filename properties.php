<?php
class Dataprop {
    /* Properties */
    private $conn;

    /* Get database access */
    public function __construct(\PDO $pdo) {
        $this->conn = $pdo;
    }

    /* List all users */
    public function get_county() {
        return $this->conn->query("SELECT EP.channel_title, CD.field_id_32, CD.field_id_31 FROM exp_channels EP, exp_structure EX, exp_channel_data CD WHERE EP.channel_id = EX.listing_cid AND EX.entry_id = CD.entry_id AND CD.field_id_32 <> '' ORDER BY channel_name ASC LIMIT 400")->fetchAll();
    }

    public function get_state($p) {
        return $this->conn->query("SELECT EP.channel_title, CD.field_id_32, CD.field_id_31 FROM exp_channels EP, exp_structure EX, exp_channel_data CD WHERE EP.channel_id = EX.listing_cid AND EX.entry_id = CD.entry_id AND CD.field_id_32 <> '' AND CD.field_id_32 LIKE '$p%'  ORDER BY channel_name ASC LIMIT 400")->fetchAll();
    }
}