<script>
  var admin_url = '<?php echo self_admin_url(); ?>';
  var countries = <?php echo json_encode($countries); ?>;
  var states = <?php echo json_encode($states); ?>;
  var per_product_shipping_nonces = <?php echo json_encode($nonce); ?>;
</script>


<div class="notice notice-warning inline">
    <p style="font-size: 14px;">
	<b>Note:</b>	After adding the rules, make sure to add the Per Product Shipping method to the <a href="<?php echo self_admin_url('admin.php?page=wc-settings&tab=shipping'); ?>">shipping zones</a>.
    </p>
</div>


<div id="per_product_app"></div>

<br><br>
<div class="wrap">
    <div id="col-container">
        <div id="col-right">
            <div class="col-wrap">
                <div class="postbox rss-postbox">
                    <h3 class="hndle"><span><i class="fa fa-wordpress"></i>&nbsp;&nbsp;WPRuby Blog</span></h3>
                    <hr>
                    <div class="inside">
                        <div class="rss-widget">
							<?php
							wp_widget_rss_output([
								'url' => 'https://wpruby.com/feed/',
								'title' => 'WPRuby Blog',
								'items' => 8,
								'show_summary' => 0,
								'show_author' => 0,
								'show_date' => 1,
							]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /col-wrap -->

        </div>
        <!-- /col-right -->

        <div id="col-left">

            <div class="col-wrap">
                <div class="postbox ">
                    <h3 class="hndle"><span><i class="fa fa-question-circle"></i>&nbsp;&nbsp;Plugin Support</span></h3>
                    <hr>
                    <div class="inside">
                        <div class="support-widget">
                            <p style="text-align: center;">
                                <img style="width:80%; max-width: 250px; max-height:100px;" src="https://wpruby.com/wp-content/uploads/2016/03/wpruby_logo_with_ruby_color-300x88.png">
                                <br/>
                                Got a Question, Idea, Problem or Praise?</p>
                            <ul>
                                <li>» <a href="https://wpruby.com/knowledgebase_category/woocommerce-per-product-shipping-pro/" target="_blank">Documentation and Common issues</a></li>
                                <li>» <a href="https://wpruby.com/plugins/" target="_blank">Our Plugins Shop</a></li>
                                <li>» If you like the plugin please leave us a <a target="_blank" href="https://wordpress.org/support/view/plugin-reviews/wc-per-product-shipping?filter=5#postform">★★★★★</a> rating.</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /col-wrap -->

        </div>
        <!-- /col-left -->

    </div>
    <!-- /col-container -->

</div> <!-- .wrap -->


<div class="clear"></div>


<style>
    #mainform .submit {
        display: none;
    }
</style>
