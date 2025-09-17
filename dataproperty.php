<?php
class Dataproperty {
    /* Status */
    private $conn;

    /* Get database access */
    public function __construct(\PDO $pdod) {
        $this->conn = $pdod;
    }

    public function get_propertieslist($p){
        $html = '';
        $p = $p."%";
        $x = $this->conn->query("SELECT entry_id, title FROM exp_zproperties WHERE channel_id = 3 AND title LIKE '$p' AND status NOT IN ('closed')")->fetchAll();
        foreach ($x as $key => $value) {
            $prop = str_replace(" ", "%20", $x[$key]['title']);
            $prop = str_replace("'", "", $prop);
            $val = $x[$key]['entry_id'].",".$prop;
            $html .= "<span id='propsbutton' onclick=tractlist('".$val."')>".$x[$key]['title']."</span>";
        }
        return $html;
    }

    public function get_tractlist($p){
        $html = '';
        $x = $this->conn->query("SELECT * FROM exp_zproperties WHERE parent_id = '$p'")->fetchAll();
        $html .= "<select class='custom-select' name='tracts' id='tracts' onchange=addtractinfo(this.value)>";
        $html .= "<option value=''>- Select a Tract -</option>";
        foreach ($x as $key => $value) {
            $html .= "<option value='".$x[$key]['entry_id']."'>".$x[$key]['title']."</option>";
        }
        $html .= '</select>';

        return $html;
    }

     public function get_tractdropdown($p){
        $html = '';
        $x = $this->conn->query("SELECT * FROM exp_zproperties WHERE parent_id = '$p'")->fetchAll();
        $html .= "<select class='custom-select' name='tracts' id='tracts'>";
        $html .= "<option value=''>- Select a Tract -</option>";
        foreach ($x as $key => $value) {
            $html .= "<option value='".$x[$key]['entry_id']."'>".$x[$key]['title']."</option>";
        }
        $html .= '</select>';

        return $html;
    }

    public function add_price($p){
        //$x = $this->conn->query("SELECT ESL.entry_id, ECD.field_id_15 AS Regprice, ECT.title, ECT.status, ECD.field_id_13 AS Size, ECD.field_id_40 AS tractnumber FROM `exp_structure_listings` AS ESL, exp_channel_data AS ECD, exp_channel_titles AS ECT WHERE ESL.entry_id = '$p' AND ESL.entry_id = ECD.entry_id AND ECT.entry_id = ESL.entry_id")->fetchAll();
        $x = $this->conn->query("SELECT * FROM exp_zproperties WHERE entry_id = '$p'")->fetchAll();
        $price = $x[0]['regprice'];
        $chkbox = "<input type='hidden' id='auxsize' name='auxsize' value='".$x[0]['size']."'><input type='hidden' id='auxtractnumber' name='auxtractnumber' value='".$x[0]['tractnumber']."'><button class='btn btn-primary btn small btn-block' onclick='addprice(".$price.")'>Add Price + ".number_format($price, 2, '.', ',')." for ".$x[0]['title']."</button>";

        return $chkbox;
    }

    public function get_datatracts($p) {
        return $this->conn->query("SELECT * FROM exp_zproperties WHERE entry_id = '$p'")->fetchAll();
    }
    public function get_tractstatus($p) {
        return $this->conn->query("SELECT * FROM exp_zproperties WHERE entry_id = '$p'")->fetchAll();
    }
    public function get_tractlocation($p) {
        $x = $this->conn->query("SELECT * FROM exp_zproperties where entry_id = '$p'")->fetchAll();
        $parent = $x[0]['parent_id'];
        return $this->conn->query("SELECT * FROM exp_zproperties where entry_id = '$parent'")->fetchAll();
    }

