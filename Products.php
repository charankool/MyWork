<?php
	/**
	* Class to process csv file
	*/
	class Products {		
		/* class constructor */
		public function __construct() {}

		/* Method to parse given csv file */
		public function parseFile($file_path = NULL) {
			$final_arr = $csv_arr = $csv_content = array();
			$file = fopen($file_path, "r");
			while(! feof($file)) {
				if (is_array($tmp = fgetcsv($file))) {
					$csv_arr[] = $tmp;	
				}				
			}
			fclose($file);

			$sku_index = array_search('sku', $csv_arr[0]);
			$cost_index = array_search('cost', $csv_arr[0]);
			$price_index = array_search('price', $csv_arr[0]);
			$qty_index = array_search('qty', $csv_arr[0]);

			$total_cost = $total_price = $total_qty = $total_profit_margin = $total_profit = 0;
			$total_products = count($csv_arr)-1;
$final_arr['total_products'] = 0;
$final_arr['csv_content'] = 0;
$final_arr['total_cost_avg'] =0;
$final_arr['total_price'] =0;
$final_arr['total_price_avg'] =0;
$final_arr['total_qty'] =0;
$final_arr['total_profit_margin_avg'] =0;
$final_arr['total_profit'] =0;
			if ($total_products > 0) {
				foreach ($csv_arr as $key => $value) {
					if ($key != 0) {
						$total_cost += $value[$cost_index];
						$total_price += $value[$price_index];
						$total_qty += $value[$qty_index];
						$profit_margin = $value[$price_index] - $value[$cost_index];
						$total_profit_margin += $profit_margin;
						$total_profit_ar = $value[$qty_index] * $profit_margin;
						$total_profit += $total_profit_ar;

						$csv_content[] = array (
							'sku' => $value[$sku_index],
							'cost' => $value[$cost_index],
							'price' => $value[$price_index],
							'qty' => $value[$qty_index],
							'profit_margin' => $profit_margin,
							'total_profit' => $total_profit_ar
						);
					}
				}

				$final_arr['total_products'] = $total_products;
				$final_arr['csv_content'] = $csv_content;
				$final_arr['total_cost'] = $total_cost;
				$final_arr['total_cost_avg'] = $total_cost / $total_products;
				$final_arr['total_price'] = $total_price;
				$final_arr['total_price_avg'] = $total_price / $total_products;
				$final_arr['total_qty'] = $total_qty;
				$final_arr['total_profit_margin_avg'] = $total_profit_margin / $total_products;
				$final_arr['total_profit'] = $total_profit;
			}
			
			return $final_arr;
		}
	}
?>