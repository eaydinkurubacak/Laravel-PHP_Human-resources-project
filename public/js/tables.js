// Initialize the DataTable
$(document).ready(function () {
    $('#example').DataTable({
    // Set the pagination length menu
    // to the given allowed sizes
    "lengthMenu": 10,
    "lengthChange": false
  });
});