<?php
require('pdf/fpdf.php');
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
          //   $this->Cell(80);
            // $this->Cell(30,10,'Factura',1,0,'C');
             $this->Ln(20);
         }	
         function Footer(){
             $this->SetY(-39);
             $this->SetFont('Times','',14);
             $this->Cell(0,0,'Blvd. Jacarandas, 22 Calle 3-05 Zona 16, Lote 3 C.C. ',0,0,'R');
             $this->SetY(-33);
             $this->Cell(0,0,'Tel:(+502) 5519-2141 ',0,0,'R');
             $this->SetY(-27);
             $this->Cell(0,0,'Tel:(+502) 5519-2142  ',0,0,'R'); 
             $this->SetY(-21);
             $this->Cell(0,0,'Nit: 7873474-6  ',0,0,'R');
             $this->SetY(-15);
             $this->Cell(0,0,utf8_decode('Pág ').$this->PageNo(),0,0,'R');
         }
         function cabeceraHorizontal()
        {
        $this->SetXY(15, 80);
        $this->SetFillColor(48,64,133);//Fondo verde de morado
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        $this->SetFont('Times','',16);
        $this->Cell(140,8,utf8_decode('Descripción'),1,0,'C', true);
        $this->Cell(40,8,'Precio',1,1,'C', true);
        $this->SetTextColor(3, 3, 3);
    }

     }

    session_start();
    $nrecibo=$_SESSION['Nrecibo'];
    $total=$_SESSION['total'];
    $uservicios=$_SESSION['ubi_servicios'];
    $nit=$_SESSION['nit'];    
    $name=$_SESSION['name'];
    $Nfactura=$_SESSION['Nrecibo'];
    $c_cuenta=$_SESSION['c_cuenta'];
    $fecha = new DateTime();  
    $Date = $fecha->format("d/m/Y"); 
    $date2= $fecha->format("Y-m-d"); 
    $conn=cone();
    $día=$fecha->format("d"); 
    //asignación de descuento
    $pdf=new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Times','',14);
    $pdf->Cell(0,10,'No.Factura: '.$Nfactura,0,1);
    $pdf->Line(35,37,65,37);
    $pdf->Cell(0,10,utf8_decode('Nombre: '.$name),0,1);
    $pdf->Line(30,47,90,47);
    $pdf->Cell(0,10,'Nit: '.$nit,0,1);
    $pdf->Line(19,57,45,57);
    $pdf->Cell(0,10,'Fecha: '.$Date,0,1);
    $pdf->Line(25,67,49,67);
    $pdf->SetFont('Times','',14);
    $pdf->cabeceraHorizontal();
    $pdf->SetX(15);
    for ($i = 0; $i <6; $i++) 
    { //este for es para separar en arreglos cada servicio cancelado por alumnos
        ${"arr".strval($i+1)}=str_split($uservicios[$i]);
    }
    $sql="SELECT * FROM `datos_alumno` WHERE `Código_cuenta`='$c_cuenta'";//registros de la cuenta
    $r0=mysqli_query($conn,$sql);
    $cont=1;
    $pos=0;
    while($row=mysqli_fetch_array($r0))
    {   $pdf->SetX(15);
        if(intval($arr1[$pos])==0 && intval($arr2[$pos])==0 && intval($arr3[$pos])==0 && intval($arr4[$pos])==0 && intval($arr5[$pos])==0 && intval($arr6[$pos])==0 )//este es para ver si se le cancelo algún servicio al alumno o no
        { 
        } 
        else
        {
            $pdf->SetFont('Times','B',13);
            $pdf->Cell(140,6,utf8_decode('Servicios de '.$row['Nombres'].' '.$row['Apellidos']),1,0,'L');
            $pdf->Cell(40,6,'',1,1,'C');
        }
        $pdf->SetFont('Times','',14);  
        $pdf->SetX(15);
        if (intval($arr1[$pos])==$cont)
        {
            $pdf->Cell(140,6,utf8_decode('Internet y uso de laboratorios'),1,0,'L');
            $pdf->Cell(40,6,'Q.300',1,1,'C');
        }
        $pdf->SetX(15);
        if (intval($arr2[$pos])==$cont)
        {
            $pdf->Cell(140,6,utf8_decode('Servicio de Bus'),1,0,'L');
            $pdf->Cell(40,6,'Q.700',1,1,'C');
        }
        $pdf->SetX(15);
        if (intval($arr3[$pos])==$cont)
        {
            $pdf->Cell(140,6,utf8_decode('Excursión'),1,0,'L');
            $pdf->Cell(40,6,'Q.150',1,1,'C');
        }
        $pdf->SetX(15);
        if (intval($arr4[$pos])==$cont)
        {
            $pdf->Cell(140,6,utf8_decode('Campamento'),1,0,'L');
            $pdf->Cell(40,6,'Q.350',1,1,'C');
        }
        $pdf->SetX(15);
        if (intval($arr5[$pos])==$cont)
        {
            $pdf->Cell(140,6,utf8_decode('Almuerzos'),1,0,'L');
            $pdf->Cell(40,6,'Q.400',1,1,'C');
        }
        $pdf->SetX(15);
        if (intval($arr6[$pos])==$cont)
        {
            $pdf->Cell(140,6,utf8_decode('Colegiatura '),1,0,'L');
            $pdf->Cell(40,6,'Q.2500',1,1,'C');
        }
        $pos=$pos+1;
        $cont=$cont+1;
       // $pdf->Cell(150,5,utf8_decode('Servicios de: '$row['Nombres'].' '.$row['Apellidos']),1,0,'C');
    }
    $pdf->SetX(15);
    $sql2="SELECT * FROM `datos del cobro` WHERE `n_recibo`='$Nfactura'";//registros de la cuenta
    $r1=mysqli_query($conn,$sql2);
    $pdf->Cell(140,6,utf8_decode(''),1,0,'L');
    $pdf->Cell(40,6,'',1,1,'C');
    while($row=mysqli_fetch_array($r1))
    {   $pdf->SetX(15);
        $pdf->Cell(140,6,utf8_decode('SUBTOTAL '),0,0,'R');
        $pdf->Cell(40,6,'Q'.$row['subtotal'],1,1,'C');
        $pdf->SetX(15);
        $pdf->Cell(140,6,utf8_decode('DESCUENTO '),0,0,'R');
        $pdf->Cell(40,6,'Q'.$row['descuento'],1,1,'C');
        $pdf->SetX(15);
        $pdf->SetFont('Times','B',13);
        $pdf->Cell(140,6,utf8_decode('TOTAL '),0,0,'R');
        $pdf->Cell(40,6,'Q'.$row['Total'],1,1,'C');
    }
    ob_end_clean();
    $pdf->Output();
    $conn->close();
        
 
?>
