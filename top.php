<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table>

    <!-- Top scoreres -->
            <?php
            $filename = 'football.csv';

        if ($_GET['choice'] == 1) {
            $table = '<table>';
            $table.='<tr><th>Team</th><th>Scores</th></tr>';

            $fp = fopen($filename, "r");
            flock($fp, LOCK_SH);
            $headings = fgetcsv($fp, 0, "\t");
            while ($aLineOfCells = fgetcsv($fp, 0, ',')) {
            $records[] = $aLineOfCells;
            }
            flock($fp, LOCK_UN);
            fclose($fp);

            $newArr = [];

            // Scores
            foreach ($records as $record) {
                $newArr[$record[2]] = [
                    'scores' => 0,
                    'points' => 0
                ];
                $newArr[$record[4]] = [
                    'scores' => 0,
                    'points' => 0
                ];
                
            }

            foreach ($records as $record) {
              
                    $newArr[$record[2]]['scores'] += explode('-',$record[3])[0];

                    $newArr[$record[4]]['scores'] += explode('-',$record[3])[1];
          
            }


            arsort($newArr);


            $count = 1;

            foreach ($newArr as $key =>$value) {
                if ($count > 10){
                    break;
                }
                $count += 1;
                $table.='<tr><td>'.$key.'</td><td>'.$value['scores'].'</td></tr>';
            }

            $table .= '</table>';
                echo $table;
            }
    ?>

        <!-- Top leaders -->
        <?php
            $filename = 'football.csv';

        if ($_GET['choice'] == 2) {
            $table = '<table>';
            $table.='<tr><th>Team</th><th>Points</th></tr>';

            $fp = fopen($filename, "r");
            flock($fp, LOCK_SH);
            $headings = fgetcsv($fp, 0, "\t");
            while ($aLineOfCells = fgetcsv($fp, 0, ',')) {
            $records[] = $aLineOfCells;
            }
            flock($fp, LOCK_UN);
            fclose($fp);

            $newArr = [];

            // Scores
            foreach ($records as $record) {
                $newArr[$record[2]] = [
                    'scores' => 0,
                    'points' => 0
                ];
                $newArr[$record[4]] = [
                    'scores' => 0,
                    'points' => 0
                ];
                
            }

            foreach ($records as $record) {

                $scores = explode('-',$record[3]);

                if ($scores[0] > $scores[1]){
                    $newArr[$record[2]]['points'] += 3;

                } elseif ($scores[0] == $scores[1]) {
                    $newArr[$record[2]]['points'] += 1; 
                    $newArr[$record[4]]['points'] += 1;
                } else { 
                    $newArr[$record[4]]['points'] += 3;
                }
          
            }

            arsort($newArr);


            $count = 1;

            foreach ($newArr as $key =>$value) {
                if ($count > 10){
                    break;
                }
                $count += 1;
                $table.='<tr><td>'.$key.'</td><td>'.$value['points'].'</td></tr>';
            }

            $table .= '</table>';
                echo $table;
            }
    ?>
  
    </table>
</body>
</html>