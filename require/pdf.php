<?php

require('FPDF/fpdf.php');

class PDF extends FPDF {
    function header() {
        // Header Title
        $this->SetFont('Arial', 'B', 30);
        $this->SetTextColor(255, 193, 7);
        $this->Cell(0, 10, 'User Information', 0, 1, 'C');
        $this->Ln(10); // Line break
    }

    function footer() {
        // Page footer
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function chapterTitle($title) {
        // Chapter title
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 6, $title, 0, 1);
        $this->Ln(4); // Line break
    }

    function chapterText($text) {
        // Chapter text
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 10, $text);
        $this->Ln(); // Line break
    }

    function addUserDetails($firstName, $lastName, $email, $password, $address, $gender, $dob) {
        // Add user details section on the left
        $this->chapterTitle('User Information');

        $this->chapterText('First Name: ' . $firstName);
        $this->chapterText('Last Name: ' . $lastName);
        $this->chapterText('Email: ' . $email);
        $this->chapterText('Password: ' . $password);
        $this->chapterText('Address: ' . $address);
        $this->chapterText('Gender: ' . $gender);
        $this->chapterText('Date of Birth: ' . $dob);
    }
}




 ?>