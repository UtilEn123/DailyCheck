<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $activity_am = $_POST['activity_am'];
    $activity_pm = $_POST['activity_pm'];
    $other_activities = $_POST['other_activities'];
    
    // กำหนดเวลาปัจจุบันสำหรับ record_time
    $record_time = date("Y-m-d H:i:s");

    // กำหนดโฟลเดอร์สำหรับอัปโหลดไฟล์
    $target_dir = "uploads/";

    // อัปโหลดรูปภาพสำหรับช่วงเช้า
    $image_am_filename = basename($_FILES["image_am"]["name"]);
    $target_file_am = $target_dir . $image_am_filename;
    if (!move_uploaded_file($_FILES["image_am"]["tmp_name"], $target_file_am)) {
        die("Failed to upload morning image.");
    }

    // อัปโหลดรูปภาพสำหรับช่วงบ่าย
    $image_pm_filename = basename($_FILES["image_pm"]["name"]);
    $target_file_pm = $target_dir . $image_pm_filename;
    if (!move_uploaded_file($_FILES["image_pm"]["tmp_name"], $target_file_pm)) {
        die("Failed to upload afternoon image.");
    }

    // เชื่อมต่อฐานข้อมูล MySQL
    $conn = new mysqli("localhost", "root", "", "daily_check");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ใช้ prepared statement เพื่อความปลอดภัยรวมทั้งบันทึก record_time
    $stmt = $conn->prepare("INSERT INTO records (firstname, lastname, activity_am, image_am, activity_pm, image_pm, other_activities, record_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssssssss", $firstname, $lastname, $activity_am, $target_file_am, $activity_pm, $target_file_pm, $other_activities, $record_time);

    // ทำการ execute และส่งผลลัพธ์ plain text กลับไปให้ AJAX 
    if ($stmt->execute()) {
        echo "บันทึกข้อมูลเรียบร้อย!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>