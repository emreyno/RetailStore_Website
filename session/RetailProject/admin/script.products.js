
function fill(Value) {
    $('#search').val(Value);
    $('#display').hide();
 }
 $(document).ready(function() {
   
    $("#search").keyup(function() {
        var name = $('#search').val();
        if (name == "") {  
            $("#display").html("");

        }
        else {
            $.ajax({
                type: "POST",
                url: "search.php",
                data: {
                    search: name
                },
                success: function(html) {
                    $("#display").html(html).show();
                }
            });
        }
    });
 });