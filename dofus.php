<?php
$sacrieur = 
[
    'pdv' => 250,
    'atk' => 10,
    'soin' => 0.5,
];
$bouftou =
[
    'pdv' => 300,
    'atk' => 12,
];
$tour = 0;
$tourSoin = 0;
$tourAtk = 0;
$soin = 0;
while ($sacrieur['pdv'] > 0 && $bouftou['pdv'] > 0) 
{
    /*pa*/
    $pa = 6;
    echo "PA : $pa";
    /*affichage boost*/
    $compteurTourSoin = $tourSoin - $tour -1;
    $compteurTourAtk = $tourAtk - $tour -1;
    echo "\n \n \n \n \n ";
    $tour++;
    echo "tour $tour\n"; 
    if ($tourSoin <= $tour) {
        echo "Boost Soin : 0 tour\n";
    } else { 
        echo "Boost Soin : $compteurTourSoin tour\n";
    }
    if ($tourAtk <= $tour) {
        echo "Boost Attaque : 0 tour\n";
    } else { 
        echo "Boost Attaque : $compteurTourAtk tour\n";
    }
    /* paramettre boost */
    if ($tourSoin <= $tour) 
    {
        $sacrieur['soin'] = 0.5;
    } elseif ($sacrieur['soin'] < 0.70) {
        $sacrieur['soin'] = $sacrieur['soin'] + ($sacrieur['soin']*0.5);
    }
    if ($tourAtk <= $tour) 
    {
        $sacrieur['atk'] = 10;
    } elseif ($sacrieur['atk'] < 12) {
        $sacrieur['atk'] = $sacrieur['atk'] + 5;
    }
    echo "\n" . 'Mes PV : ' . $sacrieur['pdv'];
    $action = (int)readline("\n 1 : Attaquer\n 2 : Abandonner");
    switch ($action) {
        case 1:
            /*Liste de sort*/
            while ($pa > 0 && $sacrieur['pdv'] > 0 && $bouftou['pdv'] > 0) {
            echo "\n" . 'PV ennemie : ' . $bouftou['pdv'] . "\n";
            echo "PA : $pa";
            $sorts = (int)readline("\n \n1 : Hémorragie\n2 : Foudroiement de Grunob\n3 : Supplice\n4 : Epée Divine\n5 : Abandonner");
            switch ($sorts) {
                case 1:
                    /*hemoragie*/
                    $bouftou['pdv'] = $bouftou['pdv'] - (2.5* $sacrieur['atk']);
                    $sacrieur['pdv'] = $sacrieur['pdv'] - ($sacrieur['pdv']*0.1);
                    $pa = $pa - 3;
                    break;
                case 2:
                    /*grunob*/
                    $bouftou['pdv'] = $bouftou['pdv'] - (1.5* $sacrieur['atk']);
                    $tourSoin = $tour + 3; 
                    $pa = $pa -3;
                    break;
                case 3:
                    /*supplice*/
                    $bouftou['pdv'] = $bouftou['pdv'] - $sacrieur['atk'];
                    $sacrieur['pdv'] = $sacrieur['pdv'] + ($sacrieur['atk']*$sacrieur['soin']);
                    $pa = $pa - 3;
                    break;
                case 4;
                    /*divine*/
                    $bouftou['pdv'] = $bouftou['pdv'] - ($sacrieur['atk']*2);
                    $tourAtk = $tour + 3;
                    $pa = $pa - 3;
                    break;
                case 5:
                    $sacrieur['pdv'] = -1000;
                    break;
                default:
                    echo "\n \n \n Le bouftou à esquivé l'attaque !!!";
                    break;
            }
        }
            break;
        case 2:  
                $sacrieur['pdv'] = -1000;
             break;        
        default:
            echo "\n \n \n Le bouftou à esquivé l'attaque";
            break;
    }
    if ($bouftou['pdv'] <= 0) 
    {
        echo "\n\nYou Win";
        break;
    }
    if ($bouftou['pdv'] > 200) 
    {
        $sacrieur['pdv'] = $sacrieur['pdv'] - $bouftou['atk'];
    } elseif ($bouftou['pdv'] > 100) {
        
        if ($soin < $tour) 
        {
            $bouftou['pdv'] =$bouftou['pdv'] + ($bouftou['atk']*4);
            $sacrieur['pdv'] = $sacrieur['pdv'] - ($bouftou['atk']*4);
            $soin = $tour + 2;
        } else {
            $sacrieur['pdv'] = $sacrieur['pdv'] - ($bouftou['atk']*2);
        }
    } else {
        if ($soin < $tour) 
        {
            $bouftou['pdv'] =$bouftou['pdv'] + ($bouftou['atk']*5);
            $sacrieur['pdv'] = $sacrieur['pdv'] - ($bouftou['atk']*5);
            $soin = $tour + 2;
        } else {
            $sacrieur['pdv'] = $sacrieur['pdv'] - ($bouftou['atk']*3);
        }
    }
    if ($sacrieur['pdv'] <= 0) 
    {
        echo "\n\nYou Died";
        break;
    }
};