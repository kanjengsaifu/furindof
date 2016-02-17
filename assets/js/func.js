    function dateShow(objReference)  
    {          
        $(objReference).datepicker('show');
    }  

    function inputFormatCurr(objSource) {
         a = $(objSource).val();
         //b = a.replace(/[^\d]/g, "");
         b = a.replace(/[^0-9,'.']/g,"");
         b = b.replace(/,/ig,"");

         c = "";
         strLength = b.length;
         j = 0;
         for (i = strLength; i > 0; i--) {
             j = j + 1;
             if (((j % 3) == 1) && (j != 1)) {
                 //c = b.substr(i - 1, 1) + "," + c;
                 c = b.substr(i - 1, 1) + "" + c;
             } else {
                 c = b.substr(i - 1, 1) + c;
             }
         }
         $(objSource).val(c);
    }
    
    function formatCurrency(amount, decimalSeparator, thousandsSeparator, nDecimalDigits){  
        var num = parseFloat( amount ); //convert to float  
        //default values  
        decimalSeparator = decimalSeparator || '.';  
        thousandsSeparator = thousandsSeparator || ',';  
        nDecimalDigits = nDecimalDigits == null? 2 : nDecimalDigits;  
      
        var fixed = num.toFixed(nDecimalDigits); //limit or add decimal digits  
        //separate begin [$1], middle [$2] and decimal digits [$4]  
        var parts = new RegExp('^(-?\\d{1,3})((?:\\d{3})+)(\\.(\\d{' + nDecimalDigits + '}))?$').exec(fixed);   
      
        if(parts){ //num >= 1000 || num < = -1000  
            return parts[1] + parts[2].replace(/\d{3}/g, thousandsSeparator + '$&') + (parts[4] ? decimalSeparator + parts[4] : '');  
        }else{  
            return fixed.replace('.', decimalSeparator);  
        }  
    }  

    function strToCurr(strCurrency) 
    {
        strNewValue = strCurrency.replace(/,/g, '');
        return parseInt(strNewValue);
    }
 
    $('[role="numeric"]').bind('keyup blur', function(e) 
    {
        e.preventDefault();
        inputFormatCurr($(this));
    });

    $(document).ready(function () 
    {
         $('[role="date"]').datepicker({
            format    : 'dd-mm-yyyy',
            autoclose : true
        });                
    });

    function numRows(objSource, colNo)
    {
        var table = objSource;
        for (i = 0; i < table.rows.length; i++)
        {
            table.rows[i].cells[colNo].innerHTML = i + 1;
        }
    }

    function clearGrid(objSource)
    {
        var table = objSource;
        for (i = 0; i < table.rows.length; i++)
        {
            table.deleteRow(i);
        }
    }