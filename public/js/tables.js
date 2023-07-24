$(document).ready(function () {
  // Initialize DataTable for Employees Records table
  $('#employee_records').DataTable({
      "lengthMenu": 10,
      "lengthChange": false,
      "ordering": false
  });
});

$(document).ready(function () {
  $('#company_records').DataTable({
  "lengthMenu": 10,
  "lengthChange": false,
  "ordering": false
});
});