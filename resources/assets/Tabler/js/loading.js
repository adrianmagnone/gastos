(function ($) {
    'use strict';

    var metodos = {
        init: function (opciones) {
            return this.each(function (method) {

                let btnSubmit  = this,
                    spinSubmit = this.querySelector("span");

                btnSubmit.addEventListener("click", (event) => {
                    btnSubmit.classList.add("disabled");
            
                    spinSubmit.classList.remove("d-none");
                });

            });
        },

        activate: function () {
            let btnSubmit = this[0],
                spinSubmit = btnSubmit.querySelector("span");

            btnSubmit.classList.remove("disabled");
            spinSubmit.classList.add("d-none");
        }
        
    },

    autoinit = function () {
        $('[data-init="loading"]').each(function (index) {
            var $this = $(this);

            metodos.init.apply($this, {});
        });
    };

    $.fn.loading = function (method) {
        if (metodos[method]) {
            return metodos[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            metodos.init.apply(this, arguments);
        } else {
            $.error('El método ' + method + ' no existe en jQuery.Dates');
        }
    };

    autoinit();
})(jQuery);