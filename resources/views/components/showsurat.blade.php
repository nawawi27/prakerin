<script>
    $('#surat').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var path = button.data('path')
      var newsrc = "{{asset('storage/')}}"

      var modal = $(this)
      
      modal.find('.modal-body #path').attr("src",newsrc +'/'+ path);
    })
</script>