<!DOCTYPE html>
<html lang="en">
    <head>
    <title>
        Selectize Re-fill Demo
    </title>
    <link href="./js/selectize/dist/css/selectize.default.css" media="screen" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="./js/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="./js/selectize/dist/js/standalone/selectize.min.js"></script>

    </head>
    <body>
        <form method="post">

            <select name="province_id" id="province_id">
                <option value="0">--Select Province--</option>
                <option value="1">Jawa Barat</option>
                <option value="2">Jawa Tengah</option>
            </select>

            <select name="district" id="district">
                <option value="0">--Select District--</option>
            </select>

        </form>
    </body>

    <script type="text/javascript">
        $(document).ready(function() {
            //initialize selectize for both fields
            $("#province_id").selectize();
            $("#district").selectize();

            // onchange
            $("#province_id").change(function() {
                $.post('./change-data', { 'province_id' : $(this).val() } , function(jsondata) {
                    var htmldata = '';
                    var new_value_options   = '[';
                    for (var key in jsondata) {
                        htmldata += '<option value="'+jsondata[key].id+'">'+jsondata[key].name+'</option>';

                        var keyPlus = parseInt(key) + 1;
                        if (keyPlus == jsondata.length) {
                            new_value_options += '{text: "'+jsondata[key].name+'", value: '+jsondata[key].id+'}';
                        } else {
                            new_value_options += '{text: "'+jsondata[key].name+'", value: '+jsondata[key].id+'},';
                        }
                    }
                    new_value_options   += ']';

                    //convert to json object
                    new_value_options = eval('(' + new_value_options + ')');
                    if (new_value_options[0] != undefined) {

                        $("#district").html(htmldata);

                        var selectize = $("#district")[0].selectize;

                        selectize.clear();
                        selectize.clearOptions();
                        selectize.renderCache['option'] = {};
                        selectize.renderCache['item'] = {};

                        selectize.addOption(new_value_options);

                        selectize.setValue(new_value_options[0].value);
                    }

                }, 'json');
            });
        });
    </script>
</html>
