(function($) {

  $(document).ready(function() {

    /**
     * Add button to delete duplicates next to delete logs
     */

    function addDeleteDuplicateButton() {
      var button = '<a href="' + red_dlm_ajax_url + '" class="add-new-h2 dlm-delete-duplicate-logs" data-nonce="' + red_dlm_nonce + '">Delete Duplicate Logs</a>';
      $('.dlm-delete-logs').after(button);
    }
    addDeleteDuplicateButton();

    $(document).on('click', '.dlm-delete-duplicate-logs', function(e) {
      e.preventDefault();
      $('body').addClass('lds-dual-ring');
      var nonce = $(this).attr('data-nonce');

      $.ajax({
         type : "post",
         // dataType : "json",
         url : red_dlm_ajax_url,
         data : { action: 'delete_all_duplicates', nonce: nonce },
         success: function(response) {
           $('body').removeClass('lds-dual-ring');
           response = JSON.parse(response);
            if (response.type == 'success') {
               location.reload();
            } else {
               alert('Error. Problem deleting duplicates.')
            }
         }
      });
    });


  });

})(jQuery);
