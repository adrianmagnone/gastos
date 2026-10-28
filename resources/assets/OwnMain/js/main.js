class Main
{
    static soloNumeros (selector) {
        
        document.querySelectorAll(selector).forEach(function(element) {
            element.addEventListener('keypress', function(event) {
                var code = event.keyCode || event.which;

                // Allow: backspace, delete, tab, escape, enter, decimal point, home, end and arrows.
                if ([46, 8, 9, 27, 13, 190].includes(code) || (code >= 35 && code <= 39)) {
                    return;
                }

                if (code >= 32 && (code < 48 || code > 57)) {
                    event.preventDefault();
                }
            });
        });
    
    }

    static evitarEnterEnvieForm (selector) {
        if (selector === undefined) {
            selector = 'input,select';
        }

        document.querySelectorAll(selector).forEach(function(element) {
            element.addEventListener('keypress', function(event) {
                return event.keyCode != 13;    
            });
        });
    }

    static imprimir () {
        if(window.print) 
            window.print();
        else
            console.log('Su navegador -o su configuración- no permite realizar impresiones');
    }
    
    static fechaValida(fecha) {

        if(fecha.length != 10 || fecha.substr_count('/') != 2) 
            return false;

        const f = fecha.split('/');
        
        f[0] = parseInt(f[0],10);
        f[1] = parseInt(f[1],10) - 1;
        f[2] = parseInt(f[2],10);
        
        const d = new Date(f[2], f[1], f[0]);
        
        return d.getDate() == f[0]  &&
               d.getMonth() == f[1] &&
               d.getFullYear() == f[2];
    }
}