    public function get_suffixlist() {
        $suffixlist ="<select class='custom-select' id='suffix'>
            <option value=''>Choose...</option>
            <option value='Mr'>MR</option>
            <option value='Ms'>MS</option>
            <option value='Jr'>JR</option>
            <option value='Sr'>SR</option>
            <option value='II'>II</option>
            <option value='III'>III</option>
            </select>";

        return $suffixlist;
    }
    public function get_mpurchaser() {
        $chkbox ="<input type='checkbox' class='form-check-input' id='openpbox' onclick='showmpbox(1)'><label class='form-check-label' for='same-address'>Multiple Purchasers</label>";

        return $chkbox;
    }

    public function get_mtracts() {
        //$chkbox ="<input type='checkbox' class='form-check-input' id='mtractsck' onclick='showmtbox(1)'><label class='form-check-label' for='multipletracts'>Multiple Tracts</label><button class='btn btn-primary btn small btn-block' onclick='showmtbox(1)'>Add Tract</button>";
        $chkbox ="<button class='btn btn-primary btn small btn-block' onclick='showmtbox(1)'>Add Tract</button>";

        return $chkbox;
    }

    public function get_stateslist($s) {
        $st = array(
          'AL' => 'Alabama',
          'AK' => 'Alaska',
          'AZ' => 'Arizona',
          'AR' => 'Arkansas',
          'CA' => 'California',
          'CO' => 'Colorado',
          'CT' => 'Connecticut',
          'DE' => 'Delaware',
          'DC' => 'District Of Columbia',
          'FL' => 'Florida',
          'GA' => 'Georgia',
          'HI' => 'Hawaii',
          'ID' => 'Idaho',
          'IL' => 'Illinois',
          'IN' => 'Indiana',
          'IA' => 'Iowa',
          'KS' => 'Kansas',
          'KY' => 'Kentucky',
          'LA' => 'Louisiana',
          'ME' => 'Maine',
          'MD' => 'Maryland',
          'MA' => 'Massachusetts',
          'MI' => 'Michigan',
          'MN' => 'Minnesota',
          'MS' => 'Mississippi',
          'MO' => 'Missouri',
          'MT' => 'Montana',
          'NE' => 'Nebraska',
          'NV' => 'Nevada',
          'NH' => 'New Hampshire',
          'NJ' => 'New Jersey',
          'NM' => 'New Mexico',
          'NY' => 'New York',
          'NC' => 'North Carolina',
          'ND' => 'North Dakota',
          'OH' => 'Ohio',
          'OK' => 'Oklahoma',
          'OR' => 'Oregon',
          'PA' => 'Pennsylvania',
          'RI' => 'Rhode Island',
          'SC' => 'South Carolina',
          'SD' => 'South Dakota',
          'TN' => 'Tennessee',
          'TX' => 'Texas',
          'UT' => 'Utah',
          'VT' => 'Vermont',
          'VA' => 'Virginia',
          'WA' => 'Washington',
          'WV' => 'West Virginia',
          'WI' => 'Wisconsin',
          'WY' => 'Wyoming',
          'AE' => 'Armed Forces'
        ); 

        $stateselect = '';
        $stateselect .= "<select class='custom-select' id='statedeed'>";
        $stateselect .= "<option value=''>Choose...</option>";
        foreach ($st as $key => $value) {
            if ($key == $s) {
               $stateselect .= "<option value='".$key."' selected>".$value."</option>";
            }else{
                $stateselect .= "<option value='".$key."'>".$value."</option>";
            }           
        }
        $stateselect .= "</select>";

        return $stateselect;
    }

