<?php
$menu = "report_p5"
?>
<?php include("header.php"); ?>

<?php
$query_my_order = "
SELECT DATE(o.order_date) AS sale_date, SUM(o.pay_amount) AS total_sales
FROM tbl_order AS o
WHERE o.order_status = 4
GROUP BY DATE(o.order_date)
ORDER BY sale_date DESC
LIMIT 10
"
or die ("Error : ".mysqli_error($query_my_order));

$rs_my_order = mysqli_query($condb, $query_my_order);
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <h1>Dashboard</h1>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="card card-gray">
    <div class="card-header ">
      <h3 class="card-title">ยอดขายต่อวัน</h3>
    </div>
    <br>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <table class="table" id="datatable">
            <thead>
              <tr>
                <th>วันที่ขายสินค้า</th>
                <th>ยอดขายต่อวัน</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($rs_my_order as $rs_order) {
                echo "<tr>";
                echo "<td>" . $rs_order['sale_date'] . "</td>";
                echo "<td>" . number_format($rs_order['total_sales'],2) . "</td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <!-- Footer content (ถ้ามี) -->
    </div>
  </div>
</section>
<!-- /.content -->

<?php include('footer2.php'); ?>

<script>
$(function () {
  $(".datatable").DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});
</script>

</body>
</html>
