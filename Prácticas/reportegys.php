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
                 $txt=str_split($t,40);
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
        $this->Cell(19,7,utf8_decode('Alumno'),1,0,'C', true);
        $this->Cell(19,7,utf8_decode('Cuenta'),1,0,'C', true);
        $this->Cell(50,7,utf8_decode('Nombres'),1,0,'C', true);
        $this->Cell(50,7,utf8_decode('Apellidos'),1,0,'C', true);
        $this->Cell(19,7,utf8_decode('Sección'),1,0,'C', true);
        $this->Cell(30,7,utf8_decode('Nacimiento'),1,1,'C', true);
        $this->SetTextColor(3, 3, 3);
    }
}

        $seccion=$_SESSION['seccion-gys'];
        $grado=$_SESSION['grado-gys'];
        if  ($grado=="BAS01")
        {
        $grad="Primero Básico";
        }
        if  ($grado=="BAS02")
        {
        $grad="Segundo Básico";
        }
        if  ($grado=="BAS03")
        { 
        $grad="Tercero Básico";
        }
        if  ($grado=="BACH01")
        { 
        $grad="4to. Bachillerato en Computación";
        }
        if  ($grado=="BACH02")
        { 
        $grad="5to. Bachillerato en Computación";
        }
        if  ($grado=="PE01")
        {  
        $grad="4to. Perito Contador";
        }
        if  ($grado=="PE02")
        { 
        $grad="5to. Perito Contador";
        }
        if  ($grado=="PE03")
        { 
        $grad="6to. Perito Contador";
        }
        if  ($grado=="BCCLL01")
        {  
        $grad="4to. Bachillerato en ciencias y letras";
        }
        if  ($grado=="BCCLL02")
        {  
        $grad="5to. Bachillerato en ciencias y letras";
        }
        $conn=cone();
        $pdf=new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Times','',14);
        $pdf->Cell(0,10,utf8_decode('Alumnos del grado: '.$grad),0,1);
        $pdf->Cell(0,10,utf8_decode('Sección  '.$seccion),0,1);
        $pdf->SetFont('Times','',14);
        $pdf->cabeceraHorizontal();
        $w=45;
        $h=11;
        $registro="SELECT * FROM `datos_alumno` WHERE `Código_cu`='$grado' and `Sección`='$seccion' ORDER BY `Apellidos` ";
        $r=mysqli_query($conn,$registro);
        if(mysqli_num_rows($r)==0)
                  {
                    echo'<script language="javascript">alert("No hay alumnos en ese grado y sección");</script>';   
                  }
        
        else{
            while($row=mysqli_fetch_array($r))
                    {
                        $pdf->SetFont('Times','',13);
                        $x=$pdf->GetX();
                        $pdf->myCell(19,$h,$x,utf8_decode($row['Código_alumno']));
                        $x=$pdf->GetX();
                        $pdf->myCell(19,$h,$x,utf8_decode($row['Código_cuenta']));
                        $x=$pdf->GetX();
                        $pdf->myCell(50,$h,$x,utf8_decode($row['Nombres']));
                        $x=$pdf->GetX();
                        $pdf->myCell(50,$h,$x,utf8_decode($row['Apellidos']));
                        $x=$pdf->GetX();
                        $pdf->myCell(19,$h,$x,utf8_decode($row['Sección']));
                        $x=$pdf->GetX();
                        $pdf->myCell(30,$h,$x,utf8_decode($row['Fecha_N']));
                        $pdf->Ln();
                    }   
        }
        ob_end_clean();
        $pdf->Output();
        $_SESSION['seccion-gys']="T";
        $conn->close();
  
 
?>