    public function convertstates($s){

        switch ($s) {
            case 46: $state = 'AK'; break;
            case 47: $state = 'AZ'; break;
            case 48: $state = 'AR'; break;
            case 49: $state = 'CA'; break;
            case 50: $state = 'AR'; break;
            case 51: $state = 'CO'; break;
            case 52: $state = 'CT'; break;
            case 53: $state = 'DE'; break;
            case 54: $state = 'DC'; break;
            case 55: $state = 'FL'; break;
            case 56: $state = 'GA'; break;
            case 57: $state = 'GU'; break;
            case 58: $state = 'HI'; break;
            case 59: $state = 'ID'; break;
            case 60: $state = 'IL'; break;
            case 61: $state = 'IN'; break;
            case 62: $state = 'IA'; break;
            case 63: $state = 'KS'; break;
            case 64: $state = 'KY'; break;
            case 65: $state = 'LA'; break;
            case 66: $state = 'ME'; break;
            case 67: $state = 'MD'; break;
            case 68: $state = 'MA'; break;
            case 69: $state = 'MI'; break;
            case 70: $state = 'MN'; break;
            case 71: $state = 'MS'; break;
            case 72: $state = 'MO'; break;
            case 73: $state = 'MT'; break;
            case 74: $state = 'NE'; break;
            case 75: $state = 'NV'; break;
            case 76: $state = 'NH'; break;
            case 77: $state = 'NJ'; break;
            case 78: $state = 'NM'; break;
            case 79: $state = 'NY'; break;
            case 80: $state = 'NC'; break;
            case 81: $state = 'ND'; break;
            case 82: $state = 'OH'; break;
            case 83: $state = 'OK'; break;
            case 84: $state = 'OR'; break;
            case 85: $state = 'PA'; break;
            case 86: $state = 'PR'; break;
            case 87: $state = 'RI'; break;
            case 88: $state = 'SC'; break;
            case 89: $state = 'SD'; break;   
            case 90: $state = 'TN'; break;         
            case 91: $state = 'TX'; break;
            case 92: $state = 'UT'; break;
            case 93: $state = 'VT'; break;
            case 94: $state = 'VI'; break;
            case 95: $state = 'VA'; break;
            case 96: $state = 'WA'; break;
            case 97: $state = 'WV'; break;
            case 98: $state = 'WI'; break;
            case 99: $state = 'WY'; break;
        }

        return $state;
    }

    public function get_signoptions() {
        //First day Contract
        $fulldate = date("d/m/Y");
        $date = date('d');
        $months = array(
                "1" => 'January',
                "2" => 'February',
                "3" => 'March',
                "4" => 'April',
                "5" => 'May',
                "6" => 'June',
                "7" => 'July',
                "8" => 'August',
                "9" => 'September',
                "10" => 'October',
                "11" => 'November',
                "12" => 'December',
            );
        if ($date >= 31) {

            $m = date('n');
            $nm = $m + 1;
            $pm = $m - 1;
            $tm = $m + 2;
            $month = $months[$m];
            $nextmonth = $months[$nm];
            $previousmonth = $months[$pm];
            $twomonths = $months[$tm];
            //echo $month." -> ".$nextmonth." -> ".$previousmonth." -> ".$twomonths;
        }else{
            $month = date('F');
            //echo date('m/d/y h:i a',(strtotime('next month',strtotime(date('m/01/y')))));            
            //$nextmonth = date("F", strtotime("+1 month"));        
            $nextmonth = date("F", strtotime(date('m/d/y h:i a',(strtotime('next month',strtotime(date('m/01/y')))))));                
            $twomonths = date("F", strtotime("+2 month"));
            //Remove January 25
            //$twomonths = $months[2];
            $previousmonth = date("F", strtotime("-1 month"));
        }

        $year = date('Y');
        //echo $year;

        if ($date < 15) {            
            $fd1 = "fifteenth day of ".$month.", ".$year.", ";
            $p1 = "fifteenth-".$month."-".$year."-".$previousmonth;
            /*if ($nextmonth == "January") {
                $year = $year + 1;
            }*/
            $fd2 = "first day of ".$nextmonth.", ".$year.", ";
            $p2 = "first-".$nextmonth."-".$year."-".$month;
            $fd3 = "fifteenth day of ".$nextmonth.", ".$year.", ";
            $p3 = "fifteenth-".$nextmonth."-".$year."-".$month;
        }else{
            /*if ($nextmonth == "January") {
                $year = $year + 1;
            }*/
            $fd1 = "first day of ".$nextmonth.", ".$year.", ";
            $p1 = "first-".$nextmonth."-".$year."-".$month;
            $fd2 = "fifteenth day of ".$nextmonth.", ".$year.", ";
            $p2 = "fifteenth-".$nextmonth."-".$year."-".$month;
            
            $fd3 = "first day of ".$twomonths.", ".$year.", ";
            $p3 = "first-".$twomonths."-".$year."-".$nextmonth;
        }

        $code = "<select class='custom-select' id='signoption' onchange=terms(this.value)>
                  <option value='0'>- Select an option -</option>
                  <option value='".$p1."'>".$fd1."</option>
                  <option value='".$p2."'>".$fd2."</option>
                  <option value='".$p3."'>".$fd3."</option>
                </select>";

        return $code;
    }

