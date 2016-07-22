<?php
	include_once('Products.php');

	$product = new Products;
	$file_contents = $product->parseFile('products.csv');
	//echo "<pre>"; print_r($file_contents); exit();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<link rel="stylesheet" href="bootstrap.min.css" />
	<style type="text/css">
		tfoot {
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
		    <div class="col-lg-12">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>SKU</th>
							<th>Cost</th>
							<th>Price</th>
							<th>QTY</th>
							<th>Profit Margin</th>
							<th>Total Profit</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if ($file_contents['total_products'] == 0) {
								echo "<tr>";
								echo "<td colspan='6' style='text-align:center;'>No Products Available.</td>";
								echo "</tr>";
							} else {
								foreach ($file_contents['csv_content'] as $key => $value) {
									echo "<tr>";
									echo "<td>".$value['sku']."</td>";
									echo "<td>$ ".number_format($value['cost'], 2, ".", ",")."</td>";
									echo "<td>$ ".number_format($value['price'], 2, ".", ",")."</td>";
									
									if ($value['qty'] < 0) {
										echo "<td style='color:red;'>".$value['qty']."</td>";
									} else {
										echo "<td style='color:green;'>".$value['qty']."</td>";
									}

									if ($value['profit_margin'] < 0) {
										echo "<td style='color:red;'>$ ".number_format($value['profit_margin'], 2, ".", ",")."</td>";
									} else {
										echo "<td style='color:green;'>$ ".number_format($value['profit_margin'], 2, ".", ",")."</td>";
									}
									
									if ($value['total_profit'] < 0) {
										echo "<td style='color:red;'>$ ".number_format($value['total_profit'], 2, ".", ",")."</td>";
									} else {
										echo "<td style='color:green;'>$ ".number_format($value['total_profit'], 2, ".", ",")."</td>";
									}									
									echo "</tr>";
								}
							}
						?>
					</tbody>
					<tfoot>
						<tr>
							<td></td>
							<td>Average Cost : $ <?php echo number_format($file_contents['total_cost_avg'], 2, ".", ","); ?></td>
							<td>Average Price : $ <?php echo number_format($file_contents['total_price_avg'], 2, ".", ","); ?></td>
							<td>Total Qty : <?php echo $file_contents['total_qty']; ?></td>
							<td>Average Profit Margin : $ <?php echo number_format($file_contents['total_profit_margin_avg'], 2, ".", ","); ?></td>
							<td>Total Profit : $ <?php echo number_format($file_contents['total_profit'], 2, ".", ","); ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>		
</body>
</html>