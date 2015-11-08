
            $(document).ready(function() {
                $("#wizard").steps({
                    onStepChanging: function(event, currentIndex, newIndex){
                        var result = false;
                        
                        if (newIndex<currentIndex) {
                            result = true;
                        }else{
                            switch(currentIndex){
                            case 0:
                            //Comprobación en el primer paso
                             if (selectedTr === null) {
                                   alert("Seleccione un empleado para continuar");
                                   result = false;
                               }else{
                                   result = true;
                               };
                            break;

                            case 1:
                            //Comprobación en el segundo paso
                                

                                if (productsRegistered.length == 0) {
                                    alert("Debe agregar productos para poder continuar");
                                    result = false;
                                } else{
                                    result = true;
                                };
                            break;

                            default:
                                result = false; 
                            break;                           
                            };
                        };

                        return result;

                    },
                    onStepChanged: function(event, currentIndex, priorIndex){
                        if (currentIndex == 2) {
                            if (needProductionRegistry) {
                                    $('#productionRegistry').modal('show');
                            };
                        };
                    },
                    onFinishing: function(event, currentIndex){                
                        sendServiceOrder();
                        return true;                        
                    },
                    onFinished: function(event, currentIndex){
                        window.location.href = "http://localhost/Filomedios/public/nueva_orden_de_servicio"
                        //Cargar nuevamente la pagina o enviar a gestor de ordenes
                    }
                })
            });
        