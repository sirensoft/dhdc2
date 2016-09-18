<?php
	function getNowDateFw() {
		$yy = date('Y');
		$mm = date('m');
		$dd = date('d', strtotime("+1 day"));
		return $dd.'/'.$mm.'/'.$yy;
	}

	function splitDate2Db($date) {
		list($dd, $mm, $yy) = split('[/.-]', $date);
		return $yy.'-'.$mm.'-'.$dd;
	}
	
	function thDate($date) {
		list($yy, $mm, $dd) = split('[/.-]',$date);
	
		if($dd=='01') { $dd='01'; }
		else if($dd=='02') { $dd='02'; }
		else if($dd=='03') { $dd='03'; }
		else if($dd=='04') { $dd='04'; }
		else if($dd=='05') { $dd='05'; }
		else if($dd=='06') { $dd='06'; }
		else if($dd=='07') { $dd='07'; }
		else if($dd=='08') { $dd='08'; }
		else if($dd=='09') { $dd='09'; }
	
		if($mm=='01') { $mm='มค'; }
		else if($mm=='02') { $mm='กพ'; }
		else if($mm=='03') { $mm='มีค'; }
		else if($mm=='04') { $mm='เมย'; }
		else if($mm=='05') { $mm='พค'; }
		else if($mm=='06') { $mm='มิย'; }
		else if($mm=='07') { $mm='กค'; }
		else if($mm=='08') { $mm='สค'; }
		else if($mm=='09') { $mm='กย'; }
		else if($mm=='10') { $mm='ตค'; }
		else if($mm=='11') { $mm='พย'; }
		else if($mm=='12') { $mm='ธค'; }
	
		$yy += 543;
		return "$dd $mm $yy";
	}
	
	function thDate3($date) { // ชนิดข้อมูล 0000-00-00 00:00:00
										//คืนค่าตัวอย่าง "27 ก.พ. 52 17:50:00"
		$tmp = explode(" ",$date);
		list($yy, $mm, $dd) = split('[/.-]',$tmp[0]);
	
		if($dd=='01') { $dd='1'; }
		else if($dd=='02') { $dd='2'; }
		else if($dd=='03') { $dd='3'; }
		else if($dd=='04') { $dd='4'; }
		else if($dd=='05') { $dd='5'; }
		else if($dd=='06') { $dd='6'; }
		else if($dd=='07') { $dd='7'; }
		else if($dd=='08') { $dd='8'; }
		else if($dd=='09') { $dd='9'; }
	
		if($mm=='01') { $mm='ม.ค.'; }
		else if($mm=='02') { $mm='ก.พ.'; }
		else if($mm=='03') { $mm='มี.ค.'; }
		else if($mm=='04') { $mm='เม.ย.'; }
		else if($mm=='05') { $mm='พ.ค.'; }
		else if($mm=='06') { $mm='มิ.ย.'; }
		else if($mm=='07') { $mm='ก.ค.'; }
		else if($mm=='08') { $mm='ส.ค.'; }
		else if($mm=='09') { $mm='ก.ย.'; }
		else if($mm=='10') { $mm='ต.ค.'; }
		else if($mm=='11') { $mm='พ.ย.'; }
		else if($mm=='12') { $mm='ธ.ค.'; }
	
		$yy += 543;
		//return "$dd $mm".substr($yy,-2)." | ".$tmp[1];
		return "$dd $mm ".$yy." เวลา ".$tmp[1]." น.";
	}
	function thDate4($date) { // ชนิดข้อมูล 0000-00-00 00:00:00
										//คืนค่าตัวอย่าง "27 ก.พ. 52 17:50:00"
		$tmp = explode(" ",$date);
		list($yy, $mm, $dd) = split('[/.-]',$tmp[0]);
	
		if($dd=='01') { $dd='1'; }
		else if($dd=='02') { $dd='2'; }
		else if($dd=='03') { $dd='3'; }
		else if($dd=='04') { $dd='4'; }
		else if($dd=='05') { $dd='5'; }
		else if($dd=='06') { $dd='6'; }
		else if($dd=='07') { $dd='7'; }
		else if($dd=='08') { $dd='8'; }
		else if($dd=='09') { $dd='9'; }
	
		if($mm=='01') { $mm='มกราคม'; }
		else if($mm=='02') { $mm='กุมภาพันธ์'; }
		else if($mm=='03') { $mm='มีนาคม'; }
		else if($mm=='04') { $mm='เมษายน'; }
		else if($mm=='05') { $mm='พฤษภาคม'; }
		else if($mm=='06') { $mm='มิถุนายน'; }
		else if($mm=='07') { $mm='กรกฎาคม'; }
		else if($mm=='08') { $mm='สิงหาคม'; }
		else if($mm=='09') { $mm='กันยายน'; }
		else if($mm=='10') { $mm='ตุลาคม'; }
		else if($mm=='11') { $mm='พฤศจิกายน'; }
		else if($mm=='12') { $mm='ธันวาคม'; }
	
		$yy += 543;
		//return "$dd $mm".substr($yy,-2)." | ".$tmp[1];
		return "$dd $mm พ.ศ.".$yy." เวลา ".$tmp[1]." น.";
	}
	function thDate5($date) { // ชนิดข้อมูล 0000-00-00 00:00:00
										//คืนค่าตัวอย่าง "27 ก.พ. 52 17:50:00"
		$tmp = explode(" ",$date);
		list($yy, $mm, $dd) = split('[/.-]',$tmp[0]);
	
		if($dd=='01') { $dd='1'; }
		else if($dd=='02') { $dd='2'; }
		else if($dd=='03') { $dd='3'; }
		else if($dd=='04') { $dd='4'; }
		else if($dd=='05') { $dd='5'; }
		else if($dd=='06') { $dd='6'; }
		else if($dd=='07') { $dd='7'; }
		else if($dd=='08') { $dd='8'; }
		else if($dd=='09') { $dd='9'; }
	
		if($mm=='01') { $mm='มกราคม'; }
		else if($mm=='02') { $mm='กุมภาพันธ์'; }
		else if($mm=='03') { $mm='มีนาคม'; }
		else if($mm=='04') { $mm='เมษายน'; }
		else if($mm=='05') { $mm='พฤษภาคม'; }
		else if($mm=='06') { $mm='มิถุนายน'; }
		else if($mm=='07') { $mm='กรกฎาคม'; }
		else if($mm=='08') { $mm='สิงหาคม'; }
		else if($mm=='09') { $mm='กันยายน'; }
		else if($mm=='10') { $mm='ตุลาคม'; }
		else if($mm=='11') { $mm='พฤศจิกายน'; }
		else if($mm=='12') { $mm='ธันวาคม'; }
	
		$yy += 543;
		//return "$dd $mm".substr($yy,-2)." | ".$tmp[1];
		return "$dd $mm ".$yy;
	}
	function thDate6($date) { // ชนิดข้อมูล 0000-00-00 00:00:00
										//คืนค่าตัวอย่าง "27 ก.พ. 52 17:50:00"
		$tmp = explode(" ",$date);
		list($yy, $mm, $dd) = split('[/.-]',$tmp[0]);
	
		if($dd=='01') { $dd='1'; }
		else if($dd=='02') { $dd='2'; }
		else if($dd=='03') { $dd='3'; }
		else if($dd=='04') { $dd='4'; }
		else if($dd=='05') { $dd='5'; }
		else if($dd=='06') { $dd='6'; }
		else if($dd=='07') { $dd='7'; }
		else if($dd=='08') { $dd='8'; }
		else if($dd=='09') { $dd='9'; }
	
		if($mm=='01') { $mm='01'; }
		else if($mm=='02') { $mm='02'; }
		else if($mm=='03') { $mm='03'; }
		else if($mm=='04') { $mm='04'; }
		else if($mm=='05') { $mm='05'; }
		else if($mm=='06') { $mm='06'; }
		else if($mm=='07') { $mm='07'; }
		else if($mm=='08') { $mm='08'; }
		else if($mm=='09') { $mm='09'; }
		else if($mm=='10') { $mm='10'; }
		else if($mm=='11') { $mm='11'; }
		else if($mm=='12') { $mm='12'; }
	
		$yy += 543;
		//return "$dd $mm".substr($yy,-2)." | ".$tmp[1];
		return "$dd/$mm/".$yy;
	}
        function chkDate($date){
            $oldYear=date('Y').'-09-30';
            if($date>$oldYear){
                $date = date('Y',strtotime('+1 year'));
            }else{
                $date = date('Y');
            }
            return $date;
        }
?>