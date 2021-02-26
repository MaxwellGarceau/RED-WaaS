<?php
class Red_Ajax {

  public function __construct( $args = array() ) {
    $this->callback = $args['callback'];
    $this->action = $args['action']; // Action in post request, also default selector to trigger click
    $this->nonce = $args['nonce'];
    $this->selector = isset( $args['selector'] ) ? $args['selector'] : '.' . $args['action'];
    // $this->javascript_callback = isset( $args['javascript_callback'] ) ? $args['javascript_callback'] : $this->javascript;

    $this->add_ajax_action();
  }

  public function get_callback() {
    return $this->callback;
  }

  public function get_nonce() {
    return $this->nonce;
  }

  public function get_action() {
    return $this->action;
  }

  public function get_selector() {
    return $this->selector;
  }

  // public function get_javascript_callback() {
  //   return $this->javascript_callback;
  // }

  public function javascript() {
    ob_start();
    ?>
    <script id="red-ajax-<?php echo $this->get_action(); ?>">
    jQuery(document).on('click', <?php echo $this->get_selector(); ?>, function(e) {
      e.preventDefault();
      // jQuery('body').addClass('lds-dual-ring');
      document.body.style.cursor = 'wait';
      var nonce = jQuery(this).attr('data-nonce');

      jQuery.ajax({
         type : 'post',
         // dataType : "json",
         url : <?php echo admin_url( 'admin-ajax.php' ); ?>,
         data : { action: <?php echo $this->get_action(); ?>, nonce: nonce },
         success: function(response) {
           // jQuery('body').removeClass('lds-dual-ring');
           document.body.style.cursor = 'default';
           response = JSON.parse(response);
            if (response.type == 'success') {
               location.reload();
            } else {
               alert('Error. Problem deleting duplicates.')
            }
         }
      });
    });
    </script>
  <?php
  echo ob_get_clean();
  }

  public function add_ajax_action() {
    add_action( 'wp_ajax_' . $this->get_action(), array( $this, 'handle_ajax_action' ) );
    add_action( 'wp_ajax_nopriv_' . $this->get_action(), array( $this, 'handle_ajax_action' ) );
    // add_action( 'wp_head', array( $this, 'get_javascript_callback' ) );
  }

  public function handle_ajax_action() {
    if ( ! wp_verify_nonce( $_REQUEST['nonce'], $this->get_action() ) ) {
      exit( 'No nonce found.' );
    }
    if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == $this->get_action() ) {
      $callback = $this->get_callback(); // Get callback string name
      $callback(); // Call the function
      $result['type'] = 'success';
    } else {
      $result['type'] = 'error';
    }
    $result = json_encode( $result );
    echo $result;
    die();
  }
}
