<?php
require('pdf/fpdf.php');
session_start();
 function cone()
 {
     $servername="localhost";
     $username="root";
     $password="";
     $bd="aws";
     $con=mysqli_connect($servername,$username,$password,$bd);
     return $con;
}
     class PDF extends FPDF
     {
         function Header()
         {
             $this->Image('img/logo2.png',150,15,50);
             $this->Image('img/logo.png',125,4,23);
             $this->SetFont('Times','U',15);
             $this->Ln(20);
         }	
         function Footer(){
             $this->SetY(-39);
             $this->SetFont('Times','',14);
             $this->Cell(0,0,'Blvd. Jacarandas, 22 Calle 3-05 Zona 16, Lote 3 C.C. ',0,0,'R');
             $this->SetY(-31);
             $this->Cell(0,0,'Tel:(+502) 5519-2141 ',0,0,'R');
             $this->SetY(-27);
             $this->Cell(0,0,'Tel:(+502) 5519-2142  ',0,0,'R'); 
             $this->SetY(-15);
             $this->Cell(0,0,$this->PageNo(),0,0,'R');
         }
         function myCell($w,$h,$x,$t)
         {
             $height=$h/3;
             $first=$height+2;
             $second=$height+$height+$height+3;
             $len=strlen($t);
             if($len>15)
             {
                 $txt=str_split($t,18);
                 $this->SetX($x);
                 $this->Cell(60,$first,$txt[0],'','','');
                 $this->SetX($x);
                 $this->Cell(60,$first+8,$txt[1],'','','');
                 $this->SetX($x);
                 $this->Cell($w,$h,'','LTRB',0,'L',0);
             }
             else
             {
                $this->SetX($x);
                $this->Cell($w,$h,$t,'LTRB',0,'L',0);
             }

         }   
         
         function cabeceraHorizontal()
        {
        $this->SetFillColor(48,64,133);//Fondo verde de morado
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        $this->SetFont('Times','',14);
        $this->Cell(17,7,utf8_decode('Alumno'),1,0,'C', true);
        $this->Cell(17,7,utf8_decode('Cuenta'),1,0,'C', true);
        $this->Cell(40,7,utf8_decode('Nombres'),1,0,'C', true);
        $this->Cell(40,7,utf8_decode('Apellidos'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Nacimiento'),1,0,'C', true);
        $this->Cell(35,7,utf8_decode('Grado'),1,0,'C', true);
        $this->Cell(18,7,utf8_decode('Sección'),1,1,'C', true);
        $this->SetTextColor(3, 3, 3);
    }
}

        $código=$_SESSION['codigo_r1'];
        $conn=cone();
        $pdf=new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Times','',14);
        $pdf->Cell(0,10,utf8_decode('Datos del Alumno: '.$código),0,1);
        $pdf->SetFont('Times','',14);
        $pdf->cabeceraHorizontal();
        $w=45;
        $h=11;
        $registro="SELECT * FROM `datos_alumno` WHERE `Código_alumno`='$código' ORDER BY `Apellidos` ";
        $r=mysqli_query($conn,$registro);
            while($row=mysqli_fetch_array($r))
                    {
                        $pdf->SetFont('Times','',13);
                        $x=$pdf->GetX();
                        $pdf->myCell(17,$h,$x,utf8_decode($row['Código_alumno']));
                        $x=$pdf->GetX();
                        $pdf->myCell(17,$h,$x,utf8_decode($row['Código_cuenta']));
                        $x=$pdf->GetX();
                        $pdf->myCell(40,$h,$x,utf8_decode($row['Nombres']));
                        $x=$pdf->GetX();
                        $pdf->myCell(40,$h,$x,utf8_decode($row['Apellidos']));
                        $x=$pdf->GetX();
                        $pdf->myCell(25,$h,$x,utf8_decode($row['Fecha_N']));
                        $x=$pdf->GetX();
                        $pdf->myCell(35,$h,$x,utf8_decode($row['Grado']));
                        $x=$pdf->GetX();
                        $pdf->myCell(18,$h,$x,utf8_decode($row['Sección']));

                        
                        $pdf->Ln();
                    }   
        ob_end_clean();
        $pdf->Output();
        $conn->close();
  
 
?>
