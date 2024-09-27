<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('fpdf.php');
require 'connection.php';

class PDF extends FPDF {
    // Page header
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Game Report', 0, 1, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(20, 10, 'ID', 1);
        $this->Cell(40, 10, 'Image', 1);
        $this->Cell(60, 10, 'Title', 1);
        $this->Cell(30, 10, 'Price', 1);
        $this->Cell(30, 10, 'Downloads', 1);
        $this->Cell(30, 10, 'Added Date', 1);
        $this->Ln();
    }

    // Page footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Create a new PDF instance
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Fetch game data from the database
$query = "SELECT p.id, p.title, p.price, p.datetime_added, pi.img_path, 
          (SELECT COUNT(*) FROM `invoice` WHERE `product_id` = p.id) as download_count
          FROM `product` p
          LEFT JOIN `product_img` pi ON p.id = pi.product_id";
$product_rs = Database::search($query);
if (!$product_rs) {
    die("Database query failed: " . Database::$connection->error);
}
$product_num = $product_rs->num_rows;

// Add data rows
for ($x = 0; $x < $product_num; $x++) {
    $selected_data = $product_rs->fetch_assoc();
    
    // Add a row for each game
    $pdf->Cell(20, 10, $selected_data['id'], 1);
    
    // Game Image
    if (!empty($selected_data['img_path'])) {
        $pdf->Cell(40, 30, $pdf->Image($selected_data['img_path'], $pdf->GetX() + 5, $pdf->GetY() + 5, 30, 20), 1);
    } else {
        $pdf->Cell(40, 30, 'No Image', 1);
    }
    
    // Other details
    $pdf->Cell(60, 30, $selected_data['title'], 1);
    $pdf->Cell(30, 30, 'Rs.' . $selected_data['price'], 1);
    $pdf->Cell(30, 30, $selected_data['download_count'], 1);
    $pdf->Cell(30, 30, $selected_data['datetime_added'], 1);
    $pdf->Ln();
}

// Output the PDF
$pdf->Output('D', 'game_report.pdf'); // 'D' for download, 'I' for inline display
?>
