<?php
function trans_id($param='F') {
$dataMax = mysql_fetch_assoc(mysql_query("SELECT SUBSTR(MAX(no_trans),-5) AS Oid FROM transaksi"));
            if($dataMax['Oid']=='') { // bila data kosong
                $Order = $param.date("m").date("d")."00001";
            }else {
                $MaksOrder = $dataMax['Oid'];
                $MaksOrder++;
                if($MaksOrder < 10){ $Order = $param.date("m").date("d")."0000".$MaksOrder;} // nilai kurang dari 10
                else if($MaksOrder < 100){ $Order = $param.date("m").date("d")."000".$MaksOrder;} // nilai kurang dari 100
                else if($MaksOrder < 1000){ $Order = $param.date("m").date("d")."00".$MaksOrder;} // nilai kurang dari 1000
                else if($MaksOrder < 10000){ $Order = $param.date("m").date("d")."0".$MaksOrder;} // nilai kurang dari 10000
                else {$Order = $MaksOrder;} // lebih dari 10000
            }
            return $Order;
        }
?>