    public function get_convertstates($st){
        $us_state_abbrevs_names = array(
            'AL'=>'ALABAMA',
            'AK'=>'ALASKA',
            'AS'=>'AMERICAN SAMOA',
            'AZ'=>'ARIZONA',
            'AR'=>'ARKANSAS',
            'CA'=>'CALIFORNIA',
            'CO'=>'COLORADO',
            'CT'=>'CONNECTICUT',
            'DE'=>'DELAWARE',
            'DC'=>'DISTRICT OF COLUMBIA',
            'FM'=>'FEDERATED STATES OF MICRONESIA',
            'FL'=>'FLORIDA',
            'GA'=>'GEORGIA',
            'GU'=>'GUAM GU',
            'HI'=>'HAWAII',
            'ID'=>'IDAHO',
            'IL'=>'ILLINOIS',
            'IN'=>'INDIANA',
            'IA'=>'IOWA',
            'KS'=>'KANSAS',
            'KY'=>'KENTUCKY',
            'LA'=>'LOUISIANA',
            'ME'=>'MAINE',
            'MH'=>'MARSHALL ISLANDS',
            'MD'=>'MARYLAND',
            'MA'=>'MASSACHUSETTS',
            'MI'=>'MICHIGAN',
            'MN'=>'MINNESOTA',
            'MS'=>'MISSISSIPPI',
            'MO'=>'MISSOURI',
            'MT'=>'MONTANA',
            'NE'=>'NEBRASKA',
            'NV'=>'NEVADA',
            'NH'=>'NEW HAMPSHIRE',
            'NJ'=>'NEW JERSEY',
            'NM'=>'NEW MEXICO',
            'NY'=>'NEW YORK',
            'NC'=>'NORTH CAROLINA',
            'ND'=>'NORTH DAKOTA',
            'MP'=>'NORTHERN MARIANA ISLANDS',
            'OH'=>'OHIO',
            'OK'=>'OKLAHOMA',
            'OR'=>'OREGON',
            'PW'=>'PALAU',
            'PA'=>'PENNSYLVANIA',
            'PR'=>'PUERTO RICO',
            'RI'=>'RHODE ISLAND',
            'SC'=>'SOUTH CAROLINA',
            'SD'=>'SOUTH DAKOTA',
            'TN'=>'TENNESSEE',
            'TX'=>'TEXAS',
            'UT'=>'UTAH',
            'VT'=>'VERMONT',
            'VI'=>'VIRGIN ISLANDS',
            'VA'=>'VIRGINIA',
            'WA'=>'WASHINGTON',
            'WV'=>'WEST VIRGINIA',
            'WI'=>'WISCONSIN',
            'WY'=>'WYOMING',
            'AE'=>'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST',
            'AA'=>'ARMED FORCES AMERICA (EXCEPT CANADA)',
            'AP'=>'ARMED FORCES PACIFIC'
        );

        $st = strtoupper(trim($st));
        $key = array_search($st, $us_state_abbrevs_names);

        return $key;
    }

    public function get_randomn($rnumber, $param){
        
        $lenghtstr = strlen($rnumber); 
        if ($param == 'minus') {
            $lenghtstr = $lenghtstr + 1;
        }
        switch ($lenghtstr) {
            case 1:
                $rdm = rand(100, 999);
                return $rdm;
                break;
            case 2:
                $rdm = rand(10, 99);
                return $rdm;
                break;
            case 3:
                $rdm = rand(1, 9);
                return $rdm;
                break;
        }
        
    }
}