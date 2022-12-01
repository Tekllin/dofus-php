<?php
$sacrieur = 
[
    'pdv' => 150,
    'atk' => 20,
];
$bouftou =
[
    'pdv' => 200,
    'atk' => 8,
];
while ($sacrieur['pdv'] > 0 && $bouftou['pdv'] > 0) 
{
    echo "\n" . "\n" . "\n" . 'Mes PV : ' . $sacrieur['pdv'] . "\n" . 'Pv ennemie : ' . $bouftou['pdv'];
    $action = (int)readline("\n 1 : Attaquer \n 2 : Se soigner \n 3 : Abandonner");
    if ($action == 1) 
    {
        $bouftou['pdv'] = $bouftou['pdv'] - $sacrieur['atk'];
    };
    if ($action == 2) 
    {
        if ($sacrieur['pdv'] >= 140) 
        {
            $sacrieur['pdv'] = 150;
        } else {
            $sacrieur['pdv'] = $sacrieur['pdv'] + 15;
            $sacrieur['atk'] = $sacrieur['atk'] + (0.05 * $sacrieur['atk']) ;
        }   
    };
    if ($action == 3) 
    {
        $sacrieur['pdv'] = -1000;
    };
    if ($bouftou['pdv'] >= 100) 
    {
        $sacrieur['pdv'] = $sacrieur['pdv'] - $bouftou['atk'];
    } else {
        $soin = rand(1, 2);
        if ($soin == 1) 
        {
            $bouftou['pdv'] = $bouftou['pdv'] + ($bouftou['pdv'] * 0.4);
            $sacrieur['pdv'] = $sacrieur['pdv'] - $bouftou['atk'];
        } else {
            $bouftou['atk'] = $bouftou['atk'] + ( $bouftou['atk'] * 0.2 );
            $sacrieur['pdv'] = $sacrieur['pdv'] - $bouftou['atk'];
        }
    }
};
if ($sacrieur['pdv'] <= 0) 
{
    echo 'You Died';
} else {
    echo 'You Win';
}
