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
					
					$a = 0.1;
					$r = 0.5 * sin($a * $it) + 0.5;
					$g = 0.5 * sin($a * $it + 2.094) + 0.5;
					$b = 0.5 * sin($a * $it + 4.188) + 0.5;
					
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