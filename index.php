<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

    <div class="container">
        <h2></h2>

        <div class="form-group py-2">
            <label for="">Total Price</label>
            <input type="text" class="form-control" id="total_price" name="total_price" value="500.00">
        </div>

        <div class="form-group py-2">
            <label for="promo_code">Apply Promocode</label>
            <input type="text" class="form-control" id="coupon_code" placeholder="Apply Promocode" name="coupon_code">
            <b><span id="message" style="color:green;"></span></b>
        </div>

        <button id="apply" class="btn btn-default">Apply</button>
        <button id="edit" class="btn btn-default" style="display:none;">Edit</button>

    </div>


<script>
    $('#apply').click(function() {
        if ($('#promo_code').val() != '') {
            $.ajax({
                type: "POST",
                url: "process.php",
                data: {
                        coupon_code: $('#coupon_code').val()
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        var after_apply = $('#total_price').val() - dataResult.value;
                        $('#total_price').val(after_apply);
                        $('#apply').hide();
                        $('#edit').show();
                        $('#message').html("Promocode applied successfully !");
                    } else if (dataResult.statusCode == 201) {
                        $('#message').html("Invalid promocode !");
                    }
                }
            });
        } else {
            $('#message').html("Promocode can not be blank. Enter a Valid Promocode !");
        }
    });
    $('#edit').click(function() {
        $('#coupon_code').val("");
        $('#apply').show();
        $('#edit').hide();
        location.reload();
    });
</script>

</body>

</html>