<div class="container">
  <h2 class="m-5">October 17, 2024</h2>          
  <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded mt-3">
    <thead>
      <tr class="fw-bold fs-6 text-gray-800 px-7">
        <th>Notifications</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="mt-5"><h5>New Announcement from Admin</h5>Your CLearance has been posted, you can view now. <a href="#">click here</a><br>October 17, 2024, 6:30pm.</td>
        <td><i class="bi bi-trash me-5" style="font-size: 18px;"></i></td>
      </tr>

      <tr>
        <td class="mt-5"><h5>New Announcement from Admin</h5>You can’t view your Clearance due to your tuition balance. October 17, 2024, 1:30pm.</span></td>
        <td><i class="bi bi-trash me-5" style="font-size: 18px;"></i></td>
      </tr>
    </tbody>
  </table>
</div>


<script>
function style() {
  $("#kt_datatable_dom_positioning").DataTable({
    "language": {
      "lengthMenu": "Show _MENU_",
    },
    "dom":
      "<'row mb-2'" +
      "<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
      "<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
      ">" +

      "<'table-responsive'tr>" +

      "<'row'" +
      "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
      "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
      ">"
  });
}

setTimeout(style, 50);
</script>