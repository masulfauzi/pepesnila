<?php

$fpdf = new Fpdf();

$fpdf->SetFont('Arial', 'B', 15);
$fpdf->AddPage("L", ['100', '100']);
$fpdf->Text(10, 10, "Hello World!");       
    
$fpdf->Output();