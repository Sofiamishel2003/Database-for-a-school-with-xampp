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
        $this->Cell(70,7,utf8_decode('Clase'),1,0,'C', true);
        $this->Cell(30,7,utf8_decode('Nota'),1,1,'C', true);
        $this->SetTextColor(3, 3, 3);
    }
}

        $cod=$_SESSION['codigo_r3'];
        $grado=$_SESSION['grado_r3'];
        $conn=cone();
        $pdf=new PDF();
        $busqueda_alumno="SELECT * FROM `datos_alumno` WHERE  `Código_alumno`='$cod'";// Buscar el registro que contiene el saldo actual
        $v1=mysqli_query($conn,$busqueda_alumno);
        while($row=mysqli_fetch_array($v1))
        {
          $name=$row['Nombres']; 
          $lastname=$row['Apellidos']; 
          $c_cu=$row['Código_cu']; 
          $grado=$row['Grado']; 
          $secii=$row['Sección']; 
        }
        $pdf->AddPage();
        $pdf->SetFont('Times','',14);
        $pdf->Cell(0,10,utf8_decode('Notas de '.$name.' '.$lastname),0,1);
        $pdf->Cell(0,10,utf8_decode('Del grado '.$grado),0,1);
        $pdf->Cell(0,10,utf8_decode('De la sección '.$secii),0,1);
        $pdf->SetFont('Times','',14);
        $pdf->Cell(30,7,"",0,1,'C');
        $pdf->cabeceraHorizontal();
        $w=45;
        $h=8;
        if($c_cu=="BAS01" or $c_cu=="BAS02" or $c_cu=="BAS03" )
        {   $tabla="basicos";
        }
        if($c_cu=="BACH01" or $c_cu=="BACH02" )
          {   $tabla="bachi_compu";
            }
        if($c_cu=="PE01" or $c_cu=="PE02" or $c_cu=="PE03")
            {   $tabla="bachi_perito";
            }
        if($c_cu=="BCCLL01" or $c_cu=="BCCLL02")
           {   $tabla="bachi_letras";
              }
        $registro="SELECT * FROM `$tabla` WHERE `Código_alumno`='$cod' ";
        $r=mysqli_query($conn,$registro);
        while($row=mysqli_fetch_array($r))
                    {
                        $pdf->SetFont('Times','',13);
                        if($c_cu=="BAS01" or $c_cu=="BAS02" or $c_cu=="BAS03" )
                        {
                        $pdf->Cell(70,7,utf8_decode('Matemáticas'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['matemáticas']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Lenguaje'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['lenguaje']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Sociales'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['sociales']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Ingles'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['ingles']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Artes'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['artes']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Biología'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['biología']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Química'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['química']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Tecnología'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['tecnología']),1,1,'C');
                        
                        }
                        if($c_cu=="BACH01" or $c_cu=="BACH02" )
                        {
                            if($c_cu=="BACH01")
                            {
                                $p1="Programación 1";
                                $c1="Computación 1";
                            }else{
                                $p1="Programación 2";
                                $c1="Computación 2";
                            }
                        $pdf->Cell(70,7,utf8_decode('Matemáticas'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['matemáticas']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Literatura'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['literatura']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Filosofía'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['filosofía']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Ingles'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['ingles']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Artes'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['artes']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode($c1),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['computación']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode($p1),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['programación']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Tecnología'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['tecnología']),1,1,'C');
                        
                        }
                        if($c_cu=="PE01" or $c_cu=="PE02" or $c_cu=="PE03")
                        {
                            if($c_cu=="PE01")
                            {
                              $c="Contabilidad 1";
                            }if($c_cu=="PE02"){
                              $c="Contabilidad 2";
                            }
                            if($c_cu=="PE03"){
                              $c="Contabilidad 3";
                              }
                        $pdf->Cell(70,7,utf8_decode('Matemáticas'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['matemáticas']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Literatura'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['literatura']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Filosofía'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['filosofía']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode($c),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['contabilidad']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Ingles'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['ingles']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Artes'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['artes']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Tecnología'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['tecnología']),1,1,'C');
                        
                        }
                        if($c_cu=="BCCLL01" or $c_cu=="BCCLL02" or $c_cu=="BCCLL03" )
                        {
                        $pdf->Cell(70,7,utf8_decode('Matemáticas'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['matemáticas']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Literatura'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['literatura']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Sociales'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['sociales']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Ingles'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['ingles']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Artes'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['artes']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Biología'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['biología']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Química'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['química']),1,1,'C');
                        $pdf->Cell(70,7,utf8_decode('Tecnología'),1,0,'L');
                        $pdf->Cell(30,7,utf8_decode($row['tecnología']),1,1,'C');
                        
                        }
                    }   
        ob_end_clean();
        $pdf->Output();
        $_SESSION['codigo_r3']="T";
        $conn->close();
  
 
?>
