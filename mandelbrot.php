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
		
			function generate_color($r, $g, $b)
			{
				return padd_color(dechex(255 * $r)) . padd_color(dechex(255 * $g)) . padd_color(dechex(255 * $b));
			}
		
			function generate_color_string($r, $g, $b)
			{
				return '"#' . generate_color($r, $g, $b) . '"';
			}
		
			$sx = -3;
			$sy = -1;
			$ex = 2;
			$ey = 1;
			
			$max_it = 1024;
			$px_size = 0.02;
	
			echo '<table cellpadding="0" cellspacing="0">';
			
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
					
					$k = 0.1;
					$sin_effect = 0.5;
					$r = $sin_effect * sin($k * $it) + (1 - $sin_effect);
					$g = $sin_effect * sin($k * $it + 2) + (1 - $sin_effect);
					$b = $sin_effect * sin($k * $it + 4) + (1 - $sin_effect);
					
					$col = generate_color_string($r, $g, $b);
					
					echo "<td bgcolor=" . $col . ' style="color:#' . generate_color($r, $g, $b) . '">';
					
					echo "llll</td>";
				}
				echo "</tr>";
				echo "\n";
			}
			
			echo "</table>";
		?>
	</body>
</html>
