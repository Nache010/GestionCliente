(function() {
    let forms = document.querySelectorAll('.destroy');
    
    for (var i = forms.length - 1; i>=0; i--) {
        forms[i].addEventListener('click', function(event) {

            let confirmacion = confirm('¿Seguro qué desea borrar el producto?');
            if(!confirmacion){
                event.preventDefault();
            } 
        
        })
    }
        
})();