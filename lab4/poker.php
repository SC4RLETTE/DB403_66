<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POKER</title>
    <style>
        .spades, .clubs{
            color: black;
        }
        .hearts, .diams{
            color: red;
        }
    </style>
</head>
<body> <?php
    $ranks = explode(',','A,2,3,4,5,6,7,8,9,10,J,Q,K');
    $suits = ['spades', 'clubs', 'hearts', 'diams'];
    $deck = [];
    foreach ($suits as $suit) {
        foreach ($ranks as $rank) {
            $deck[] = ['suit' => $suit,'rank' => $rank];
        }
        }
    function deal($deck){
        $tmp = rand(0,51);
        $c1 = $deck[$tmp];
        $cardA = "
        <span class='{$c1['suit']}'>
        {$c1['rank']}&{$c1['suit']};
        </span>";
        unset($deck[$tmp]);
        sort($deck);
        $c2 = $deck[rand(0, 50)];
        $cardB = "<span class='{$c2['suit']}'>{$c2['rank']}&{$c2['suit']};
        </span>";
        return $cardA.'+'.$cardB;
    }
    ?>
    <h1>ไพ่ที่ได้</h1>
    <h1>
        <?php echo deal($deck); ?>
    </h1>
</body>
</html>