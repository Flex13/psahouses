
<footer>
    <div class="text-center small ">
        <p class="copyright">
            <?php
    ini_set('date.timezone', 'Africa/Harare');
    $startYear = 2020;
    $thisYear = date('Y');
    if ($startYear == $thisYear) {
      echo $startYear;
    } else {
      echo "{$startYear}-{$thisYear}";
    }
    ?>
            &copy; BukaniTech Solutions ----- All Rights Reserved</p>
        <div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<!-- footer date script-->


<script>
$(document).ready(function() {

    $('.button-psswd').on('click', function() {

        if ($('.input-psswd').attr('psswd-shown') == 'false') {

            $('.input-psswd').removeAttr('type');
            $('.input-psswd').attr('type', 'text');

            $('.input-psswd').removeAttr('psswd-shown');
            $('.input-psswd').attr('psswd-shown', 'true');

            $('.button-psswd').html('Hide');

        } else {

            $('.input-psswd').removeAttr('type');
            $('.input-psswd').attr('type', 'password');

            $('.input-psswd').removeAttr('psswd-shown');
            $('.input-psswd').attr('psswd-shown', 'false');

            $('.button-psswd').html('Show');

        }

    });

});
</script>


</body>

</html>

<?php
ob_end_flush( );
?>

<!--J query-->