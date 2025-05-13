<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Form</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<div class="container mt-5">
  <h2>User Information Form</h2>

  <form id="formId">
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name">
    </div>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email">
    </div>

    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter phone">
    </div>

    <div class="form-group">
      <label for="city">City:</label>
      <select class="form-control" id="city">
        <option value="">-- Select City --</option>
        <option value="Karachi">Karachi</option>
        <option value="Lahore">Lahore</option>
        <option value="Islamabad">Islamabad</option>
        <option value="Peshawar">Peshawar</option>
        <option value="Quetta">Quetta</option>
      </select>
    </div>

    <div class="form-group">
      <label for="country">Country:</label>
      <input type="text" class="form-control" id="country" placeholder="Enter country">
    </div>

    <div class="form-group">
      <label for="postal">Postal Code:</label>
      <input type="text" class="form-control" id="postal" placeholder="Enter postal code">
    </div>

    <button type="button" class="btn btn-primary" id="butsave">Submit</button>
  </form>

  <div id="success" class="alert alert-success mt-3" style="display:none;"></div>
</div>

<!-- Your existing jQuery AJAX code script here -->
<script>
    $(document).ready(function() {
  $('#butsave').on('click', function() {
      $("#butsave").attr("disabled", "disabled");
    var name = $('#name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var city = $('#city').val();
    if(name !== "" && email !== "" && phone !== "" && city !== ""){
        $.ajax({
            url: "save.php",
            type: "POST",
            data: {
              name: name,
              email: email,
              phone: phone,
              city: city
            },
            cache: false,
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode == 200){
                    $("#butsave").removeAttr("disabled");
                    $('#formId').find('input:text').val('');
                    $("#success").show();
                    $('#success').html('Data added successfully!');
                } else if(dataResult.statusCode == 201){
                    alert("Error occurred!");
                }
            }
        });
    } else {
        alert('Please fill all the field!');
    }
  });
});
</script>

</body>
</html>
