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
             $height=$h/4;
             $first=$height+2;
             $second=$height+$height+$height+3;
             $len=strlen($t);
             if($len>20)
             {
                 $txt=str_split($t,32);
                 $this->SetX($x);
                 $this->Cell(60,$first,$txt[0],'','','');
                 $this->SetX($x);
                 $this->Cell(60,$first+8,$txt[1],'','','');
                 $this->SetX($x);
                 $this->Cell(60,$first+16,$txt[2],'','','');
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
        $this->SetFont('Times','',13);
        $this->Cell(20,7,utf8_decode('Recibo'),1,0,'C', true);
        $this->Cell(15,7,utf8_decode('Cuenta'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Nit'),1,0,'C', true);
        $this->Cell(20,7,utf8_decode('Fecha'),1,0,'C', true);
        $this->Cell(60,7,utf8_decode('Servicios'),1,0,'C', true);
        $this->Cell(18,7,utf8_decode('Subtotal'),1,0,'C', true);
        $this->Cell(21,7,utf8_decode('Descuento'),1,0,'C', true);
        $this->Cell(18,7,utf8_decode('Total'),1,1,'C', true);
        $this->SetTextColor(3, 3, 3);
    }
}

        $orden=$_SESSION['orden'];
        $fecha1=$_SESSION['fecha1'];
        $fecha2=$_SESSION['fecha2'];
        $conn=cone();
        $pdf=new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Times','',14);
        $pdf->Cell(0,10,utf8_decode('Historial de pagos y cobros entre '.$fecha1.' y '.$fecha2),0,1);
        $pdf->SetFont('Times','',14);
        $pdf->cabeceraHorizontal();
        $w=45;
        $h=15;
        $registro="SELECT * FROM `datos del cobro` WHERE `fecha` BETWEEN '$fecha1'  AND '$fecha2'  ORDER BY `$orden` ";
        $r=mysqli_query($conn,$registro);
            while($row=mysqli_fetch_array($r))
                    {
                        $pdf->SetFont('Times','',11);
                        $x=$pdf->GetX();
                        $pdf->myCell(20,$h,$x,utf8_decode($row['n_recibo']));
                        $x=$pdf->GetX();
                        $pdf->myCell(15,$h,$x,utf8_decode($row['Código_cuenta']));
                        $x=$pdf->GetX();
                        $pdf->myCell(25,$h,$x,utf8_decode($row['nit']));
                        $x=$pdf->GetX();
                        $pdf->myCell(20,$h,$x,utf8_decode($row['fecha']));
                        $x=$pdf->GetX();
                        $pdf->myCell(60,$h,$x,utf8_decode($row['servicios']));
                        $x=$pdf->GetX();
                        $pdf->myCell(18,$h,$x,utf8_decode("Q.".$row['subtotal']));
                        $x=$pdf->GetX();
                        $pdf->myCell(21,$h,$x,utf8_decode("Q.".$row['descuento']));
                        $x=$pdf->GetX();
                        $pdf->myCell(18,$h,$x,utf8_decode("Q.".$row['Total']));
                        
                        $pdf->Ln();
                    }   
        ob_end_clean();
        $pdf->Output();
        //$_SESSION['fecha1']="T";
        $conn->close();
  
 
?>
