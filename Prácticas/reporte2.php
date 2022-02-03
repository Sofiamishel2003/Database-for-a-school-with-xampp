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
                 $txt=str_split($t,30);
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
        $this->Cell(30,7,utf8_decode('Cod Alumno'),1,0,'C', true);
        $this->Cell(60,7,utf8_decode('Servicio'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Descuento'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Costo'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Total'),1,0,'C', true);
        $this->Cell(25,7,utf8_decode('Fecha'),1,1,'C', true);
        $this->SetTextColor(3, 3, 3);
    }
}

        $código=$_SESSION['codigo_r2'];
        $conn=cone();
        $pdf=new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Times','',14);
        $pdf->Cell(0,10,utf8_decode('Historial de cobros y pagos del alumno: '.$código),0,1);
        $pdf->SetFont('Times','',14);
        $pdf->cabeceraHorizontal();
        $w=45;
        $h=8;
        $registro="SELECT * FROM `datos_servicio` WHERE `Código_alumno`='$código'";
        $r=mysqli_query($conn,$registro);
        while($row=mysqli_fetch_array($r))
                    {
                        if($row["Código_servicio"]=="S1")
                        {
                            $servicio="Internet y uso de laboratorios";
                        }
                        if($row["Código_servicio"]=="S2")
                        {
                            $servicio="Servicio de Bus";
                        }
                        if($row["Código_servicio"]=="S3")
                        {
                            $servicio="Excursión";
                        }
                        if($row["Código_servicio"]=="S4")
                        {
                            $servicio="Campamento";
                        }
                        if($row["Código_servicio"]=="S5")
                        {
                            $servicio="Almuerzos";
                        }
                        if($row["Código_servicio"]=="S6")
                        {
                            $servicio="Colegiatura";
                        }
                        $pdf->SetFont('Times','',13);
                        $x=$pdf->GetX();
                        $pdf->myCell(30,$h,$x,utf8_decode($row['Código_alumno']));
                        $x=$pdf->GetX();
                        $pdf->myCell(60,$h,$x,utf8_decode($servicio));
                        $x=$pdf->GetX();
                        $pdf->myCell(25,$h,$x,utf8_decode("Q.".strval($row['costo']*$row['descuento'])));
                        $x=$pdf->GetX();
                        $pdf->myCell(25,$h,$x,utf8_decode("Q.".$row['costo']));
                        $x=$pdf->GetX();
                        $pdf->myCell(25,$h,$x,utf8_decode("Q.".strval($row["costo"]-($row['costo']*$row['descuento']))));
                        $x=$pdf->GetX();
                        $pdf->myCell(25,$h,$x,utf8_decode($row['fecha']));         
                        $pdf->Ln();
                    }   
        ob_end_clean();
        $pdf->Output();
        $conn->close();
  
 
?>
