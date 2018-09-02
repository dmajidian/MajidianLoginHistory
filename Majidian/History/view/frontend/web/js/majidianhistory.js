define([
    "jquery",
    "jquery/ui",
    "tablesorter"
], function ($) {
    "use strict";

    $.widget('mage.majidianhistory', {
        options: {},
        _create: function () {
            $("#checkall").click(function () {
                $(".checkoption").prop('checked', $(this).prop('checked'));
            });
            $(".checkoption").change(function(){
                if (!$(this).prop("checked")){
                    $("#checkall").prop("checked",false);
                }
            });
            $('.data-grid').tablesorter();
        }
    });

    return $.mage.majidianhistory;
});
