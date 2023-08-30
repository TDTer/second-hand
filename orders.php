<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<h1 style="margin-left:30%;">BÁN HÀNG</h1>
    <label for="price-filter" style="font-size: 1.6rem"><b>Nhập giá để lọc:</b></label>
<input type="number" id="price-filter" min="0" onchange="filterTable()">
<section id="banhang">
    <table id="product-table">
        <thead>
          <tr>
            <th>Checkbox</th>
            <th>Tên hàng hoá</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><input type="checkbox" onclick="checkStatus(this)"></td>
            <td>Đồng hồ</td>
            <td class="price">15000000 </td>
            <td><input type="number" min="0" onchange="calculateTotal()" class="quantity" disabled></td>
            <td><span id="total"></span></td>
          </tr>
          <tr>
            <td><input type="checkbox" onclick="checkStatus(this)"></td>
            <td>Túi xách</td>
            <td class="price">600000 </td>
            <td><input type="number" min="0" onchange="calculateTotal()" class="quantity" disabled></td>
            <td><span id="total"></span></td>
          </tr>
          <tr>
            <td><input type="checkbox" onclick="checkStatus(this)"></td>
            <td>Giày thể thao</td>
            <td class="price">300000 </td>
            <td><input type="number" min="0" onchange="calculateTotal()" class="quantity" disabled></td>
            <td><span id="total"></span></td>
          </tr>
          <tr>
            <td><input type="checkbox" onclick="checkStatus(this)"></td>
            <td>Dép sandal</td>
            <td class="price">100000 </td>
            <td><input type="number" min="0" onchange="calculateTotal()" class="quantity" disabled></td>
            <td><span id="total"></span></td>
          </tr>
          <tr>
            <td><input type="checkbox" onclick="checkStatus(this)"></td>
            <td>Áo sơ mi</td>
            <td class="price">150000 </td>
            <td><input type="number" min="0" onchange="calculateTotal()" class="quantity" disabled></td>
            <td><span id="total"></span></td>
          </tr>
          <tr>
            <td><input type="checkbox" onclick="checkStatus(this)"></td>
            <td>Váy liền</td>
            <td class="price">350000 </td>
            <td><input type="number" min="0" onchange="calculateTotal()" class="quantity" disabled></td>
            <td><span id="total"></span></td>
          </tr>
        </tbody>
        <tfoot>
            <tr>
              <th colspan="4">Tổng tiền:</th>
              <th><span id="grand-total"></span></th> 
            </tr> 
        </tfoot>
      </table>
</section>



<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>
<script>
function checkStatus(checkbox) {
  var quantity = checkbox.parentNode.parentNode.getElementsByTagName("input")[1];
  if (checkbox.checked) {
    quantity.removeAttribute("disabled");
  } else {
    quantity.setAttribute("disabled", "true");
  }
}

function calculateTotal() {
  var rows = document.getElementsByTagName("tr");
  var grandTotal = 0;
  for (var i = 1; i < rows.length; i++) {
    var row = rows[i];
    var quantityElement = row.getElementsByClassName("quantity")[0];
    if (quantityElement) {
  var quantity = Number(quantityElement.value);
  console.log(quantity);
} else {
  console.log(quantityElement.value);
  console.log("Quantity element not found");
    
}
    var price = Number(row.getElementsByClassName("price")[0].innerHTML);
    console.log(price);
    var total = quantity * price;
    row.getElementsByTagName("span")[0].innerHTML = total;
        grandTotal += total;
  }
  console.log(grandTotal);
  document.getElementById("grand-total").innerHTML = grandTotal;
}


function filterTable() {
  var priceFilter = document.getElementById("price-filter").value;
  var rows = document.getElementById("product-table").getElementsByTagName("tr");
  for (var i = 1; i <= rows.length; i++) {
    var row = rows[i];
    var price = Number(row.getElementsByClassName("price")[0].innerHTML);
    if (price > priceFilter) {
        row.style.display = "none";
    } else {
        row.style.display = "";
    }
  }
}

</script>
</body>
</html>