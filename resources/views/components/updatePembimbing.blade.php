<script>
    $('#editPembimbing').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id = button.data('id')
      var nama = button.data('nama')
      var tlp = button.data('tlp')
      var username = button.data('username')
      var uid = button.data('uid')

      var modal = $(this)
      
      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #nama_lengkap').val(nama);
      modal.find('.modal-body #nama_pengguna').val(username);
      modal.find('.modal-body #tlp').val(tlp);
      modal.find('.modal-body #uid').val(uid);
    })
</script>