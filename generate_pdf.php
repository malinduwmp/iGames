<?php
require('fpdf.php'); // Include the FPDF library

// Extend FPDF class to create a custom PDF
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('logo.png', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Title
        $this->Cell(0, 10, 'Game Report', 0, 1, 'C');
        // Line break
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Create new PDF instance
$pdf = new PDF();
$pdf->AliasNbPages(); // Set alias for total number of pages

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', '', 12);

// Dummy data for the report
$gameTitle = 'Sample Game';
$gameDescription = 'This is a sample game description.';

// Output game information
$pdf->Cell(0, 10, 'Game Title: ' . $gameTitle, 0, 1);
$pdf->MultiCell(0, 10, 'Game Description: ' . $gameDescription);

// Output more content as needed
$pdf->Cell(0, 10, 'More content...', 0, 1);

// Output footer with date
$pdf->Cell(0, 10, 'Generated on: ' . date('Y-m-d H:i:s'), 0, 1);

// Output PDF as attachment (force download)
$pdf->Output('D', 'Game_Report.pdf');
?>
