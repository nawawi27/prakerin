<script>
    $('#editGrup').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var program = button.data('program')
      var kompetensi = button.data('kompetensi')
      var kelas = button.data('kelas')

      var modal = $(this)
      
      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #program_keahlian').val(program);
      modal.find('.modal-body #kompetensi_keahlian').val(kompetensi);
      modal.find('.modal-body #kelas').val(kelas);
    })
</script>