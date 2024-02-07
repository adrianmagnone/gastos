(function($){
    "use strict";

    var defaults = {
        
    };

    var metodos = {
        init: function (opciones) {
            return this.each(function (method) {

                var settings = $.extend({}, defaults, opciones),
                    $this = $(this),
                    id = this.id;

                $('.steps > a[title]').tooltip();

                $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                    var target = $(e.target);
                
                    if (target.hasClass('disabled')) {
                        return false;
                    }
                });
            
                $(".next-step").click(function (e) {
            
                    var active = $('.step step-item a.active');
                    active.next().removeClass('disabled');
                    nextTab(active);
            
                });
                $(".prev-step").click(function (e) {
            
                    var active = $('.step step-item a.active');
                    prevTab(active);
            
                });

                $('.steps').on('click', 'a', function() {
                    $('.step-item a.active').removeClass('active');
                    $(this).addClass('active');
                });

            });
        },
    };

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }

    $.fn.MegaStep = function (method) {
        if (metodos[method]) {
            return metodos[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === "object" || !method) {
            metodos.init.apply(this, arguments);
        } else {
            $.error("El método " + method + " no existe en jQuery.MegaStep");
        }
    };
})(jQuery);