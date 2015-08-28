$(document).ready(function($, window, document, undefined){
    $("#months").on("change", function(){
       var date = new Date($("#start_date").val()),
           months = parseInt($("#months").val());
        
        if(!isNaN(date.getTime())){
            date.setMonth(date.getMonth() + months);
            
            $("#end_date").val(date.toInputFormat());
        } else {
       //     alert("Invalid Date");  
        }
    });
    
    
    //From: http://stackoverflow.com/questions/3066586/get-string-in-yyyymmdd-format-from-js-date-object
    Date.prototype.toInputFormat = function() {
       var yyyy = this.getFullYear().toString();
       var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
       var dd  = this.getDate().toString();
       return yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]); // padding
    };
})(jQuery, this, document);