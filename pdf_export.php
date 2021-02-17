<?php
	// database connection
	require('./inc/database_connection.php');

	// parameters
	if (isset($_GET['startingDate'])) {
		$startingDate = filter_var($_GET['startingDate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	if (isset($_GET['endingDate'])) {
		$endingDate = filter_var($_GET['endingDate'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	}

	if (isset($_GET['lastname'])) {
		$lastname = filter_var($_GET['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	} else {
		$lastname = null;
	}
	
	if (isset($_GET['firstname'])) {
		$firstname = filter_var($_GET['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	} else {
		$firstname = null;
	}

	if (isset($_GET['place'])) {
		$place = filter_var($_GET['place'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	} else {
		$place = null;
	}

	// choosing query 
	if ($place == null) {
		$query = "SELECT r.`date`,r.`time`,r.`lastname`,r.`firstname`,r.`email`,r.`phone`,p.`name` AS `place`
		FROM `register` AS r
		INNER JOIN `places` AS p
		ON p.`id` = r.`place_id`
		WHERE r.`lastname` = '$lastname'
		AND r.`firstname` = '$firstname'
		AND r.`date` BETWEEN '$startingDate' AND '$endingDate'
		ORDER BY r.`date` ASC;";
	} else {
		$query = "SELECT r.`date`, r.`time`, r.`lastname`, r.`firstname`, r.`email`, r.`phone`, p.`name` AS `place`
		FROM `register` AS r
		INNER JOIN `places` AS p
		ON p.`id` = r.`place_id`
		WHERE p.`name` = '$place'
		AND r.`date` BETWEEN '$startingDate' AND '$endingDate'
		ORDER BY r.`date` ASC;";
	}

	$stmt = $db->query($query);

	// FPDF call
	require('./inc/fpdf.php');

	class PDF extends FPDF {

		// Header
		function Header() {
			// logo
			// $this->Image('logo_nf_2018.png', 10, 10, 15, 15);
			// Title in helvetica bold 14
			$this->SetFont('Helvetica', 'B', '14');
			// horizontal position of the upper left corner
			$this->SetX(100);
			// width, height, text, border, new line, centered
			$this->Cell(97, 8, 'Nouvelle Forge - Registre des visites', 0, 1, 'C');
			// new line
			$this->Ln(10);
		}

		// Footer
		function Footer() {
			// 10mm from bottom
			$this->SetY(-10);
			// Helvetica italic 12
			$this->SetFont('Helvetica', 'I', 12);
			// page number
			$this->Cell(0, 8, utf8_decode('Nouvelle Forge, 80 Avenue Roland Moreno, 59410 Anzin, tél: 03 62 26 05 60 | ') . ' Page '.$this->PageNo().'/{nb}', 0, 0, 'R');
		}

	}

	// creating pdf object
	$pdf = new PDF('L', 'mm', 'A4');
	// adding new page
	$pdf->AddPage();
	// setting default font
	$pdf->SetFont('Helvetica', '', 11);
	// setting default color : black
	$pdf->SetTextColor(0);
	// page counter {nb}
	$pdf->AliasNbPages();

	// table header
	function table_header($position_header) {
		global $pdf;

		$pdf->SetFont('Helvetica', 'B', 12);	// Helvetica Bold 12
		$pdf->SetFillColor(73, 51, 137);			// background color
		$pdf->SetDrawColor(0, 0, 0);					// borders color
		$pdf->SetTextColor(255, 255, 255);		// text color

		$pdf->SetY($position_header);

		// column 1
		$pdf->SetX(10);
		$pdf->Cell(30, 8, utf8_decode('Date'), 1, 0, 'C', true); 

		// column 2
		$pdf->SetX(40); // 10 + 40
		$pdf->Cell(30, 8, utf8_decode('Heure'), 1, 0, 'C', true);

		// column 3
		$pdf->SetX(70); // 40 + 30
		$pdf->Cell(40, 8, utf8_decode('Nom'), 1, 0, 'C', true);

		// column 4
		$pdf->SetX(110); // 70 + 40
		$pdf->Cell(40, 8, utf8_decode('Prénom'), 1, 0, 'C', true);

		// column 5
		$pdf->SetX(150); // 110 + 40
		$pdf->Cell(60, 8, utf8_decode('E-mail'), 1, 0, 'C', true);

		// column 6
		$pdf->SetX(210); // 150 + 60
		$pdf->Cell(30, 8, utf8_decode('Téléphone'), 1, 0, 'C', true);

		// column 7
		$pdf->SetX(240); // 210 + 30
		$pdf->Cell(50, 8, utf8_decode('Lieu'), 1, 0, 'C', true);

		$pdf->Ln();

		$pdf->SetFont('Helvetica', '', 11);	// Helvetica Regular 11
		$pdf->SetFillColor(255, 255, 255);	// background color
		$pdf->SetDrawColor(0, 0, 0);				// borders color
		$pdf->SetTextColor(0, 0, 0);				// text color
	}

	table_header(20);

	$row_position = 28;
	$cpt = 0;
	while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
		
		if ($cpt > 19) {
			$cpt = 0;
			$row_position = 28;
			$pdf->AddPage();
			table_header(20);
		}

		$pdf->SetY($row_position);
		
		// column 1
		$pdf->SetX(10);
		$dateArray = explode('-', $result['date']);
		$date = $dateArray[2] . ' / ' . $dateArray[1] . ' / ' . $dateArray[0];
		$pdf->Cell(30, 8, utf8_decode($date), 1, 0, 'C', true); 

		// column 2
		$pdf->SetX(40); // 10 + 40
		$timeArray = explode(':', $result['time']);
		$time = $timeArray[0] . ' : ' . $timeArray[1];
		$pdf->Cell(30, 8, utf8_decode($time), 1, 0, 'C', true);

		// column 3
		$pdf->SetX(70); // 40 + 30
		$pdf->Cell(40, 8, utf8_decode($result['lastname']), 1, 0, 'C', true);

		// column 4
		$pdf->SetX(110); // 70 + 40
		$pdf->Cell(40, 8, utf8_decode($result['firstname']), 1, 0, 'C', true);

		// column 5
		$pdf->SetX(150); // 110 + 40
		$pdf->Cell(60, 8, utf8_decode($result['email']), 1, 0, 'C', true);

		// column 6
		$pdf->SetX(210); // 150 + 60
		$pdf->Cell(30, 8, utf8_decode($result['phone']), 1, 0, 'C', true);

		// column 7
		$pdf->SetX(240); // 210 + 30
		$pdf->Cell(50, 8, utf8_decode($result['place']), 1, 0, 'C', true);

		// adding cell height to cell position
		$row_position += 8;
		$cpt++;
	}

	if ($place == null) {
		$file_name = $startingDate . '_to_' . $endingDate . '_' . $lastname . '-' . $firstname . '.pdf';
	} else {
		$file_name = $startingDate . '_to_' . $endingDate . '_for_' . $place . '.pdf';
	}
	
	// display result of pdf
	$pdf->Output('I', $file_name);