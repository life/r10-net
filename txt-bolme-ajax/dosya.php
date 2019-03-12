<div class="icerik"></div>
<input name="tur" value="1" type="hidden">
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        var rakam = Number(10);
        $.ajaxLoad = function () {
            var kontrol = 'kontrol='+$("input[name='tur']").val();
            $.ajax({
                type: "GET",
                url: "ajax.php",
                data: kontrol,
                success: function(deger) {
                    $( ".icerik" ).append(deger);
 
                    var tur     =   $("input[name='tur']").val();
                    var toplam = parseInt(tur)+parseInt(rakam);
                    $( "input[name='tur']" ).val(toplam);
                }
 
            });
 
        };
        setInterval('$.ajaxLoad()', 5000 );
 
    });
</script>
