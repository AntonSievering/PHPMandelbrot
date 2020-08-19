<!DOCTYPE html>
<html>
	<head>
		<title>Mandelbrot</title>
	</head>

	<body>
		<?php
			function padd_color($v)
			{
				if (strlen($v) == 2) return $v;
				else return "0" . $v;
			}
		
			function generate_color($it, $max_it)
			{
				$k = 0.1;
				$sin_effect = 0.5;
				$r = $sin_effect * sin($k * $it) + (1.0 - $sin_effect);
				$g = $sin_effect * sin($k * $it + 2 / 3 * pi()) + (1.0 - $sin_effect);
				$b = $sin_effect * sin($k * $it + 4 / 3 * pi()) + (1.0 - $sin_effect);
					
				$r = round(255 * $r, 0);
				$g = round(255 * $g, 0);
				$b = round(255 * $b, 0);
					
				$r = max($r, 0);
				$g = max($g, 0);
				$b = max($b, 0);
				
				return padd_color(dechex($r)) . padd_color(dechex($g)) . padd_color(dechex($b));
			}
			
			function generate_color_2($it, $max_it)
			{
				$v = $it / $max_it;
				$v = 255 - round(255 * $v, 0);
				$p = padd_color(dechex($v));
				return $p . $p . $p;
			}
		
			$sx = -3;
			$sy = -1;
			$ex = 2;
			$ey = 1;
			
			$max_it = 1024;
			$px_size = 0.1;
	
			if (isset($_GET['sx']))
				$sx = $_GET['sx'];
			if (isset($_GET['sy']))
				$sy = $_GET['sy'];
			if (isset($_GET['ex']))
				$ex = $_GET['ex'];
			if (isset($_GET['ey']))
				$ey = $_GET['ey'];
			if (isset($_GET['max_it']))
				$max_it = $_GET['max_it'];
			if (isset($_GET['px_size']) && $_GET['px_size'] > 0)
				$px_size = $_GET['px_size'];
			
	
			echo '<table cellpadding="0" cellspacing="0">
';
			
			for ($y = $sy; $y <= $ey; $y += $px_size)
			{
				echo "<tr>";
				for ($x = $sx; $x <= $ex; $x += $px_size)
				{
					$zr = 0;
					$zi = 0;
					$it = 0;
					
					while ($zr * $zr + $zi * $zi < 1024.0 and $it < $max_it)
					{
						$znr = $zr * $zr - $zi * $zi + $x;
						$zni = 2 * $zr * $zi + $y;
						$zr = $znr;
						$zi = $zni;
						
						$it += 1;
					}
					
					$col = generate_color_2($it, $max_it);
					
					echo "<td bgcolor=" . $col . ' style="color:#' . $col . '">';
					
					echo "llll</td>";
				}
				echo "</tr>";
				echo "\n";
			}
			
			echo "</table>";
		?>
	</body>
</html>
