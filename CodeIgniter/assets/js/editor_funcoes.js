
    
    //Converte conteudo de editor para pdf
    function pdfToHTML(){
        var pdf = new jsPDF('p', 'px', 'a4');
        var largura = pdf.internal.pageSize.width;    
        var height = pdf.internal.pageSize.height;
        //alert(height);
        //alert(largura);
        largura=largura-40;
        //alert(largura);
        source ="<!DOCTYPE html><html><head><title></title>";
        source +=" <style type='text/css'> </style>"
        source+= "</head> <body> <img src='<?php echo base_url('assets/imagens/logoGoverno.png');?>' height='120' width='420'>";

        source += CKEDITOR.instances['editor1'].getData();
        source += "</body></html>";
        // alert(source);
        
        specialElementHandlers = {
            '#bypassme': function(element, renderer){
                return true
            }
        }
        margins = {
            top: 20,
            left: 20,
            right: 20,
          
            width: largura
          };
        pdf.fromHTML(
            source // HTML string or DOM elem ref.
            , margins.left
            , margins.top 
            // y coord
            , {
                'width': margins.width // max width of content on PDF
                , 'elementHandlers': specialElementHandlers
            },
            function (dispose) {
                var e = document.getElementById("idTipo");
            
        var nome = e.options[e.selectedIndex].text;
                pdf.save(nome+'.pdf');
              }
          )     
    }
