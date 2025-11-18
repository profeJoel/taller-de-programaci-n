<?php
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=consultas.csv");

echo "Estado,Doctor,Fecha\n";
echo "Pendiente,Dra. Soto,2024-08-01\n";
echo "Resuelta,Dr. Reyes,2024-08-01\n";
echo "Pendiente,Dra. Soto,2024-08-02\n";
echo "Resuelta,Dra. Soto,2024-08-02\n";
echo "Cancelada,Dr. Reyes,2024-08-03\n";
echo "Pendiente,Dra. Soto,2024-08-03\n";
echo "Resuelta,Dr. Reyes,2024-08-04\n";
?>