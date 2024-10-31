<?php
namespace PerProduct\Api\Endpoints;

class WPRPP_Search_Products_Endpoint extends WPRPP_Abstract_Endpoint {

	public function callback( $data )
	{
		if (!isset($data['search'])) {
			$this->abort('[search] field is required');
		}

		$data['search'] = sanitize_text_field($data['search']);

		$args = [
			's'              => $data['search'],
			'post_type'      => 'product',
			'orderby'        => 'title',
			'posts_per_page' => 10
		];

		$query = new \WP_Query($args);
		$results = [];
		while ( $query->have_posts() ) {
			$query->the_post();
			$product = wc_get_product(intval($query->post->ID));
			$product_result = [
				'code'  => $product->get_id(),
				'label' => $product->get_name(),

			];

			$results[] = $product_result;
		}

		return $results;
	}

	public function action()
	{
		return 'per_product_search_products';
	}
}
