<?

$salario1 = 0;
$salario2 = 52;

for ($x = 0; $x <= 100; $x++) {
    ++$salario1;
    if($x === 49){
        break;
    } 
}

if ($salario1 < $salario2)
    echo "Salário 1 = $salario1"


?>