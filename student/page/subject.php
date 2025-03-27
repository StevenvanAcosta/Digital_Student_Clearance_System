<div class="container mt-5">
  <h2>Grade 11, 1st Term</h2>          
  <table id="kt_datatable_dom_positioning1" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <thead>
      <tr class="fw-bold fs-6 text-gray-800 px-7">
        <th>DESCRIPTION</th>
        <th>UNITS</th>
        <th>SCHEDULE</th>
        <th>PROCTOR</th>
        <th>REMARKS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Room 4-a1<br><span>General Mathematics</span></td>
        <td>3</td>
        <td>Monday<br><span>7:00 am - 10:30 am</span></td>
        <td>Ms. Naperi</td>
        <td>Face to Face</td>
      </tr>

      <tr>
        <td>Room 1-a6<br><span>Pre-Calculus</span></td>
        <td>3</td>
        <td>Monday<br><span>7:00 am - 10:30 am</span></td>
        <td>Mr. Atutubo</td>
        <td>Face to Face</td>
      </tr>

      <tr>
        <td>Room 2-a2 | abs-cbn-gma<br><span>Empowerment Technologies</span></td>
        <td>3</td>
        <td>Wednesday<br><span>7:00 am - 10:30 am</span></td>
        <td>Mrs. Dela Cruz</td>
        <td>Face to Face</td>
      </tr>

      <tr>
        <td>Room 2-a5 | gma-abs-cbn<br><span>Earth and Life Sciences</span></td>
        <td>3</td>
        <td>Wednesday<br><span>7:00 am - 10:30 am</span></td>
        <td>Mrs. Dimaculangan</td>
        <td>Face to Face</td>
      </tr>

      <tr>
        <td>Room 1-a1 | abs-cbn-gma<br><span>General Physics 1</span></td>
        <td>3</td>
        <td>Friday<br><span>7:00 am - 10:30 am</span></td>
        <td>Mr. Avendano</td>
        <td>Face to Face</td>
      </tr>

      <tr>
        <td>Room 1-a6 | abs-cbn-gma<br><span>General Biology 1</span></td>
        <td>3</td>
        <td>Friday<br><span>7:00 am - 10:30 am</span></td>
        <td>Mr. Payos</td>
        <td>Face to Face</td>
      </tr>

      <tr>
        <td>Room 3-a2 | abs-cbn-gma<br><span>Practical Reseach 1</span></td>
        <td>3</td>
        <td>Saturday<br><span>7:00 am - 10:30 am</span></td>
        <td>Mrs Tuazon</td>
        <td>Face to Face</td>
      </tr>
    </tbody>
  </table>
</div>


<br><br>

<div class="container mt-5">
  <h2>Grade 11, 2nd Term</h2>          
  <table id="kt_datatable_dom_positioning2" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
    <thead>
      <tr class="fw-bold fs-6 text-gray-800 px-7">
        <th>DESCRIPTION</th>
        <th>UNITS</th>
        <th>SCHEDULE</th>
        <th>PROCTOR</th>
        <th>REMARKS</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Room 4-a1<br><span>General Mathematics</span></td>
        <td>3</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td>Room 1-a6<br><span>Pre-Calculus</span></td>
        <td>3</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td>Room 2-a2 | abs-cbn-gma<br><span>Empowerment Technologies</span></td>
        <td>3</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td>Room 2-a5 | gma-abs-cbn<br><span>Earth and Life Sciences</span></td>
        <td>3</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td>Room 1-a1 | abs-cbn-gma<br><span>General Physics 1</span></td>
        <td>3</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td>Room 1-a6 | abs-cbn-gma<br><span>General Biology 1</span></td>
        <td>3</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>

      <tr>
        <td>Room 3-a2 | abs-cbn-gma<br><span>Practical Reseach 1</span></td>
        <td>3</td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>


<script>
function style1() {
  $("#kt_datatable_dom_positioning1").DataTable({
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

function style2() {
  $("#kt_datatable_dom_positioning2").DataTable({
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

setTimeout(style1, 50);
setTimeout(style2, 50);
</script>