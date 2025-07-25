<?php
function rutTien ($soDu,$soTienRut){
    if ($soTienRut <=0){
        throw new InvalidArgumentException("Số tiền rút phải lớn hơn 0!"); // Throw: Chỉ ra exception 1
    }

    if ($soDu < $soTienRut){
        throw new Exception("Số dư không đủ để rút. Vui lòng thử lại!"); // Chỉ ra exception 2
    }

    return $soDu - $soTienRut;
}

$giaoDich = [ //Tạo array dữ liệu
    [100,40], // Case 1: Chạy thành công
    [50,60], // Case 2: Lỗi nhập liệu
    [50,-1], // Case 3: Lỗi logic
];

    foreach ($giaoDich as [$soDu,$soTienRut]){ // Nạp dữ liệu vào function và cho chạy vòng lặp duyệt qua từng case dữ liệu trong array
        try { // Chứa đoạn code có khả năng xuất hiện exception
            $soConLai = rutTien($soDu,$soTienRut);
            echo "Rút thành công. Số dư còn lại: ".$soConLai."<br>";
        }catch (InvalidArgumentException $e){ //Bát lỗi từ throw (1)
    echo 'Lỗi nhập liệu: ', $e->getMessage(), "<br>";
} catch (Exception $e){ // Bắt lỗi từ throw (2)
    echo 'Lỗi xử lý: ',$e->getMessage(), "<br>";

}  finally{ // Luôn chạy trong mọi case (Dù có throw hay ko)
    echo "Giải quyết xong exception!<br>";
}
}

